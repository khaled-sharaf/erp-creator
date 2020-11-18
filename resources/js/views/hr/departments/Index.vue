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
    >
        <tbody>
            <tr
                role="row"
                v-for="(department, index) in dataTable"
                :key="department.id"
                :data-id="department.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >


                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>


                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{department.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{department.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="department.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="department.created_at"></relative-date>
                </td>


                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">

                    <menu-actions
                        :model="department"
                        :modelName="idPage"
                        @destroyRow="destroyRow(department.id)"
                    >
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
        idPage: 'departments',
        urlGetDataTable: '/hr/departments',
        filters: ['search'],
        columns: [
            { label: "ID", name: "id" },
            { label: "Name", name: "name" },
            { label: "Updated at", name: "updated_at" },
            { label: "Registered", name: "created_at" },
        ],
        breadcrumb: [],
        btnCreate: {}
    };
  },
  mounted() {
        this.tableData.searchColumns = this.tableData.searchColumns.concat([
            'id',
            'name'
        ])
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.departments'), active: true},
        ]
        this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_department'), to: {name: this.idPage + '-create'}, viewIf: $can('create-departments')}
  },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.departments')
        })
    }
};
</script>

