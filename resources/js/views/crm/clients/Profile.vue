<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">


                <!-- btn new quotation -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.user != null && $can('create-quotations')"
                    class="btn btn-sm btn-secondary"
                    :to="{name: 'quotations-create', params: {id: modelData.id}}"
                >
                    {{ $t('sidebar.quotation') }}
                    <i class="fas fa-dollar-sign"></i>
                </router-link>
                <!-- ./btn new quotation -->

                <!-- btn craete lead_contracts -->
                <router-link
                    v-if="modelData.deleted_at == null && modelData.user != null && $can('create-lead_contracts')"
                    class="btn btn-sm btn-success"
                    :to="{name: 'lead_contracts-create', params: {id: modelData.id}}"
                >
                    <i class="fas fa-handshake"></i>
                    {{ $t('global.contract') }}
                </router-link>
                <!-- ./btn craete lead_contracts -->

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-clients')" :model="modelData" :modelName="idPage"></btn-edit>
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
                                        <img :src="$domain + modelData.company_logo" alt="Company logo">
                                    </div>
                                </div><!-- ./col-md -->

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
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.name') }}</label>
                                                <div class="content" v-text="modelData.name"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.phone">{{modelData.phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- whatsapp_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.whatsapp_phone') }}</label>
                                                <div class="content">
                                                    <a target="_blank" v-link-whatsapp="modelData.whatsapp_phone">{{modelData.whatsapp_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- email -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{$t('clients_table.email')}}</label>
                                                <div class="content">
                                                    <a :href="'mailto:' + modelData.email">{{modelData.email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- id_cart -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.id_cart') }}</label>
                                                <div class="content" v-text="modelData.id_cart"></div>
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
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.company_name') }}</label>
                                                <div class="content" v-text="modelData.company_name"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.company_phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.company_phone">{{modelData.company_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_email -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{$t('clients_table.company_email')}}</label>
                                                <div class="content">
                                                    <a :href="'mailto:' + modelData.company_email">{{modelData.company_email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_address -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.company_address') }}</label>
                                                <div class="content" v-text="modelData.company_address"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- company_scope -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.company_scope') }}</label>
                                                <div class="content" v-text="modelData.company_scope"></div>
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
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.assign_to') }}</label>
                                                <div class="content">
                                                    <created-by :model="modelData.user" :modelName="'users-profile'"></created-by>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- created_by -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.created_by') }}</label>
                                                <div class="content">
                                                    <created-by :model="modelData.created_by_user" :modelName="'users-profile'"></created-by>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <div class="col-12"></div>
                                        <br>

                                        <!-- note -->
                                        <div class="col-12">
                                            <div class="profile-field-group">
                                                <label>{{ $t('clients_table.note') }}</label>
                                                <div class="content" v-text="modelData.note"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


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
        urlModel: '/crm/clients',
        modelData: {
          name: "",
          phone: "",
          whatsapp_phone: "",
          email: "",
          id_cart: "",

          company_name: "",
          company_phone: "",
          company_email: "",
          company_logo: "",
          company_address: "",
          company_scope: "",
          latitude: "",
          longitude: "",

          assign_to: "",
          lead_status_id: "",
          note: ""
        },

        idPage: 'clients',
        breadcrumb: []
      }
    },
    methods: {
        getClient(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const client = response.data.lead
                    if (client != null && client.type == 2) {
                        this.modelData = client
                    } else {
                        this.$router.push({name: 'clients'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getClient(this.$route)
                }, 1000)
            })
        }
    },
    mounted() {
        this.getClient(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.clients'), to: {name: 'clients'}},
            {label: this.$t('global.client_profile'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getClient(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.client_profile')
        })
    }
}
</script>
