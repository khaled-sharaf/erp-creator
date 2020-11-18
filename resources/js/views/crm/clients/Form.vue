
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-md-9 col-xl-10 col-12">

                <div class="row">

                    <!-- title   ===  client_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('clients_table.client_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- name -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('clients_table.name') }}</label>
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

                    <!-- phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('clients_table.phone') }}</label>
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

                    <!-- whatsapp_phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.whatsapp_phone') }}</label>
                            <input
                                v-model="form.whatsapp_phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('whatsapp_phone') }"
                            >
                            <has-error :form="form" field="whatsapp_phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                    <!-- email -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{$t('clients_table.email')}}</label>
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


                    <!-- id_cart -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{$t('clients_table.id_cart')}}</label>
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




                    <!-- title   ===  company_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('clients_table.company_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- company_name -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.company_name') }}</label>
                            <input
                                v-model="form.company_name"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('company_name') }"
                            >
                            <has-error :form="form" field="company_name"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- company_phone -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.company_phone') }}</label>
                            <input
                                v-model="form.company_phone"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('company_phone') }"
                            >
                            <has-error :form="form" field="company_phone"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- company_email -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.company_email') }}</label>
                            <input
                                v-model="form.company_email"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('company_email') }"
                            >
                            <has-error :form="form" field="company_email"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- company_address -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.company_address') }}</label>
                            <input
                                v-model="form.company_address"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('company_address') }"
                            >
                            <has-error :form="form" field="company_address"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- company_scope -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.company_scope') }}</label>
                            <input
                                v-model="form.company_scope"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('company_scope') }"
                            >
                            <has-error :form="form" field="company_scope"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- title   ===  client_settings -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('clients_table.client_settings')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                    <!-- assign_to -->
                    <div class="col-sm-6 col-lg-4 col-xl-3" v-if="$can('admin-crm')">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.assign_to') }}</label>
                            <select
                                v-model="form.assign_to"
                                class="custom-select custom-select-sm"
                                :class="{ 'is-invalid': form.errors.has('assign_to') }"
                            >
                                <optgroup v-for="department in departments" v-show="department.users.length" :key="department.id" :label="department.name">
                                    <option
                                        v-for="user in department.users"
                                        :key="user.id"
                                        :value="user.id"
                                        v-text="user.name">
                                    </option>
                                </optgroup>
                            </select>
                            <has-error :form="form" field="assign_to"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <div class="col-12"></div>
                    <br>

                    <!-- note -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('clients_table.note') }}</label>
                            <textarea
                                v-model="form.note"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('note') }"
                            ></textarea>
                            <has-error :form="form" field="note"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                </div>
                <!-- ./row -->
            </div><!-- ./col-md -->

            <div class="col-md-3 col-xl-2 col-12">
                <div class="form-group">
                    <upload-image
                        :form="form"
                        propertyName="company_logo"
                        :required="false"
                        :defaultSrcImage="defaultImage"
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
        defaultImage: "images/lead-logos/default-avatar.png",
        lead_statuses: [],

        url_departments_select: '/hr/departments_with_users_select?name=sales',
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
        $getLeadStatuses().then(statuses => {
            this.lead_statuses = statuses
        })
        this.getDepartments()
    },


  }
</script>
