<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <!-- btn craete lead_contracts -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.lead != null && modelData.personal_sales != null && $can('create-lead_contracts')"
                    class="btn btn-success text-white btn-sm"
                    :to="{name: 'lead_contracts-create', params: {id: modelData.lead.id, by_quotation: true, lead: modelData.lead, services: modelData.services, personal_sales: modelData.personal_sales}}"
                >
                    {{ $t('global.contract') }}
                    <i class="fas fa-handshake"></i>
                </router-link>
                <!-- ./btn craete lead_contracts -->
                
                <!-- btn send pdf to_mail -->
                <a
                    v-if="modelData.lead != null && $can('profile-quotations')"
                    class="btn btn-primary text-white btn-sm"
                    :disabled="sendQuotationLoading"
                    @click.prevent="sendQuotation(modelData.id)"
                    href="javascript:void(0)"
                >
                    {{ $t('global.send') }}
                    {{ $t('global.to_mail') }}
                    <span v-if="sendQuotationLoading" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                    <i v-else class="fas fa-envelope"></i>
                </a>
                <!-- ./btn send pdf to_mail -->

                <!-- btn send pdf -->
                <a
                    v-if="modelData.lead != null  && $can('profile-quotations')"
                    class="btn btn-success text-white btn-sm"
                    v-send-whatsapp="{phone: modelData.lead.whatsapp_phone, text: 'Creator Quotation: \n\n ' + $domain + 'quotation/pdf/' + modelData.secret_id + '/view'}"
                    target="_blank"
                >
                    {{ $t('global.send') }}
                    {{ $t('global.to_whatsapp') }}
                    <i class="fab fa-whatsapp"></i>
                </a>
                <!-- ./btn send pdf -->

                <!-- btn save pdf -->
                <a
                    v-if="modelData.deleted_at == null && $can('profile-quotations')"
                    class="btn btn-danger text-white btn-sm"
                    :href="$domain + 'quotation/pdf/' + modelData.secret_id + '/view'"
                    target="_blank"
                >
                    {{ $t('global.download') }}
                    PDF
                    <i class="fas fa-file-pdf"></i>
                </a>
                <!-- ./btn save pdf -->

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-quotations')" :model="modelData" :modelName="idPage"></btn-edit>
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
                                                    <h3 class="text" v-text="$t('quotations_table.lead_data')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- name -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.lead_id') }}</label>
                                                    <div class="content" v-text="modelData.lead.name"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- phone -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.lead_phone') }}</label>
                                                    <div class="content" v-text="modelData.lead.phone"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- whatsapp_phone -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.lead_whatsapp_phone') }}</label>
                                                    <div class="content" v-text="modelData.lead.whatsapp_phone"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- type -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.lead_type') }}</label>
                                                    <div class="content">
                                                        <span class="badge badge-warning" v-if="modelData.lead.type == 0" v-text="$t('global.lead')"></span>
                                                        <span class="badge badge-primary" v-if="modelData.lead.type == 1" v-text="$t('global.meeting')"></span>
                                                        <span class="badge badge-success" v-if="modelData.lead.type == 2" v-text="$t('global.client')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- title   ===  sales_data -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('quotations_table.sales_data')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- name -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.sales_id') }}</label>
                                                    <div class="content" v-text="modelData.personal_sales.name"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                        </div>
                                    </div>
                                </div>

                                <!-- ================================= services ================================= -->
                                <div class="col-md-6" v-if="modelData.services.length">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  services -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('quotations_table.services')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- services -->
                                            <div class="col-12">
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
                                                    <h3 class="text" v-text="$t('quotations_table.quotation_amount')"></h3>
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
                                                        {{ $settings['taxes'] }}%
                                                        <div class="amount">
                                                            {{ parseInt(modelData.services_amount * ($settings['taxes'] / 100)) }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> -->
                                            <!-- =========================================================== -->

                                            <!-- total_amount -->
                                            <div class="col-sm-4 col-md-12 col-lg-6">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('quotations_table.total_amount') }}</label>
                                                    <div class="content">
                                                        <div class="amount">
                                                            {{ modelData.total_amount }}
                                                            {{ $t('global.currency') }}
                                                        </div>
                                                    </div>
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
        urlModel: '/crm/quotations',
        modelData: {
            lead: {
                name: '',
                phone: '',
                whatsapp_phone: '',
                type: '',
            },
            personal_sales: {
                name: '',
            },
            secret_id: "",
            total_amount: "",
            services: []
        },

        idPage: 'quotations',
        breadcrumb: [],
        sendQuotationLoading: false
      }
    },
    methods: {
        getQuotation(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const quotation = response.data.quotation
                    if (quotation != null) {
                        this.modelData = quotation
                    } else {
                        this.$router.push({name: 'quotations'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getQuotation(this.$route)
                }, 1000)
            })
        },
        sendQuotation(id) {
            this.sendQuotationLoading = true
            axios.post('/crm/send/quotation/' + id).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    this.sendQuotationLoading = false
                    if (typeof data === 'object') {
                        if (data.message === 'success') {
                            toastMsg.fire({
                                icon: 'success',
                                text: this.$t('quotations_table.msg_success_send_quotation')
                            })
                        } else if (data.message === 'lead_not_has_email') {
                            toastMsg.fire({
                                icon: 'error',
                                text: this.$t('messages.msg_not_mail_lead_registerd')
                            })
                        }
                    }
                }
            })
            .catch(errors => {
                this.sendQuotationLoading = false
                toastMsg.fire({
                    icon: 'error',
                    text: this.$t('quotations_table.msg_error_send_quotation')
                })
            })
        }
    },
    mounted() {
        this.getQuotation(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.quotations'), to: {name: 'quotations'}},
            {label: this.$t('global.quotation_profile'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.quotation_profile')
        })
    }
}
</script>
