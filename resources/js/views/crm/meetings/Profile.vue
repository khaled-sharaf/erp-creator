<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">

                <!-- btn craete meeting -->
                <a
                    v-if="modelData.deleted_at == null && modelData.lead != null && $can('create-meetings')"
                    class="btn btn-sm btn-info"
                    :href="$domain + 'crm/meetings/create'"
                    @click.prevent="showCreateMeetingModal(modelData.lead, modelData)"
                >
                    <i class="fas fa-user-friends"></i>
                    {{ $t('global.next_meeting') }}
                </a>
                <!-- ./btn craete meeting -->

                <!-- btn craete lead_contracts -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.lead != null && $can('create-lead_contracts')"
                    class="btn btn-sm btn-success"
                    :to="{name: 'lead_contracts-create', params: {id: modelData.id}}"
                >
                    <i class="fas fa-handshake"></i>
                    {{ $t('global.contract') }}
                </router-link>
                <!-- ./btn craete lead_contracts -->

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-meetings')" :model="modelData" :modelName="idPage"></btn-edit>
                <!-- ./btn edit row -->
            </template>
        </header-comp>

        <create-meeting-modal
            :data="currentDataCreateMeeting"
            :callBackFn="callBackAfterMeeting"
            urlModel="meetings"
        ></create-meeting-modal>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <!-- row -->
                            <div class="row">
                                <!-- col-md -->
                                <div class="col-12">

                                    <div class="row">

                                        <!-- title   ===  meeting_data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('meetings_table.meeting_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- created_by -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('meetings_table.created_by') }}</label>
                                                <div class="content">
                                                    <created-by :model="modelData.created_by_user" :modelName="'users-profile'"></created-by>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- date -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('meetings_table.date') }}</label>
                                                <div class="content">
                                                    <div class="ltr" v-html="moment(String(modelData.date)).format('MMM DD - hh:mm A')"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- address -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('meetings_table.address') }}</label>
                                                <div class="content" v-text="modelData.address"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- status -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('meetings_table.status') }}</label>
                                                <div class="content">
                                                    <span
                                                        v-if="modelData.id"
                                                        class="badge status-badge text-white"
                                                        :style="{'background-color': modelData.status != null ? meeting_statuses.find(status => status.value === modelData.status).color : '#333333'}"
                                                        v-text="modelData.status != null ? meeting_statuses.find(status => status.value === modelData.status).label : 'None'">
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- note -->
                                        <div class="col-12">
                                            <div class="profile-field-group">
                                                <label>{{ $t('meetings_table.note') }}</label>
                                                <div class="content" v-text="modelData.note"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- title   ===  lead_data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('meetings_table.lead_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- title   ===  lead profile -->
                                        <div class="col-12" v-if="modelData.lead != null">
                                            <router-link
                                                :to="{name: modelData.lead.type == 2 ? 'clients-profile' : 'leads-profile', params: {id: modelData.lead.id}}"
                                                class="btn btn-dark  btn-sm"
                                            >
                                                {{ $t('global.show') + ' ' + $t('global.lead_profile') }}
                                                <i class="fas fa-eye"></i>
                                            </router-link>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- name -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('leads_table.name') }}</label>
                                                <div class="content">
                                                    <span v-if="modelData.lead != null">{{ modelData.lead.name | capitalize }}</span>
                                                    <span class="badge badge-danger" v-else v-text="$t('global.model_is_deleted')"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3" v-if="modelData.lead != null">
                                            <div class="profile-field-group">
                                                <label>{{ $t('leads_table.phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.lead.phone">{{modelData.lead.phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- whatsapp_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3" v-if="modelData.lead != null">
                                            <div class="profile-field-group">
                                                <label>{{ $t('leads_table.whatsapp_phone') }}</label>
                                                <div class="content">
                                                    <a target="_blank" v-link-whatsapp="modelData.lead.whatsapp_phone">{{modelData.lead.whatsapp_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_address -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3" v-if="modelData.lead != null">
                                            <div class="profile-field-group">
                                                <label>{{ $t('leads_table.company_address') }}</label>
                                                <div class="content" v-text="modelData.lead.company_address"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_scope -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3" v-if="modelData.lead != null">
                                            <div class="profile-field-group">
                                                <label>{{ $t('leads_table.company_scope') }}</label>
                                                <div class="content" v-text="modelData.lead.company_scope"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- title   ===  metting-in-profile -->
                                        <div class="col-12" v-if="modelData.next_meetings.length">
                                            <!-- title   ===  next_meetings -->
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('meetings_table.next_meetings')"></h3>
                                            </div>
                                            <!-- =========================================================== -->
                                            <div class="metting-in-profile" v-for="(next_meeting, index) in modelData.next_meetings" :key="next_meeting.id">
                                                <div class="row">
                                                    <!-- date -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('meetings_table.date') }}</label>
                                                            <div class="content">
                                                                <div class="ltr" v-html="moment(String(next_meeting.date)).format('MMM DD - hh:mm A')"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- address -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('meetings_table.address') }}</label>
                                                            <div class="content" v-text="next_meeting.address"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- status -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('meetings_table.status') }}</label>
                                                            <div class="content">
                                                                <span class="status-badge-in-tabel">
                                                                    <span
                                                                        v-if="next_meeting.id"
                                                                        class="badge status-badge text-white"
                                                                        :class="{disabled: next_meeting.status == 'next_meeting' || next_meeting.status == 'done'}"
                                                                        @click="currentMenuStatus = currentMenuStatus == 0 || currentMenuStatus != next_meeting.id ? next_meeting.id : 0"
                                                                        :disabled="!$can('edit-meetings')"
                                                                        :style="{'background-color': next_meeting.status != null ? meeting_statuses.find(status => status.value === next_meeting.status).color : '#333333'}"
                                                                        v-text="next_meeting.status != null ? meeting_statuses.find(status => status.value === next_meeting.status).label : 'None'">
                                                                    </span>
                                                                    <div
                                                                        class="select-menu-inner in-profile"
                                                                        v-if="currentMenuStatus === next_meeting.id"
                                                                        >
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
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- note -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('meetings_table.note') }}</label>
                                                            <div class="content" v-text="next_meeting.note"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- edit -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-3" v-if="$can('edit-meetings')">
                                                        <div class="profile-field-group">
                                                            <router-link
                                                                class="btn btn-primary btn-sm"
                                                                :to="{name: 'meetings-edit', params: {id: next_meeting.id}}"
                                                            >
                                                                {{ $t('global.edit') }}
                                                                <i class="fas fa-edit"></i>
                                                            </router-link>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div><!-- ./metting-in-profile -->
                                    </div><!-- ./col -->
                                    <!-- ./row -->
                                </div><!-- ./col-md -->


                            </div><!-- ./row -->
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>
export default {
    data() {
      return {
        urlModel: '/crm/meetings',
        url_change_status: '/crm/meetings/change_status/',
        modelData: {
            next_meetings: [],
            lead: {
                name: "",
                phone: "",
                whatsapp_phone: "",
                company_address: "",
                company_scope: "",
            },
            date: "",
            address: "",
            status: "",
            note: ""
        },
        currentMenuStatus: 0,
        meeting_statuses: [
            {label: 'Done', value: 'done', color: '#27ae60'},
            {label: 'Next meeting', value: 'next_meeting', color: '#2980b9'},
            {label: 'Project delay', value: 'project_delay', color: '#8e44ad'},
            {label: 'Refused offer', value: 'refused_offer', color: '#2c3e50'},
            {label: 'Rejected', value: 'rejected', color: '#d63031'},
        ],


        idPage: 'meetings',
        breadcrumb: [],

        currentDataCreateMeeting: {}
      }
    },
    methods: {
        getMeeting(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const meeting = response.data.meeting
                    if (meeting != null && meeting.meeting_id == null) {
                        this.modelData = meeting
                    } else {
                        this.$router.push({name: 'meetings'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getMeeting(this.$route)
                }, 1000)
            })
        },

        changeMeetingStatus(index, status) {
            let meeting = this.modelData.next_meetings[index]
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

        callBackAfterMeeting() {
            this.getMeeting(this.$route)
        }
    },
    mounted() {
        // this.popupItem = document.getElementById('dataTable')
        // this.popupItem = document.querySelector('.metting-in-profile')
        this.getMeeting(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.meetings'), to: {name: 'meetings'}},
            {label: this.$t('sidebar.meeting_view'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getMeeting(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.meeting_view')
        })
    }
}
</script>
