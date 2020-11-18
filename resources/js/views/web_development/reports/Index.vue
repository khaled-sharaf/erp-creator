<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb"></header-comp>
        <!-- /.content-header -->

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
                                        <div class="col-sm-12 col-md-6 col-xl-4" v-if="$can('admin-web-development')">
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
                                                    <!-- <h3 v-text="reports.clients.total"></h3> -->
                                                    <p v-text="$t('sidebar.websites')"></p>
                                                    <p>{{websites}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="fas fa-sitemap"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'websites'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.websites') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box remaining_amount text-white">
                                                <div class="inner">
                                                    <!-- <h3 v-text="reports.services.total"></h3> -->
                                                    <p v-text="$t('sidebar.hostings')"></p>
                                                    <p>{{hosts}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="fas fa-h-square"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'hostings'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.hostings') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-warning  ">
                                                <div class="inner">
                                                    <p v-text="$t('sidebar.hostings_total_price')"></p>
                                                    <p>{{hosts_total_price}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="fas fa-hand-holding-usd"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'hostings'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.hostings') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-primary">
                                                <div class="inner">
                                                    <!-- <h3 v-text="reports.leads.total"></h3> -->
                                                    <p v-text="$t('sidebar.domains')"></p>
                                                    <p>{{domains}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="fas fa-boxes"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'domains'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.domains') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

                                        <div class="col-sm-6 col-md-4 col-lg-3 col-xl-2">
                                            <div class="small-box bg-success">
                                                <div class="inner">
                                                    <p v-text="$t('sidebar.domains_total_price')"></p>
                                                    <p>{{domains_total_price}}</p>
                                                </div>
                                                <div class="icon">
                                                  <i class="fas fa-hand-holding-usd"></i>
                                                </div>
                                                <router-link
                                                    class="small-box-footer"
                                                    :to="{name: 'domains'}"
                                                >
                                                    {{ $t('global.n_all') }}
                                                    {{ $t('sidebar.domains') }}
                                                    <i class="fas fa-arrow-circle-right"></i>
                                                </router-link>
                                            </div>
                                        </div>
                                        <!-- ./col -->

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
        urlGetReports: 'web-total-counts',
        filter: {
            from_date: '',
            to_date: '',
            user_id: '',
        },
        websites: '',
        hosts: '',
        hosts_total_price: '',
        domains: '',
        domains_total_price: '',
        users: [],
        idPage: 'web_reports',
        breadcrumb: [],
      }
    },
    methods: {
        getReports() {
            axios.get(this.urlGetReports, {params: this.filter}).then(response => {

              if (response.status === 200) {
              console.log(response);
                    const data = response.data
                        this.websites = data.webs;
                        this.hosts = data.hosts;
                        this.hosts_total_price = data.hosts_total_price;
                        this.domains = data.domains;
                        this.domains_total_price = data.domains_total_price;
                }

                // console.log(this.domains);

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
            {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
            {label: this.$t('sidebar.reports'), active: true},
        ]
        $getUsersSelect().then(users => {
          // console.log(users);

            this.users = users
        })
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            vm.getReports()
            to.meta.title = vm.$t('sidebar.web_reports')
        })
    }
}
</script>
