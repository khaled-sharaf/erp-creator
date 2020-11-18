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

            <lead-statuses-select
                :getData="getData"
                :tableData="tableData"
                :lead_statuses="lead_statuses"
            ></lead-statuses-select>
        </template>

        <template slot="after-container">
            <create-meeting-modal
                :data="currentDataCreateMeeting"
                :callBackFn="getData"
                urlModel="meetings"
            ></create-meeting-modal>
        </template>

        <tbody>
            <tr
                role="row"
                v-for="(lead, index) in dataTable"
                :key="lead.id"
                :data-id="lead.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{lead.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="lead.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('created_by') != -1" class="created_by">
                    <created-by :model="lead.created_by_user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ lead.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('phone') != -1" class="phone">
                    <a :href="'tel:' + lead.phone">{{lead.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('whatsapp_phone') != -1" class="whatsapp_phone">
                    <a target="_blank" v-link-whatsapp="lead.whatsapp_phone">{{lead.whatsapp_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('assign_to') != -1" class="assign_to">
                    <created-by :model="lead.user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('email') != -1" class="email">
                    <a :href="'mailto:' + lead.email">{{lead.email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_name') != -1" class="company_name">
                    {{ lead.company_name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('id_cart') != -1" class="id_cart">
                    {{ lead.id_cart }}
                </td>

                <td v-show="tableData.columns.indexOf('company_phone') != -1" class="company_phone">
                    <a :href="'tel:' + lead.company_phone">{{lead.company_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_email') != -1" class="company_email">
                    <a :href="'mailto:' + lead.company_email">{{lead.company_email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_logo') != -1" class="company_logo" style="text-align:center;">
                    <img class="avatar-table" :src="$domain + lead.company_logo">
                </td>

                <td v-show="tableData.columns.indexOf('company_address') != -1" class="company_address">
                    {{ lead.company_address }}
                </td>

                <td v-show="tableData.columns.indexOf('company_scope') != -1" class="company_scope">
                    {{ lead.company_scope }}
                </td>

                <td v-show="tableData.columns.indexOf('lead_status_id') != -1" class="lead_status_id">
                    <span class="status-badge-in-tabel">
                        <span
                            class="badge status-badge text-white"
                            :style="{'background-color': lead.status != null ? lead.status.color : '#2fa360'}"
                            @click="currentMenuStatus = currentMenuStatus == 0 || currentMenuStatus != lead.id ? lead.id : 0"
                            >
                            <span class="text" v-text="lead.status != null ? lead.status.name : 'New'"></span>
                        </span>
                        <div class="select-menu-in-tabel" v-if="currentMenuStatus ===  lead.id" @click.self="hideMenuStatus">
                            <div
                                class="select-menu-inner"
                                v-if="currentMenuStatus === lead.id"
                                >
                                <div
                                    class="status"
                                    v-for="status in lead_statuses"
                                    @click.stop="changeLeadStatus(index, status)"
                                    :key="status.id"
                                >
                                    <span
                                        class="badge status-badge text-white"
                                        :style="{'background-color': status.color}"
                                        v-text="status.name"
                                    >
                                    </span>
                                </div>
                            </div>
                        </div>
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('note') != -1" class="note">
                    {{ lead.note }}
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="lead.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="lead"
                        :modelName="idPage"
                        @destroyRow="destroyRow(lead.id)"
                        @forceDeleteRow="forceDeleteRow(lead.id)"
                        @restoreRow="restoreRow(lead.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn craete meeting -->
                            <a
                                v-if="lead.deleted_at == null && lead.user != null && $can('create-meetings')"
                                class="dropdown-item text-info"
                                @click="showCreateMeetingModal(lead)"
                            >
                                <i class="fas fa-user-friends"></i>
                                {{ $t('global.meeting') }}
                            </a>
                            <!-- ./btn craete meeting -->

                            <!-- btn craete lead_contracts -->
                            <router-link
                                v-if="lead.deleted_at == null && lead.user != null && $can('create-lead_contracts')"
                                class="dropdown-item text-success"
                                :to="{name: 'lead_contracts-create', params: {id: lead.id}}"
                            >
                                <i class="fas fa-handshake"></i>
                                {{ $t('global.contract') }}
                            </router-link>
                            <!-- ./btn craete lead_contracts -->

                            <!-- btn craete quotations -->
                            <router-link
                                v-if="lead.deleted_at == null && lead.user != null && $can('create-quotations')"
                                class="dropdown-item text-secondary"
                                :to="{name: 'quotations-create', params: {id: lead.id}}"
                            >
                                <i class="fas fa-dollar-sign"></i>
                                {{ $t('sidebar.quotation') }}
                            </router-link>
                            <!-- ./btn craete quotations -->
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
        idPage: 'leads',
        urlGetDataTable: '/crm/leads',
        url_change_status: '/crm/leads/change_status/',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_at" },
            { label: "", name: "created_by" },
            { label: "", name: "name" },

            { label: "", name: "phone" },
            { label: "", name: "whatsapp_phone" },
            { label: "", name: "assign_to" },
            { label: "", name: "email" },
            { label: "", name: "id_cart" },

            { label: "", name: "company_name" },
            { label: "", name: "company_phone" },
            { label: "", name: "company_email" },
            { label: "", name: "company_logo" },
            { label: "", name: "company_address" },
            { label: "", name: "company_scope" },

            { label: "", name: "lead_status_id" },
            { label: "", name: "note" },

            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['assign_to', 'created_by', 'note', 'company_logo'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['company_logo', 'updated_at'],
        lead_statuses: [],
        currentMenuStatus: 0,
        currentDataCreateMeeting: {}
    };
  },

    methods: {
        changeLeadStatus(index, status) {
            loadReq(this.$Progress);
            this.dataTable[index].status = {...status}
            let leadId = this.dataTable[index].id
            axios.put(this.url_change_status + leadId, {status_id: status.id}).then(response => {
                if (response.status === 200) {
                    toastMsg.fire({
                        icon: 'success',
                        title: this.$t('messages.change_lead_status_success_msg')
                    });
                }
            }).catch(response => {
                toastMsg.fire({
                    icon: 'error',
                    title: this.$t('messages.change_lead_status_failed_msg')
                })
                this.$Progress.fail();
            })
            this.currentMenuStatus = 0
        },

        showCreateMeetingModal(lead) {
            this.currentDataCreateMeeting = {lead: lead}
            this.$nextTick(() => {
                $('#createMeetingModal').modal('show')
            })
        },

        hideMenuStatus() {
            this.currentMenuStatus = 0
        }
    },


  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'phone',
        'whatsapp_phone',
        'email',
        'id_cart',
        'company_name',
        'company_phone',
        'company_email',
        'company_logo',
        'company_address',
        'company_scope'
    ])
    this.tableData.created_by = ''
    this.tableData.lead_status_id = ''
    this.breadcrumb = [
        {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
        {label: this.$t('sidebar.leads'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_lead'), to: {name: this.idPage + '-create'}, viewIf: $can('create-leads')}

    this.excelFields = {
        [this.$t(this.idPage + '_table.assign_to')]: {
            field: 'user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.lead_status_id')]: {
            field: 'status',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.created_by')]: {
            field: 'created_by_user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
    }
    $getLeadStatuses().then(statuses => {
        this.lead_statuses = statuses
    })

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
          to.meta.title = vm.$t('sidebar.leads')
      })
  }
};
</script>

