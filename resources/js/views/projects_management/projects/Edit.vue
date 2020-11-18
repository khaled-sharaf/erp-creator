<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-sm btn-dark"
                    :to="{name: 'home'}"
                    v-if="$can('profile-projects')"
                >
                    <i class="fas fa-eye"></i>
                    {{ $t('projects_table.view_project') }}
                </router-link>

                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'projects-profile', params: {id: $route.params.id}}"
                    v-if="$can('profile-projects')"
                >
                    {{ $t('global.show') + ' ' + $t('global.project_profile') }}
                    <i class="fas fa-eye"></i>
                </router-link>

            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <div class="wrapper-section-data">
                                <!-- row -->
                                <div class="row">
                                    <!-- title   ===  client_data -->
                                    <div class="col-12">
                                        <div class="form-title">
                                            <h3 class="text" v-text="$t('projects_table.client_data')"></h3>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->


                                    <!-- lead_id -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_id') }}</label>
                                            <div class="content" v-text="contract.lead.name"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- lead_phone -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_phone') }}</label>
                                            <div class="content" v-text="contract.lead.phone"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- lead_whatsapp_phone -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_whatsapp_phone') }}</label>
                                            <div class="content" v-text="contract.lead.whatsapp_phone"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_name -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_name') }}</label>
                                            <div class="content" v-text="contract.lead.company_name"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_scope -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_scope') }}</label>
                                            <div class="content" v-text="contract.lead.company_scope"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_email -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_email') }}</label>
                                            <div class="content" v-text="contract.lead.company_email"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- ads_amount -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('lead_contracts_table.ads_amount') }}</label>
                                            <div class="content">
                                                <div class="amount">
                                                    {{ contract.ads_amount }}
                                                    {{ $t('global.currency') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- contract_number -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('lead_contracts_table.id') }}</label>
                                            <div class="content">
                                                <div class="amount">
                                                    {{ contract.id }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                </div>
                                <!-- ./row -->
                            </div>
                            <!-- ./wrapper-section-data -->
                        </div>
                    </div>

                    <!-- form -->
                    <form @submit.prevent="updateProject()" class="global-form-handel">
                        <!-- card-body -->
                        <div class="card-body">
                            <form-model typeForm="edit" :form="form"></form-model>
                        </div>
                        <!-- ./card-body -->

                        <!-- card-footer -->
                        <div class="card-footer">
                            <btn-update :form="form"></btn-update>
                        </div> <!-- ./card-footer -->

                    </form>
                    <!-- form -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>
import FormModel from './Form'
import MixinChangeLocaleMessages from "./../../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/projectmanagement/projects',
        contract: {
            lead: {
                name: '',
                phone: '',
                whatsapp_phone: '',
                company_name: '',
                company_scope: '',
            },
            ads_amount: ''
        },
        form: new Form({
            id: '',
            designer_id: '',
            designer_deadline_days: '', // days number
            designer_deadline_hours: '', // hours number
            marketer_id: '',
            marketer_deadline_days: '', // days number
            marketer_deadline_hours: '', // hours number
            advertiser_id: '',
            advertiser_deadline_days: '', // days number
            advertiser_deadline_hours: '', // hours number

            addresses: [],
            phone_numbers: [],
            websites: [],
            emails: [],

            designs_count: '', // integer
            need_logo: false, // boolean
            logo_src: '', // file
            logo_ext: '', // file extension
            need_cover: false, // boolean
            need_profile: false, // boolean
            colors_favorite: null,
            design_info: '', // textarea
            gallery: [],
            deletedGallery: [],
            posts_type: {
                single: '',
                grouped: '',
                cover_post: ''
            },
            posts_count: '', // integer
            client_products: '', // textarea
            client_offers: '', // textarea
            competitors_links: null, // json
            sponsored_posts_count: '', // integer
            targeted_places: null, // json
            targeted_gender: {
                male: true,
                female: true
            }, // json
            targeted_age: {
                min: 13,
                max: 65
            }, // json
            days_count: '', // integer
            day_budget: '', // integer
            note: '',
            platforms: [],
            deletedPlatforms: [],

            designer_activated_at: null,
            marketer_activated_at: null,
            advertiser_activated_at: null,

            designer_accepted_at: null,
            marketer_accepted_at: null,
            advertiser_accepted_at: null,

            designer_progress: 0,
            marketer_progress: 0,
            advertiser_progress: 0,

            designer_done_at: null,
            marketer_done_at: null,
            advertiser_done_at: null,
        }),
        idPage: 'projects',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateProject() {
            loadReq(this.$Progress)

            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    this.getProjectEdit(this.$route)
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    // setTimeout(() => {
                    //     this.$router.push({name: 'projects'})
                    // }, 500)
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            })
        },
        getProjectEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const project = response.data.project
                    if (project != null) {
                        project.deletedPlatforms = []
                        project.deletedGallery = []
                        project.need_logo = project.need_logo == null ? false : project.need_logo
                        project.need_cover = project.need_cover == null ? false : project.need_cover
                        project.need_profile = project.need_profile == null ? false : project.need_profile
                        this.contract = project.contract
                        this.form.fill(project)
                    } else {
                        this.$router.push({name: 'projects'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getProjectEdit(this.$route)
                }, 1000)
            })
        },

        destroyModel() {
            this.$destroyRow(this.form.id, this.urlModel).then(() => {
                this.$router.push({name: 'projects'})
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.projects_management'), to: {name: 'projects_management-model'}},
            {label: this.$t('sidebar.projects'), to: {name: 'projects'}},
            {label: this.$t('sidebar.edit_project'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_project')
            vm.$nextTick(() => {
                vm.getProjectEdit(to)
            })
        })
    }
}
</script>
