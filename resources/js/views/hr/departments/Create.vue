<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createDepartment()" class="global-form-handel">
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
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/hr/departments',
        form: new Form({
          name: "",
          job_titles: [
              {name: ''}
          ]
        }),

        idPage: 'departments',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createDepartment() {
            loadReq(this.$Progress)
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    const oldForm = {...this.form}
                    this.form.reset()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'departments'})
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
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.departments'), to: {name: 'departments'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_department'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_department')
        })
    }
}
</script>
