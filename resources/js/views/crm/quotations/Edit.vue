<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'quotations-profile', params: {id: $route.params.id}}"
                >
                    {{ $t('global.show') + ' ' + $t('global.quotation_profile') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateQuotation()" class="global-form-handel">
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
        urlModel: '/crm/quotations',
        form: new Form({
            id: "",
            lead_id: '',
            sales_id: '',
            total_amount: '',
            services: [
                {service_id: '', amount: '', description: '',profit_method: 1}
            ],
            currency_id: 42,
            deletedServices: [],
        }),
        idPage: 'quotations',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateQuotation() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    this.getQuotationEdit(this.$route)
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'quotations'})
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
        getQuotationEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const quotation = response.data.quotation
                    if (quotation != null) {
                        quotation.deletedServices = []
                        this.form.fill(quotation)
                    } else {
                        this.$router.push({name: 'quotations'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getQuotationEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.quotations'), to: {name: 'quotations'}},
            {label: this.$t('sidebar.edit_quotation'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_quotation')
            vm.$nextTick(() => {
                vm.getQuotationEdit(to)
            })
        })
    }
}
</script>
