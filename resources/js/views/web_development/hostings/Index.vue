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
        :rangeDateDays="rangeDateDays"
        :rangeDateMonths="rangeDateMonths"
    >

        <tbody>
            <tr
                role="row"
                v-for="(hosting, index) in dataTable"
                :key="hosting.id"
                :data-id="hosting.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{hosting.hosting_name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('country') != -1" class="country">
                    {{ hosting.price != null ? hosting.price + ' ' + $t('global.currency') : '' }}
                </td>

                <td v-show="tableData.columns.indexOf('hiring_date') != -1" class="hiring_date">
                    {{ hosting.booking_date }}
                </td>

                <td v-show="tableData.columns.indexOf('email') != -1" class="email">
                    {{ hosting.renewal_date }}
                </td>

                <td v-show="tableData.columns.indexOf('salary') != -1" class="salary">
                    <!-- {{rangeDateDays[index]}} -->
                    <span
                        class="badge status-badge text-white"
                        :style="{'background-color': rangeDateMonths[index] <= 1 ? '#eb4d4b' : '#2fa360'}"
                        >
                        <span class="text">{{rangeDateMonths[index]}}</span>
                    </span>
                    <!-- {{rangeDateMonths[index]}} -->
                </td>

                <td v-show="tableData.columns.indexOf('description') != -1" class="description">
                    {{ hosting.description  }}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="hosting.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="hosting"
                        :modelName="idPage"
                        @destroyRow="destroyRow(hosting.id)"
                        @forceDeleteRow="forceDeleteRow(hosting.id)"
                        @restoreRow="restoreRow(hosting.id)"
                    >
                    </menu-actions>
                </td>
            </tr>
        </tbody>
    </data-table>
</template>



<script>
import MixinsDatatable from "./../../../mixins/MixinsDatatable"
import moment from 'moment'

export default {
    mixins: [MixinsDatatable],
  data() {
    return {
        idPage: 'hostings',
        urlGetDataTable: '/hostings',
        filters: ['trashed', 'search'],
        columns: [
            // { label: "", name: "id" },
            { label: "", name: "name" },
            { label: "", name: "country" },
            { label: "", name: "hiring_date" },
            { label: "", name: "email" },
            { label: "", name: "salary" },
            { label: "", name: "description" },
        ],
        columnsExceptedSorting: [],
        breadcrumb: [],
        btnCreate: {},
        excelFieldsExcepted: ['description'],
    };
  },
  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'price',
        'renewal_date',
        'hiring_date'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.web_development'), to: {name: 'web_development-model'}},
        {label: this.$t('sidebar.hostings'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_hosting'), to: {name: this.idPage + '-create'}, viewIf: $can('create-hostings')}

  },
  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.hostings')
      })
  }
};
</script>

