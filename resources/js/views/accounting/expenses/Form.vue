
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
                            <label class="required">{{ $t('expenses_table.name') }}</label>
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
                            <label class="required">{{ $t('expenses_table.amount') }}</label>
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
                            <label>{{ $t('expenses_table.description') }}</label>
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

                    <!-- active -->
                    <div class="col-12">
                        <div class="form-group form-group-input">
                            <label>{{ $t('expenses_table.active') }}</label>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="switch_active" v-model="form.active">
                                <label class="custom-control-label" for="switch_active">
                                    <div class="value-label">
                                        {{ form.active == 1 ? $t('global.yes') : $t('global.no') }}
                                    </div>
                                </label>
                            </div>
                            <has-error :form="form" field="active"></has-error>
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
