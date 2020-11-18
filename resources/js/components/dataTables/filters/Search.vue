<template>
    <!-- search -->
    <div class="dataTables_search">
        <div class="view-search">
            <div class="view-input">
                <input
                    type="text"
                    class="form-control form-control-sm search-input"
                    v-model="tableData.search"
                    :placeholder="$t('datatable.search')"
                    @input="getData()"
                >
                <span class="icon search">
                    <i class="fas fa-search"></i>
                </span>
                <span
                    class="icon delete"
                    @click="tableData.search = ''; getData();"
                    v-if="tableData.search.length"
                >
                    <i class="fas fa-times-circle"></i>
                </span>
            </div>

            <!-- select-column -->
            <div
                v-selectcolumnopen
                class="dataTables_columns select-column custom-select custom-select-sm"
                v-if="tableData.searchColumns.length > 1"
                >
                <select
                    class="custom-select view-columns-filter"
                    v-model="tableData.searchColumnSelected"
                    v-selectSearchColumn="tableData.searchColumnSelected"
                    multiple="multiple"
                >
                    <option
                        v-for="(column, index) in tableData.searchColumns"
                        :key="index"
                        :value="column"
                    >
                        {{ getColumnLabel(column) }}
                    </option>
                </select>
                <span class="title">
                    {{ $t('datatable.search_by') }}
                </span>
            </div>
            <!-- ./select-column -->
        </div>
    </div>
</template>





<script>
export default {
    props: [
        'tableData',
        'getData',
        'columns'
    ],

    methods: {
        getColumnLabel(name) {
            if (name != 'all') {
                return this.columns.find(col => col.name === name).label
            } else {
                return this.$t('datatable.all')
            }
        }
    },

    watch: {
        "tableData.searchColumnSelected"(newVal) {
            this.getData()
        }
    },

    mounted() {
    },
}
</script>
