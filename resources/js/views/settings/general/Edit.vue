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
                            <form @submit.prevent="editSetting()">
                                <!-- card-body -->
                                <div class="card-body">
                                    <form-setting typeForm="edit" :form="form"></form-setting>
                                </div>
                                <!-- ./card-body -->

                                <!-- card-footer -->
                                <div class="card-footer">
                                    <btn-update :form="form"></btn-update>
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
          id: 0,
          slug: "",
          name: "",
          value: "",
          type: "string"
        }),
        settingEdit: {},
        idPage: 'general-settings',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        editSetting() {
            loadReq(this.$Progress);
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
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
        getSettingEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const setting = response.data.setting
                    if (setting != null) {
                        this.settingEdit = setting
                        this.form.fill(this.settingEdit)
                    } else {
                        this.$router.push({name: 'general-settings'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getSettingEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.settings'), to: {name: 'settings-model'}},
            {label: this.$t('sidebar.general-settings'), to: {name: 'general-settings'}},
            {label: this.$t('sidebar.edit_setting'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_setting')
            vm.$nextTick(() => {
                if (to.params.setting) {
                    vm.settingEdit = to.params.setting
                    vm.form.fill(vm.settingEdit)
                } else {
                    vm.getSettingEdit(to)
                }
            })
        })
    }
}
</script>
