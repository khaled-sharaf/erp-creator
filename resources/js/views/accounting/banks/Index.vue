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

        <tbody>
            <tr
                role="row"
                v-for="(bank, index) in dataTable"
                :key="bank.id"
                :data-id="bank.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{bank.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ bank.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('type') != -1" class="type">
                    {{ $t('global.accounts_types')[bank.type] }}
                </td>

                <td v-show="tableData.columns.indexOf('account_no') != -1" class="account_no">
                    {{ bank.account_no }}
                </td>

                <td v-show="tableData.columns.indexOf('balance') != -1" class="balance">
                    <span class="amount max-content" v-text="bank.balance"></span>
                </td>

                <td v-show="tableData.columns.indexOf('credit') != -1" class="credit">
                    <span class="amount max-content" v-text="bank.credit"></span>
                </td>

                <td v-show="tableData.columns.indexOf('debit') != -1" class="debit">
                    <span class="amount max-content" v-text="bank.debit"></span>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="bank.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="bank.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <router-link
                        class="btn btn-dark btn-show-profile btn-table-actions btn-sm"
                        :to="{name: 'payments', params: {id: bank.id}}"
                    >
                        {{ $t('global.view_payments') }}
                        <i class="fas fa-eye"></i>
                    </router-link>

                    <!-- btn edit row -->
                    <btn-edit :model="bank" :modelName="idPage"></btn-edit>
                    <!-- ./btn edit row -->

                    <!-- btn delete row -->
                    <btn-delete :model="bank" :modelName="idPage" @destroyRow="destroyRow(bank.id)"></btn-delete>
                    <!-- ./btn delete row -->

                    <!-- btn restore row -->
                    <btn-restore :model="bank" :modelName="idPage" @restoreRow="restoreRow(bank.id)"></btn-restore>
                    <!-- ./btn restore row -->

                    <!-- btn force delete row -->
                    <btn-force-delete :model="bank" :modelName="idPage" @forceDeleteRow="forceDeleteRow(bank.id)"></btn-force-delete>
                    <!-- ./btn force delete row -->
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
        idPage: 'banks',
        urlGetDataTable: '/accounting/accounts',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "name" },
            { label: "", name: "type" },
            { label: "", name: "account_no" },
            { label: "", name: "balance" },
            { label: "", name: "credit" },
            { label: "", name: "debit" },

            { label: "", name: "created_at" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: [],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['updated_at'],
    };
  },


  mounted() {
    this.tableData.kind = 'bank'
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'type',
        'account_no',
        'balance',
        'credit',
        'debit'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
        {label: this.$t('sidebar.banks'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_bank'), to: {name: this.idPage + '-create'}}

  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.banks')
      })
  }
};
</script>

