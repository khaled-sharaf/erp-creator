<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'suppliers-profile', params: {id: $route.params.id}}"
                >
                    {{ $t('global.show') + ' ' + $t('global.supplier_profile') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateSupplier()" class="global-form-handel">
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
        urlModel: '/accounting/suppliers',
        form: new Form({
            id: "",
            name: "",
            company_name: "",
            phone: "",
            whatsapp_phone: "",
            email: "",
            logo: "",
            address: "",
            latitude: "",
            longitude: "",
            note: "",
            services: [],
            deletedServices: []
        }),
        idPage: 'suppliers',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateSupplier() {
            this.form.latitude = window.parseFloat($('#latitude_in_form').val())
            this.form.longitude = window.parseFloat($('#longitude_in_form').val())

            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'suppliers'})
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
        getSupplierEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const supplier = response.data.supplier
                    if (supplier != null) {
                        supplier.deletedServices = []

                        this.form.reset()
                        $('#remove_location_in_form').click()

                        this.form.fill(supplier)
                        if (this.form.latitude != null && this.form.longitude != null) {
                            $('.myMap #address').val('')
                        }
                        $('#latitude_in_form').val(this.form.latitude)
                        $('#longitude_in_form').val(this.form.longitude)
                    } else {
                        this.$router.push({name: 'suppliers'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getSupplierEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.suppliers'), to: {name: 'suppliers'}},
            {label: this.$t('sidebar.edit_supplier'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_supplier')
            vm.$nextTick(() => {
                vm.getSupplierEdit(to)
            })
        })
    }
}
</script>
