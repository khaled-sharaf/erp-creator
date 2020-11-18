<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->

        <!-- money -->
        <!-- all contracts -->
        <money v-model="reports.all_contracts.total_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.all_contracts.paid_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.all_contracts.remaining_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.all_contracts.profit_company" v-bind="{masked: true}"></money>
        <money v-model="reports.all_contracts.ads_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.all_contracts.sales_commission" v-bind="{masked: true}"></money>

        <!-- current contracts -->
        <money v-model="reports.current_contracts.total_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.current_contracts.paid_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.current_contracts.remaining_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.current_contracts.profit_company" v-bind="{masked: true}"></money>
        <money v-model="reports.current_contracts.ads_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.current_contracts.sales_commission" v-bind="{masked: true}"></money>

        <!-- paid contracts -->
        <money v-model="reports.paid_contracts.total_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.paid_contracts.paid_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.paid_contracts.remaining_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.paid_contracts.profit_company" v-bind="{masked: true}"></money>
        <money v-model="reports.paid_contracts.ads_amount" v-bind="{masked: true}"></money>
        <money v-model="reports.paid_contracts.sales_commission" v-bind="{masked: true}"></money>
        <!-- ./money -->

        <section class="content">
            <div class="container-fulid">
                <div class="wrapper-reports">
                    <div class="reports">
                        <div class="card">
                            <div class="card-header">
                                <div class="header-filter global-form-handel">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-3 col-xl-2">
                                            <div class="form-group form-group-input">
                                                <label v-text="$t('global.from')"></label>
                                                <div class="input-date">
                                                    <date-picker
                                                        v-model="filter.from_date"
                                                        @input="getReports"
                                                        type="date"
                                                        value-type="format"
                                                        format="YYYY-MM-DD"
                                                        :placeholder="$t('global.from')"
                                                        :lang="$langDatePicker"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-sm-6 col-md-3 col-xl-2">
                                            <div class="form-group form-group-input">
                                                <label v-text="$t('global.to')"></label>
                                                <div class="input-date">
                                                    <date-picker
                                                        v-model="filter.to_date"
                                                        @input="getReports"
                                                        type="date"
                                                        value-type="format"
                                                        format="YYYY-MM-DD"
                                                        :placeholder="$t('global.to')"
                                                        :lang="$langDatePicker"
                                                    ></date-picker>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                        <div class="col-sm-12 col-md-6 col-xl-4" v-if="$can('admin-crm')">
                                            <div class="form-group form-group-input">
                                                <label v-text="$t('leads_table.assign_to')"></label>
                                                <vue-select
                                                    :options="users"
                                                    v-model="filter.user_id"
                                                    label="name"
                                                    :reduce="user => user.id"
                                                    @input="getReports"
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
                                            </div>
                                        </div>
                                        <!-- ./col -->
                                    </div>
                                </div>
                            </div>
                            <!-- card header -->
                            <div class="card-body">
                                <div class="total-counts">
                                    <div class="row">
                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box paid_amount text-white">
                                                <div class="inner">
                                                    <h3 v-text="reports.clients.total"></h3>
                                                    <p v-text="$t('sidebar.clients')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-check"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'clients'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.clients') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box remaining_amount text-white">
                                                <div class="inner">
                                                    <h3 v-text="reports.services.total"></h3>
                                                    <p v-text="$t('sidebar.services')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-boxes"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'services'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.services') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-primary">
                                                <div class="inner">
                                                    <h3 v-text="reports.leads.total"></h3>
                                                    <p v-text="$t('sidebar.leads')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-clock"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'leads'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.leads') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-warning">
                                                <div class="inner">
                                                    <h3 v-text="reports.meetings.total"></h3>
                                                    <p v-text="$t('sidebar.meetings')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-user-friends"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'meetings'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.meetings') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-dark">
                                                <div class="inner">
                                                    <h3 v-text="reports.all_contracts.total"></h3>
                                                    <p v-text="$t('global.n_all') + ' ' + $t('sidebar.lead_contracts')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-handshake"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'lead_contracts'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.lead_contracts') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-danger">
                                                <div class="inner">
                                                    <h3 v-text="reports.current_contracts.total"></h3>
                                                    <p v-text="$t('sidebar.lead_current_contracts')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="far fa-handshake"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'lead_contracts'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.lead_contracts') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <h3 v-text="reports.paid_contracts.total"></h3>
                                                    <p v-text="$t('sidebar.lead_paid_contracts')"></p>
                                                </div>
                                                <div class="icon">
                                                    <i class="fas fa-credit-card"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'lead_contracts'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.lead_contracts') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <!-- ==================================================================== -->
                                        <!-- total counts all contracts -->
                                        <div class="col-12">
                                            <b v-text="$t('global.n_all') + ' ' + $t('sidebar.lead_contracts')"></b>
                                        </div>


                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white total_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.total_amount')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.total_amount"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white paid_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.paid_amount')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.paid_amount"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white remaining_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.remaining_amount')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.remaining_amount"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white profit_company">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.profit_company')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.profit_company"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white ads_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.ads_amount')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.ads_amount"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white sales_commission">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('lead_contracts_table.sales_commission')"></span>
                                                    <span class="info-box-number" v-text="reports.all_contracts.sales_commission"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./total counts all contracts -->




                                        <!-- ==================================================================== -->
                                        <!-- total leads -->
                                        <div class="col-12">
                                            <b v-text="$t('global.n_all') + ' ' + $t('sidebar.leads')"></b>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white total_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('global.total') + ' ' + $t('sidebar.leads')"></span>
                                                    <span class="info-box-number" v-text="reports.leads.total"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div
                                            class="col-sm-6 col-md-4 col-lg-3 col-xl-2"
                                            v-for="status in reports.leads.statuses"
                                            :key="status.name"
                                        >
                                            <div class="info-box text-white" :style="{backgroundColor: status.color}">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="status.name"></span>
                                                    <span class="info-box-number" v-text="status.leads_count"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./total leads  -->

                                        <!-- ==================================================================== -->
                                        <!-- total meetings -->
                                        <div class="col-12">
                                            <b v-text="$t('global.n_all') + ' ' + $t('sidebar.meetings')"></b>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box text-white total_amount">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('global.total') + ' ' + $t('sidebar.meetings')"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.total"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_done">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' Done'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.done"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_next_meeting">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' Next meeting'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.next_meeting"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_project_delay">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' Project delay'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.project_delay"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_refused_offer">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' Refused offer'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.refused_offer"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_rejected">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' Rejected'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.rejected"></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="info-box meeting_none">
                                                <div class="info-box-content">
                                                    <span class="info-box-text" v-text="$t('sidebar.meetings') + ' None'"></span>
                                                    <span class="info-box-number" v-text="reports.meetings.none"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- ./total meetings  -->
                                    </div>
                                    <!-- ./row -->
                                </div>
                                <!-- ./total-counts -->
                            </div>
                            <!-- card body -->
                        </div>
                        <!-- card -->
                    </div>
                </div>
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>

export default {
    components: {

    },
    data() {
      return {
        urlGetReports: '/crm/crm-total-counts',
        filter: {
            from_date: '',
            to_date: '',
            user_id: '',
        },
        reports: {
            leads: {
                total: 0,
                statuses: [],
            },
            meetings: {
                total: 0,
                none: 0,
                done: 0,
                next_meeting: 0,
                project_delay: 0,
                refused_offer: 0,
                rejected: 0
            },
            clients: {
                total: 0,
            },
            all_contracts: {
                total: 0,
                total_amount: 0,
                paid_amount: 0,
                remaining_amount: 0,
                profit_company: 0,
                ads_amount: 0,
                sales_commission: 0,
            },
            current_contracts: {
                total: 0,
                total_amount: 0,
                paid_amount: 0,
                remaining_amount: 0,
                profit_company: 0,
                ads_amount: 0,
                sales_commission: 0,
            },
            paid_contracts: {
                total: 0,
                total_amount: 0,
                paid_amount: 0,
                remaining_amount: 0,
                profit_company: 0,
                ads_amount: 0,
                sales_commission: 0,
            },
            services: {
                total: 0,
            },
        },
        users: [],
        idPage: 'crm_reports',
        breadcrumb: [],
      }
    },
    methods: {
        getReports() {
            axios.get(this.urlGetReports, {params: this.filter}).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    if (typeof data === 'object') {
                        this.reports = data.data
                    } else {
                        setTimeout(() => {
                            this.getReports()
                        }, 1000)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getReports()
                }, 1000)
            })
        },

        resetFilter() {
            this.filter.from_date = ''
            this.filter.to_date = ''
            this.filter.user_id = ''
        }
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
            {label: this.$t('sidebar.reports'), active: true},
        ]
        $getUsersSelect().then(users => {
            this.users = users
        })
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            vm.getReports()
            to.meta.title = vm.$t('sidebar.crm_reports')
        })
    }
}
</script>
