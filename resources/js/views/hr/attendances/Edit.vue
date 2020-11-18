<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateAttendance()" class="global-form-handel">
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
        urlModel: '/hr/attendances',
        form: new Form({
            id: '',
            user_id: null,
            absent: false,
            comment: null,
            check_in: null,
            check_out: null,
            overtime: null,
            permission_type: null,
            permission_time: null,
            created_at: null,
        }),
        idPage: 'attendances',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateAttendance() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    this.getAttendanceEdit(this.$route)
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'attendances'})
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
        getAttendanceEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const attendance = response.data.data.attendance
                    if (attendance != null) {
                        this.form.reset()
                        this.form.fill(attendance)
                    } else {
                        this.$router.push({name: 'attendances'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getAttendanceEdit(this.$route)
                }, 500)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.attendances'), to: {name: 'attendances'}},
            {label: this.$t('sidebar.edit_attendance'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_attendance')
            vm.$nextTick(() => {
                vm.getAttendanceEdit(to)
            })
        })
    }
}
</script>
