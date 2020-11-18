
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
                                <label class="required">{{ $t('cashs_table.name') }}</label>
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

                        <!-- balance -->
                        <div class="col-sm-6 col-lg-4 col-xl-6" v-if="typeForm === 'create'">
                            <div class="form-group form-group-input">
                                <label class="required">{{ $t('cashs_table.balance') }}</label>
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
