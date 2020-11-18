
<template>
    <div>
        <div class="row">

            <!-- lead_id -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <!-- title   ===  lead_data -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('lead_contracts_table.lead_data')"></h3>
                            </div>

                            <div class="row">
                                <div class="col-md-6" v-if="!$route.params.id">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('lead_contracts_table.lead_id') }}</label>
                                        <div class="d-flex">
                                            <vue-select
                                                :options="leads"
                                                v-model="currentLead"
                                                label="name"
                                                :reduce="customLead"
                                                :class="{ 'is-invalid': form.errors.has(`lead.id`) }"
                                                class="h-100 flex-1"
                                                @input="chooseLead"
                                            >
                                                <template v-slot:option="lead">
                                                    <div class="my-vue-select vue-select-leads">
                                                        <div class="lead-image">
                                                            <div class="type">
                                                                <span class="badge badge-warning" v-if="lead.type == 0" v-text="$t('global.lead')"></span>
                                                                <span class="badge badge-primary" v-if="lead.type == 1" v-text="$t('global.meeting')"></span>
                                                                <span class="badge badge-success" v-if="lead.type == 2" v-text="$t('global.client')"></span>
                                                            </div>
                                                            <img class="image" :src="$domain + lead.company_logo">
                                                        </div>
                                                        <div class="lead-data">
                                                            <div class="text-data">
                                                                <div class="section">
                                                                    <span class="title" v-text="lead.d_name"></span>
                                                                    <span class="title d-block" v-text="lead.phone"></span>
                                                                </div>
                                                                <div class="section">
                                                                    <span class="title" v-text="lead.company_name"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <div slot="no-options">{{ $t('lead_contracts_table.not_found_lead') }}</div>
                                            </vue-select>
                                            <button
                                                type="button"
                                                class="btn btn-primary ml-2 py-0"
                                                data-toggle="modal"
                                                data-target="#shortClientModal"
                                            >
                                                <i class="fa fa-plus"></i> New Client
                                            </button>

                                        </div>
                                        <has-error :form="form" field="lead.id"></has-error>
                                        <!-- short new lead modal -->
                                        <ShortNewClientModal
                                            v-on:newClientSelect="newClientSelect"
                                        />
                                    </div>
                                </div>
                                <div class="col-md-6" v-if="$route.params.id && typeForm === 'create'">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('clients_table.name') }}</label>
                                        <input
                                            :value="currentLead.name"
                                            type="text"
                                            disabled="disabled"
                                            class="form-control form-control-sm"
                                        >
                                    </div>
                                </div>
                            </div>

                            <!-- lead data -->
                            <div class="row" v-if="form.lead.id">

                                <!-- lead title -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.job_title_lead') }}</label>
                                        <input
                                            v-model="form.job_title_lead"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('job_title_lead') }"
                                        >
                                        <has-error :form="form" field="job_title_lead"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- lead id_cart -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.id_cart') }}</label>
                                        <input
                                            v-model="form.lead.id_cart"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead.id_cart') }"
                                        >
                                        <has-error :form="form" field="lead.id_cart"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- lead company_name -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('leads_table.company_name') }}</label>
                                        <input
                                            v-model="form.lead.company_name"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead.company_name') }"
                                        >
                                        <has-error :form="form" field="lead.company_name"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- lead company_scope -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('leads_table.company_scope') }}</label>
                                        <input
                                            v-model="form.lead.company_scope"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead.company_scope') }"
                                        >
                                        <has-error :form="form" field="lead.company_scope"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- lead company_address -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('leads_table.company_address') }}</label>
                                        <input
                                            v-model="form.lead.company_address"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead.company_address') }"
                                        >
                                        <has-error :form="form" field="lead.company_address"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- lead email -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('leads_table.email') }}</label>
                                        <input
                                            v-model="form.lead.email"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('lead.email') }"
                                            aria-describedby="lead_email"
                                        >
                                        <has-error :form="form" field="lead.email"></has-error>
                                        <small id="lead_email" class="form-text text-muted">
                                            {{ $t('lead_contracts_table.msg_help_lead_email') }}
                                        </small>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                            </div>
                            <!-- ./row -->
                            <!-- =========================================================== -->
                            <br>
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>

            <!-- sales_id -->
            <div class="col-lg-6" v-if="form.lead.id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <!-- title   === personal sales_data -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('lead_contracts_table.sales_data')"></h3>
                            </div>

                            <div class="row" v-if="typeForm === 'create' && $can('admin-crm')">
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('lead_contracts_table.sales_id') }}</label>
                                        <vue-select
                                            :options="users"
                                            v-model="currentPersonalSales"
                                            label="name"
                                            :reduce="user => user"
                                            @input="choosePersonalSales"
                                            :class="{ 'is-invalid': form.errors.has('personal_sales.id') }"
                                        >
                                            <template v-slot:option="user">
                                                <div class="my-vue-select">
                                                    <div class="lead-image">
                                                        <img class="image" :src="$domain + user.photo">
                                                    </div>
                                                    <div class="lead-data">
                                                        <div class="text-data">
                                                            <div class="section">
                                                                <span class="title" v-text="user.name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="type">
                                                            <span class="badge badge-primary" v-if="user.job_title != null" v-text="user.job_title.name"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div slot="no-options">{{ $t('lead_contracts_table.not_found_user') }}</div>
                                        </vue-select>
                                        <has-error :form="form" field="personal_sales.id"></has-error>
                                    </div>
                                </div>
                            </div>

                            <!-- personal sales data -->
                            <div class="row" v-if="form.personal_sales.id">
                                <!-- sales_name_ar -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.sales_name_ar') }}</label>
                                        <input
                                            v-model="form.personal_sales.name_ar"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('personal_sales.name_ar') }"
                                        >
                                        <has-error :form="form" field="personal_sales.name_ar"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- sales_id_cart -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.sales_id_cart') }}</label>
                                        <input
                                            v-model="form.personal_sales.id_cart"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('personal_sales.id_cart') }"
                                        >
                                        <has-error :form="form" field="personal_sales.id_cart"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- sales_address -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('users_table.address') }}</label>
                                        <input
                                            v-model="form.personal_sales.address"
                                            type="text"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('personal_sales.address') }"
                                        >
                                        <has-error :form="form" field="personal_sales.address"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->
                            </div>
                            <!-- =========================================================== -->
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- title   ===  contract data -->
            <div class="col-lg-6" v-if="form.lead.id && form.personal_sales.id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-title">
                                <h3 class="text" v-text="$t('lead_contracts_table.contract_data')"></h3>
                            </div>

                            <div class="row">

                                <!-- created_at -->
                                <!-- <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('lead_contracts_table.created_at') }}</label>
                                        <date-picker
                                            v-model="form.created_at"
                                            type="datetime"
                                            format="YYYY-MM-DD HH:mm:ss"
                                            value-type="format"
                                            :lang="$langDatePicker"
                                            :placeholder="$t('lead_contracts_table.created_at')"
                                            :class="{ 'is-invalid': form.errors.has('created_at') }"
                                        ></date-picker>
                                        <has-error :form="form" field="created_at"></has-error>
                                    </div>
                                </div> -->
                                <!-- =========================================================== -->

                            </div>
                            <!-- ./row -->

                            <div class="row">
                                <!-- created_at -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.created_at') }}</label>
                                        <date-picker
                                            v-model="form.created_at"
                                            type="date"
                                            format="YYYY-MM-DD"
                                            value-type="format"
                                            :lang="$langDatePicker"
                                            :placeholder="$t('lead_contracts_table.created_at')"
                                            :class="{ 'is-invalid': form.errors.has('created_at') }"
                                        ></date-picker>
                                        <has-error :form="form" field="created_at"></has-error>
                                    </div>
                                </div>
                                <!-- start_date -->
                                <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.start_date') }}</label>
                                        <date-picker
                                            v-model="form.start_date"
                                            type="date"
                                            format="YYYY-MM-DD"
                                            value-type="format"
                                            :lang="$langDatePicker"
                                            :placeholder="$t('lead_contracts_table.start_date')"
                                            :class="{ 'is-invalid': form.errors.has('start_date') }"
                                        ></date-picker>
                                        <has-error :form="form" field="start_date"></has-error>
                                    </div>
                                </div>
                                <!-- =========================================================== -->
                                <div class="form-group form-group-input">
                                    <label class="required">{{ $t('lead_contracts_table.duration') }}</label>
                                    <select
                                        v-model="form.duration_unit"
                                        class="custom-select custom-select-sm"
                                        :class="{ 'is-invalid': form.errors.has(`form.duration_unit`) }"
                                    >
                                        <option
                                            value="days"
                                        >Day</option>
                                        <option
                                            value="months"
                                        >Month</option>
                                        <option
                                            value="years"
                                        >Year</option>
                                    </select>
                                    <has-error :form="form" :field="`form.duration_unit`"></has-error>

                                </div>
                                <!-- =========================================================== -->

                                <!-- duration -->
                                <div class="col-sm-6 col-md-4" v-if="form.duration_unit != ''">
                                    <div class="form-group form-group-input">
                                        <label>Duration</label>
                                        <input
                                            v-model="form.duration"
                                            type="text"
                                            class="form-control form-control-sm"
                                        >
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <!-- duration -->
                                <!-- <div class="col-sm-6 col-md-4">
                                    <div class="form-group form-group-input">
                                        <label class="required">{{ $t('lead_contracts_table.duration') }}</label>
                                        <select
                                            v-model="form.duration"
                                            class="custom-select custom-select-sm"
                                            :class="{ 'is-invalid': form.errors.has('duration') }"
                                        >
                                            <option
                                                v-for="duration in durations"
                                                :key="duration"
                                                :value="duration">
                                                {{ duration }}
                                                {{ duration > 2 ? $t('global.months') : $t('global.month') }}
                                            </option>
                                        </select>
                                        <has-error :form="form" field="duration"></has-error>
                                    </div>
                                </div> -->
                                <!-- =========================================================== -->

                                <!-- end_date -->
                                <div class="col-sm-6 col-md-4" v-if="form.duration != '' && form.start_date != ''">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('lead_contracts_table.end_date') }}</label>
                                        <input
                                            type="text"
                                            readonly
                                            :value="$endContractDate(form)"
                                            class="form-control form-control-sm"
                                        >
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                            </div>
                            <!-- ./row -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- title   ===  services -->
            <div class="col-lg-6" v-if="form.lead.id && form.personal_sales.id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-title">
                                <h3 class="text" v-text="$t('lead_contracts_table.services')"></h3>
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2">
                                    <button
                                        type="button"
                                        class="btn btn-primary ml-2 py-0"
                                        data-toggle="modal"
                                        data-target="#shortServiceModal"
                                    >
                                        <i class="fa fa-plus"></i> New Service
                                    </button>
                                    <!-- short new lead modal -->
                                    <ShortServiceModal
                                        v-on:newService="addService"
                                    />
                                </div>
                                <div class="col-12">
                                    <div class="form-plus form-plus-color flex-wrap"
                                    v-for="(formService, index) in form.services" :key="index">
                                        <div class="form-plus-input form-group-input form-plus-fw flex-grow-1" style="flex-basis: auto;">
                                            <select
                                                class="custom-select custom-select-sm"
                                                :class="{ 'is-invalid': form.errors.has(`services.${index}.service_id`) }"
                                                v-model="formService.service_id"
                                                @change="addOldAmount(index)"
                                            >
                                                <option
                                                    v-for="service in services"
                                                    :value="service.id"
                                                    :key="service.id"
                                                    v-text="service.name"
                                                ></option>
                                            </select>
                                            <has-error :form="form" :field="`services.${index}.service_id`"></has-error>
                                        </div>
                                        <div class="form-plus-color-input form-group-input" v-if="formService.service_id != ''">
                                            <input
                                                v-model.number="formService.amount"
                                                type="number"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid': form.errors.has(`services.${index}.amount`) }"
                                                :placeholder="$t('services_table.amount')"
                                            >
                                            <has-error :form="form" :field="`services.${index}.amount`"></has-error>
                                        </div>
                                        <div class="form-plus-color-input form-group-input w-100" v-if="formService.service_id != ''">
                                            <input
                                                v-model ="formService.description"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid': form.errors.has(`services.${index}.description`) }"
                                                :placeholder="$t('services_table.description')"
                                                type="text"
                                            />
                                            <has-error :form="form" :field="`services.${index}.description`"></has-error>
                                        </div>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger btn-plus"
                                            v-if="index > 0 ||  index === 0 && form.services.length > 1"
                                            @click="removeService(index)"
                                        >
                                            {{ $t('sidebar.delete_services') }}
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- =========================================================== -->
                                    </div>
                                    <div class="bottom-services-contract">
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-success btn-plus"
                                            @click="addService()"
                                        >
                                            {{ $t('sidebar.add_services') }}
                                            <i class="fas fa-plus"></i>
                                        </button>

                                        <div class="calculation-contract" v-if="totalServices > 0">
                                            <!-- <div class="total-services">
                                                <span class="title" v-text="$t('lead_contracts_table.total_services') + ': '"></span>
                                                <b class="value amount" v-text="totalServices"></b>
                                                <span class="currency" v-text="$t('global.currency')"></span>
                                            </div> -->

                                            <!-- <div class="taxes">
                                                <span class="title" v-text="$t('lead_contracts_table.taxes') + ' ' + form.tax + '%:'"></span>
                                                <b class="value amount">
                                                    {{ parseInt(totalServices * (form.tax / 100)) }}
                                                </b>
                                                <span class="currency" v-text="$t('global.currency')"></span>
                                            </div> -->

                                            <div class="total-amount d-flex align-items-center">
                                                <span class="title" v-text="$t('lead_contracts_table.total_amount') + ': '"></span>
                                                <b class="value amount" v-text="form.total_amount"></b>
                                                <!-- <span class="currency" v-text="$t('global.currency')"></span> -->
                                                <div class="form-plus-input form-group-input ml-2" style="width:70px;">
                                                    <select
                                                        v-model="form.currency_id"
                                                        class="custom-select custom-select-sm"
                                                        :class="{ 'is-invalid': form.errors.has(`form.currency`) }"
                                                    >
                                                        <option
                                                            v-for="currency in currencies"
                                                            :value="currency.id"
                                                            :key="currency.id"
                                                            v-text="currency.iso"
                                                        ></option>
                                                    </select>
                                                    <has-error :form="form" :field="`form.currency`"></has-error>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- title   ===  terms -->
            <div class="col-lg-6" v-if="form.lead.id && form.personal_sales.id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-title">
                                <h3 class="text" v-text="$t('lead_contracts_table.terms')"></h3>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-plus form-plus-color" v-for="(term, index) in form.terms" :key="index">
                                        <div class="form-plus-input form-group-input form-plus-fw">
                                            <textarea
                                                v-model="term.content"
                                                class="form-control form-control-sm"
                                                :class="{ 'is-invalid': form.errors.has(`terms.${index}.content`) }"
                                                :placeholder="$t('lead_contracts_table.term_content')"
                                            ></textarea>
                                            <has-error :form="form" :field="`terms.${index}.content`"></has-error>
                                        </div>
                                        <button
                                            type="button"
                                            class="btn btn-sm btn-danger btn-plus"
                                            @click="removeTerm(index)"
                                        >
                                            {{ $t('sidebar.delete_terms') }}
                                            <i class="fas fa-trash"></i>
                                        </button>
                                        <!-- =========================================================== -->
                                    </div>
                                    <button
                                        type="button"
                                        class="btn btn-sm btn-success btn-plus"
                                        @click="addTerm()"
                                    >
                                        {{ $t('sidebar.add_terms') }}
                                        <i class="fas fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- note -->
            <div class="col-lg-6" v-if="form.lead.id && form.personal_sales.id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-input">
                                <label>{{ $t('lead_contracts_table.note') }}</label>
                                <textarea
                                    v-model="form.note"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('note') }"
                                ></textarea>
                                <has-error :form="form" field="note"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->
        </div><!-- ./row -->
    </div>
</template>


<script>
import ShortNewClientModal from './ShortNewClientModal';
import ShortServiceModal from './ShortServiceModal';
export default {
    props: ['form', 'typeForm'],
    components: {
        ShortNewClientModal,
        ShortServiceModal
    },
    data() {
      return {
        leads: [],
        users: [],
        services: [],
        currentLead: {},
        currentPersonalSales: {},
        durations: [
            1,
            3,
            6,
            12,
            24
        ],
        currencies: []
      }
    },

    methods: {
        chooseLead() {
            this.currentLead = {
                ...this.currentLead,
                name: this.currentLead.d_name
            }
            this.form.lead = {...this.currentLead}
            if (!$can('admin-crm')) {
                this.form.personal_sales = {...$auth}
            }
        },
        async newClientSelect(data){
            await this.getLeadsSelect();
            this.currentLead = data;
            this.chooseLead()
        },
        choosePersonalSales() {
           this.form.personal_sales = {...this.currentPersonalSales}
        },

        async addService(data) {
            if(data){
                await this.getServicesSelect();
                // data.service_id = data.id
                this.form.services.push({
                    service_id: data.id,
                    amount: data.amount,
                    profit_method: 1
                })
            }else{
                this.form.services.push({service_id: "", amount: "", profit_method: 1})
            }
        },
        removeService(index) {
            if (this.typeForm == 'edit') {
                if (this.form.services[index].id) {
                    this.form.deletedServices.push(this.form.services[index].id)
                }
            }
            this.form.services.splice(index, 1)
        },

        addTerm() {
            this.form.terms.push({content: ""})
        },
        removeTerm(index) {
            if (this.typeForm == 'edit') {
                if (this.form.terms[index].id) {
                    this.form.deletedTerms.push(this.form.terms[index].id)
                }
            }
            this.form.terms.splice(index, 1)
        },

        addOldAmount(index) {
            const service = {...this.form.services[index]}
            const origenalService = this.services.find(serv => serv.id === service.service_id)
            this.form.services[index].amount = origenalService.amount
            this.form.services[index].description = origenalService.description
            this.form.services[index].profit_method = origenalService.profit_method
        },
        getLeadsSelect(){
            $getLeadsSelect().then(leads => {
                this.leads = leads
                if (this.$route.params.id && this.typeForm === 'create') {
                    this.currentLead = leads.find(lead => lead.id == this.$route.params.id)
                }
            })
        },
        getServicesSelect(){
            $getServicesSelect().then(services => {
                this.services = services
            })
        },
        customLead(lead){
            // console.log(lead);
            lead.d_name = lead.d_name?lead.d_name:lead.name;
            lead.name = `${lead.d_name} - ${lead.phone}`
            return lead
        }
    },

    computed: {
        totalServices() {
            let total = 0
            this.form.services.forEach(service => {
                if (isNaN(service.amount)) {
                    this.form.total_amount = 0
                    return 0
                } else {
                    total = parseInt(total) + parseInt(service.amount)
                    // let totalTax = parseInt(total * (this.form.tax / 100))
                    this.form.total_amount = total
                }
            })
            return total
        }
    },

    mounted() {
        this.getLeadsSelect();
        $getUsersSelect().then(users => {
            this.users = users.filter(user => user.job_title != null)
        })
        this.getServicesSelect();
        /**
         * get all currency options
         */
        $getSystemCurrencies()
        .then((data)=>{
            this.currencies = data;

        })

    },


  }
</script>
