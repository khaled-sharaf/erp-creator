<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">

                <!-- btn send pdf to_mail -->
                <a
                    v-if="modelData.deleted_at == null && modelData.lead != null && $can('profile-lead_contracts')"
                    class="btn btn-primary text-white btn-sm"
                    href="javascript:void(0)"
                >
                    <!-- :disabled="sendQuotationLoading" -->
                    <!-- @click.prevent="sendQuotation(quotation.id)" -->
                    {{ $t('global.send') }}
                    {{ $t('global.to_mail') }}
                    <i class="fas fa-envelope"></i>
                </a>
                <!-- ./btn send pdf to_mail -->

                <!-- btn send pdf -->
                <a
                    v-if="modelData.deleted_at == null && modelData.lead != null && $can('view-pdf-lead_contracts')"
                    class="btn btn-success text-white"
                    v-send-whatsapp="{phone: modelData.lead.whatsapp_phone, text: 'Creator Contract: \n\n ' + $domain + 'contract/pdf/' + modelData.secret_id + '/view'}"
                    target="_blank"
                >
                    {{ $t('global.send') }}
                    {{ $t('global.to_whatsapp') }}
                    <i class="fab fa-whatsapp"></i>
                </a>
                <!-- ./btn send pdf -->

                <!-- btn save pdf -->
                <a
                    v-if="modelData.deleted_at == null && $can('download-pdf-lead_contracts')"
                    class="btn btn-danger text-white"
                    :href="$domain + 'contract/pdf/' + modelData.id"
                >
                    {{ $t('global.donwload') }}
                    PDF
                    <i class="fas fa-file-pdf"></i>
                </a>
                <!-- ./btn save pdf -->

                <!-- btn view pdf -->
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
                <!-- ./btn view pdf -->

                <!-- btn edit row -->
                <btn-edit :model="modelData" :modelName="idPage" v-if="$can('edit-lead_contracts')"></btn-edit>
                <!-- ./btn edit row -->

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

                                            <!-- company_address -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('leads_table.company_address') }}</label>
                                                    <div class="content" v-text="modelData.lead.company_address"></div>
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

                                            <!-- name_ar -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('lead_contracts_table.sales_name_ar') }}</label>
                                                    <div class="content" v-text="modelData.personal_sales.name_ar"></div>
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

                                            <!-- address -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('users_table.address') }}</label>
                                                    <div class="content" v-text="modelData.personal_sales.address"></div>
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
                                                            {{ modelData.profit_company }}
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
        urlModel: '/lead_contracts',
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
            // paid_amount: "",
            tax: 5,
            note: "",
            services: [],
            terms: [],
            created_at: ""
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
        }
    },
    mounted() {
        this.getLeadContract(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.lead_contracts'), to: {name: 'lead_contracts'}},
            {label: this.$t('global.contract_profile'), active: true},
        ]

    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.contract_profile')
        })
    }
}
</script>
