<template>
    <div>
        <div class="wrapper-simple-table table-responsive">
                                    <table class="table table-striped table-hover table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th v-text="$t('global.name')"></th>
                                                <th v-text="$t('global.total')"></th>
                                                <th v-text="$t('global.infors')"></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <!-- leads -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.leads')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.leads.total"></b>
                                                </td>
                                                <td>
                                                    <div class="table-in-td-columns">
                                                        <div
                                                            class="column"
                                                            v-for="status in reports.leads.statuses"
                                                            :key="status.name"
                                                            >
                                                            <div class="head">
                                                                <span
                                                                    class="status"
                                                                    :style="{backgroundColor: status.color}"
                                                                    v-text="status.name"
                                                                    ></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="status.leads_count"></b>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- meetings -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.meetings')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.meetings.total"></b>
                                                </td>
                                                <td>
                                                    <div class="table-in-td-columns">
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status done">Done</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.done"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status next_meeting">Next meeting</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.next_meeting"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status project_delay">Project delay</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.project_delay"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status refused_offer">Refused offer</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.refused_offer"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status rejected">Rejected</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.rejected"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status">None</span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.meetings.none"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- clients -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.clients')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.clients.total"></b>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- all_contracts -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('global.n_all') + ' ' + $t('sidebar.lead_contracts')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.all_contracts.total"></b>
                                                </td>
                                                <td>
                                                    <div class="table-in-td-columns">
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status total_amount" v-text="$t('lead_contracts_table.total_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.total_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status paid_amount" v-text="$t('lead_contracts_table.paid_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.paid_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status remaining_amount" v-text="$t('lead_contracts_table.remaining_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.remaining_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status profit_company" v-text="$t('lead_contracts_table.profit_company')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.profit_company"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status ads_amount" v-text="$t('lead_contracts_table.ads_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.ads_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status sales_commission" v-text="$t('lead_contracts_table.sales_commission')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.all_contracts.sales_commission"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- current_contracts -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.lead_current_contracts')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.current_contracts.total"></b>
                                                </td>
                                                <td>
                                                    <div class="table-in-td-columns">
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status total_amount" v-text="$t('lead_contracts_table.total_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.total_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status paid_amount" v-text="$t('lead_contracts_table.paid_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.paid_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status remaining_amount" v-text="$t('lead_contracts_table.remaining_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.remaining_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status profit_company" v-text="$t('lead_contracts_table.profit_company')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.profit_company"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status ads_amount" v-text="$t('lead_contracts_table.ads_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.ads_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status sales_commission" v-text="$t('lead_contracts_table.sales_commission')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.current_contracts.sales_commission"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- paid_contracts -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.lead_paid_contracts')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.paid_contracts.total"></b>
                                                </td>
                                                <td>
                                                    <div class="table-in-td-columns">
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status total_amount" v-text="$t('lead_contracts_table.total_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.total_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status paid_amount" v-text="$t('lead_contracts_table.paid_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.paid_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status remaining_amount" v-text="$t('lead_contracts_table.remaining_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.remaining_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status profit_company" v-text="$t('lead_contracts_table.profit_company')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.profit_company"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status ads_amount" v-text="$t('lead_contracts_table.ads_amount')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.ads_amount"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                        <div class="column">
                                                            <div class="head">
                                                                <span class="status sales_commission" v-text="$t('lead_contracts_table.sales_commission')"></span>
                                                            </div>
                                                            <div class="body">
                                                                <b v-text="reports.paid_contracts.sales_commission"></b>
                                                            </div>
                                                        </div>
                                                        <!-- ./column -->
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                            <!-- services -->
                                            <tr>
                                                <td>
                                                    <span v-text="$t('sidebar.services')"></span>
                                                </td>
                                                <td>
                                                    <b v-text="reports.services.total"></b>
                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                            <!-- ============================================================== -->

                                        </tbody>
                                    </table>
                                </div>
    </div>
</template>
