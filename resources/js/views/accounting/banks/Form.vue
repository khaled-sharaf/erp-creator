
<template>
    <div>
        <!-- row -->
        <div class="row">

            <!-- ================================= data ================================= -->
            <div class="col-12">
                <div class="wrapper-section-data">
                    <div class="row">

                        <!-- name -->
                        <div class="col-sm-6 col-lg-4 col-xl-6">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('banks_table.name') }}</label>
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

                        <!-- type -->
                        <div class="col-sm-6 col-lg-4 col-xl-6">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('banks_table.type') }}</label>
                                <select
                                    class="custom-select custom-select-sm"
                                    v-model="form.type"
                                    :class="{ 'is-invalid': form.errors.has('type') }"
                                >
                                    <option value="current" v-text="$t('global.accounts_types.current')"></option>
                                    <option value="saving" v-text="$t('global.accounts_types.saving')"></option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- account_no -->
                        <div class="col-sm-6 col-lg-4 col-xl-6">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('banks_table.account_no') }}</label>
                                <input
                                    v-model="form.account_no"
                                    type="number"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('account_no') }"
                                >
                                <has-error :form="form" field="account_no"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- balance -->
                        <div class="col-sm-6 col-lg-4 col-xl-6" v-if="typeForm === 'create'">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('banks_table.balance') }}</label>
                                <input
                                    v-model="form.balance"
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('balance') }"
                                >
                                <has-error :form="form" field="balance"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>
export default {
    props: ['form', 'typeForm']
  }
</script>
