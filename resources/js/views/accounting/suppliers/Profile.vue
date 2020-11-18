<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">

                <!-- btn edit row -->
                <btn-edit :model="modelData" :modelName="idPage"></btn-edit>
                <!-- ./btn edit row -->

            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <!-- row -->
                            <div class="row">

                                <div class="col-md-3 col-xl-2 col-12">
                                    <div class="profile-image">
                                        <img :src="$domain + modelData.logo" alt="Logo">
                                    </div>
                                </div><!-- ./col-md -->

                                <!-- col-md -->
                                <div class="col-md-9 col-xl-10 col-12">

                                    <div class="row">

                                        <!-- ================================= data ================================= -->
                                        <div class="col-xl-6">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    
                                                    <!-- name -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.name') }}</label>
                                                            <div class="content" v-text="modelData.name"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- company_name -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.company_name') }}</label>
                                                            <div class="content" v-text="modelData.company_name"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- phone -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.phone') }}</label>
                                                            <div class="content">
                                                                <a :href="'tel:' + modelData.phone">{{modelData.phone}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- whatsapp_phone -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.whatsapp_phone') }}</label>
                                                            <div class="content">
                                                                <a target="_blank" v-link-whatsapp="modelData.whatsapp_phone">{{modelData.whatsapp_phone}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- email -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{$t('suppliers_table.email')}}</label>
                                                            <div class="content">
                                                                <a :href="'mailto:' + modelData.email">{{modelData.email}}</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->

                                                    <!-- address -->
                                                    <div class="col-sm-6 col-lg-4 col-xl-6">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.address') }}</label>
                                                            <div class="content" v-text="modelData.address"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ============================================================================= -->


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
                                                    <!-- location_map -->
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('global.location_map') }}</label>
                                                            <div class="content">
                                                                <div class="my-map" id="show_my_map" v-if="modelData.latitude != null && modelData.longitude != null">
                                                                    <div id="show_location_map"></div>
                                                                </div>
                                                                <div class="alert alert-info" v-else v-text="$t('global.no_location')"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ============================================================================= -->


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

                                                    <!-- services -->
                                                    <div class="col-12" v-if="modelData.services.length">
                                                        <div
                                                            class="row services-in-profile"
                                                            v-for="service in modelData.services"
                                                            :key="service.id">
                                                            <div class="col-12">
                                                                <div class="profile-field-group">
                                                                    <div class="content">
                                                                        <div class="name">
                                                                            <h4 class="title" v-text="service.name"></h4>
                                                                            <div class="desc" v-text="service.description"></div>
                                                                            <div class="actions">
                                                                                <span class="badge badge-success" v-if="service.active == 1" v-text="$t('global.active')"></span>
                                                                                <span class="badge badge-warning" v-else v-text="$t('global.disactive')"></span>
                                                                            </div>
                                                                        </div>
                                                                        <div class="amount">
                                                                            {{ service.amount }}
                                                                            {{ $t('global.currency') }}
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ============================================================================= -->


                                        <div class="col-12">
                                            <div class="wrapper-section-data">
                                                <div class="row">
                                                    <!-- note -->
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('suppliers_table.note') }}</label>
                                                            <div class="content" v-text="modelData.note"></div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- ./row -->
                                </div><!-- ./col-md -->


                            </div><!-- ./row -->
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>
export default {
    data() {
      return {
        urlModel: '/accounting/suppliers',
        modelData: {
            name: "",
            company_name: "",
            phone: "",
            whatsapp_phone: "",
            email: "",
            logo: "",
            address: "",
            latitude: "",
            longitude: "",
            note: "",
            services: []
        },

        idPage: 'suppliers',
        breadcrumb: []
      }
    },
    methods: {
        getSupplier(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const supplier = response.data.supplier
                    if (supplier != null) {
                        this.modelData = supplier
                        if (supplier.latitude != null && supplier.longitude != null) {
                            this.$showGoogleMap(supplier.latitude,  supplier.longitude)
                        }
                    } else {
                        this.$router.push({name: 'suppliers'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getSupplier(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.getSupplier(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
            {label: this.$t('sidebar.suppliers'), to: {name: 'suppliers'}},
            {label: this.$t('global.supplier_profile'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getSupplier(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.supplier_profile')
        })
    }
}
</script>
