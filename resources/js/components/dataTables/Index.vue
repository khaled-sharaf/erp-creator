<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb || []"  :btnCreate="btnCreate || {}">
            <template v-slot:btns>
                <slot name="btns"></slot>
            </template>
        </header-comp>
        <!-- /.content-header -->
        <section class="content">
            <div class="dataTable" :id="idPage">
                <div class="dataTables_wrapper">
                    <div class="dataTables_header_buttons">
                        <div class="buttons_side">
                            <!-- btn show search tools -->
                            <button type="button" class="btn btn-outline-secondary" @click="showSearchToolsFn">
                                <i class="fas fa-tools"></i>
                                {{ $t('datatable.search_tools') }}
                            </button>
                            <!-- ./btn show search tools -->
                        </div>
                        <div class="buttons_side">
                            <!-- print -->
                            <button
                                type="button"
                                class="btn btn-primary"
                                v-if="dataTable.length"
                                v-print="printObject">
                                {{ $t('datatable.print') }}
                                <i class="fas fa-print"></i>
                            </button>
                            <!-- ./print -->

                            <!-- Excel -->
                            <export-excel
                                v-if="dataTable.length"
                                class="btn btn-success"
                                :data="dataTable"
                                :fields="excelFieldsGlobal"
                                :name="idPage"
                            >
                                Excel
                                <i class="far fa-file-excel"></i>
                            </export-excel>
                            <!-- ./Excel -->
                        </div>
                    </div>
                    <div class="card">
                        <!-- card-header -->
                        <div class="card-header" :class="{'show-search-tools': showSearchTools, 'show-search-tools-height': showSearchToolsHeight}">
                            <div class="card-header-wrapper">
                                <!-- dataTables_filters -->
                                <div class="dataTables_filters">

                                    <table-settings
                                        :toggleShowSettings="toggleShowSettings"
                                        :showSettings="showSettings"
                                        :idPage="idPage"
                                        :columns="columns"
                                    ></table-settings>
                                        <!-- v-if="$route.name == idPage" -->

                                    <div class="filters" v-if="showFilters" v-click-outside="hideFilterFn">
                                        <div class="btn-text" @click="openFilter = !openFilter">
                                                {{ $t('datatable.filters') }}
                                            <i class="fas fa-angle-down"></i>
                                        </div>
                                        <div class="menu-filters" :class="{'hide-filter': !openFilter}">
                                            <div class="header-filter">
                                                <div class="title">
                                                    <i class="fas fa-filter"></i>
                                                    {{ $t('datatable.filters') }}
                                                </div>
                                                <div class="btn-reset">
                                                    <button
                                                        type="button"
                                                        class="btn btn-outline-dark btn-sm"
                                                        @click="resetFilter"
                                                        v-text="$t('datatable.reset')"
                                                    >
                                                    </button>
                                                </div>
                                            </div>
                                            <slot name="more-filters"></slot>
                                            <rules
                                                v-if="filters.indexOf('rules') != -1"
                                                :getData="getData"
                                                :tableData="tableData"
                                            ></rules>
                                            <trashed
                                                v-if="filters.indexOf('trashed') != -1"
                                                :getData="getData"
                                                :tableData="tableData"
                                            ></trashed>
                                            <activation
                                                v-if="filters.indexOf('activation') != -1"
                                                :getData="getData"
                                                :tableData="tableData"
                                            ></activation>
                                            <display
                                                v-if="filters.indexOf('display') != -1"
                                                :getData="getData"
                                                :tableData="tableData"
                                            ></display>
                                            <created-between
                                                v-if="filters.indexOf('created-between') != -1"
                                                :getData="getData"
                                                :tableData="tableData"
                                            ></created-between>
                                        </div>
                                    </div>

                                    <!-- Filter columns -->
                                    <filters-columns
                                        :getData="getData"
                                        :deleteResotreMulti="deleteResotreMulti"
                                        :tableData="tableData"
                                        :columns="columns"
                                        :themeTableClasses="themeTableClasses"
                                        :perPage="perPage"
                                    ></filters-columns>

                                    <!-- dataTables_search -->
                                    <search
                                        v-if="filters.indexOf('search') != -1"
                                        :getData="getData"
                                        :tableData="tableData"
                                        :columns="columns"
                                    ></search><!-- ./dataTables_search -->
                                    <!-- dataTables_search -->
                                    <DateRange
                                        :getData="getData"
                                        :tableData="tableData"
                                        :columns="columns"
                                    ></DateRange><!-- ./dataTables_search -->


                                    <!-- dataTables_pagination -->
                                    <div class="dataTables_pagination">
                                        <pagination
                                            :pagination="pagination"
                                            :getData="getData"
                                        ></pagination>
                                    </div>
                                    <!-- ./dataTables_pagination -->
                                </div><!-- ./dataTables_filters -->
                            </div>
                        </div>
                        <!-- /.card-header -->


                        <!-- card-body -->
                        <div class="card-body table-responsive">
                            <!-- btns-multi-select -->
                            <btns-multi-select
                                :deleteResotreMulti="deleteResotreMulti"
                                :tableData="tableData"
                            >
                            </btns-multi-select>
                            <!-- ./btns-multi-select -->

                            <table-wrapper
                                :successResponse="successResponse"
                                :hideMultiSelect="hideMultiSelect"
                                :dataTable="dataTable"
                                :columns="columns"
                                :columnsView="columnsView"
                                :columnsExcepted="columnsExcepted"
                                :themeTableClassesFilter="themeTableClassesFilter"
                                :sortOrders="sortOrders"
                                :tableData="tableData"
                                :getData="getData"
                            >
                                <slot></slot>
                            </table-wrapper>
                        </div> <!-- /.card-body -->

                    </div> <!-- /.card -->
                </div> <!-- /.datatables wrapper -->
            </div> <!-- /.dataTable -->
            <slot name="after-container"></slot>
        </section>
    </div>
</template>



<script>
// global components
import TableWrapper from "./TableWrapper";
import FiltersColumns from "./filters/FiltersColumns";
import Pagination from "./Pagination";
import TableSettings from "./TableSettings"
import BtnsMultiSelect from "./BtnsMultiSelect"

// filters
import Activation from "./filters/Activation"
import Trashed from "./filters/Trashed"
import Display from "./filters/Display"
import Rules from "./filters/Rules"
import CreatedBetween from "./filters/CreatedBetween"
import Search from "./filters/Search"
import DateRange from "./filters/DateRange"


export default {
    props: [
        'idPage',
        'breadcrumb',
        'btnCreate',
        'showSettings',
        'hideMultiSelect',
        'columns',
        'excelFields',
        'excelFieldsExcepted',
        'themeTableClasses',
        'dataTable',
        'tableData',
        'perPage',
        'successResponse',
        'columnsView',
        'columnsExcepted',
        'themeTableClassesFilter',
        'sortOrders',
        'pagination',
        'filters',

        // functions
        'toggleShowSettings',
        'deleteResotreMulti',
        'getData',
    ],
    components: {
        // global
        TableWrapper,
        FiltersColumns,
        Pagination,
        TableSettings,
        BtnsMultiSelect,

        // filters
        Activation,
        Trashed,
        Display,
        Rules,
        CreatedBetween,
        Search,
        DateRange
    },

    data() {
        return {
            // openFilter: true
            openFilter: false,
            showSearchTools: true,
            showSearchToolsHeight: true,
            filtersDefault: {},
            excelFieldsGlobal: {},
            excelFieldsExceptedGlobal: [
                'select_row',
                'show_plus',
                'index',
                'actions',
                'photo',
                'image'
            ],
            printObject: {
                id: 'dataTable',
                popTitle: this.$t('sidebar.' + this.idPage)
            }
        }
    },
    computed: {
        showFilters() {
            if (this.filters.indexOf('rules') != -1 ||
                this.filters.indexOf('trashed') != -1 ||
                this.filters.indexOf('activation') != -1 ||
                this.filters.indexOf('display') != -1 ||
                this.filters.indexOf('created-between') != -1
            ) {
                return true
            } else {
                return false
            }
        },
    },
    methods: {
        showSearchToolsFn() {
            if (this.showSearchTools) {
                this.showSearchTools = false
                setTimeout(() => this.showSearchToolsHeight = false, 250)
            } else {
                this.showSearchToolsHeight = true
                setTimeout(() => this.showSearchTools = true, 10)
            }
        },
        hideFilterFn() {
            this.openFilter = false
        },
        resetFilter() {
            const exceptedKeys = ['columns', 'filter']
            for (let index in this.tableData) {
                if (exceptedKeys.indexOf(index) == -1) {
                    this.tableData[index] = this.filtersDefault[index]
                }
            }
            this.getData()
        }
    },

    mounted() {
        setTimeout(() => {
            this.showSearchTools = false
            this.showSearchToolsHeight = false
            this.filtersDefault = {...this.tableData}
        }, 500)

        setTimeout(() => {
            if (typeof this.excelFieldsExcepted === 'object') {
                this.excelFieldsExceptedGlobal = this.excelFieldsExceptedGlobal.concat(this.excelFieldsExcepted)
            }

            for (let column of this.columns) {
                if (this.excelFieldsExceptedGlobal.indexOf(column.name) == -1) {
                    this.excelFieldsGlobal[column.label] = column.name
                }
            }
            if (typeof this.excelFields === 'object') {
                if (Object.keys(this.excelFields).length) {
                    for (let field in this.excelFields) {
                        this.excelFieldsGlobal[field] = this.excelFields[field]
                    }
                }
            }
        }, 100)

        // $('.dataTables_filters .filters .menu-filters').overlayScrollbars({
        //     // sizeAutoCapable: true,
        //     scrollbars: {
        //         autoHide: 'm',
        //         // clickScrolling: true
        //     }
        // });
    },
}
</script>
