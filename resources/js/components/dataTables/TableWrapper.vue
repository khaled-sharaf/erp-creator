<template>
<div>
    <div class="wrapper-loading" v-show="!successResponse">
        <div class="loading">
            <img :src="$domain + 'admin/images/loader.gif'">
        </div>
    </div>
    <table class="table dataTable table-hover" id="dataTable" :class="' table-' + themeTableClassesFilter.join(' table-')" v-if="dataTable.length">
        <thead class="thead-light">
            <tr>
                <th v-if="!hideMultiSelect" class="actions th-checkbox" v-html="columns[0].label"></th>
                <th class="actions th-show-plus" v-html="columns[1].label"></th>
                <th
                    rowspan="1"
                    colspan="1"
                    v-for="column in columns"
                    v-show="columnsView.indexOf(column.name) != -1"
                    :key="column.name"
                    @click="sortBy(column.name)"
                    :class="classesTh(column.name)"
                    v-html="column.label"
                ></th>
            </tr>
        </thead>
        <slot></slot>
        <!-- <tfoot class="thead-light">
            <tr>
                <th v-if="!hideMultiSelect" class="actions th-checkbox"></th>
                <th class="actions th-show-plus" v-html="columns[1].label"></th>
                <th
                    rowspan="1"
                    colspan="1"
                    v-for="column in columns"
                    v-show="columnsView.indexOf(column.name) != -1"
                    :key="column.name"
                    @click="sortBy(column.name)"
                    :class="classesTh(column.name)"
                    v-html="column.label"
                ></th>
            </tr>
        </tfoot> -->
    </table>
    <div v-if="!dataTable.length && successResponse === true" class="alert alert-danger alert-dismissible">
        <h5><i class="icon fas fa-info"></i> {{ $t('datatable.empty_table') }}!</h5>
        {{ $t('datatable.no_data_msg') }}
    </div>
</div>
</template>



<script>
export default {
    props: [
        "successResponse",
        "hideMultiSelect",
        "dataTable",
        "columns",
        "themeTableClassesFilter",
        "columnsView",
        "columnsExcepted",
        "sortOrders",
        "tableData",
        "getData"
    ],
    methods: {
        sortBy(key) {
            if (this.columnsExcepted.indexOf(key) == -1) {
                this.tableData.sortBy = key
                this.sortOrders[key] = this.sortOrders[key] * -1
                this.tableData.dir = this.sortOrders[key] == 1 ? "asc" : "desc"
                this.getData()
            }
        },
        classesTh(columnName) {
            let classSorting
            if (this.columnsExcepted.indexOf(columnName) == -1) {
                if (this.tableData.sortBy === columnName) {
                    if (this.sortOrders[columnName] > 0) {
                        classSorting = 'sorting_asc'
                    } else {
                        classSorting = 'sorting_desc'
                    }
                } else {
                    classSorting = 'sorting'
                }
            } else {
                classSorting = 'actions'
            }
            return classSorting;
        }
    },
}
</script>
