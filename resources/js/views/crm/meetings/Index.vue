<template>
    <data-table
        :idPage="idPage"
        :showSettings="showSettings"
        :breadcrumb="breadcrumb"
        :btnCreate="btnCreate"
        :columns="columns"
        :themeTableClasses="viewTableClasses"
        :dataTable="dataTable"
        :tableData="tableData"
        :perPage="perPage"
        :successResponse="successResponse"
        :columnsView="tableData.columns"
        :columnsExcepted="tableData.filter.columnsExcept"
        :themeTableClassesFilter="tableData.filter.viewTable"
        :sortOrders="sortOrders"
        :pagination="pagination"
        :filters="filters"

        :toggleShowSettings="toggleShowSettings"
        :deleteResotreMulti="deleteResotreMulti"
        :getData="getData"

        :excelFields="excelFields"
        :excelFieldsExcepted="excelFieldsExcepted"
    >

        <template slot="more-filters">

            <created-by-select
                :getData="getData"
                :tableData="tableData"
                v-if="$can('admin-crm')"
            ></created-by-select>

            <meeting-statuses-select
                :getData="getData"
                :tableData="tableData"
            ></meeting-statuses-select>
        </template>

        <template slot="after-container">
            <create-meeting-modal
                :data="currentDataCreateMeeting"
                :getData="getData"
                urlModel="meetings"
            ></create-meeting-modal>
        </template>

        <tbody>
            <tr
                role="row"
                v-for="(meeting, index) in dataTable"
                :key="meeting.id"
                :data-id="meeting.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{meeting.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_by') != -1" class="created_by">
                    <created-by :model="meeting.created_by_user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="meeting.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('lead_name') != -1" class="lead_name">
                    <created-by v-if="meeting.lead != null" :model="meeting.lead" :modelName="meeting.lead.type == 2 ? 'clients-profile' : 'leads-profile'"></created-by>
                    <span class="badge badge-danger" v-else v-text="$t('global.model_is_deleted')"></span>
                </td>

                <td v-show="tableData.columns.indexOf('lead_phone') != -1" class="lead_phone">
                    <a v-if="meeting.lead != null" :href="'tel:' + meeting.lead.phone">{{meeting.lead.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('lead_whatsapp_phone') != -1" class="lead_whatsapp_phone">
                    <a v-if="meeting.lead != null" target="_blank" v-link-whatsapp="meeting.lead.whatsapp_phone">{{meeting.lead.whatsapp_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('assign_to') != -1" class="assign_to">
                    <router-link
                        v-if="meeting.lead.assign_to != null"
                        :to="{name: 'users-profile', params: {id: meeting.lead.user.id}}"
                    >
                        {{ meeting.lead.user.name }}
                    </router-link>
                </td>

                <td v-show="tableData.columns.indexOf('date') != -1" class="date">
                    <div class="ltr" v-html="moment(String(meeting.date)).format('MMM DD - hh:mm A')"></div>
                </td>

                <td v-show="tableData.columns.indexOf('address') != -1" class="address">
                    {{ meeting.address }}
                </td>

                <td v-show="tableData.columns.indexOf('status') != -1" class="status">
                    <span class="status-badge-in-tabel">
                        <span
                            class="badge status-badge text-white"
                            :class="{disabled: meeting.status == 'next_meeting' || meeting.status == 'done'}"
                            :style="{'background-color': meeting.status != null ? meeting_statuses.find(status => status.value === meeting.status).color : '#333333'}"
                            @click="currentMenuStatus = currentMenuStatus == 0 || currentMenuStatus != meeting.id ? meeting.id : 0"
                            :disabled="!$can('edit-meetings')"
                            >
                            <span class="text" v-text="meeting.status != null ? meeting_statuses.find(status => status.value === meeting.status).label : 'None'"></span>
                        </span>
                        <div class="select-menu-in-tabel" v-if="currentMenuStatus === meeting.id" @click.self="hideMenuStatus">
                            <div class="select-menu-inner">
                                <div
                                    class="status"
                                    v-for="status in meeting_statuses"
                                    @click.stop="changeMeetingStatus(index, status)"
                                    :key="status.value"
                                    v-show="status.value != 'next_meeting' && status.value != 'done'"
                                    >
                                    <span
                                        class="badge status-badge text-white"
                                        :style="{'background-color': status.color}"
                                        v-text="status.label"
                                        >
                                    </span>
                                </div>
                            </div>
                        </div>
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('meeting_id') != -1" class="meeting_id">
                    <div class="ltr" v-if="meeting.next_meetings.length" v-html="moment(String(meeting.next_meetings[0].date)).format('MMM DD - hh:mm A')"></div>
                </td>

                <td v-show="tableData.columns.indexOf('note') != -1" class="note">
                    {{ meeting.note }}
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="meeting.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="meeting"
                        :modelName="idPage"
                        @destroyRow="destroyRow(meeting.id)"
                        @forceDeleteRow="forceDeleteRow(meeting.id)"
                        @restoreRow="restoreRow(meeting.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn craete next meeting -->
                            <a
                                v-if="meeting.deleted_at == null && meeting.lead != null && $can('create-meetings')"
                                class="dropdown-item text-primary"
                                :href="$domain + 'crm/meetings/create/' + meeting.id"
                                @click.prevent="showCreateMeetingModal(meeting.lead, meeting)"
                            >
                                <i class="fas fa-user-friends"></i>
                                {{ $t('global.next_meeting') }}
                            </a>
                            <!-- ./btn craete next meeting -->

                            <!-- btn craete lead_contracts -->
                            <router-link
                                v-if="meeting.deleted_at == null && meeting.lead != null && $can('create-lead_contracts')"
                                class="dropdown-item text-success"
                                :to="{name: 'lead_contracts-create', params: {id: meeting.lead.id}}"
                            >
                                <i class="fas fa-handshake"></i>
                                {{ $t('global.contract') }}
                            </router-link>
                            <!-- ./btn craete lead_contracts -->
                        </template>
                    </menu-actions>
                </td>
            </tr>
        </tbody>
    </data-table>
</template>



<script>
import MixinsDatatable from "./../../../mixins/MixinsDatatable"
export default {
    mixins: [MixinsDatatable],
  data() {
    return {
        idPage: 'meetings',
        urlGetDataTable: '/crm/meetings',
        url_change_status: '/crm/meetings/change_status/',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_by" },
            { label: "", name: "created_at" },
            { label: "", name: "lead_name" },
            { label: "", name: "lead_phone" },
            { label: "", name: "lead_whatsapp_phone" },
            { label: "", name: "assign_to" },
            { label: "", name: "date" },
            { label: "", name: "address" },
            { label: "", name: "status" },
            { label: "", name: "meeting_id" },
            { label: "", name: "note" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['lead_name', 'lead_phone', 'lead_whatsapp_phone', 'created_by', 'note'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['updated_at', 'meeting_id'],
        currentMenuStatus: 0,
        meeting_statuses: [
            {label: 'Done', value: 'done', color: '#27ae60'},
            {label: 'Next meeting', value: 'next_meeting', color: '#2980b9'},
            {label: 'Project delay', value: 'project_delay', color: '#8e44ad'},
            {label: 'Refused offer', value: 'refused_offer', color: '#2c3e50'},
            {label: 'Rejected', value: 'rejected', color: '#d63031'},
        ],
        currentDataCreateMeeting: {}
    };
  },

    methods: {
        changeMeetingStatus(index, status) {
            let meeting = this.dataTable[index]
            this.currentMenuStatus = 0
            Swal.fire({
                title: this.$t('messages.reason_status'),
                text: this.$t('messages.change_meeting_status_to') + ' ( ' + status.label + ' )',
                inputValue: meeting.note,
                input: 'text',
                inputPlaceholder: this.$t('meetings_table.note'),
                icon: 'info',
                inputAttributes: {
                    autocapitalize: 'off'
                },
                showCancelButton: true,
                confirmButtonColor: "#38c172",
                cancelButtonColor: "#6d6d6d",
                confirmButtonText: this.$t('global.save'),
                cancelButtonText: this.$t('global.cancel')
            })
            .then(result => {
                let value = result.value ? result.value : '';
                const data = {
                    note: value,
                    status: status.value
                }
                if (!result.dismiss) {
                    loadReq(this.$Progress);
                    axios.put(this.url_change_status + meeting.id, data).then(response => {
                        if (response.status === 200) {
                            meeting.status = status.value
                            meeting.note = value
                            toastMsg.fire({
                                icon: 'success',
                                title: this.$t('messages.change_meeting_status_success_msg')
                            });
                        }
                    }).catch(response => {
                        toastMsg.fire({
                            icon: 'error',
                            title: this.$t('messages.change_meeting_status_failed_msg')
                        })
                        this.$Progress.fail();
                    })
                }
            });
        },
        hideMenuStatus() {
            this.currentMenuStatus = 0
        },

        showCreateMeetingModal(lead, meeting) {
            this.currentDataCreateMeeting = {
                lead: lead,
                meeting: meeting
            }
            this.$nextTick(() => {
                $('#createMeetingModal').modal('show')
            })
        },

    },


  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'address',
        'lead_name',
        'lead_phone'
    ])
    this.tableData.created_by = ''
    this.tableData.status = ''
    this.breadcrumb = [
        {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
        {label: this.$t('sidebar.meetings'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_meeting'), to: {name: this.idPage + '-create'}, viewIf: $can('create-meetings')}

    this.excelFields = {
        [this.$t(this.idPage + '_table.lead_name')]: {
            field: 'lead',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.lead_phone')]: {
            field: 'lead',
            callback: (value) => {
                return value != null ? value.phone : ''
            }
        },
        [this.$t(this.idPage + '_table.lead_whatsapp_phone')]: {
            field: 'lead',
            callback: (value) => {
                return value != null ? value.whatsapp_phone : ''
            }
        },
        [this.$t(this.idPage + '_table.created_by')]: {
            field: 'created_by_user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
    }
  },

  watch: {
      "dataTable.length"(newVale) {
        setTimeout(() => {
            this.popupItem = document.getElementById('dataTable')
        }, 500)
      }
  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.meetings')
      })
  }
};
</script>

