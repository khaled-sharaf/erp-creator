<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateDomain()" class="global-form-handel">
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
        urlModel: '/domains',
        form: new Form({
            id: "",
            domain_name: "",
            booking_date: "",
            renewal_date: "",
            description: "",
            price: "",
        }),
        idPage: 'domains',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateDomain() {
            loadReq(this.$Progress)

            this.form.put(this.urlModel + '/' + this.form.id).then(response => {

                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'domains'})
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
        getDomainEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {

                    const domain = response.data.domain
                    if (domain != null) {
                        this.form.fill(domain)
                    } else {
                        this.$router.push({name: 'domains'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getDomainEdit(this.$route)
                }, 1000)
            })
        }
    },
    watch: {
        "$route.params.id"(val) {
            this.getDomainEdit(this.$route)
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
            {label: this.$t('sidebar.domains'), to: {name: 'domains'}},
            {label: this.$t('sidebar.edit_domain'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_domain')
            vm.$nextTick(() => {
                vm.getDomainEdit(to)
            })
        })
    }
}
</script>
