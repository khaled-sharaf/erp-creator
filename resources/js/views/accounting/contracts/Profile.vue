<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                 <!-- btn create project -->
                <a
                    class="btn btn-primary btn-table-actions text-white btn-sm"
                    @click="createNewProject"
                    v-if="modelData.project == null && $can('create-projects')"
                >
                    {{ $t('projects_table.create_project') }}
                    <i class="fas fa-project-diagram"></i>
                </a>
                <!-- ./btn create project -->

                <!-- btn pdf -->
                <a
                    v-if="modelData.deleted_at == null && $can('download-pdf-lead_contracts')"
                    class="btn btn-danger text-white"
                    :href="$domain + 'contract/pdf/' + modelData.id"
                >
                    {{ $t('global.donwload') }}
                    PDF
                    <i class="fas fa-file-pdf"></i>
                </a>
                <!-- ./btn pdf -->

                <!-- btn pdf -->
                <a
                    v-if="modelData.deleted_at == null && $can('view-pdf-lead_contracts')"
                    class="btn btn-danger text-white"
                    :href="$domain + 'contract/pdf/' + modelData.secret_id + '/view'"
                    target="_blank"
                >
                    {{ $t('global.view') }}
                    PDF
                    <i class="fas fa-file-pdf"></i>
                </a>
                <!-- ./btn pdf -->

                <!-- btn invoice -->
                <a
                    v-if="modelData.deleted_at == null && $can('invoice-lead_contracts')"
                    class="btn btn-info text-white"
                    :href="$domain + 'invoice/pdf/' + modelData.secret_id + '/view'"
                    target="_blank"
                >
                    {{ $t('global.invoice') }}
                    <i class="fas fa-file-invoice"></i>
                </a>
                <!-- ./btn invoice -->

                <!-- btn payments -->
                <router-link
                    v-if="modelData.deleted_at == null && $can('payment-lead_contracts')"
                    class="btn btn-success text-white"
                    :to="{name: 'contracts-payments', params: {id: $route.params.id}}"
                >
                    {{ $t('global.payments') }}
                    <i class="far fa-credit-card"></i>
                </router-link>
                <!-- ./btn payments -->
                
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <!-- row -->
                            <div class="row">

                                <!-- ================================= lead_data ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">

                                            <!-- title   ===  lead_data -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.lead_data')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- name -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('leads_table.name') }}</label>
                                                    <div class="content" v-text="modelData.lead.name"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- job_title_lead -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.job_title_lead') }}</label>
                                                    <div class="content" v-text="modelData.job_title_lead"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- id_cart -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('leads_table.id_cart') }}</label>
                                                    <div class="content" v-text="modelData.lead.id_cart"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- company_name -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('leads_table.company_name') }}</label>
                                                    <div class="content" v-text="modelData.lead.company_name"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- company_scope -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('leads_table.company_scope') }}</label>
                                                    <div class="content" v-text="modelData.lead.company_scope"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>

                                <!-- ================================= sales_data ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  sales_data -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.sales_data')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- name -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.sales_name') }}</label>
                                                    <div class="content" v-text="modelData.personal_sales.name"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- id_cart -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.sales_id_cart') }}</label>
                                                    <div class="content" v-text="modelData.personal_sales.id_cart"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


                                <!-- ================================= contract_data ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  contract_data -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.contract_data')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- created_at -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.created_at') }}</label>
                                                    <div class="content" v-html="moment(String(modelData.created_at)).format('YYYY MMMM DD - hh:mm A')"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- created_by -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.created_by') }}</label>
                                                    <div class="content">
                                                        <created-by :model="modelData.created_by_user" :modelName="'users-profile'"></created-by>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- start_date -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.start_date') }}</label>
                                                    <div class="content" v-text="modelData.start_date"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- end_date -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.end_date') }}</label>
                                                    <div class="content" v-text="$endContractDate(modelData)"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- duration -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.duration') }}</label>
                                                    <div class="content">
                                                        {{ modelData.duration }}
                                                        {{ modelData.duration > 2 ? $t('global.months') : $t('global.month') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


                                <!-- ================================= services ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  services -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.services')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- services -->
                                            <div class="col-12" v-if="modelData.services.length">
                                                <div
                                                    class="row services-in-profile"
                                                    v-for="service in modelData.services"
                                                    :key="service.id">
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <div class="content">
                                                                <div class="name">
                                                                    {{ service.original_services.name }}
                                                                </div>
                                                                <div class="amount">
                                                                    {{ service.amount }}
                                                                    {{ $t('global.currency') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


                                <!-- ================================= contract_payments ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  contract_payments -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.contract_payments')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- services_amount -->
                                            <!-- <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.services_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount">
                                                            {{ modelData.services_amount }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- =========================================================== -->

                                            <!-- taxes -->
                                            <!-- <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.taxes') }}</label>
                                                    <div class="content">
                                                        {{ modelData.tax }}%
                                                        <div class="amount">
                                                            {{ parseInt(modelData.services_amount * (modelData.tax / 100)) }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- =========================================================== -->

                                            <!-- total_amount -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.total_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount">
                                                            {{ modelData.total_amount }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- sales_commission -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.sales_commission') }}</label>
                                                    <div class="content">
                                                        <span v-if="modelData.personal_sales_commission != null">
                                                            <span class="badge badge-primary">
                                                                {{ modelData.personal_sales_commission.commission + '%' }}
                                                            </span>
                                                            <span class="amount">
                                                                {{ parseInt(modelData.profit_company * (modelData.personal_sales_commission.commission / 100)) }}
                                                                {{ $t('global.currency') }}
                                                            </span>
                                                        </span>
                                                        <span v-else class="badge badge-danger">
                                                            {{ $t('global.undefined') }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- profit_company -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.profit_company') }}</label>
                                                    <div class="content">
                                                        <div class="amount" v-if="modelData.profit_company != null">
                                                            <!-- {{ parseInt(modelData.profit_company) + parseInt(modelData.profit_company * (modelData.tax / 100)) }} -->
                                                            {{ modelData.profit_company }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- ads_amount -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.ads_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount" v-if="modelData.profit_ads != null">
                                                            <!-- {{ parseInt(modelData.profit_ads) + parseInt(modelData.profit_ads * (modelData.tax / 100)) }} -->
                                                            {{ modelData.profit_ads }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- paid_amount -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.paid_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount" v-if="modelData.paid_amount != null">
                                                            {{ modelData.paid_amount }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- remaining_amount -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.remaining_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount" v-if="modelData.paid_amount != null">
                                                            {{ parseInt(modelData.total_amount - modelData.paid_amount) }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


                                <!-- ================================= terms ================================= -->
                                <div class="col-md-6" v-if="modelData.terms.length">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  terms -->
                                            <div class="col-12" v-if="modelData.terms.length">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('lead_contracts_table.terms')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- terms -->
                                            <div
                                                class="col-12"
                                                v-for="term in modelData.terms"
                                                :key="term.id">
                                                <div class="profile-field-group">
                                                    <div class="content" v-text="term.content"></div>
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
                                                    <label>{{ $t('lead_contracts_table.note') }}</label>
                                                    <div class="content" v-text="modelData.note"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


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
        urlModel: '/crm/lead_contracts',
        modelData: {
            lead: {
                name: '',
                id_cart: '',
                company_name: '',
                company_scope: '',
            },
            personal_sales: {
                name: '',
                id_cart: '',
            },
            personal_sales_commission: {
                commission: 0
            },
            secret_id: "",
            job_title_lead: "",
            start_date: "",
            duration: "",
            total_amount: "",
            paid_amount: "",
            tax: 5,
            note: "",
            services: [],
            terms: [],
            created_at: "",
            project: null,
        },

        idPage: 'lead_contracts',
        breadcrumb: []
      }
    },
    methods: {
        getLeadContract(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const lead_contract = response.data.lead_contract
                    if (lead_contract != null) {
                        this.modelData = lead_contract
                    } else {
                        this.$router.push({name: 'lead_contracts'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getLeadContract(this.$route)
                }, 1000)
            })
        },

        createNewProject() {
            this.$createNewProject(this.modelData.id).then(res => {
                this.modelData.project = {}
            })
        }
    },
    mounted() {
        this.getLeadContract(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.lead_contracts'), to: {name: 'contracts'}},
            {label: this.$t('global.contract_profile'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getLead(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.contract_profile')
        })
    }
}
</script>
