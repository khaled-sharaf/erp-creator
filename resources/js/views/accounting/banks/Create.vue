<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createBank()" class="global-form-handel">
                        <!-- card-body -->
                        <div class="card-body">
                            <form-model typeForm="create" :form="form"></form-model>
                        </div>
                        <!-- ./card-body -->

                        <!-- card-footer -->
                        <div class="card-footer">
                            <btn-create :form="form"></btn-create>
                            <btn-create :form="form" createType="again"></btn-create>
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
    name: 'banks-create',
    components: {
        FormModel,
    },
    data() {
      return {
        urlModel: '/accounting/accounts',
        form: new Form({
            name: "",
            type: "current",
            account_no: "",
            balance: "",
            kind: "bank"
        }),
        idPage: 'banks',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createBank() {
            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    // const id = response.data.id
                    const oldForm = {...this.form}
                    this.form.reset()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'banks'})
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
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.banks'), to: {name: 'banks'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_bank'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_bank')
        })
    }
}
</script>
