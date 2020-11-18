<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createQuotation()" class="global-form-handel">
                        <!-- card-body -->
                        <div class="card-body">
                            <form-model typeForm="create" :form="form"></form-model>
                        </div>
                        <!-- ./card-body -->

                        <!-- card-footer -->
                        <div class="card-footer">
                            <btn-create :form="form" :disabled="!form.lead_id || !form.sales_id"></btn-create>
                            <btn-create
                                v-if="!$route.params.id"
                                :form="form"
                                createType="again"
                                :disabled="!form.lead_id || !form.sales_id"
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
    name: 'quotations-create',
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/crm/quotations',
        form: new Form({
            lead_id: '',
            sales_id: '',
            total_amount: '',
            services: [
                {service_id: '', amount: '', description: '',profit_method: 1}
            ],
            currency_id: 42
        }),
        idPage: 'quotations',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createQuotation() {
            loadReq(this.$Progress)
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    const oldForm = {...this.form}
                    this.form.reset();
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'quotations'})
                        }, 500)
                    }
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            });
        },

        getLead(route) {
            axios.get('/crm/leads/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const lead = response.data.lead
                    if (lead != null) {
                        this.form.lead_id = lead.id
                        if (!$can('admin-crm')) {
                            this.form.sales_id = $auth.id
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
        }
    },

    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.quotations'), to: {name: 'quotations'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_quotation'), active: true},
        ]
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            if (to.params.id) {
                vm.getLead(to)
            }
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_quotation')
        })
    }
}
</script>
