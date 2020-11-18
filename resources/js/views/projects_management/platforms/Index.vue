<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-create-new"
                    :to="{name: 'projects'}"
                >
                    {{ $t('sidebar.all_projects') }}
                    <i class="fas fa-eye"></i>
                </router-link>
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">

                    <!-- form -->
                    <form @submit.prevent="updatePlatforms()" class="global-form-handel">
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
        urlModel: '/projectmanagement/platforms',
        form: new Form({
          platforms: [
              {
                name: '',
                logo: '' ,
                cover_width: '',
                cover_height: '',
                profile_width: '',
                profile_height: '',
                post_width: '',
                post_height: '',
                display: 1,
              }
          ],
          deletedPlatforms: []
        }),
        idPage: 'platforms',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updatePlatforms() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.getPlatformsEdit()
                    ToastReq.fire({
                        text: this.success_msg
                    })
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            });
        },
        getPlatformsEdit() {
            $getPlatforms().then(response => {
                const data = {
                    platforms: response,
                    deletedPlatforms: []
                }
                this.form.reset()
                this.form.fill(data)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.projects_management'), to: {name: 'projects_management-model'}},
            {label: this.$t('sidebar.platforms'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.platforms')
            vm.$nextTick(() => {
                vm.getPlatformsEdit()
            })
        })
    }
}
</script>
