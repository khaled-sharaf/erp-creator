<template>
    <div>
        <!-- row -->
        <div class="row justify-content-center">
            <!-- col-md -->
            <div class="col-md-12 col-lg-8">

                <!-- slug -->
                <div class="form-group">
                    <label> {{ $t('general-settings_table.slug') }} <span class="field-required"></span></label>
                    <input
                    v-model="form.slug"
                    type="text"
                    :placeholder="$t('general-settings_table.slug')"
                    class="form-control"
                    :class="{ 'is-invalid': form.errors.has('slug') }"
                    >
                    <!-- :disabled="typeForm === 'edit'" -->
                    <has-error :form="form" field="slug"></has-error>
                </div>


                <!-- name -->
                <div class="form-group" v-show="typeForm !== 'edit'">
                    <label> {{ $t('general-settings_table.name') }} <span class="field-required"></span></label>
                    <input
                    v-model="form.name"
                    type="text"
                    class="form-control"
                    :placeholder="$t('general-settings_table.name')"
                    :disabled="typeForm === 'edit'"
                    :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>


                <!-- type -->
                <div class="form-group" v-show="typeForm !== 'edit'">
                    <label> {{ $t('general-settings_table.type') }} <span class="field-required"></span></label>
                    <select
                        v-model="form.type"
                        class="custom-select"
                        :disabled="typeForm === 'edit'"
                        :class="{ 'is-invalid': form.errors.has('type') }"
                    >
                        <option value="string"> {{ $t('general-settings_table.setting_types.string') }} </option>
                        <option value="text"> {{ $t('general-settings_table.setting_types.text') }} </option>
                        <option value="image"> {{ $t('general-settings_table.setting_types.image') }} </option>
                    </select>
                    <has-error :form="form" field="type"></has-error>
                </div>


                <!-- vlaue -->

                <div class="form-group">
                    <label> {{ $t('general-settings_table.value') }} </label>
                    <div v-if="form.type == 'string'">
                        <input
                            v-model="form.value"
                            type="text"
                            :placeholder="$t('general-settings_table.value')"
                            class="form-control"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        >
                        <has-error :form="form" field="value"></has-error>
                    </div>

                    <div v-else-if="form.type == 'text'">
                        <vue-editor
                            v-model="form.value"
                            :class="{ 'is-invalid': form.errors.has('value') }"
                        ></vue-editor>
                        <span class="help-error-form" v-if="form.errors.has('value')" v-text="form.errors.get('value')"></span>
                    </div>
                    <div v-else-if="form.type == 'image'">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <upload-image
                                    :form="form"
                                    :required="false"
                                    propertyName="value"
                                ></upload-image>
                            </div>
                        </div>
                    </div>
                </div>


            </div><!-- ./col-md -->
        </div><!-- ./row -->
    </div>
</template>


<script>
import UploadImage from './../../../components/form/UploadImage'
export default {
    props: ['form', 'typeForm'],
    components: {
        UploadImage
    },
    watch: {
        "form.type"(newVal, oldVal) {
            if (this.typeForm == 'create') {
                if (newVal == 'image' || oldVal == 'image') {
                    this.form.value = ''
                }
            }
        }
    }
  }
</script>
