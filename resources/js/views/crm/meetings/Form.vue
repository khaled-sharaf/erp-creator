
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-12">

                <div class="row">

                    <!-- title   ===  lead_data -->
                    <div class="col-12">
                        <div class="form-title">
                            <h3 class="text" v-text="$t('meetings_table.lead_data')"></h3>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- searchLead -->
                    <div class="col-sm-6 col-lg-4 col-xl-3" v-if="!newLead && !Object.keys(currentLead).length">
                        <div class="form-group form-group-input">
                            <input
                                v-model="searchLead"
                                type="text"
                                @input="getLeadsSearch"
                                :placeholder="$t('meetings_table.enter_lead_name_or_mobile')"
                                class="form-control form-control-sm"
                            >
                        </div>
                        <div class="list-search" v-if="searchLead != ''">
                            <ul>
                                <li v-for="lead in leads_list" :key="lead.name" @click="selectLead(lead)">
                                    <b v-text="lead.name"></b> | 
                                    <span v-text="lead.phone"></span>
                                </li>
                            </ul>
                        </div>
                        <div class="search-loading" v-if="searchLoading">
                            <i class="fas fa-circle-notch fa-spin"></i>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- new lead -->
                    <div class="col-sm-6 col-lg-4 col-xl-3" v-if="!newLead && !Object.keys(currentLead).length">
                        <div class="form-group form-group-input">
                            <button
                                type="button"
                                class="btn btn-sm btn-success"
                                @click="newLead = true"
                            >
                                {{ $t('global.create') + ' ' + $t('sidebar.new_lead') }}
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- lead_name -->
                    <div class="col-12" v-if="newLead">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group form-group-input">
                                    <label class="required">{{ $t('meetings_table.lead_name') }}</label>
                                    <input
                                        v-model="form.lead_name"
                                        type="text"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has('lead_name') }"
                                    >
                                    <has-error :form="form" field="lead_name"></has-error>
                                </div>
                            </div>
                            <!-- =========================================================== -->

                            <!-- lead_phone -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group form-group-input">
                                    <label class="required">{{ $t('meetings_table.lead_phone') }}</label>
                                    <input
                                        v-model="form.lead_phone"
                                        type="text"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has('lead_phone') }"
                                    >
                                    <has-error :form="form" field="lead_phone"></has-error>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- =========================================================== -->
                    <div class="col-12" v-if="newLead === false && Object.keys(currentLead).length">
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <label>{{ $t('meetings_table.lead_name') }}</label>
                                <div class="content">
                                    {{ currentLead.name }}
                                </div>
                            </div>
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <label>{{ $t('meetings_table.lead_phone') }}</label>
                                <div class="content">
                                    {{ currentLead.phone }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- title   ===  meeting_data -->
                    <div class="col-12"  v-if="newLead === true || Object.keys(currentLead).length">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-title">
                                    <h3 class="text" v-text="$t('meetings_table.meeting_data')"></h3>
                                </div>
                            </div>
                            <!-- =========================================================== -->

                            <!-- date -->
                            <div class="col-sm-6 col-lg-4 col-xl-3">
                                <div class="form-group form-group-input">
                                    <label class="required">{{ $t('meetings_table.date') }}</label>
                                    <date-picker
                                        v-model="form.date"
                                        type="datetime"
                                        format="YYYY-MM-DD HH:mm:ss"
                                        value-type="format"
                                        :lang="$langDatePicker"
                                        :placeholder="$t('meetings_table.date')"
                                        :class="{ 'is-invalid': form.errors.has('date') }"
                                    ></date-picker>
                                    <has-error :form="form" field="date"></has-error>
                                </div>
                            </div>
                            <!-- =========================================================== -->

                            <!-- address -->
                            <div class="col-sm-12 col-lg-8 col-xl-6">
                                <div class="form-group form-group-input">
                                    <label class="required">{{ $t('meetings_table.address') }}</label>
                                    <input
                                        v-model="form.address"
                                        type="text"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has('address') }"
                                    >
                                    <has-error :form="form" field="address"></has-error>
                                </div>
                            </div>
                            <!-- =========================================================== -->
                        </div>
                    </div>

                </div>
                <!-- ./row -->
            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm', 'formReset'],
    data() {
      return {
        url_leads_search: '/crm/leads_search',
        leads_list: [],
        searchLead: '',
        newLead: false,
        currentLead: {},
        searchLoading: false
      }
    },

    methods: {
        selectLead(lead) {
            this.currentLead = lead
            this.form.lead_id = lead.id
        },
        getLeadsSearch() {
            if ((!isNaN(this.searchLead) && this.searchLead.length > 3) || (isNaN(this.searchLead) && this.searchLead.length > 1)) {
                this.searchLoading = true
                axios.get(this.url_leads_search, {params: {searchValue: this.searchLead}}).then(response => {
                    if (typeof response.data === 'object') {
                        if (response.status === 200) {
                            this.leads_list = response.data
                            this.searchLoading = false
                        }
                    } else {
                        setTimeout(() => {
                            this.getLeadsSearch()
                        }, 1000)
                    }
                })
                .catch(errors => {
                    setTimeout(() => {
                        this.getLeadsSearch()
                    }, 1000)
                })
            } else {
                this.leads_list = []
            }
        }
    },

    watch: {
        "formReset.reset"(val) {
            if (val) {
                this.leads_list =  []
                this.searchLead =  ''
                this.newLead =  false
                this.currentLead =  {}
                this.formReset.reset = false
            }
        } 
    },

    mounted() {

    },


  }
</script>
