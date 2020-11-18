
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-md-9 col-xl-10 col-12">

                <div class="row">

                    <!-- hosting name -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('hostings_table.hosting_name') }}</label>
                            <input
                                v-model="form.hosting_name"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('hosting_name') }"
                            >
                            <has-error :form="form" field="hosting_name"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- booking_date -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('hostings_table.booking_date') }}</label>
                            <date-picker
                                v-model="form.booking_date"
                                type="date"
                                format="YYYY-MM-DD"
                                value-type="format"
                                :lang="$langDatePicker"
                                :placeholder="$t('hostings_table.booking_date')"
                                :class="{ 'is-invalid': form.errors.has('booking_date') }"
                            ></date-picker>
                            <has-error :form="form" field="booking_date"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- renewal_date -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('hostings_table.renewal_date') }}</label>
                            <date-picker
                                v-model="form.renewal_date"
                                type="date"
                                format="YYYY-MM-DD"
                                value-type="format"
                                :lang="$langDatePicker"
                                :placeholder="$t('hostings_table.renewal_date')"
                                :class="{ 'is-invalid': form.errors.has('renewal_date') }"
                            ></date-picker>
                            <has-error :form="form" field="renewal_date"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->


                    <!-- price -->
                    <div class="col-sm-6 col-lg-4 col-xl-3">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('hostings_table.price') }}</label>
                            <input
                                v-model="form.price"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('price') }"
                            >
                            <has-error :form="form" field="price"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- description -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('hostings_table.description') }}</label>
                            <textarea
                                v-model="form.description"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('description') }"
                            ></textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <div class="col-12"></div>
                    <br>

                </div>
                <!-- ./row -->
            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>
export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        // url_hostings_select: 'hostings_with_hostings_select',
        url_hostings_select: 'hostings_select',
        hostings: []
      }
    },

    methods: {
        getHosting() {
            axios.get(this.url_hostings_select).then(response => {
              // console.log(response);

                if (typeof response.data === 'object') {
                    if (response.status === 200) {
                        this.hostings = response.data
                    }
                } else {
                    setTimeout(() => {
                        this.getHosting()
                    }, 1000)
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getHosting()
                }, 1000)
            })
        }
    },

    mounted() {
        this.getHosting()
    }
  }
</script>
