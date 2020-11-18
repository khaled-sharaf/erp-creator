<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="createLead()" class="global-form-handel">
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
    name: 'leads-create',
    components: {
        FormModel,
    },
    data() {
      return {
        urlModel: '/crm/leads',
        form: new Form({
            name: "",
            phone: "",
            whatsapp_phone: "",
            email: "",
            id_cart: "",

            company_name: "",
            company_phone: "",
            company_email: "",
            company_logo: "",
            company_address: "",
            company_scope: "",
            latitude: "",
            longitude: "",

            assign_to: "",
            lead_status_id: "",
            note: "",
            type: 0
        }),
        idPage: 'leads',
        typePage: 'create',
        breadcrumb: []
      }
    },
    methods: {
        createLead() {
            this.form.latitude = window.parseFloat($('#latitude_in_form').val())
            this.form.longitude = window.parseFloat($('#longitude_in_form').val())

            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    // const id = response.data.id
                    const oldForm = {...this.form}
                    this.form.reset()
                    $('#remove_location_in_form').click()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    if (!oldForm.create_again) {
                        setTimeout(() => {
                            this.$router.push({name: 'leads'})
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
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.leads'), to: {name: 'leads'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_lead'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_lead')
        })
    }
}
</script>
