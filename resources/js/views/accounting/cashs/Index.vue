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
                v-for="(cash, index) in dataTable"
                :key="cash.id"
                :data-id="cash.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{cash.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ cash.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('balance') != -1" class="balance">
                    <span class="amount max-content" v-text="cash.balance"></span>
                </td>

                <td v-show="tableData.columns.indexOf('credit') != -1" class="credit">
                    <span class="amount max-content" v-text="cash.credit"></span>
                </td>

                <td v-show="tableData.columns.indexOf('debit') != -1" class="debit">
                    <span class="amount max-content" v-text="cash.debit"></span>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="cash.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="cash.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <router-link
                        class="btn btn-dark btn-show-profile btn-table-actions btn-sm"
                        :to="{name: 'payments', params: {id: cash.id}}"
                    >
                        {{ $t('global.view_payments') }}
                        <i class="fas fa-eye"></i>
                    </router-link>

                    <!-- btn edit row -->
                    <btn-edit :model="cash" :modelName="idPage"></btn-edit>
                    <!-- ./btn edit row -->

                    <!-- btn delete row -->
                    <btn-delete :model="cash" :modelName="idPage" @destroyRow="destroyRow(cash.id)"></btn-delete>
                    <!-- ./btn delete row -->

                    <!-- btn restore row -->
                    <btn-restore :model="cash" :modelName="idPage" @restoreRow="restoreRow(cash.id)"></btn-restore>
                    <!-- ./btn restore row -->

                    <!-- btn force delete row -->
                    <btn-force-delete :model="cash" :modelName="idPage" @forceDeleteRow="forceDeleteRow(cash.id)"></btn-force-delete>
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
        idPage: 'cashs',
        urlGetDataTable: '/accounting/accounts',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "name" },
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
    this.tableData.kind = 'cash'
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'balance',
        'credit',
        'debit'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
        {label: this.$t('sidebar.cashs'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_cash'), to: {name: this.idPage + '-create'}}

  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.cashs')
      })
  }
};
</script>

