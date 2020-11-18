
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-md-9 col-xl-10 col-12">

                <div class="row">

                    <!-- title   ===  registration_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('users_table.registration_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- name -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('users_table.name') }}</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('name') }"
                            >
                            <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                    <!-- email -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{$t('users_table.email')}}</label>
                            <input
                                v-model="form.email"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('email') }"
                            >
                            <has-error :form="form" field="email"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- password -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{$t('users_table.password') }}</label>
                            <input
                                v-model="form.password"
                                type="password"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('password') }"
                            >
                            <has-error :form="form" field="password"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- password confirm -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{$t('users_table.repeat_password')}}</label>
                            <input
                                v-model="form.password_confirmation"
                                type="password"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('password_confirmation') }"
                            >
                            <has-error :form="form" field="password_confirmation"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->




                    <!-- title   ===  personal data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('users_table.personal_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- name_ar -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.name_ar') }}</label>
                            <input
                                v-model="form.name_ar"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('name_ar') }"
                            >
                            <has-error :form="form" field="name_ar"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.phone') }}</label>
                            <input
                                v-model="form.phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('phone') }"
                            >
                            <has-error :form="form" field="phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- home_phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.home_phone') }}</label>
                            <input
                                v-model="form.home_phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('home_phone') }"
                            >
                            <has-error :form="form" field="home_phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- emergency_phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.emergency_phone') }}</label>
                            <input
                                v-model="form.emergency_phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('emergency_phone') }"
                            >
                            <has-error :form="form" field="emergency_phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- country -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.country') }}</label>
                            <input
                                v-model="form.country"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('country') }"
                            >
                            <has-error :form="form" field="country"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- city -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.city') }}</label>
                            <input
                                v-model="form.city"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('city') }"
                            >
                            <has-error :form="form" field="city"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- address -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.address') }}</label>
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

                    <!-- nationality -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.nationality') }}</label>
                            <input
                                v-model="form.nationality"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('nationality') }"
                            >
                            <has-error :form="form" field="nationality"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- marital_status -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.marital_status') }}</label>
                            <select
                                v-model="form.marital_status"
                                class="custom-select custom-select-sm"
                                :class="{ 'is-invalid': form.errors.has('marital_status') }"
                            >
                                <option :value="key" v-for="(value, key) in $t('users_table.marital_statuses')" :key="key" v-text="value"></option>
                            </select>
                            <has-error :form="form" field="marital_status"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- gender -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.gender') }}</label>
                            <select
                                v-model="form.gender"
                                class="custom-select custom-select-sm"
                                :class="{ 'is-invalid': form.errors.has('gender') }"
                            >
                                <option :value="key" v-for="(value, key) in $t('users_table.genders')" :key="key" v-text="value"></option>
                            </select>
                            <has-error :form="form" field="gender"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- birth_date -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.birth_date') }}</label>
                            <date-picker
                                v-model="form.birth_date"
                                type="date"
                                format="YYYY-MM-DD"
                                value-type="format"
                                :lang="$langDatePicker"
                                :placeholder="$t('users_table.birth_date')"
                                :class="{ 'is-invalid': form.errors.has('birth_date') }"
                            ></date-picker>
                            <has-error :form="form" field="birth_date"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- id_cart -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.id_cart') }}</label>
                            <input
                                v-model="form.id_cart"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('id_cart') }"
                            >
                            <has-error :form="form" field="id_cart"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->



                    <!-- title   ===  Education -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('users_table.education')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                    <!-- certificate_level -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.certificate_level') }}</label>
                            <input
                                v-model="form.certificate_level"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('certificate_level') }"
                            >
                            <has-error :form="form" field="certificate_level"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- school -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.school') }}</label>
                            <input
                                v-model="form.school"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('school') }"
                            >
                            <has-error :form="form" field="school"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->




                    <!-- title   ===  word_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('users_table.word_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- work_phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.work_phone') }}</label>
                            <input
                                v-model="form.work_phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('work_phone') }"
                            >
                            <has-error :form="form" field="work_phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- work_email -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.work_email') }}</label>
                            <input
                                v-model="form.work_email"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('work_email') }"
                            >
                            <has-error :form="form" field="work_email"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- work_address -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.work_address') }}</label>
                            <input
                                v-model="form.work_address"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('work_address') }"
                            >
                            <has-error :form="form" field="work_address"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- bank_account_number -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.bank_account_number') }}</label>
                            <input
                                v-model="form.bank_account_number"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('bank_account_number') }"
                            >
                            <has-error :form="form" field="bank_account_number"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- visa_number -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.visa_number') }}</label>
                            <input
                                v-model="form.visa_number"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('visa_number') }"
                            >
                            <has-error :form="form" field="visa_number"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- visa_expire_date -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.visa_expire_date') }}</label>
                            <date-picker
                                v-model="form.visa_expire_date"
                                type="date"
                                format="YYYY-MM-DD"
                                value-type="format"
                                :lang="$langDatePicker"
                                :placeholder="$t('users_table.visa_expire_date')"
                                :class="{ 'is-invalid': form.errors.has('visa_expire_date') }"
                            ></date-picker>
                            <has-error :form="form" field="visa_expire_date"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->




                    <!-- title   ===  job_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('users_table.job_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- job_title_id -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.job_title_id') }}</label>
                            <select
                                v-model="form.job_title_id"
                                class="custom-select custom-select-sm"
                                :class="{ 'is-invalid': form.errors.has('job_title_id') }"
                            >
                                <optgroup v-for="department in departments" :key="department.id" :label="department.name">
                                    <option
                                        v-for="job in department.job_titles"
                                        :key="job.id"
                                        :value="job.id"
                                        v-text="job.name">
                                    </option>
                                </optgroup>
                            </select>
                            <has-error :form="form" field="job_title_id"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- hiring_date -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.hiring_date') }}</label>
                            <date-picker
                                v-model="form.hiring_date"
                                type="date"
                                format="YYYY-MM-DD"
                                value-type="format"
                                :lang="$langDatePicker"
                                :placeholder="$t('users_table.hiring_date')"
                                :class="{ 'is-invalid': form.errors.has('hiring_date') }"
                            ></date-picker>
                            <has-error :form="form" field="hiring_date"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- salary -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.salary') }}</label>
                            <input
                                v-model="form.salary"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('salary') }"
                            >
                            <has-error :form="form" field="salary"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <div class="col-12"></div>
                    <br>

                    <!-- active -->
                    <div class="col-sm-6 col-lg-4 col-xl-3" v-if="form.id != 1">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.active') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch_active" v-model="form.active">
                                <label class="custom-control-label" for="switch_active">
                                    <div class="value-label">
                                        {{ form.active ? $t('users_table.activate.on') : $t('users_table.activate.off') }}
                                    </div>
                                </label>
                            </div>
                            <has-error :form="form" field="active"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <div class="col-12"></div>
                    <br>

                    <!-- document_note -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.document_note') }}</label>
                            <textarea
                                v-model="form.document_note"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('document_note') }"
                            ></textarea>
                            <has-error :form="form" field="document_note"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                     <!-- documents -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('users_table.documents') }}</label>
                            <upload-image
                                :form="form"
                                propertyName="documents"
                                :required="false"
                                :domain="$domain"
                                type="multiple"
                                propertyDeletedName="deletedDocuments"
                            ></upload-image>
                        </div>
                    </div>
                    <!-- ./documents -->
                    <!-- =========================================================== -->


                </div>
                <!-- ./row -->
            </div><!-- ./col-md -->

            <div class="col-md-3 col-xl-2 col-12">
                <div class="form-group">
                    <upload-image
                        :form="form"
                        propertyName="photo"
                        :required="false"
                        :defaultSrcImage="defaultUserAvatar"
                        :domain="$domain"
                    ></upload-image>
                        <!-- :maxSize="3150000" -->
                </div>
            </div><!-- ./col-md -->


        </div><!-- ./row -->
    </div>
</template>


<script>
export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        defaultUserAvatar: "images/user-avatar/default-avatar.png",
        url_departments_select: '/hr/departments_select',
        departments: []
      }
    },

    methods: {
        getDepartments() {
            axios.get(this.url_departments_select).then(response => {
                if (typeof response.data === 'object') {
                    if (response.status === 200) {
                        this.departments = response.data
                    }
                } else {
                    setTimeout(() => {
                        this.getDepartments()
                    }, 1000)
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getDepartments()
                }, 1000)
            })
        }
    },

    mounted() {
        this.getDepartments()
    }
  }
</script>
