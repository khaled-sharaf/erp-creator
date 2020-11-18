<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateStatuses()" class="global-form-handel">
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
        urlModel: '/crm/lead_statuses',
        form: new Form({
          statuses: [
              {name: '', color: '#333333'}
          ],
          deletedStatuses: []
        }),
        idPage: 'lead_statuses',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateStatuses() {
            loadReq(this.$Progress);
            this.form.put(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.getStatusesEdit()
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
        getStatusesEdit() {
            axios.get(this.urlModel).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    const statuses = data.statuses
                    if (typeof data === 'object') {
                        data.deletedStatuses = []
                        this.form.reset()
                        this.form.fill(data)
                    } else {
                        setTimeout(() => {
                            this.getStatusesEdit()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getStatusesEdit()
                }, 500)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.settings'), to: {name: 'settings-model'}},
            {label: this.$t('sidebar.lead_statuses'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.lead_statuses')
            vm.$nextTick(() => {
                vm.getStatusesEdit()
            })
        })
    }
}
</script>
