
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- col-md -->
            <div class="col-12">

                <div class="row">

                    <!-- name -->
                    <div class="col-sm-6">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('services_table.name') }}</label>
                            <input
                                v-model="form.name"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('name') }"
                            >
                            <has-error :form="form" field="name"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- amount -->
                    <div class="col-sm-6">
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('services_table.amount') }}</label>
                            <input
                                v-model="form.amount"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('amount') }"
                            >
                            <has-error :form="form" field="amount"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- description -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('services_table.description') }}</label>
                            <textarea
                                v-model="form.description"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has('description') }"
                            ></textarea>
                            <has-error :form="form" field="description"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

                    <!-- profit_method -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('services_table.profit_method') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch_profit_method" v-model="form.profit_method">
                                <label class="custom-control-label" for="switch_profit_method">
                                    <div class="value-label">
                                        {{ form.profit_method == 1 ? $t('services_table.profit_company') : $t('services_table.profit_ads') }}
                                    </div>
                                </label>
                            </div>
                            <has-error :form="form" field="profit_method"></has-error>
                        </div>
                    </div>
                    <!-- =========================================================== -->

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
      }
    },

  }
</script>
