<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'users-profile', params: {id: $route.params.id}}"
                >
                    {{ $t('global.show') + ' ' + $t('global.user_profile') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateUser()" class="global-form-handel">
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
        urlModel: '/hr/users',
        form: new Form({
          id: "",
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
          deletedDocuments: [],
          active: 1,

          document_note: "",
        }),
        idPage: 'users',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateUser() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    // setTimeout(() => {
                    //     this.$router.push({name: 'users'})
                    // }, 500)
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            });
        },
        getUserEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const user = response.data.user
                    if (user != null) {
                        user.deletedDocuments = []
                        this.form.fill(user)
                    } else {
                        this.$router.push({name: 'users'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getUserEdit(this.$route)
                }, 1000)
            })
        }
    },
    watch: {
        "$route.params.id"(val) {
            this.getUserEdit(this.$route)
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.users'), to: {name: 'users'}},
            {label: this.$t('sidebar.edit_user'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_user')
            vm.$nextTick(() => {
                vm.getUserEdit(to)
            })
        })
    }
}
</script>
