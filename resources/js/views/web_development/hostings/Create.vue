<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createHost()" class="global-form-handel">
                        <!-- card-body -->
                        <div class="card-body">
                            <form-model typeForm="create" :form="form"></form-model>
                        </div>
                        <!-- ./card-body -->

                        <!-- card-footer -->
                        <div class="card-footer">
                            <btn-create :form="form"></btn-create>
                            <!-- <btn-create :form="form" createType="again"></btn-create> -->
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
    name: 'hostings-create',
    components: {
        FormModel
    },
    data() {
      return {
        urlModel: '/hostings',
        form: new Form({
          hosting_name: "",
          booking_date: "",
          renewal_date: "",
          description: "",
          price: "",
        }),

        idPage: 'hostings',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createHost() {
            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
              // console.log(response);

                if (response.status === 200) {
                    // const id = response.data.id
                    const oldForm = {...this.form}
                    this.form.reset()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'hostings'})
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
            {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
            {label: this.$t('sidebar.hostings'), to: {name: 'hostings'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_hosting'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_hosting')
        })
    }
}
</script>
