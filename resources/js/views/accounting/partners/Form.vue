
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
                                <label class="required">{{ $t('partners_table.name') }}</label>
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
                                <label class="required">{{ $t('partners_table.type') }}</label>
                                <select
                                    class="custom-select custom-select-sm"
                                    v-model="form.type"
                                    :class="{ 'is-invalid': form.errors.has('type') }"
                                >
                                    <option value="joint" v-text="$t('global.accounts_types.joint')"></option>
                                    <option value="recom" v-text="$t('global.accounts_types.recom')"></option>
                                </select>
                                <has-error :form="form" field="type"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- ratio -->
                        <div class="col-sm-6 col-lg-4 col-xl-6">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('partners_table.ratio') }}</label>
                                <input
                                    v-model.number="form.ratio"
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('ratio') }"
                                >
                                <has-error :form="form" field="ratio"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- id_card -->
                        <div class="col-sm-6 col-lg-4 col-xl-6">
                            <div class="form-group form-group-input">
                                <label>{{ $t('partners_table.id_card') }}</label>
                                <input
                                    v-model="form.id_card"
                                    type="text"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('id_card') }"
                                >
                                <has-error :form="form" field="id_card"></has-error>
                            </div>
                        </div>
                        <!-- =========================================================== -->

                        <!-- balance -->
                        <div class="col-sm-6 col-lg-4 col-xl-6" v-if="typeForm === 'create'">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('partners_table.balance') }}</label>
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
