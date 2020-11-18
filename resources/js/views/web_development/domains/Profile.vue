<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-domains')" :model="modelData" :modelName="idPage"></btn-edit>
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
                            <!-- ================================= lead_data ================================= -->
                            <div class="wrapper-section-data">
                                <!-- row -->
                                <div class="row">
                                    <!-- title   ===  domain_data -->
                                    <div class="col-12">
                                        <div class="form-title">
                                            <h3 class="text" v-text="$t('domains_table.domain_data')"></h3>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->


                                    <!-- lead_id -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('domains_table.domain_name') }}</label>
                                            <div class="content" v-text="modelData.domain_name"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- booking_date -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('domains_table.booking_date') }}</label>
                                            <div class="content" v-text="modelData.booking_date"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- renewal_date -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('domains_table.renewal_date') }}</label>
                                            <div class="content" v-text="modelData.renewal_date"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- price -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('domains_table.price') }}</label>
                                            <div class="content">
                                                <div class="amount">
                                                    {{ modelData.price }}
                                                    {{ $t('global.currency') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- description -->
                                    <div class="col-12">
                                        <div class="profile-field-group">
                                            <label>{{ $t('domains_table.description') }}</label>
                                            <div class="content" v-text="modelData.description"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                </div>
                                <!-- ./row -->
                            </div>
                            <!-- ./wrapper-section-data -->
                            <!-- ============================================================================= -->
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
        urlModel: '/domains',
        modelData: {
            id: "",
            domain_name: "",
            booking_date: "",
            renewal_date: "",
            description: "",
            price: "",
        },

        idPage: 'domains',
        breadcrumb: []
      }
    },
    methods: {
        getDoamin(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {

                if (response.status === 200) {
                    const domain = response.data.domain
                    if (domain != null) {
                        this.modelData = domain
                    } else {
                        this.$router.push({name: 'domains'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getDoamin(this.$route)
                }, 1000)
            })
        },

    },
    mounted() {
        this.getDoamin(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
            {label: this.$t('sidebar.domains'), to: {name: 'domains'}},
            {label: this.$t('global.domain_profile'), active: true},
        ]

    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.domain_profile')
        })
    }
}
</script>
