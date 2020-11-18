
<template>
    <div>
        <!-- Button trigger modal -->

        <div class="row">
            <!-- lead_id -->
            <div class="col-lg-6" v-if="typeForm === 'create'">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <!-- title   ===  lead_data -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('quotations_table.lead_data')"></h3>
                            </div>

                            <div class="row">
                                <div class="col-md-6" v-if="!$route.params.id">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('quotations_table.lead_id') }}</label>
                                        <div class="d-flex">
                                            <vue-select
                                                :options="leads"
                                                v-model="currentLead"
                                                label="name"
                                                :reduce="customLead"
                                                :class="{ 'is-invalid': form.errors.has(`lead_id`) }"
                                                @input="chooseLead"
                                                class="h-100 flex-1"
                                            >
                                                <template v-slot:option="lead">
                                                    <div class="my-vue-select vue-select-leads">
                                                        <div class="lead-image">
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
                                                            <div class="type">
                                                                <span class="badge badge-warning" v-if="lead.type == 0" v-text="$t('global.lead')"></span>
                                                                <span class="badge badge-primary" v-if="lead.type == 1" v-text="$t('global.meeting')"></span>
                                                                <span class="badge badge-success" v-if="lead.type == 2" v-text="$t('global.client')"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </template>
                                                <div slot="no-options">{{ $t('quotations_table.not_found_lead') }}</div>
                                            </vue-select>
                                            <button
                                                type="button"
                                                class="btn btn-primary ml-2 py-0"
                                                data-toggle="modal"
                                                data-target="#shortLeadModal"
                                            >
                                                <i class="fa fa-plus"></i> New Lead
                                            </button>
                                        </div>

                                        <has-error :form="form" field="lead.id"></has-error>

                                        <!-- short new lead modal -->
                                        <ShortNewLeadModal
                                            v-on:newLeadSelect="newLeadSelect"
                                        />
                                    </div>
                                </div>

                                <div class="col-md-6" v-if="$route.params.id">
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

                                <div class="col-md-6" v-if="form.lead_id && $can('admin-crm')">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('quotations_table.sales_id') }}</label>
                                        <select
                                            v-model="currentPersonalSales"
                                            class="custom-select custom-select-sm"
                                            @change="choosePersonalSales"
                                            :class="{ 'is-invalid': form.errors.has('sales_id') }"
                                        >
                                            <option
                                                v-for="user in users"
                                                :key="user.id"
                                                :value="user"
                                                v-text="user.name">
                                            </option>
                                        </select>
                                        <has-error :form="form" field="sales_id"></has-error>
                                    </div>
                                </div>

                            </div>
                            <br>
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>

            <!-- title   ===  services -->
            <div class="col-lg-6" v-if="form.lead_id && form.sales_id">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">

                            <div class="form-title">
                                <h3 class="text" v-text="$t('quotations_table.services')"></h3>
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

                                        <div class="form-plus-input form-group-input flex-grow-1">
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
                                            <i class="fas fa-plus"></i>
                                            {{ $t('sidebar.add_services') }}
                                        </button>

                                        <div class="calculation-contract" v-if="totalServices > 0">
                                            <!-- <div class="total-services">
                                                <span class="title" v-text="$t('quotations_table.total_services') + ': '"></span>
                                                <b class="value amount" v-text="totalServices"></b>
                                                <span class="currency" v-text="$t('global.currency')"></span>
                                            </div>

                                            <div class="taxes">
                                                <span class="title" v-text="$t('quotations_table.taxes') + ' ' + $settings['taxes'] + '%:'"></span>
                                                <b class="value amount">
                                                    {{ parseInt(totalServices * ($settings['taxes'] / 100)) }}
                                                </b>
                                                <span class="currency" v-text="$t('global.currency')"></span>
                                            </div> -->

                                            <div class="total-amount d-flex align-items-center">
                                                <span class="title" v-text="$t('quotations_table.total_amount') + ': '"></span>
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
        </div><!-- ./row -->
    </div>
</template>


<script>

import ShortNewLeadModal from './ShortNewLeadModal';
import ShortServiceModal from './ShortServiceModal';
export default {
    props: ['form', 'typeForm'],
    components: {
        ShortNewLeadModal,
        ShortServiceModal
    },
    data() {
      return {
        leads: [],
        users: [],
        services: [],
        currentLead: {},
        currentPersonalSales: {},
        currencies: []
      }
    },

    methods: {
        chooseLead() {
            this.currentLead = {
                ...this.currentLead,
                name: this.currentLead.d_name
            }

            this.form.lead_id = this.currentLead.id
            if (!$can('admin-crm')) {
                this.form.sales_id = $auth.id
            }
        },
        async newLeadSelect(data){
            await this.getLeadsSelect();
            this.currentLead = data;
            this.chooseLead()
        },
        choosePersonalSales() {
           this.form.sales_id = this.currentPersonalSales.id
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
                this.form.services.push({service_id: '', amount: '', description: '', profit_method: 1})
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
                    // let totalTax = parseInt(total * ($settings['taxes'] / 100))
                    this.form.total_amount = total
                }
            })
            return total
        }
    },

    mounted() {
        this.getLeadsSelect();
        //
        $getUsersSelect().then(users => {
            this.users = users.filter(user => user.job_title != null)
        })
        //
        this.getServicesSelect()
        /**
         * get all currency options
         */
        $getSystemCurrencies()
        .then((data)=>{
            this.currencies = data;

        });
    },
  }
</script>
