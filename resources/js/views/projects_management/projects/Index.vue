<template>
    <data-table
        :idPage="idPage"
        :showSettings="showSettings"
        :breadcrumb="breadcrumb"
        :columns="columns"
        :themeTableClasses="viewTableClasses"
        :dataTable="dataTable"
        :tableData="tableData"
        :perPage="perPage"
        :successResponse="successResponse"
        :columnsView="tableData.columns"
        :columnsExcepted="tableData.filter.columnsExcept"
        :themeTableClassesFilter="tableData.filter.viewTable"
        :sortOrders="sortOrders"
        :pagination="pagination"
        :filters="filters"

        :toggleShowSettings="toggleShowSettings"
        :deleteResotreMulti="deleteResotreMulti"
        :getData="getData"

        :excelFields="excelFields"
        :excelFieldsExcepted="excelFieldsExcepted"
    >

        <template slot="more-filters">

            <created-by-select
                :getData="getData"
                :tableData="tableData"
                v-if="$can('admin-crm')"
            ></created-by-select>

        </template>

        <tbody>
            <tr
                role="row"
                v-for="(project, index) in dataTable"
                :key="project.id"
                :data-id="project.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{project.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="project.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('staff') != -1" class="staff">
                    <div class="staff-in-table">
                        <!-- designer -->
                        <div
                            v-if="project.designer != null"
                            class="image designer"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="project.designer.name"
                        >
                            <img :src="$domain + project.designer.photo">
                        </div>
                        <!-- ============================================= -->

                        <!-- marketer -->
                        <div
                            v-if="project.marketer != null"
                            class="image marketer"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="project.marketer.name"
                        >
                            <img :src="$domain + project.marketer.photo">
                        </div>
                        <!-- ============================================= -->

                        <!-- advertiser -->
                        <div
                            v-if="project.advertiser != null"
                            class="image advertiser"
                            data-toggle="tooltip"
                            data-placement="top"
                            :title="project.advertiser.name"
                        >
                            <img :src="$domain + project.advertiser.photo">
                        </div>
                        <!-- ============================================= -->
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('lead_id') != -1" class="lead_id">
                    <created-by v-if="project.contract != null && project.contract.lead != null" :model="project.contract.lead" :modelName="'clients-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('lead_phone') != -1" class="lead_phone">
                    <div v-if="(!$can('admin-projects-management') && project.designer_id != $auth.id) || $can('admin-projects-management')">
                        <a v-if="project.contract != null && project.contract.lead != null" :href="'tel:' + project.contract.lead.phone">{{ project.contract.lead.phone }}</a>
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('company_name') != -1" class="company_name">
                    <span v-if="project.contract != null && project.contract.lead != null">
                        {{project.contract.lead.company_name}}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('start_date') != -1" class="start_date">
                    <div class="max-content">
                        {{project.contract.start_date}}
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('end_date') != -1" class="end_date">
                    <div class="max-content">
                        {{ $endContractDate(project.contract) }}
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('duration') != -1" class="duration">
                    {{ project.contract.duration }}
                    {{ project.contract.duration > 2 ? $t('global.months') : $t('global.month') }}
                </td>

                <td v-show="tableData.columns.indexOf('ads_amount') != -1" class="ads_amount">
                    <span class="amount max-content">
                        {{ project.contract.ads_amount }}
                    </span>
                    <b v-if="Number(project.contract.ads_amount) > 0">
                        {{ $t('global.currency') }}
                    </b>
                </td>

                <td v-show="tableData.columns.indexOf('status') != -1" class="status">
                    ---
                </td>

                <td v-show="tableData.columns.indexOf('created_by') != -1" class="created_by">
                    <created-by :model="project.created_by_user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="project.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="project"
                        :modelName="idPage"
                        :allows="{
                            viewModel: $t('sidebar.project_info'),
                            editModel: $t('projects_table.complete_project')
                        }"
                        @destroyRow="destroyRow(project.id)"
                        @forceDeleteRow="forceDeleteRow(project.id)"
                        @restoreRow="restoreRow(project.id)"
                    >
                        <template v-slot:before-delete>
                            <router-link
                                v-if="project.deleted_at == null && $can('profile-projects')"
                                class="dropdown-item"
                                :to="{name: 'home'}"
                            >
                                <i class="fas fa-eye"></i>
                                {{ $t('projects_table.view_project') }}
                            </router-link>
                        </template>
                    </menu-actions>

                    <!-- btn new task -->
                    <button
                        type="button"
                        class="btn btn-primary btn-sm btn-table-actions"
                    >
                        {{ $t('sidebar.New_task') }}
                    </button>
                    <!-- ./btn new task -->

                    <!-- btn accepte -->
                    <button
                        type="button"
                        v-if="!$can('admin-projects-management')"
                        v-text="$t('global.accepte_now')"
                        class="btn btn-success btn-sm btn-table-actions"
                        @click="accepteProject(project.id)"
                    ></button>
                    <!-- ./btn accepte -->
                </td>
            </tr>
        </tbody>
    </data-table>
</template>



<script>
import MixinsDatatable from "./../../../mixins/MixinsDatatable"
export default {
    mixins: [MixinsDatatable],
  data() {
    return {
        idPage: 'projects',
        urlGetDataTable: '/projectmanagement/projects',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_at" },
            { label: "", name: "staff" },
            { label: "", name: "lead_id" },
            { label: "", name: "lead_phone" },
            { label: "", name: "company_name" },
            { label: "", name: "start_date" },
            { label: "", name: "end_date" },
            { label: "", name: "duration" },
            { label: "", name: "ads_amount" },
            { label: "", name: "status" },
            { label: "", name: "created_by" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['created_by', 'sales_id', 'lead_id', 'lead_phone', 'company_name', 'start_date', 'end_date', 'duration', 'ads_amount'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['updated_at']
    };
  },

  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'lead_id',
        'lead_phone',
        'company_name'
    ])

    this.tableData.created_by = ''

    this.breadcrumb = [
        {label: this.$t('sidebar.projects_management'), to: {name: 'projects_management-model'}},
        {label: this.$t('sidebar.projects'), active: true},
    ]

    // this.excelFields = {
    //     [this.$t(this.idPage + '_table.created_by')]: {
    //         field: 'created_by_user',
    //         callback: (value) => {
    //             return value != null ? value.name : ''
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.lead_id')]: {
    //         field: 'lead',
    //         callback: (value) => {
    //             return value != null ? value.name : ''
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.company_name')]: {
    //         field: 'lead',
    //         callback: (value) => {
    //             return value != null ? value.company_name : ''
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.sales_id')]: {
    //         field: 'personal_sales',
    //         callback: (value) => {
    //             return value != null ? value.name : ''
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.duration')]: {
    //         field: 'duration',
    //         callback: (value) => {
    //             return value > 2 ? value + ' ' + this.$t('global.months') : value + ' ' + this.$t('global.month')
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.sales_commission')]: {
    //         callback: (value) => {
    //             let commission = 0
    //             if (value.personal_sales_commission != null) {
    //                 commission = parseInt(value.total_amount * (value.personal_sales_commission.commission / 100))
    //             } else {
    //                 commission = this.$t('global.undefined')
    //             }
    //             return commission
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.profit_company')]: {
    //         callback: (value) => {
    //             let profit = ''
    //             if (value.profit_company != null) {
    //                 profit = parseInt(value.profit_company) + parseInt(value.profit_company * (value.tax / 100))
    //             }
    //             return profit
    //         }
    //     },
    //     [this.$t(this.idPage + '_table.end_date')]: {
    //         callback: (value) => {
    //             return this.$endContractDate(value)
    //         }
    //     },
    // }

  },


  methods: {
    accepteProject(id) {
        console.log(id)
    },
  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.projects')
      })
  }
};
</script>

