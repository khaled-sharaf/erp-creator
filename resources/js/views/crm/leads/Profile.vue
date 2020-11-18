<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">

                <!-- btn craete quotations -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.user != null && $can('create-quotations')"
                    class="btn btn-sm btn-secondary"
                    :to="{name: 'quotations-create', params: {id: modelData.id}}"
                >
                    <i class="fas fa-dollar-sign"></i>
                    {{ $t('sidebar.quotation') }}
                </router-link>
                <!-- ./btn craete quotations -->

                <!-- btn craete meeting -->
                <a
                    v-if="modelData.deleted_at == null && modelData.user != null && $can('create-meetings')"
                    class="btn btn-sm btn-info"
                    :href="$domain + 'crm/meetings/create'"
                    @click.prevent="showCreateMeetingModal(modelData)"
                >
                    <i class="fas fa-user-friends"></i>
                    {{ $t('global.meeting') }}
                </a>
                <!-- ./btn craete meeting -->

                <!-- btn craete lead_contracts -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.user != null && $can('create-lead_contracts')"
                    class="btn btn-sm btn-success"
                    :to="{name: 'lead_contracts-create', params: {id: modelData.id}}"
                >
                    <i class="fas fa-handshake"></i>
                    {{ $t('global.contract') }}
                </router-link>
                <!-- ./btn craete lead_contracts -->

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-leads')" :model="modelData" :modelName="idPage"></btn-edit>
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

                                <div class="col-md-3 col-xl-2 col-12">
                                    <div class="profile-image">
                                        <img :src="$domain + modelData.company_logo" alt="Company logo">
                                    </div>
                                </div><!-- ./col-md -->

                                <!-- col-md -->
                                <div class="col-md-9 col-xl-10 col-12">

                                    <div class="row">

                                        <!-- ================================= lead_data ================================= -->
                                        <div class="col-xl-6">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    <!-- title   ===  lead_data -->
                                                    <div class="col-12">
                                                        <div class="form-title">
                                                            <h3 class="text" v-text="$t('leads_table.lead_data')"></h3>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- name -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.name') }}</label>
                                                            <div class="content" v-text="modelData.name"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- phone -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.phone') }}</label>
                                                            <div class="content">
                                                                <a :href="'tel:' + modelData.phone">{{modelData.phone}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- whatsapp_phone -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.whatsapp_phone') }}</label>
                                                            <div class="content">
                                                                <a target="_blank" v-link-whatsapp="modelData.whatsapp_phone">{{modelData.whatsapp_phone}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- email -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{$t('leads_table.email')}}</label>
                                                            <div class="content">
                                                                <a :href="'mailto:' + modelData.email">{{modelData.email}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- id_cart -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.id_cart') }}</label>
                                                            <div class="content" v-text="modelData.id_cart"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>



                                        <!-- ================================= company_data ================================= -->
                                        <div class="col-xl-6">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    <!-- title   ===  company_data -->
                                                    <div class="col-12">
                                                        <div class="form-title">
                                                            <h3 class="text" v-text="$t('leads_table.company_data')"></h3>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_name -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.company_name') }}</label>
                                                            <div class="content" v-text="modelData.company_name"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_phone -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.company_phone') }}</label>
                                                            <div class="content">
                                                                <a :href="'tel:' + modelData.company_phone">{{modelData.company_phone}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_email -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{$t('leads_table.company_email')}}</label>
                                                            <div class="content">
                                                                <a :href="'mailto:' + modelData.company_email">{{modelData.company_email}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_address -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.company_address') }}</label>
                                                            <div class="content" v-text="modelData.company_address"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_scope -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.company_scope') }}</label>
                                                            <div class="content" v-text="modelData.company_scope"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->


                                                    <!-- title   ===  lead_settings -->
                                                    <div class="col-12">
                                                        <div class="form-title">
                                                            <h3 class="text" v-text="$t('leads_table.lead_settings')"></h3>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- assign_to -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.assign_to') }}</label>
                                                            <div class="content">
                                                                <created-by :model="modelData.user" :modelName="'users-profile'"></created-by>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- lead_status_id -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.lead_status_id') }}</label>
                                                            <div class="content">
                                                                <span
                                                                    v-if="modelData.status != null"
                                                                    class="badge status-badge text-white"
                                                                    :style="{'background-color': modelData.status.color}"
                                                                    v-text="modelData.status.name">
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- created_by -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.created_by') }}</label>
                                                            <div class="content">
                                                                <created-by :model="modelData.created_by_user" :modelName="'users-profile'"></created-by>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>




                                        <!-- ================================= location ================================= -->
                                        <div class="col-12">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    <!-- title   ===  location -->
                                                    <div class="col-12">
                                                        <div class="form-title">
                                                            <h3 class="text" v-text="$t('global.location')"></h3>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- location_map -->
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('global.location_map') }}</label>
                                                            <div class="content">
                                                                <div class="my-map" id="show_my_map" v-if="modelData.latitude != null && modelData.longitude != null">
                                                                    <div id="show_location_map"></div>
                                                                </div>
                                                                <div class="alert alert-info" v-else v-text="$t('global.no_location')"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>



                                        <!-- ================================= note ================================= -->
                                        <div class="col-12">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    <!-- note -->
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('leads_table.note') }}</label>
                                                            <div class="content" v-text="modelData.note"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
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
        urlModel: '/crm/leads',
        modelData: {
          name: "",
          phone: "",
          whatsapp_phone: "",
          email: "",
          id_cart: "",

          company_name: "",
          company_phone: "",
          company_email: "",
          company_logo: "",
          company_address: "",
          company_scope: "",
          latitude: "",
          longitude: "",

          assign_to: "",
          lead_status_id: "",
          note: ""
        },
        currentDataCreateMeeting: {},

        idPage: 'leads',
        breadcrumb: []
      }
    },
    methods: {
        getLead(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const lead = response.data.lead
                    if (lead != null && (lead.type == 0 || lead.type == 1)) {
                        this.modelData = lead
                        if (lead.latitude != null && lead.longitude != null) {
                            this.$showGoogleMap(lead.latitude,  lead.longitude)
                        }
                    } else {
                        this.$router.push({name: 'leads'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getLead(this.$route)
                }, 1000)
            })
        },

        showCreateMeetingModal(lead) {
            this.currentDataCreateMeeting = {lead: lead}
            this.$nextTick(() => {
                $('#createMeetingModal').modal('show')
            })
        },

        callBackAfterMeeting() {
            this.$router.push({name: 'leads'})
        }

    },
    mounted() {
        this.getLead(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.leads'), to: {name: 'leads'}},
            {label: this.$t('global.lead_profile'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getLead(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.lead_profile')
        })
    }
}
</script>
