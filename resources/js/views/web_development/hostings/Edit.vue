<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateHosting()" class="global-form-handel">
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
        urlModel: '/hostings',
        form: new Form({
            id: "",
            hosting_name: "",
            booking_date: "",
            renewal_date: "",
            description: "",
            price: "",
        }),
        idPage: 'hostings',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateHosting() {
            loadReq(this.$Progress)
            
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'hostings'})
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
        getHostingEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    
                    const hosting = response.data.hosting
                    if (hosting != null) {
                        this.form.fill(hosting)
                    } else {
                        this.$router.push({name: 'hostings'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getHostingEdit(this.$route)
                }, 1000)
            })
        }
    },
    watch: {
        "$route.params.id"(val) {
            this.getHostingEdit(this.$route)
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
            {label: this.$t('sidebar.hostings'), to: {name: 'hostings'}},
            {label: this.$t('sidebar.edit_hosting'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_hosting')
            vm.$nextTick(() => {
                vm.getHostingEdit(to)
            })
        })
    }
}
</script>
