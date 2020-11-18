
<template>
    <div>
        <!-- Modal -->
        <div class="modal fade" id="createMeetingModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="createMeetingModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMeetingModalLabel">
                        {{ this.$t('global.create') }}
                        {{ this.$t('sidebar.new_meeting') }}
                        <span v-if="Object.keys(data).length">
                            {{ this.$t('global.with') + ' ( ' + data.lead.name + ' )' }}
                        </span>
                    </h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form @submit.prevent="createMeeting()" class="global-form-handel">

                    <div class="modal-body">
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

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ this.$t('global.cancel') }}</button>
                        <button type="submit" class="btn btn-success">{{ this.$t('global.create') }}</button>
                    </div>

                </form>

            </div>
        </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        data: {
            type: Object,
            required: true
        },
        callBackFn: Function,
        urlModel: String
    },

    data() {
        return {
            form: new Form({
                date: "",
                address: ""
            })
        }  
    },

    methods: {
        createMeeting() {
            loadReq(this.$Progress)
            this.form.lead_id = this.data.lead.id
            if (this.data.meeting) {
                this.form.meeting_id = this.data.meeting.id
            }
            this.form.post(this.urlModel).then(response => {
                if (response.status === 200) {
                    this.form.reset()
                    if (typeof this.callBackFn === 'function') {
                        this.callBackFn()
                    }
                    $('#createMeetingModal').modal('hide')
                    ToastReq.fire({
                        text: this.$t('meetings_table.p_create.success_msg')
                    })
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.$t('global.failed') + "!",
                    text: this.$t('meetings_table.p_create.failed_msg')
                })
                this.$Progress.fail()
            })
        }
    }
}
</script>
