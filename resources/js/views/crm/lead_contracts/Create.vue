<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createContract()" class="global-form-handel">
                        <!-- card-body -->
                        <div class="card-body">
                            <form-model typeForm="create" :form="form"></form-model>
                        </div>
                        <!-- ./card-body -->

                        <!-- card-footer -->
                        <div class="card-footer">
                            <btn-create :form="form" :disabled="!form.lead.id || !form.personal_sales.id"></btn-create>
                            <btn-create
                                v-if="!$route.params.id"
                                :form="form"
                                createType="again"
                                :disabled="!form.lead.id || !form.personal_sales.id"
                                ></btn-create>
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
    name: 'lead_contracts-create',
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/lead_contracts',
        form: new Form({
            lead: {},
            personal_sales: {},
            job_title_lead: "",
            created_at: "",
            start_date: "",
            duration_unit: "",
            duration: "",
            total_amount: "",
            tax: 5,
            note: "",
            services: [
                {service_id: '', amount: '', description: '',profit_method: 1}
            ],
            currency_id: 42,
            terms: [],
            created_at: ''
        }),
        idPage: 'lead_contracts',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createContract() {
            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    // const id = response.data.id
                    const oldForm = {...this.form}
                    this.form.reset();
                    ToastReq.fire({
                        text: this.success_msg
                    });
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'lead_contracts'})
                        }, 500)
                    }
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },

        getLead(route) {
            axios.get('/leads/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const lead = response.data.lead
                    if (lead != null) {
                        this.form.lead = lead
                        if (!$can('admin-crm')) {
                            this.form.personal_sales = {...$auth}
                        }
                    } else {
                        this.$router.push({name: 'lead_contracts'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getLead(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.lead_contracts'), to: {name: 'lead_contracts'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_lead_contract'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            if (to.params.id) {
                if (to.params.by_quotation && to.params.by_quotation === true) {
                    vm.form.lead = to.params.lead
                    vm.form.personal_sales =  to.params.personal_sales
                    let services = to.params.services
                    let serviceCleared = []

                    services.forEach(serv => {
                        let newServ = {
                            service_id: serv.service_id,
                            amount: serv.amount,
                            description: serv.description,
                            profit_method: serv.profit_method
                        }
                        serviceCleared.push(newServ)
                    })
                    vm.form.services = serviceCleared
                    vm.form.currency_id = to.params.currency_id
                } else {
                    vm.getLead(to)
                }
            }
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_lead_contract')
        })
    }
}
</script>
