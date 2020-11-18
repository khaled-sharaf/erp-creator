
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-md-9 col-xl-10 col-12">

                <div class="row">

                    <!-- ================================= lead_data ================================= -->
                    <div class="col-xl-6">
                        <div class="wrapper-section-data">
                            <div class="row">
                                <!-- title   ===  lead_data -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('leads_table.lead_data')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- name -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('leads_table.name') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('leads_table.phone') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.whatsapp_phone') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{$t('leads_table.email')}}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{$t('leads_table.id_cart')}}</label>
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
                            </div>
                        </div>
                    </div>






                    <!-- ================================= company_data && lead_settings ================================= -->
                    <div class="col-xl-6">
                        <div class="wrapper-section-data">
                            <div class="row">
                                <!-- title   ===  company_data -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('leads_table.company_data')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- company_name -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.company_name') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.company_phone') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.company_email') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.company_address') }}</label>
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.company_scope') }}</label>
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

                                <!-- title   ===  lead_settings -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('leads_table.lead_settings')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->


                                <!-- assign_to -->
                                <div class="col-sm-6 col-lg-4 col-xl-6" v-if="$can('admin-crm') && (typeForm == 'create' || (typeForm == 'edit' && form.type == 0))">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.assign_to') }}</label>
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



                                <!-- lead_status_id -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.lead_status_id') }}</label>
                                        <select
                                            v-model="form.lead_status_id"
                                            class="custom-select custom-select-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead_status_id') }"
                                        >
                                            <option
                                                v-for="status in lead_statuses"
                                                :value="status.id"
                                                :key="status.id"
                                                v-text="status.name"
                                            ></option>
                                        </select>
                                        <has-error :form="form" field="lead_status_id"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->
                            </div>
                        </div>
                    </div>


                    <!-- ================================= location ================================= -->
                    <div class="col-12">
                        <div class="wrapper-section-data">
                            <div class="row">
                                <!-- title   ===  location -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('global.location')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- latitude -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group form-group-input">
                                        <label> {{ $t('global.latitude') }} </label>
                                        <input
                                            type="text"
                                            :placeholder="$t('global.latitude')"
                                            id="latitude_in_form"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('latitude') }"
                                        >
                                        <has-error :form="form" field="latitude"></has-error>
                                    </div>
                                </div>
                                <!-- ================================================= -->

                                <!-- longitude -->
                                <div class="col-sm-6 col-lg-3">
                                    <div class="form-group form-group-input">
                                        <label> {{ $t('global.longitude') }} </label>
                                        <input
                                            type="text"
                                            :placeholder="$t('global.longitude')"
                                            id="longitude_in_form"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('longitude') }"
                                        >
                                        <has-error :form="form" field="longitude"></has-error>
                                    </div>
                                </div>
                                <!-- ================================================= -->

                                <!-- actions -->
                                <div class="col-12 col-lg-6">
                                    <div class="form-group form-group-input">
                                        <label> {{ $t('global.location_actions') }} </label>
                                        <div>
                                            <button type="button" class="btn btn-primary btn-sm mx-1 mb-1" id="get_current_location_in_form"> {{ $t('global.get_current_location') }} </button>
                                            <button type="button" class="btn btn-danger btn-sm mx-1 mb-1" id="remove_location_in_form"> {{ $t('global.remove_location') }} </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================================================= -->

                                <!-- show latitude and longitude in google map -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <div class="myMap" :data-lat="typeForm == 'create' || form.latitude == null ? '30.0444196' : form.latitude" :data-long="typeForm == 'create' || form.longitude == null ? '31.23571160000006' : form.longitude">
                                            <h5 class="info-map"> {{ $t('global.msg_location_map') }}</h5>
                                            <div id="floating-panel">
                                                <input class="form-control" id="address" type="text" value="مصر، القاهرة" :placeholder="$t('datatable.search')">
                                                <span class="error-location error_location"> {{ $t('global.error_location') }} </span>
                                            </div>
                                            <div id="map"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ================================================= -->
                            </div>
                        </div>
                    </div>


                    <!-- ================================= note ================================= -->
                    <div class="col-12">
                        <div class="wrapper-section-data">
                            <div class="row">
                                <!-- note -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.note') }}</label>
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
                        </div>
                    </div>



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

        if (this.typeForm == 'edit') {
            const getData = setInterval(() => {
                if (this.form.id != '') {
                    this.$showGoogleMapInForm()
                    clearInterval(getData)
                }
            }, 500)
        } else if (this.typeForm == 'create') {
            this.$showGoogleMapInForm()
        }
    },


  }
</script>
