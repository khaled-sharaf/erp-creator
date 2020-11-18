<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateCommissions()" class="global-form-handel">
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
        urlModel: '/crm/sales_commissions',
        form: new Form({
          commissions: [
              {sales_id: '', commission: ''}
          ],
          deletedCommissions: []
        }),
        idPage: 'sales_commissions',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateCommissions() {
            loadReq(this.$Progress);
            this.form.put(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.getCommissionsEdit()
                    ToastReq.fire({
                        text: this.success_msg
                    });
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail();
            });
        },
        getCommissionsEdit() {
            axios.get(this.urlModel).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    const commissions = data.commissions
                    if (typeof data === 'object') {
                        data.deletedCommissions = []
                        this.form.reset()
                        this.form.fill(data)
                    } else {
                        setTimeout(() => {
                            this.getCommissionsEdit()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCommissionsEdit()
                }, 500)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.settings'), to: {name: 'settings-model'}},
            {label: this.$t('sidebar.sales_commissions'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.sales_commissions')
            vm.$nextTick(() => {
                vm.getCommissionsEdit()
            })
        })
    }
}
</script>
