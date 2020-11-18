<template>
    <div class="dataTables_select">

        <!-- dataTables_length -->
        <div class="dataTables_length">
            <select class="custom-select custom-select-sm" v-model="tableData.length" @change="getData()">
                <option
                    v-for="(records, index) in perPage"
                    :key="index"
                    :value="records"
                >{{records}}</option>
            </select>
        </div>
        <!-- ./dataTables_length -->

        <!-- dataTables_columns -->
        <div class="dataTables_columns custom-select custom-select-sm" v-selectcolumnopen>
            <select
                class="custom-select view-columns-filter"
                v-model="tableData.columns"
                v-selectcolumn="tableData.columns"
                multiple="multiple"
            >
                <option
                    v-for="(column, index) in updatedColumns"
                    :key="index"
                    :value="column.name"
                    v-html="column.label"
                ></option>
            </select>
            <span class="icon">
                <i class="fas fa-eye"></i>
            </span>
        </div>
        <!-- ./dataTables_columns -->

        <!-- dataTables_viewtable -->
        <!-- <div class="dataTables_viewtable custom-select custom-select-sm" v-selectcolumnopen>
            <select
                class="custom-select view-table-filter"
                v-model="tableData.filter.viewTable"
                v-selectviewtableclass="tableData.filter.viewTable"
                multiple="multiple"
            >
                <option
                    v-for="(viewclass, index) in themeTableClasses"
                    :key="index"
                    :value="viewclass"
                >{{viewclass}}</option>
            </select>
            <span class="icon">
                <i class="fas fa-table"></i>
            </span>
        </div> -->
        <!-- ./dataTables_viewtable -->

        <!-- dataTables_refresh -->
        <div class="dataTables_refresh">
            <span class="icon-flat" @click="getData()">
                <i class="fas fa-sync-alt"></i>
            </span>
        </div>
        <!-- ./dataTables_refresh -->

    </div>
</template>





<script>
export default {
    props: [
        "columns",
        "themeTableClasses",
        "tableData",
        "perPage",
        "getData"
    ],
    data() {
        return {
            updatedColumns: []
        }
    },
    methods: {
        updateColumns() {
            this.updatedColumns = this.columns.filter(column => {
                return column.name != 'show_plus' && column.name != 'select_row'
            })
        }
    },
    watch: {
        "$i18n.locale"(val) {
            this.updatedColumns = []
            setTimeout(() => {
                this.updateColumns()
            })
        }
    },
    mounted() {
        this.$nextTick(() => {
            this.updateColumns()
        })
    },
}
</script>

