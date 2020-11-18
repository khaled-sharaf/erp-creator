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

        :excelFieldsExcepted="excelFieldsExcepted"
    >

        <tbody>
            <tr
                role="row"
                v-for="(expense, index) in dataTable"
                :key="expense.id"
                :data-id="expense.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{expense.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ expense.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('description') != -1" class="description">
                    {{ expense.description  }}
                </td>

                <td v-show="tableData.columns.indexOf('amount') != -1" class="amount">
                    {{ expense.amount }}
                </td>

                <td v-show="tableData.columns.indexOf('active') != -1" class="active">
                    <span class="badge badge-success" v-if="expense.active == 1" v-text="$t('global.active')"></span>
                    <span class="badge badge-warning" v-else v-text="$t('global.disactive')"></span>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="expense.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="expense.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <!-- btn edit row -->
                    <btn-edit :model="expense" :modelName="idPage"></btn-edit>
                    <!-- ./btn edit row -->

                    <!-- btn delete row -->
                    <btn-delete :model="expense" :modelName="idPage" @destroyRow="destroyRow(expense.id)"></btn-delete>
                    <!-- ./btn delete row -->

                    <!-- btn restore row -->
                    <btn-restore :model="expense" :modelName="idPage" @restoreRow="restoreRow(expense.id)"></btn-restore>
                    <!-- ./btn restore row -->

                    <!-- btn force delete row -->
                    <btn-force-delete :model="expense" :modelName="idPage" @forceDeleteRow="forceDeleteRow(expense.id)"></btn-force-delete>
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
        idPage: 'expenses',
        urlGetDataTable: '/accounting/expenses',
        filters: ['activation', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "name" },
            { label: "", name: "description" },
            { label: "", name: "amount" },
            { label: "", name: "active" },

            { label: "", name: "created_at" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['description'],
        breadcrumb: [],
        btnCreate: {},
        excelFieldsExcepted: ['created_at', 'updated_at']
    };
  },

    methods: {

    },


  mounted() {
    this.tableData.active = 1  
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'description',
        'amount'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
        {label: this.$t('sidebar.expenses'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_expense'), to: {name: this.idPage + '-create'}}
  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.expenses')
      })
  }
};
</script>

