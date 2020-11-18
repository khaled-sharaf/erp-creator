<template>
    <data-table
        :idPage="idPage"
        :showSettings="showSettings"
        :breadcrumb="breadcrumb"
        :btnCreate="btnCreate"
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
                    </span>
                    <b>
                        <!-- {{ $t('global.currency') }} -->
                        {{ lead_contract.currency?lead_contract.currency.iso:"" }}
                    </b>
                </td>

                <td v-show="tableData.columns.indexOf('sales_commission') != -1" class="sales_commission">
                    <span v-if="lead_contract.personal_sales_commission != null">
                        <span class="amount max-content">
                            {{ parseInt(lead_contract.profit_company * (lead_contract.personal_sales_commission.commission / 100)) }}
                        </span>
                        <b>
                            <!-- {{ $t('global.currency') }} -->
                        {{ lead_contract.currency?lead_contract.currency.iso:"" }}
                        </b>
                    </span>
                    <span v-else class="badge badge-danger">
                        {{ $t('global.undefined') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('profit_company') != -1" class="profit_company">
                    <span class="amount max-content" v-if="lead_contract.profit_company != null">
                        {{ lead_contract.profit_company }}
                    </span>
                    <b>
                        <!-- {{ $t('global.currency') }} -->
                        {{ lead_contract.currency?lead_contract.currency.iso:"" }}
                    </b>
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
                        @destroyRow="destroyRow(lead_contract.id)"
                        @forceDeleteRow="forceDeleteRow(lead_contract.id)"
                        @restoreRow="restoreRow(lead_contract.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn renewal contract -->
                            <a
                                v-if="lead_contract.deleted_at == null && lead_contract.lead != null && $can('create-lead_contracts')"
                                class="dropdown-item text-success"
                                :href="`lead_contracts/${lead_contract.id}/renewal`"
                            >
                                <i class="fas fa-retweet"></i>
                                {{ $t('global.renewal') }}
                            </a>
                            <!-- ./btn renewal contract -->

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

                            <!-- btn send pdf to_whatsapp -->
                            <a
                                v-if="lead_contract.deleted_at == null && lead_contract.lead != null && $can('view-pdf-lead_contracts')"
                                class="dropdown-item text-success"
                                v-send-whatsapp="{phone: lead_contract.lead.whatsapp_phone, text: 'Creator Contract: \n\n ' + $domain + 'contract/pdf/' + lead_contract.secret_id + '/view'}"
                                target="_blank"
                            >
                                <i class="fas fa-file-pdf"></i>
                                {{ $t('global.send') }}
                                {{ $t('global.to_whatsapp') }}
                            </a>
                            <!-- ./btn send pdf to_whatsapp -->

                            <!-- btn send pdf to_mail -->
                            <a
                                v-if="lead_contract.deleted_at == null && lead_contract.lead != null && $can('profile-lead_contracts')"
                                class="dropdown-item text-primary"
                                href="javascript:void(0)"
                            >
                                <!-- :disabled="sendQuotationLoading" -->
                                <!-- @click.prevent="sendQuotation(quotation.id)" -->
                                <i class="fas fa-envelope"></i>
                                {{ $t('global.send') }}
                                {{ $t('global.to_mail') }}
                            </a>
                                <!-- <span v-if="sendQuotationLoading" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span> -->
                            <!-- ./btn send pdf to_mail -->

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
        urlGetDataTable: '/lead_contracts',
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
            { label: "", name: "created_by" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['created_by', 'sales_id', 'lead_id', 'lead_phone', 'company_name', 'sales_commission'],
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
        {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
        {label: this.$t('sidebar.lead_contracts'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_lead_contract'), to: {name: this.idPage + '-create'}, viewIf: $can('create-lead_contracts')}

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
