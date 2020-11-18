<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    v-if="currentMeeting.meeting_id === null && $can('profile-meetings')"
                    class="btn btn-create-new"
                    :to="{name: 'meetings-profile', params: {id: $route.params.id}}"
                >
                    {{ $t('global.show') + ' ' + $t('sidebar.meeting_view') }}
                    <i class="fas fa-eye"></i>
                </router-link>

                <router-link
                    v-if="currentMeeting.meeting_id !== null && $can('profile-meetings')"
                    class="btn btn-create-new"
                    :to="{name: 'meetings-profile', params: {id: currentMeeting.meeting_id}}"
                >
                    {{ $t('global.show') + ' ' + $t('meetings_table.first_meeting') }}
                    <i class="fas fa-eye"></i>
                </router-link>
                
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- form -->
                    <form @submit.prevent="updateMeeting()" class="global-form-handel">

                        <!-- =========================================================== -->
                        <div class="card-body" v-if="form.lead != null">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <label>{{ $t('leads_table.name') }}</label>
                                        <div class="content">
                                            {{ form.lead.name }}
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <label>{{ $t('leads_table.phone') }}</label>
                                        <div class="content">
                                            {{ form.lead.phone }}
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('meetings_table.meeting_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- date -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="form-group form-group-input">
                                                <label class="required">{{ $t('meetings_table.date') }}</label>
                                                <date-picker
                                                    v-model="form.date"
                                                    type="datetime"
                                                    format="YYYY-MM-DD HH:mm:ss"
                                                    value-type="format"
                                                    :lang="$langDatePicker"
                                                    :placeholder="$t('meetings_table.date')"
                                                    :class="{ 'is-invalid': form.errors.has('date') }"
                                                ></date-picker>
                                                <has-error :form="form" field="date"></has-error>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- address -->
                                        <div class="col-sm-12 col-lg-8 col-xl-6">
                                            <div class="form-group form-group-input">
                                                <label class="required">{{ $t('meetings_table.address') }}</label>
                                                <input
                                                    v-model="form.address"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has('address') }"
                                                >
                                                <has-error :form="form" field="address"></has-error>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->
                                    </div>
                                </div>
                            </div>
                        </div>

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
        urlModel: '/crm/meetings',
        form: new Form({
          id: "",
          lead: {
            name: "",
            phone: ""
          },
          lead_id: '',
          date: "",
          address: "",
        }),
        currentMeeting: {},
        idPage: 'meetings',
        typePage: 'edit',
        breadcrumb: []
      }
    },
    methods: {
        updateMeeting() {
            loadReq(this.$Progress)
            this.form.put(this.urlModel + '/' + this.form.id).then(response => {
                if (response.status === 200) {
                    ToastReq.fire({
                        text: this.success_msg
                    })
                    setTimeout(() => {
                        this.$router.push({name: 'meetings'})
                    }, 500)
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            })
        },
        getMeetingEdit(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const meeting = response.data.meeting
                    if (meeting != null) {
                        this.currentMeeting = meeting
                        this.form.fill(meeting)
                    } else {
                        this.$router.push({name: 'meetings'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getMeetingEdit(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.meetings'), to: {name: 'meetings'}},
            {label: this.$t('sidebar.edit_meeting'), active: true},
        ]
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.edit_meeting')
            vm.$nextTick(() => {
                vm.getMeetingEdit(to)
            })
        })
    }
}
</script>
