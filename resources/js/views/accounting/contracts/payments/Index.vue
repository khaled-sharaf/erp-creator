<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'contracts-profile', params: {id: $route.params.id}}"
                >
                    {{ $t('global.show') + ' ' + $t('global.contract_profile') }}
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
                            <!-- row -->
                            <div class="row">
                                <!-- title   ===  contract_data -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('lead_contracts_table.contract_data')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- contract_number -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('lead_contracts_table.contract_number') }}</label>
                                        <div class="content" v-text="leadContract.id"></div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <div class="col-12"></div>


                                <!-- lead name -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('leads_table.name') }}</label>
                                        <div class="content" v-text="leadContract.lead.name"></div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- company_name -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('leads_table.company_name') }}</label>
                                        <div class="content" v-text="leadContract.lead.company_name"></div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- company_scope -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('leads_table.company_scope') }}</label>
                                        <div class="content" v-text="leadContract.lead.company_scope"></div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <div class="col-12"></div>

                                <!-- total_amount -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('lead_contracts_table.total_amount') }}</label>
                                        <div class="content">
                                            <div class="amount">
                                                {{ leadContract.total_amount }}
                                                {{ $t('global.currency') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- paid_amount -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('lead_contracts_table.paid_amount') }}</label>
                                        <div class="content">
                                            <div class="amount" v-if="leadContract.paid_amount != null && leadContract.paid_amount != 0">
                                                {{ leadContract.paid_amount }}
                                                {{ $t('global.currency') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- remaining_amount -->
                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                    <div class="profile-field-group">
                                        <label>{{ $t('lead_contracts_table.remaining_amount') }}</label>
                                        <div class="content">
                                            <div class="amount">
                                                {{ parseInt(leadContract.total_amount - leadContract.paid_amount) }}
                                                {{ $t('global.currency') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                            </div>
                            <!-- ./row -->
                        </div>
                    </div>

                    <!-- form -->
                    <form @submit.prevent="updatePayments()" class="global-form-handel">
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
import MixinChangeLocaleMessages from "./../../../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/crm/lead_contracts/payments/',
        form: new Form({
          payments: [
              {
                date: '',
                amount: '',
                profit_method: 1,
                payment_method: 1,
                description: '',
              }
          ],
          deletedPayments: []
        }),
        leadContract: {
            id: '',
            total_amount: 0,
            paid_amount: 0,
            lead: {
                name: '',
                company_name: '',
                company_scope: '',
            }
        },
        idPage: 'lead_contracts_payments',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updatePayments() {
            loadReq(this.$Progress);
            this.form.put(this.urlModel + this.$route.params.id).then(response => {
                if (response.status === 200) {
                    this.getPaymentsEdit()
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },
        getPaymentsEdit() {
            axios.get(this.urlModel + this.$route.params.id).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    if (typeof data === 'object') {
                        this.leadContract = data.lead_contract
                        data.payments = data.lead_contract.payments
                        data.deletedPayments = []
                        this.form.reset()
                        this.form.fill(data)
                    } else {
                        setTimeout(() => {
                            this.getPaymentsEdit()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getPaymentsEdit()
                }, 500)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.lead_contracts'), to: {name: 'contracts'}},
            {label: this.$t('lead_contracts_table.contract_payments'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('lead_contracts_table.contract_payments')
            vm.$nextTick(() => {
                vm.getPaymentsEdit()
            })
        })
    }
}
</script>
