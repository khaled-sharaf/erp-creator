<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="container-fluid">

                <div class="row mt-3">
                    <div class="col-12">
                        <div class="card">
                            <!-- form -->
                            <form @submit.prevent="createSetting()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-setting typeForm="create" :form="form"></form-setting>
                                </div>
                                <!-- ./card-body -->

                                <!-- card-footer -->
                                <div class="card-footer">
                                    <btn-create :form="form"></btn-create>
                                </div> <!-- ./card-footer -->
                            </form><!-- form -->
                        </div>
                    </div><!-- /.col-12 -->

                </div><!-- /.row -->
            </div><!--/. container-fluid -->
        </section>
    </div>
</template>


<script>
import FormSetting from './Form'
import MixinChangeLocaleMessages from "./../../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [MixinChangeLocaleMessages],
    components: {
        FormSetting
    },
    data() {
      return {
        urlModel: '/setting/settings',
        form: new Form({
          slug: "",
          name: "",
          value: "",
          type: "string",
        }),
        typePage: 'create',
        idPage: 'general-settings',
        breadcrumb: []
      }
    },
    methods: {
        createSetting() {
            loadReq(this.$Progress);
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.form.reset();
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
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.settings'), to: {name: 'settings-model'}},
            {label: this.$t('sidebar.general-settings'), to: {name: 'general-settings'}},
            {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_setting'), active: true},
        ]
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.create') + ' ' + vm.$t('sidebar.new_setting')
        })
    }
}
</script>
