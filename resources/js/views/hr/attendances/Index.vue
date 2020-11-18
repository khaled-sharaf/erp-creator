<template>
    <div>
    <!-- Content Header (Page header) -->
    <header-comp :breadcrumb="breadcrumb" :btnCreate="btnCreate"></header-comp>
    <!-- /.content-header -->


    <section class="content">
        <div class="container-fulid">
            <div class="wrapper-reports">
                <div class="reports">
                    <div class="card">

                        <div class="card-header">
                            <div class="header-filter global-form-handel">
                                <div class="row">
                                    <div class="col-sm-4 col-md-3 col-xl-2">
                                        <div class="form-group form-group-input">
                                            <label v-text="$t('attendances_table.type')"></label>
                                            <div class="input-date">
                                                <button
                                                    class="btn btn-primary btn-sm mx-1"
                                                    v-text="$t('global.day')"
                                                    @click="switchType('day')"
                                                    :disabled="filter.type === 'day'"
                                                ></button>
                                                <button
                                                    class="btn btn-primary btn-sm"
                                                    v-text="$t('global.month')"
                                                    @click="switchType('month')"
                                                    :disabled="filter.type === 'month'"
                                                ></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ./col -->
                                    <!-- years -->
                                    <div class="col-sm-4 col-md-3 col-xl-2">
                                        <div class="form-group form-group-input">
                                            <label v-text="$t('global.year')"></label>
                                            <div class="input-date">
                                                    <!-- label="value" -->
                                                <vue-select
                                                    :options="years"
                                                    :reduce="year => year.value"
                                                    label="title"
                                                    v-model="filter.year"
                                                    class="select-one-line"
                                                >
                                                </vue-select>
                                            </div>
                                            <div class="paginate-date">
                                                <div class="arrow-left" @click="switchDate('year', -1)">
                                                    <span v-text="$t('datatable.prev')"></span>
                                                </div>
                                                <div class="arrow-right" @click="switchDate('year', 1)">
                                                    <span v-text="$t('datatable.next')"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================================== -->

                                    <!-- months -->
                                    <div class="col-sm-4 col-md-3 col-xl-2" v-if="filter.year != null">
                                        <div class="form-group form-group-input">
                                            <label v-text="$t('global.month')"></label>
                                            <div class="input-date">
                                                    <!-- label="value" -->
                                                <vue-select
                                                    :options="months"
                                                    :reduce="month => month.value"
                                                    label="title"
                                                    v-model="filter.month"
                                                    class="select-one-line"
                                                >
                                                </vue-select>
                                            </div>
                                            <div class="paginate-date">
                                                <div class="arrow-left" @click="switchDate('month', -1)">
                                                    <span v-text="$t('datatable.prev')"></span>
                                                </div>
                                                <div class="arrow-right" @click="switchDate('month', 1)">
                                                    <span v-text="$t('datatable.next')"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================================== -->

                                    <!-- days -->
                                    <div class="col-sm-4 col-md-3 col-xl-2" v-if="filter.type === 'day' && filter.month != null">
                                        <div class="form-group form-group-input">
                                            <label v-text="$t('global.day')"></label>
                                            <div class="input-date">
                                                    <!-- label="value" -->
                                                <vue-select
                                                    :options="days"
                                                    :reduce="day => day.value"
                                                    label="title"
                                                    v-model="filter.day"
                                                    class="select-one-line"
                                                >
                                                </vue-select>
                                            </div>
                                            <div class="paginate-date">
                                                <div class="arrow-left" @click="switchDate('day', -1)">
                                                    <span v-text="$t('datatable.prev')"></span>
                                                </div>
                                                <div class="arrow-right" @click="switchDate('day', 1)">
                                                    <span v-text="$t('datatable.next')"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- ================================== -->

                                    <!-- ./col -->
                                    <div class="col-sm-12 col-md-6 col-xl-4" v-if="$can('admin-hr')">
                                        <div class="form-group form-group-input">
                                            <label v-text="$t('attendances_table.user_id')"></label>
                                            <vue-select
                                                :options="users"
                                                label="name"
                                                :reduce="user => user.id"
                                                v-model="filter.user_id"
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
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title mb-0">
                                        {{ filter.day }}

                                        <span v-if="filter.month != null">
                                            {{ moment(currentDateFilter).format('MMMM') }}
                                        </span>

                                        <span v-if="filter.day != null">
                                            -
                                            {{ moment(currentDateFilter).format('dddd') }}
                                        </span>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body table-responsive p-0 table-filters loading-body">
                                    <table class="table table-hover table-sm table-bordered">
                                        <thead>
                                            <tr class="text-center tr-total" v-if="filter.type === 'month' && filter.user_id != null && filter.month != null">
                                                <th colspan="2" v-text="$t('global.total')"></th>
                                                <!-- all hours -->
                                                <th colspan="2" class="check_in">
                                                    {{ totalHours }}
                                                    <span v-if="totalHours > 0">
                                                        {{ totalHours <= 1.5 ? $t('global.hour') : $t('global.hours') }}
                                                    </span>
                                                </th>
                                                <!-- overtime -->
                                                <th class="overtime">
                                                    {{ totalOvertime / 60 }}
                                                    <span v-if="totalOvertime > 0">
                                                        {{ totalOvertime <= 60 ? $t('global.hour') : $t('global.hours') }}
                                                    </span>
                                                </th>
                                                <!-- permissions -->
                                                <th class="permission">
                                                    {{ totalPermissions / 60 }}
                                                    <span v-if="totalPermissions > 0">
                                                        {{ totalPermissions <= 60 ? $t('global.hour') : $t('global.hours') }}
                                                    </span>
                                                </th>
                                                <!-- absent -->
                                                <th class="absent">
                                                    {{ totalAbsent }}
                                                    <span v-if="totalAbsent > 0">
                                                        {{ totalAbsent == 1 ? $t('global.day') : $t('global.days') }}
                                                    </span>
                                                </th>
                                                <th colspan="3"></th>
                                            </tr>

                                            <tr>
                                                <!-- <th v-text="$t('attendances_table.id')"></th> -->
                                                <th v-text="$t('attendances_table.created_at')"></th>
                                                <th v-text="$t('attendances_table.user_id')"></th>
                                                <th v-text="$t('attendances_table.check_in')"></th>
                                                <th v-text="$t('attendances_table.check_out')"></th>
                                                <th v-text="$t('attendances_table.overtime')"></th>
                                                <th v-text="$t('attendances_table.permission')"></th>
                                                <th v-text="$t('attendances_table.absent')"></th>
                                                <th v-text="$t('attendances_table.comment')"></th>
                                                <th v-text="$t('attendances_table.type')"></th>
                                                <th v-text="$t('attendances_table.actions')"></th>
                                            </tr>



                                        </thead>
                                        <tbody>
                                            <tr
                                                v-for="(model, index) in dataTable"
                                                :key="index"
                                                :class="{
                                                    absent: model.absent == 1,
                                                    'vacation-day': moment(String(model.created_at)).format('dddd').toLowerCase() == 'friday'
                                                    || moment(String(model.created_at)).format('dddd').toLowerCase() == 'saturday'
                                                }">
                                                <!-- <td>183</td> -->
                                                <!-- created_at -->
                                                <td>
                                                    {{ moment(String(model.created_at)).format('YYYY') }}
                                                    <span class="light-purple">
                                                        {{ moment(String(model.created_at)).format('MMMM DD') }}
                                                    </span>
                                                    {{ moment(String(model.created_at)).format(' - hh:mm A') }}
                                                    <span class="light-purple">
                                                        {{ moment(String(model.created_at)).format('dddd') }}
                                                    </span>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- user_id -->
                                                <td>
                                                    <created-by v-if="model.user != null" :model="model.user" :modelName="'users-profile'"></created-by>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- check_in -->
                                                <td :class="{check_in: model.absent == 0 && model.check_in != null}">
                                                    <div v-if="model.absent == 0 && model.check_in != null">
                                                        <!-- {{ moment(String(model.check_in)).format('DD - ') }} -->
                                                        <span class="light">
                                                            {{ moment(String(model.check_in)).format('hh:mm') }}
                                                        </span>
                                                        {{ moment(String(model.check_in)).format('A') }}
                                                    </div>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- check_out -->
                                                <td :class="{check_out: model.absent == 0 && model.check_out != null}">
                                                    <div v-if="model.absent == 0 && model.check_out != null">
                                                        <!-- {{ moment(String(model.check_out)).format('DD - ') }} -->
                                                        <span class="light">
                                                            {{ moment(String(model.check_out)).format('hh:mm') }}
                                                        </span>
                                                        {{ moment(String(model.check_out)).format('A') }}
                                                    </div>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- overtime -->
                                                <td :class="{overtime: model.overtime != null && model.absent == 0}">
                                                    <div v-if="model.overtime != null && model.absent == 0">
                                                        <span class="light">
                                                            {{ model.overtime / 60 }}
                                                        </span>
                                                        {{ model.overtime <= 60 ? $t('global.hour') : $t('global.hours') }}
                                                    </div>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- permission_time -->
                                                <td :class="{permission: model.permission_time != null && model.absent == 0}">
                                                    <div v-if="model.permission_time != null && model.absent == 0">
                                                        <span class="light">
                                                            {{ model.permission_time / 60 }}
                                                        </span>
                                                        {{ model.permission_time <= 60 ? $t('global.hour') : $t('global.hours') }}
                                                        <span class="badge badge-info">
                                                            {{ model.permission_type | uppercase }}
                                                        </span>
                                                    </div>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- absent -->
                                                <td>
                                                    <span class="badge badge-danger" v-if="model.absent == 1" v-text="$t('attendances_table.absent')"></span>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- comment -->
                                                <td>
                                                    <b>
                                                        {{ model.comment }}
                                                    </b>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- type -->
                                                <td>
                                                    <span class="light-blue">
                                                        {{ model.type | capitalize }}
                                                    </span>
                                                </td>
                                                <!-- =========================== -->
                                                <!-- actions -->
                                                <td>
                                                    <menu-actions
                                                        :model="model"
                                                        :modelName="idPage"
                                                        @destroyRow="destroyRow(model.id)"
                                                    >
                                                    </menu-actions>
                                                </td>
                                                <!-- =========================== -->
                                            </tr>
                                            <!-- ==================================================== -->
                                        </tbody>
                                    </table>
                                    <div v-if="!dataTable.length && loadingData === false" class="alert alert-danger alert-dismissible">
                                        <h5><i class="icon fas fa-info"></i> {{ $t('datatable.empty_table') }}!</h5>
                                        {{ $t('datatable.no_data_msg') }}
                                    </div>
                                    <div class="loading-data" v-if="loadingData">
                                        <div class="wrapper-loading">
                                            <div class="loading">
                                                <img :src="$domain + 'admin/images/loader.gif'">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->
                                </div>
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
    data() {
        return {
            idPage: 'attendances',
            urlGetData: '/hr/attendances',
            users: [],
            breadcrumb: [],
            btnCreate: {},
            dataTable: [],
            totalOvertime: 0,
            totalPermissions: 0,
            totalAbsent: 0,
            totalHours: 0,
            loadingData: true,

            years: [],
            months: [],
            days: [],

            lastYears: 5,

            filter: {
                user_id: null,
                year: null,
                month: null,
                day: null,
                type: 'day'
            }
        };
    },

    watch: {
        filter: {
            handler(newFitler) {
                if (this.$route.params.id != newFitler.user_id && newFitler.user_id != null) {
                    this.$router.replace({
                        name: this.$route.name,
                        params: {
                            id: newFitler.user_id
                        }
                    })
                }
                if (newFitler.user_id == null) {
                    if (typeof this.$route.params.id != 'undefined') {
                        this.$router.replace({name: this.$route.name})
                    }
                }

                if (this.filter.year == null) {
                    this.filter.month = null
                }
                if (this.filter.month === null) {
                    this.filter.day = null
                }
                setTimeout(() => {
                    this.getData()
                }, 300)
            },
            deep: true
        }
    },

    methods: {
        getData() {
            this.loadingData = true
            axios.get(this.urlGetData, {params: this.filter}).then(response => {
                if (response.status === 200) {
                    const data = response.data.data
                    if (typeof data === 'object') {
                        this.dataTable = data.attendance
                        this.totalOvertime = Number(data.total_overtime)
                        this.totalPermissions = Number(data.total_permissions)
                        this.totalAbsent = Number(data.total_absent)
                        this.totalHours = Number(data.total_hours)
                        this.loadingData = false
                    } else {
                        setTimeout(() => {
                            this.getData()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getData()
                }, 500)
            })
        },

        destroyRow(id) {
            this.$destroyRow(id, this.urlGetData).then(() => {
                this.dataTable = this.dataTable.filter(a => a.id != id)
            })
        },

        switchType(type) {
            this.filter.type = type
            if (type === 'day') {
                this.filter.day = Number(this.moment().format('DD'))
            } else {
                this.filter.day = null
                this.filter.month = this.filter.month == null ? Number(this.moment().format('MM')) : this.filter.month
            }
        },

        switchDate(date, n) {
            if (date == 'year') {
                let currentYear = parseInt(this.moment().format('YYYY'))
                let lastYear = currentYear - this.lastYears
                if (n === 1) {
                    if (this.filter.year >= currentYear) return false
                } else {
                    if (this.filter.year <= lastYear) return false
                }

                if (this.filter.year == null) {
                    this.filter.year = currentYear - 1
                }
                this.filter.year = this.filter.year + n
            } else if (date == 'month') {
                if (n === 1) {
                    if (this.filter.month >= 12) return false
                } else {
                    if (this.filter.month <= 1) return false
                }
                this.filter.month = this.filter.month + n
            } else if (date == 'day') {
                if (n === 1) {
                    if (this.filter.day >= 31) return false
                } else {
                    if (this.filter.day <= 1) return false
                }
                this.filter.day = this.filter.day + n
            }
        }
    },

    filters: {
        timeHours(value) {
            value = parseInt(value)
            let hours = Math.floor(value / 60)
            let minutes = value % 60
            let result = hours
            if (minutes > 0) { result = hours + ':' + minutes }
            return result
        }
    },

    computed: {
        currentDateFilter() {
            let result = ''
            if (this.filter.year != null) {
                result += this.filter.year
            }
            if (this.filter.month != null) {
                result += this.filter.year != null ? '-' + this.filter.month : this.filter.month
            }
            if (this.filter.day != null) {
                result += this.filter.month != null ? '-' + this.filter.day : this.filter.day
            }
            return result
        }
    },

    mounted() {
        let currentYear = parseInt(this.moment().format('YYYY'))
        let currentMonth = parseInt(this.moment().format('MM'))
        let currentDay = parseInt(this.moment().format('DD'))

        // add years
        for (let y = (currentYear - this.lastYears); y <= currentYear; y++) {
            this.years.push({ title: y, value: y })
        }
        // add months
        for (let m = 1; m <= 12; m++) {
            let title = m < 10 ? '0' + m : m
            this.months.push({ title: title, value: m })
        }
        // add days
        for (let d = 1; d <= 31; d++) {
            let title = d < 10 ? '0' + d : d
            this.days.push({ title: title, value: d })
        }



        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.attendances'), active: true},
        ]
        this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_attendance'), to: {name: this.idPage + '-create'}, viewIf: $can('create-attendances')}

        $getUsersSelect().then(users => {
            this.users = users
            this.filter.user_id = typeof this.$route.params.id != 'undefined' ? Number(this.$route.params.id) : null
            this.filter.year = currentYear
            this.filter.month = currentMonth
            this.filter.day = currentDay
            if (this.filter.user_id != null) {
                this.switchType('month')
            }
        })
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.attendances')
        })
    }
};
</script>

