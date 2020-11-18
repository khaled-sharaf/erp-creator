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

        </template>

        <tbody>
            <tr
                role="row"
                v-for="(quotation, index) in dataTable"
                :key="quotation.id"
                :data-id="quotation.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{quotation.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="quotation.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('sales_id') != -1" class="sales_id">
                    <created-by :model="quotation.personal_sales" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('lead_id') != -1" class="lead_id">
                    <created-by v-if="quotation.lead != null" :model="quotation.lead" :modelName="quotation.lead.type == 2 ? 'clients-profile' : 'leads-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('lead_phone') != -1" class="lead_phone">
                    <a :href="'tel:' + quotation.lead.phone">{{quotation.lead.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('lead_whatsapp_phone') != -1" class="lead_whatsapp_phone">
                    <a target="_blank" v-link-whatsapp="quotation.lead.whatsapp_phone">{{quotation.lead.whatsapp_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('lead_type') != -1" class="lead_type">
                    <span class="badge badge-warning" v-if="quotation.lead.type == 0" v-text="$t('global.lead')"></span>
                    <span class="badge badge-primary" v-if="quotation.lead.type == 1" v-text="$t('global.meeting')"></span>
                    <span class="badge badge-success" v-if="quotation.lead.type == 2" v-text="$t('global.client')"></span>
                </td>

                <td v-show="tableData.columns.indexOf('total_amount') != -1" class="total_amount">
                    <span class="amount max-content">
                        {{ quotation.total_amount }}
                    </span>
                    <b>
                        {{ quotation.currency?quotation.currency.iso:"" }}
                        <!-- {{ $t('global.currency') }} -->
                    </b>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="quotation.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="quotation"
                        :modelName="idPage"
                        @destroyRow="destroyRow(quotation.id)"
                        @forceDeleteRow="forceDeleteRow(quotation.id)"
                        @restoreRow="restoreRow(quotation.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn craete lead_contracts -->
                            <router-link
                                v-if="quotation.deleted_at == null && quotation.lead != null && quotation.personal_sales != null && $can('create-lead_contracts')"
                                class="dropdown-item text-success"
                                :to="{name: 'lead_contracts-create', params: {id: quotation.lead.id, by_quotation: true, lead: quotation.lead, services: quotation.services, personal_sales: quotation.personal_sales}}"
                            >
                                <i class="fas fa-handshake"></i>
                                {{ $t('global.contract') }}
                            </router-link>
                            <!-- ./btn craete lead_contracts -->

                            <!-- btn save pdf -->
                            <a
                                v-if="quotation.deleted_at == null && $can('profile-quotations')"
                                class="dropdown-item text-secondary"
                                :href="$domain + 'quotation/pdf/' + quotation.secret_id + '/view'"
                                target="_blank"
                            >
                                <i class="fas fa-file-pdf"></i>
                                {{ $t('global.download') }}
                                PDF
                            </a>
                            <!-- ./btn save pdf -->

                            <!-- btn send pdf to_whatsapp -->
                            <a
                                v-if="quotation.deleted_at == null && quotation.lead != null && $can('profile-quotations')"
                                class="dropdown-item text-success"
                                v-send-whatsapp="{phone: quotation.lead.whatsapp_phone, text: 'Creator Quotation: \n\n ' + $domain + 'quotation/pdf/' + quotation.secret_id + '/view'}"
                                target="_blank"
                            >
                                <i class="fab fa-whatsapp"></i>
                                {{ $t('global.send') }}
                                {{ $t('global.to_whatsapp') }}
                            </a>
                            <!-- ./btn send pdf to_whatsapp -->

                            <!-- btn send pdf to_mail -->
                            <a
                                v-if="quotation.deleted_at == null && quotation.lead != null && $can('profile-quotations')"
                                class="dropdown-item text-primary"
                                :disabled="sendQuotationLoading"
                                @click.prevent="sendQuotation(quotation.id)"
                                href="javascript:void(0)"
                            >
                                <i class="fas fa-envelope"></i>
                                {{ $t('global.send') }}
                                {{ $t('global.to_mail') }}
                                <span v-if="sendQuotationLoading" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                            </a>
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
        idPage: 'quotations',
        urlGetDataTable: '/crm/quotations',
        filters: ['created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_at" },
            { label: "", name: "sales_id" },
            { label: "", name: "lead_id" },
            { label: "", name: "lead_phone" },
            { label: "", name: "lead_whatsapp_phone" },
            { label: "", name: "lead_type" },
            { label: "", name: "total_amount" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['sales_id', 'lead_id', 'lead_phone', 'lead_whatsapp_phone', 'lead_type'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['updated_at'],
        sendQuotationLoading: false
    };
  },


  methods: {
      sendQuotation(id) {
            this.sendQuotationLoading = true
            axios.post('/crm/send/quotation/' + id).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    this.sendQuotationLoading = false
                    if (typeof data === 'object') {
                        if (data.message === 'success') {
                            toastMsg.fire({
                                icon: 'success',
                                text: this.$t('quotations_table.msg_success_send_quotation')
                            })
                        } else if (data.message === 'lead_not_has_email') {
                            toastMsg.fire({
                                icon: 'error',
                                text: this.$t('messages.msg_not_mail_lead_registerd')
                            })
                        }
                    }
                }
            })
            .catch(errors => {
                this.sendQuotationLoading = false
                toastMsg.fire({
                    icon: 'error',
                    text: this.$t('quotations_table.msg_error_send_quotation')
                })
            })
        }
  },

  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
    ])

    this.breadcrumb = [
        {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
        {label: this.$t('sidebar.quotations'), active: true},
    ]
    if ($can('create-quotation')) {
        this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_quotation'), to: {name: this.idPage + '-create'}}
    }

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

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.quotations')
      })
  }
};
</script>
