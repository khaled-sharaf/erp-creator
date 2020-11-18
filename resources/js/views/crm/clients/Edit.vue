<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'clients-profile', params: {id: $route.params.id}}"
                    v-if="$can('profile-clients')"
                >
                    {{ $t('global.show') + ' ' + $t('global.client_profile') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateClient()" class="global-form-handel">
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
        urlModel: '/crm/clients',
        form: new Form({
          id: "",
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
          note: ""
        }),
        idPage: 'clients',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateClient() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'clients'})
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
        getClientEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const client = response.data.lead
                    if (client != null && client.type == 2) {
                        this.form.fill(client)
                    } else {
                        this.$router.push({name: 'clients'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getClientEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.clients'), to: {name: 'clients'}},
            {label: this.$t('sidebar.edit_client'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_client')
            vm.$nextTick(() => {
                vm.getClientEdit(to)
            })
        })
    }
}
</script>
