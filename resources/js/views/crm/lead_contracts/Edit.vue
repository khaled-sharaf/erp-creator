<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'lead_contracts-profile', params: {id: $route.params.id}}"
                    v-if="$can('profile-lead_contracts')"
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
                    <!-- form -->
                    <form @submit.prevent="updateLead()" class="global-form-handel">
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
        urlModel: '/lead_contracts',
        form: new Form({
            id: "",
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
            created_at: '',
            deletedServices: [],
            deletedTerms: [],
        }),
        idPage: 'lead_contracts',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateLead() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    this.getLeadContractEdit(this.$route)
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'lead_contracts'})
                    }, 500)
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            });
        },
        getLeadContractEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const lead_contract = response.data.lead_contract
                    if (lead_contract != null) {
                        lead_contract.deletedServices = []
                        lead_contract.deletedTerms = []
                        this.form.fill(lead_contract)
                    } else {
                        this.$router.push({name: 'lead_contracts'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getLeadContractEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.lead_contracts'), to: {name: 'lead_contracts'}},
            {label: this.$t('sidebar.edit_lead_contract'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_lead_contract')
            vm.$nextTick(() => {
                vm.getLeadContractEdit(to)
            })
        })
    }
}
</script>
