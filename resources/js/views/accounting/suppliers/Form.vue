
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-md-9 col-xl-10 col-12">

                <div class="row">

                    <!-- ================================= data ================================= -->
                    <div class="col-xl-6">
                        <div class="wrapper-section-data">
                            <div class="row">

                                <!-- name -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('suppliers_table.name') }}</label>
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

                                <!-- company_name -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('suppliers_table.company_name') }}</label>
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

                                <!-- phone -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('suppliers_table.phone') }}</label>
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
                                        <label>{{ $t('suppliers_table.whatsapp_phone') }}</label>
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
                                        <label>{{$t('suppliers_table.email')}}</label>
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

                                <!-- address -->
                                <div class="col-sm-6 col-lg-4 col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('suppliers_table.address') }}</label>
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



                    <!-- ================================= location ================================= -->
                    <div class="col-xl-6">
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
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
                                <div class="col-sm-6 col-lg-4 col-xl-6">
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
                                <div class="col-12">
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


                    <!-- ================================= services ================================= -->
                    <div class="col-12">
                        <div class="wrapper-section-data">
                            <div class="row">
                                <!-- title   ===  services -->
                                <div class="col-12">
                                    <div class="form-title">
                                        <h3 class="text" v-text="$t('lead_contracts_table.services')"></h3>
                                    </div>
                                </div>
                                <!-- =========================================================== -->



                                <div class="col-12">
                                    <div class="form-plus form-plus-multi" v-for="(service, index) in form.services" :key="index">
                                        <!-- name -->
                                        <div class="form-plus-input form-group-input">
                                            <label class="required">{{ $t('suppliers_table.service_name') }}</label>
                                            <input
                                                v-model="service.name"
                                                type="text"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid': form.errors.has(`services.${index}.name`) }"
                                                :placeholder="$t('suppliers_table.service_name')"
                                            >
                                            <has-error :form="form" :field="`services.${index}.name`"></has-error>
                                        </div>
                                        <!-- ======================================================= -->

                                        <!-- amount -->
                                        <div class="form-plus-no-shrink-input form-group-input">
                                            <label class="required">{{ $t('suppliers_table.service_amount') }}</label>
                                            <input
                                                v-model="service.amount"
                                                type="text"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid': form.errors.has(`services.${index}.amount`) }"
                                                :placeholder="$t('suppliers_table.service_amount')"
                                            >
                                            <has-error :form="form" :field="`services.${index}.amount`"></has-error>
                                        </div>
                                        <!-- ======================================================= -->

                                        <!-- active -->
                                        <div class="form-plus-no-shrink-input form-group-input">
                                            <label class="required">{{ $t('suppliers_table.service_active') }}</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" :id="`switch_active-${index}`" v-model="service.active">
                                                <label class="custom-control-label" :for="`switch_active-${index}`">
                                                    <div class="value-label">
                                                        {{ service.active == 1 ? $t('global.yes') : $t('global.no') }}
                                                    </div>
                                                </label>
                                            </div>
                                            <has-error :form="form" :field="`services.${index}.active`"></has-error>
                                        </div>
                                        <!-- ======================================================= -->

                                        <div class="form-plus-textarea-fullwidth form-group-input">
                                            <label>{{ $t('suppliers_table.description') }}</label>
                                            <textarea
                                                v-model="service.description"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid':form.errors.has(`services.${index}.description`) }"
                                            ></textarea>
                                            <has-error :form="form" :field="`services.${index}.description`"></has-error>
                                        </div>

                                        <div class="btns-overflow">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger"
                                                @click="removeService(index)"
                                            >
                                                {{ $t('sidebar.delete_services') }}
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                        <!-- =========================================================== -->
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-success btn-plus"
                                        @click="addService()"
                                    >
                                        {{ $t('sidebar.add_services') }}
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>

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
                                        <label>{{ $t('suppliers_table.note') }}</label>
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
                        propertyName="logo"
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
        defaultImage: "images/supplier-logos/default-avatar.png",
      }
    },

    methods: {
        addService() {
            this.form.services.push({
                name: '',
                amount: '',
                active: 1,
                description: ''
            })
        },
        // $serviceMethods
        removeService(index) {
            if (this.typeForm == 'edit') {
                if (this.form.services[index].id) {
                    this.form.deletedServices.push(this.form.services[index].id)
                }
            }
            this.form.services.splice(index, 1)
        }
    },

    mounted() {
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
    }

  }
</script>
