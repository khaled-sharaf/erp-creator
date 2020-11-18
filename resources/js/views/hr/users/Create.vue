<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createUser()" class="global-form-handel">
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
    name: 'users-create',
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/hr/users',
        form: new Form({
          name: "",
          name_ar: "",
          email: "",
          password: "",
          password_confirmation: "",
          phone: "",
          home_phone: "",
          emergency_phone: "",
          country: "",
          city: "",
          address: "",
          photo: "",
          nationality: "",
          marital_status: "",
          gender: "",
          birth_date: "",
          id_cart: "",

          work_phone: "",
          work_email: "",
          work_address: "",
          bank_account_number: "",
          visa_number: "",
          visa_expire_date: "",

          certificate_level: "",
          school: "",

          job_title_id: "",
          work_period_id: "",

          hiring_date: "",
          salary: "",
          documents: [],
          active: 1,

          document_note: "",
        }),

        idPage: 'users',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createUser() {
            loadReq(this.$Progress);
            const fomrHasFile = new FormData();
            const keysExcepted = ['documents', 'successful', 'busy', 'errors', 'originalData'];
            for (let key in this.form) {
                if (keysExcepted.indexOf(key) == -1) {
                    fomrHasFile.append(key, this.form[key])
                }
            }
            // fomrHasFile.append('documents', JSON.stringify(this.form.documents))
            for (let doc of this.form.documents) {
                fomrHasFile.append('documents[][value]', doc.value)
            }

            axios.post(this.urlModel, fomrHasFile).then(response => {
                if (response.status === 200) {
                    const oldForm = {...this.form}
                    // this.form.reset()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'users'})
                        }, 500)
                    }
                }
            }).catch(err => {
                this.form.errors.errors = err.response.data && err.response.data.errors ? err.response.data.errors : []
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
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.users'), to: {name: 'users'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_user'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_user')
        })
    }
}
</script>
