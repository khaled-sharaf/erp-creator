
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- title   ===  contract_payments -->
            <div class="col-12">
                <div class="form-title">
                    <h3 class="text" v-text="$t('lead_contracts_table.contract_payments')"></h3>
                </div>
            </div>
            <!-- =========================================================== -->



            <div class="col-12">

                <div class="form-plus form-plus-multi" v-for="(payment, index) in form.payments" :key="index">
                    <div class="form-plus-input form-group-input">
                        <label class="required">{{ $t('lead_contracts_table.payment_date') }}</label>
                        <date-picker
                            v-model="payment.date"
                            type="date"
                            format="YYYY-MM-DD"
                            value-type="format"
                            :lang="$langDatePicker"
                            :placeholder="$t('lead_contracts_table.payment_date')"
                            :class="{ 'is-invalid': form.errors.has(`payments.${index}.date`) }"
                        ></date-picker>
                        <has-error :form="form" :field="`payments.${index}.date`"></has-error>
                    </div>
                    <div class="form-plus-no-shrink-input form-group-input">
                        <label class="required">{{ $t('lead_contracts_table.payment_amount') }}</label>
                        <input
                            v-model="payment.amount"
                            type="text"
                            class="form-control form-control-sm"
                            :class="{ 'is-invalid': form.errors.has(`payments.${index}.amount`) }"
                            :placeholder="$t('lead_contracts_table.payment_amount')"
                        >
                        <has-error :form="form" :field="`payments.${index}.amount`"></has-error>
                    </div>
                    <div class="form-plus-no-shrink-input form-group-input">
                        <label class="required">{{ $t('lead_contracts_table.profit_method') }}</label>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" :id="`switch_profit_method-${index}`" v-model="payment.profit_method">
                            <label class="custom-control-label" :for="`switch_profit_method-${index}`">
                                <div class="value-label">
                                    {{ payment.profit_method == 1 ? $t('services_table.profit_company') : $t('services_table.profit_ads') }}
                                </div>
                            </label>
                        </div>
                        <has-error :form="form" :field="`payments.${index}.profit_method`"></has-error>
                    </div>
                    <div class="form-plus-no-shrink-input form-group-input">
                        <label class="required">{{ $t('lead_contracts_table.payment_method') }}</label>
                        <select
                            v-model="payment.payment_method"
                            class="custom-select custom-select-sm"
                            :class="{ 'is-invalid': form.errors.has(`payments.${index}.payment_method`) }"
                        >
                            <option
                                v-for="(method_name, method_value) in $paymentMethods"
                                :key="method_value"
                                :value="method_value"
                                v-text="method_name">
                            </option>
                        </select>
                        <has-error :form="form" :field="`payments.${index}.payment_method`"></has-error>
                    </div>

                    <div class="form-plus-textarea-fullwidth form-group-input">
                        <label>{{ $t('lead_contracts_table.description') }}</label>
                        <textarea
                            v-model="payment.description"
                            class="form-control form-control-sm"
                            :class="{ 'is-invalid':form.errors.has(`payments.${index}.description`) }"
                        ></textarea>
                        <has-error :form="form" :field="`payments.${index}.description`"></has-error>
                    </div>
                    <div class="btns-overflow">
                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            @click="removePayment(index)"
                            v-if="$can('delete-payment-lead_contracts')"
                        >
                            {{ $t('sidebar.delete_payment') }}
                            <i class="fas fa-trash"></i>
                        </button>
                        <a
                            v-if="payment.id && $can('receipt-lead_contracts')"
                            class="btn btn-sm btn-info"
                            :href="$domain_admin + 'receipt/pdf/' + payment.id"
                            target="_blank"
                        >
                            {{ $t('sidebar.receipt') }}
                            <i class="fas fa-receipt"></i>
                        </a>

                        <button
                            v-if="payment.id && $can('receipt-lead_contracts')"
                            type="button"
                            class="btn btn-sm btn-primary"
                            :disabled="sendPaymentLoading"
                            @click="sendPayment(payment.id)"
                        >
                            {{ $t('sidebar.send_receipt') }}
                            <span v-if="sendPaymentLoading" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                            <i v-else class="fas fa-share"></i>
                        </button>
                    </div>
                    <!-- =========================================================== -->
                </div>
                <button
                    type="button"
                    class="btn btn-sm btn-success btn-plus"
                    @click="addPayment()"
                    v-if="$can('add-payment-lead_contracts')"
                >
                    {{ $t('sidebar.add_payment') }}
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm'],
    data() {
        return {
            sendPaymentLoading: false
        }
    },
    methods: {
        addPayment() {
            this.form.payments.push({
                date: '',
                amount: '',
                profit_method: 1,
                payment_method: 1,
                description: ''
            })
        },
        // $paymentMethods
        removePayment(index) {
            if (this.typeForm == 'edit') {
                if (this.form.payments[index].id) {
                    this.form.deletedPayments.push(this.form.payments[index].id)
                }
            }
            this.form.payments.splice(index, 1)
        },

        sendPayment(id) {
            this.sendPaymentLoading = true
            axios.post('/crm/send/payment/' + id).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    this.sendPaymentLoading = false
                    if (typeof data === 'object') {
                        if (data.message === 'success') {
                            toastMsg.fire({
                                icon: 'success',
                                text: this.$t('lead_contracts_table.msg_success_send_receipt')
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
                this.sendPaymentLoading = false
                toastMsg.fire({
                    icon: 'error',
                    text: this.$t('lead_contracts_table.msg_error_send_receipt')
                })
            })
        }
    }
  }
</script>
