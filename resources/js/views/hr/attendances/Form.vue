
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- side one -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <!-- user -->
                        <div class="col-12">
                            <div class="form-group form-group-input">
                                <label class="required" v-text="$t('attendances_table.user_id')"></label>
                                <vue-select
                                    :options="users"
                                    v-model="form.user_id"
                                    label="name"
                                    :reduce="user => user.id"
                                    :class="{ 'is-invalid': form.errors.has(`user_id`) }"
                                >
                                    <template v-slot:option="user">
                                        <div class="my-vue-select">
                                            <div class="lead-image">
                                                <img class="image" :src="$domain + user.photo">
                                            </div>
                                            <div class="lead-data">
                                                <div class="text-data">
                                                    <div class="section">
                                                        <span class="title" v-text="user.name"></span>
                                                    </div>
                                                </div>
                                                <div class="type">
                                                    <span class="badge badge-primary" v-if="user.job_title != null" v-text="user.job_title.name"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </template>
                                    <div slot="no-options">{{ $t('lead_contracts_table.not_found_user') }}</div>
                                </vue-select>
                                <has-error :form="form" field="user_id"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- absent -->
                        <div class="col-md-6" v-if="form.user_id != null">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('attendances_table.absent') }}</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="switch_absent" v-model="form.absent">
                                    <label class="custom-control-label" for="switch_absent">
                                        <div class="value-label">
                                            {{ form.absent ? $t('global.yes') : $t('global.no') }}
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- created_at -->
                        <div class="col-md-6" v-if="form.user_id != null">
                            <div class="form-group form-group-input">
                                <label v-text="$t('attendances_table.created_at')"></label>
                                <div class="input-date">
                                    <date-picker
                                        v-model="form.created_at"
                                        type="datetime"
                                        value-type="format"
                                        format="YYYY-MM-DD HH:mm:ss"
                                        :placeholder="$t('attendances_table.created_at')"
                                        :class="{ 'is-invalid': form.errors.has('created_at') }"
                                        :lang="$langDatePicker"
                                    ></date-picker>
                                    <has-error :form="form" field="created_at"></has-error>
                                </div>
                            </div>
                        </div>
                        <!-- =================================================-->

                        <!-- all form -->
                        <div class="col-12" v-if="!form.absent && form.user_id != null">
                            <div class="row">

                                <!-- check_in -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label v-text="$t('attendances_table.check_in')"></label>
                                        <div class="input-date">
                                            <date-picker
                                                v-model="form.check_in"
                                                type="datetime"
                                                value-type="format"
                                                format="YYYY-MM-DD HH:mm:ss"
                                                :placeholder="$t('attendances_table.check_in')"
                                                :lang="$langDatePicker"
                                                :class="{ 'is-invalid': form.errors.has('check_in') }"
                                            ></date-picker>
                                            <has-error :form="form" field="check_in"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <!-- =================================================-->

                                <!-- check_out -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label v-text="$t('attendances_table.check_out')"></label>
                                        <div class="input-date">
                                            <date-picker
                                                v-model="form.check_out"
                                                type="datetime"
                                                value-type="format"
                                                format="YYYY-MM-DD HH:mm:ss"
                                                :placeholder="$t('attendances_table.check_out')"
                                                :class="{ 'is-invalid': form.errors.has('check_out') }"
                                                :lang="$langDatePicker"
                                            ></date-picker>
                                            <has-error :form="form" field="check_out"></has-error>
                                        </div>
                                    </div>
                                </div>
                                <!-- =================================================-->
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- comment -->
                        <div class="col-12" v-if="form.user_id != null">
                            <div class="form-group form-group-input">
                                <label>{{ $t('attendances_table.comment') }}</label>
                                <textarea
                                    v-model="form.comment"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('comment') }"
                                ></textarea>
                                <has-error :form="form" field="comment"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                    </div>
                </div>
            </div>


            <!-- side two -->
            <div class="col-lg-6" v-if="!form.absent && form.user_id != null">
                <div class="wrapper-section-data">
                    <div class="row">

                        <!-- overtime -->
                        <div class="col-12">
                            <div class="form-group form-group-input">
                                <label v-text="$t('attendances_table.overtime')"></label>
                                <div class="input-date">
                                    <vue-select
                                        :options="overtimes"
                                        :reduce="time => time.value"
                                        label="title"
                                        v-model="form.overtime"
                                        class="select-one-line"
                                        :class="{ 'is-invalid': form.errors.has('overtime') }"
                                    >
                                    </vue-select>
                                    <has-error :form="form" field="overtime"></has-error>
                                </div>
                            </div>
                        </div>
                        <!-- ================================== -->

                        <!-- permissionTimes -->
                        <div class="col-12">
                            <div class="form-group form-group-input">
                                <label v-text="$t('attendances_table.permission_time')"></label>
                                <div class="input-date">
                                    <vue-select
                                        :options="permissionTimes"
                                        :reduce="time => time.value"
                                        label="title"
                                        v-model="form.permission_time"
                                        class="select-one-line"
                                        :class="{ 'is-invalid': form.errors.has('permission_time') }"
                                    >
                                    </vue-select>
                                    <has-error :form="form" field="permission_time"></has-error>
                                </div>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- permission_type -->
                        <div class="col-sm-6" v-if="form.permission_time != null">
                            <div class="form-group form-group-input">
                                <label>{{ $t('attendances_table.permission_type') }}</label>
                                <div class="form-group form-group-input">
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input
                                            type="radio"
                                            id="check_permission_type_am"
                                            name="check_permission_type"
                                            class="custom-control-input"
                                            v-model="form.permission_type"
                                            value="am"
                                            :class="{ 'is-invalid': form.errors.has('permission_type') }"
                                        >
                                        <label class="custom-control-label" for="check_permission_type_am">
                                            <div class="value-label">AM</div>
                                        </label>
                                        <has-error :form="form" field="permission_type"></has-error>
                                    </div>

                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input
                                            type="radio"
                                            id="check_permission_type_pm"
                                            name="check_permission_type"
                                            class="custom-control-input"
                                            v-model="form.permission_type"
                                            value="pm"
                                            :class="{ 'is-invalid': form.errors.has('permission_type') }"
                                        >
                                        <label class="custom-control-label" for="check_permission_type_pm">
                                            <div class="value-label">PM</div>
                                        </label>
                                        <has-error :form="form" field="permission_type"></has-error>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm'],

    data() {
        return {
            users: [],
            overtimes: [],
            permissionTimes: [],
        }
    },


    watch: {
        "form.permission_time"(time) {
            this.form.permission_type = time == null ? null : this.form.permission_type
        }
    },


    mounted() {
        $getUsersSelect().then(users => {
            this.users = users
        })
        for (let x = 30; x <= 600; x += 30) {
            let time = {
                title: String(x / 60), //  + ' ' + (x <= 90 ? this.$t('global.hour') : this.$t('global.hours'))
                value: x
            }
            this.overtimes.push(time)
            if (x <= (60 * 4)) {
                this.permissionTimes.push(time)
            }
        }
    }
  }
</script>
