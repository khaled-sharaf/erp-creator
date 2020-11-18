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
                v-if="$can('accounting-crm')"
            ></created-by-select>

        </template>

        <tbody>
            <tr
                role="row"
                v-for="(lead_contract, index) in dataTable"
                :key="lead_contract.id"
                :data-id="lead_contract.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{lead_contract.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="lead_contract.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('sales_id') != -1" class="sales_id">
                    <created-by :model="lead_contract.personal_sales" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('lead_id') != -1" class="lead_id">
                    <created-by :model="lead_contract.lead" :modelName="'clients-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('lead_phone') != -1" class="lead_phone">
                    <a :href="'tel:' + lead_contract.lead.phone">{{ lead_contract.lead.phone }}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_name') != -1" class="company_name">
                    {{lead_contract.lead.company_name}}
                </td>

                <td v-show="tableData.columns.indexOf('start_date') != -1" class="start_date">
                    <div class="max-content">
                        {{lead_contract.start_date}}
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('end_date') != -1" class="end_date">
                    <div class="max-content">
                        {{ $endContractDate(lead_contract) }}
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('duration') != -1" class="duration">
                    {{ lead_contract.duration }}
                    {{ lead_contract.duration > 2 ? $t('global.months') : $t('global.month') }}
                </td>

                <td v-show="tableData.columns.indexOf('total_amount') != -1" class="total_amount">
                    <span class="amount max-content">
                        {{ lead_contract.total_amount }}
                        {{ $t('global.currency') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('sales_commission') != -1" class="sales_commission">
                    <span v-if="lead_contract.personal_sales_commission != null">
                        <span class="amount max-content">
                            {{ parseInt(lead_contract.profit_company * (lead_contract.personal_sales_commission.commission / 100)) }}
                            {{ $t('global.currency') }}
                        </span>
                    </span>
                    <span v-else class="badge badge-danger">
                        {{ $t('global.undefined') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('profit_company') != -1" class="profit_company">
                    <span class="amount max-content" v-if="lead_contract.profit_company != null">
                        {{ lead_contract.profit_company }}
                        {{ $t('global.currency') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('ads_amount') != -1" class="ads_amount">
                    <span class="amount max-content" v-if="lead_contract.profit_ads != null">
                        {{ lead_contract.profit_ads }}
                        {{ $t('global.currency') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('paid_amount') != -1" class="paid_amount">
                    <span class="amount max-content" v-if="lead_contract.paid_amount != null">
                        {{ lead_contract.paid_amount }}
                        {{ $t('global.currency') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('remaining_amount') != -1" class="remaining_amount">
                    <span class="amount max-content">
                        {{ parseInt(lead_contract.total_amount - lead_contract.paid_amount) }}
                        {{ $t('global.currency') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('created_by') != -1" class="created_by">
                    <created-by :model="lead_contract.created_by_user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="lead_contract.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="lead_contract"
                        :modelName="idPage"
                        :allows="{viewModel: false, editModel: false, deleteModel: false, restoreModel: false, forceDeleteModel: false}"
                    >
                        <template v-slot:before-delete>
                            <!-- view profile -->
                            <router-link
                                v-if="lead_contract.deleted_at == null && $can('profile-lead_contracts')"
                                class="dropdown-item link-router-in-table"
                                :to="{name: 'contracts-profile', params: {id: lead_contract.id}}"
                                data-name="contracts-profile"
                                :data-params='`{"id": ${lead_contract.id}}`'
                            >
                                <i class="fas fa-eye"></i>
                                {{ $t('global.view_profile') }}
                            </router-link>
                            <!-- ./view profile -->

                            <!-- btn payments -->
                            <router-link
                                v-if="lead_contract.deleted_at == null && $can('payment-lead_contracts')"
                                class="dropdown-item text-success"
                                :to="{name: 'contracts-payments', params: {id: lead_contract.id}}"
                            >
                                <i class="far fa-credit-card"></i>
                                {{ $t('global.payments') }}
                            </router-link>
                            <!-- ./btn payments -->

                            <!-- btn invoice -->
                            <a
                                v-if="lead_contract.deleted_at == null && $can('invoice-lead_contracts')"
                                class="dropdown-item text-primary"
                                :href="$domain + 'invoice/pdf/' + lead_contract.secret_id + '/view'"
                                target="_blank"
                            >
                                <i class="fas fa-file-invoice"></i>
                                {{ $t('global.invoice') }}
                            </a>
                            <!-- ./btn invoice -->

                            <!-- btn save pdf -->
                            <a
                                v-if="lead_contract.deleted_at == null && $can('download-pdf-lead_contracts')"
                                class="dropdown-item text-secondary"
                                :href="$domain_admin + 'contract/pdf/' + lead_contract.id"
                            >
                                <i class="fas fa-file-pdf"></i>
                                {{ $t('global.download') }}
                                PDF
                            </a>
                            <!-- ./btn save pdf -->

                            <!-- btn create project -->
                            <a
                                v-if="lead_contract.deleted_at == null && lead_contract.project == null && $can('create-projects')"
                                class="dropdown-item text-secondary"
                                @click.prevent="createNewProject(lead_contract.id, index)"
                                href="javascript:void(0)"
                            >
                                {{ $t('projects_table.create_project') }}
                                <i class="fas fa-project-diagram"></i>
                            </a>
                            <!-- ./btn create project -->

                        </template>
                    </menu-actions>

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
        idPage: 'lead_contracts',
        urlGetDataTable: '/crm/lead_contracts',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_at" },
            { label: "", name: "sales_id" },
            { label: "", name: "lead_id" },
            { label: "", name: "lead_phone" },
            { label: "", name: "company_name" },
            { label: "", name: "start_date" },
            { label: "", name: "end_date" },
            { label: "", name: "duration" },
            { label: "", name: "total_amount" },
            { label: "", name: "sales_commission" },
            { label: "", name: "profit_company" },
            { label: "", name: "ads_amount" },
            { label: "", name: "paid_amount" },
            { label: "", name: "remaining_amount" },
            { label: "", name: "created_by" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['created_by', 'sales_id', 'lead_id', 'lead_phone', 'company_name', 'sales_commission', 'ads_amount', 'remaining_amount'],
        breadcrumb: [],
        excelFields: {},
        excelFieldsExcepted: ['updated_at']
    };
  },

  methods: {
      createNewProject(lead_contract_id, index) {
          this.$createNewProject(lead_contract_id).then(res => {
              let contract = this.dataTable.find(con => con.id == lead_contract_id)
              if (contract) {
                  contract.project = {}
              }
              this.dataTable[index] = contract
            //   this.getData()
          })
      }
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
        {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
        {label: this.$t('sidebar.lead_contracts'), active: true},
    ]

    this.excelFields = {
        [this.$t(this.idPage + '_table.created_by')]: {
            field: 'created_by_user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.lead_id')]: {
            field: 'lead',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.company_name')]: {
            field: 'lead',
            callback: (value) => {
                return value != null ? value.company_name : ''
            }
        },
        [this.$t(this.idPage + '_table.sales_id')]: {
            field: 'personal_sales',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.duration')]: {
            field: 'duration',
            callback: (value) => {
                return value > 2 ? value + ' ' + this.$t('global.months') : value + ' ' + this.$t('global.month')
            }
        },
        [this.$t(this.idPage + '_table.sales_commission')]: {
            callback: (value) => {
                let commission = 0
                if (value.personal_sales_commission != null) {
                    commission = parseInt(value.total_amount * (value.personal_sales_commission.commission / 100))
                } else {
                    commission = this.$t('global.undefined')
                }
                return commission
            }
        },
        [this.$t(this.idPage + '_table.profit_company')]: {
            callback: (value) => {
                let profit = ''
                if (value.profit_company != null) {
                    profit = parseInt(value.profit_company) + parseInt(value.profit_company * (value.tax / 100))
                }
                return profit
            }
        },
        [this.$t(this.idPage + '_table.ads_amount')]: {
            callback: (value) => {
                let profit = ''
                if (value.profit_ads != null) {
                    profit = parseInt(value.profit_ads) + parseInt(value.profit_ads * (value.tax / 100))
                }
                return profit
            }
        },
        [this.$t(this.idPage + '_table.remaining_amount')]: {
            callback: (value) => {
                return parseInt(value.total_amount - value.paid_amount)
            }
        },
        [this.$t(this.idPage + '_table.end_date')]: {
            callback: (value) => {
                return this.$endContractDate(value)
            }
        },
    }
  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.lead_contracts')
      })
  }
};
</script>

