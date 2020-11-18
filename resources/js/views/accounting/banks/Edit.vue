<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'payments', params: {id: $route.params.id}}"
                >
                    {{ $t('global.view_payments') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateBank()" class="global-form-handel">
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
        urlModel: '/accounting/accounts',
        form: new Form({
            id: "",
            name: "",
            type: "",
            account_no: "",
            balance: ""
        }),
        idPage: 'banks',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateBank() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'banks'})
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
        getBankEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const bank = response.data.account
                    if (bank != null) {
                        this.form.fill(bank)
                    } else {
                        this.$router.push({name: 'banks'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getBankEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.banks'), to: {name: 'banks'}},
            {label: this.$t('sidebar.edit_bank'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_bank')
            vm.$nextTick(() => {
                vm.getBankEdit(to)
            })
        })
    }
}
</script>
