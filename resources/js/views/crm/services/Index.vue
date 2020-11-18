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
                v-for="(service, index) in dataTable"
                :key="service.id"
                :data-id="service.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{service.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ service.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('description') != -1" class="description">
                    {{ service.description  }}
                </td>

                <td v-show="tableData.columns.indexOf('amount') != -1" class="amount">
                    {{ service.amount }}
                </td>

                <td v-show="tableData.columns.indexOf('profit_method') != -1" class="profit_method">
                    <span class="badge badge-success" v-if="service.profit_method == 1" v-text="$t('services_table.profit_company')"></span>
                    <span class="badge badge-warning" v-else v-text="$t('services_table.profit_ads')"></span>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="service.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="service.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="service"
                        :modelName="idPage"
                        @destroyRow="destroyRow(service.id)"
                        @forceDeleteRow="forceDeleteRow(service.id)"
                        @restoreRow="restoreRow(service.id)"
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
                idPage: 'services',
                urlGetDataTable: '/crm/services',
                filters: ['trashed', 'created-between', 'search'],
                columns: [
                    { label: "", name: "id" },
                    { label: "", name: "name" },
                    { label: "", name: "description" },
                    { label: "", name: "amount" },
                    { label: "", name: "profit_method" },

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
            this.tableData.searchColumns = this.tableData.searchColumns.concat([
                'id',
                'name',
                'description',
                'amount'
            ])
            this.breadcrumb = [
                {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
                {label: this.$t('sidebar.services'), active: true},
            ]
            this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_service'), to: {name: this.idPage + '-create'}, viewIf: $can('create-services')}
        },

        beforeRouteEnter(to, from, next) {
            next(vm => {
                to.meta.title = vm.$t('sidebar.services')
            })
        }
    };
</script>

