
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- title   ===  all_platforms -->
            <div class="col-12">
                <div class="form-title">
                    <h3 class="text" v-text="$t('sidebar.all_platforms')"></h3>
                </div>
            </div>
            <!-- =========================================================== -->



            <div class="col-12">

                <div class="form-plus form-plus-multi form-platforms" v-for="(platform, index) in form.platforms" :key="index">

                    <div class="form-plus-no-shrink-input form-group-input side-one mb-3">

                        <!-- name -->
                        <div class="form-group form-group-input">
                            <label class="required">{{ $t('platforms_table.name') }}</label>
                            <input
                                v-model="platform.name"
                                type="text"
                                class="form-control form-control-sm"
                                :class="{ 'is-invalid': form.errors.has(`platforms.${index}.name`) }"
                                :placeholder="$t('platforms_table.name')"
                            >
                            <has-error :form="form" :field="`platforms.${index}.name`"></has-error>
                        </div>
                        <!-- ./name -->

                        <div class="multi-inputs multi-inputs-inline justify-between mt-4">

                            <!-- logo -->
                            <div class="form-group-input">
                                <label class="required">{{ $t('platforms_table.logo') }}</label>
                                <upload-image
                                    :form="form"
                                    :propertyArrayRecursive="platform"
                                    :pathError="`platforms.${index}.logo`"
                                    propertyName="logo"
                                    :domain="$domain"
                                ></upload-image>
                            </div>
                            <!-- ./logo -->

                            <!-- display -->
                            <div class="form-group-input input-switch">
                                <label class="required">{{ $t('platforms_table.display') }}</label>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" :id="`switch_display-${index}`" v-model="platform.display">
                                    <label class="custom-control-label" :for="`switch_display-${index}`">
                                        <div class="value-label">
                                            {{ platform.display == 1 ? $t('global.show') : $t('global.hide') }}
                                        </div>
                                    </label>
                                </div>
                                <has-error :form="form" :field="`platforms.${index}.display`"></has-error>
                            </div>
                            <!-- ./display -->

                        </div>
                    </div>

                    <div class="form-plus-no-shrink-input form-group-input side-two">

                        <!-- cover -->
                        <div class="form-group-input form-group">
                            <label>{{ $t('platforms_table.cover') }}</label>
                            <div class="multi-inputs multi-inputs-inline">
                                <!-- cover_width -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.width') }}</label>
                                    <input
                                        v-model="platform.cover_width"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.cover_width`) }"
                                        :placeholder="$t('platforms_table.width')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.cover_width`"></has-error>
                                </div>
                                <!-- ./cover_width -->

                                <!-- cover_height -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.height') }}</label>
                                    <input
                                        v-model="platform.cover_height"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.cover_height`) }"
                                        :placeholder="$t('platforms_table.height')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.cover_height`"></has-error>
                                </div>
                                <!-- ./cover_height -->

                            </div>
                        </div>
                        <!-- ./cover -->

                        <!-- profile -->
                        <div class="form-group-input form-group">
                            <label>{{ $t('platforms_table.profile') }}</label>
                            <div class="multi-inputs multi-inputs-inline">
                                <!-- profile_width -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.width') }}</label>
                                    <input
                                        v-model="platform.profile_width"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.profile_width`) }"
                                        :placeholder="$t('platforms_table.width')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.profile_width`"></has-error>
                                </div>
                                <!-- ./profile_width -->

                                <!-- profile_height -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.height') }}</label>
                                    <input
                                        v-model="platform.profile_height"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.profile_height`) }"
                                        :placeholder="$t('platforms_table.height')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.profile_height`"></has-error>
                                </div>
                                <!-- ./profile_height -->

                            </div>
                        </div>
                        <!-- ./cover -->

                        <!-- post -->
                        <div class="form-group-input form-group">
                            <label>{{ $t('platforms_table.post') }}</label>
                            <div class="multi-inputs multi-inputs-inline">
                                <!-- post_width -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.width') }}</label>
                                    <input
                                        v-model="platform.post_width"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.post_width`) }"
                                        :placeholder="$t('platforms_table.width')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.post_width`"></has-error>
                                </div>
                                <!-- ./post_width -->

                                <!-- post_height -->
                                <div class="form-group-input">
                                    <label>{{ $t('platforms_table.height') }}</label>
                                    <input
                                        v-model="platform.post_height"
                                        type="number"
                                        class="form-control form-control-sm"
                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.post_height`) }"
                                        :placeholder="$t('platforms_table.height')"
                                    >
                                    <has-error :form="form" :field="`platforms.${index}.post_height`"></has-error>
                                </div>
                                <!-- ./post_height -->

                            </div>
                        </div>
                        <!-- ./cover -->

                    </div>


                    <div class="btns-overflow">
                        <button
                            type="button"
                            class="btn btn-sm btn-danger"
                            @click="removePlatform(index)"
                        >
                            {{ $t('sidebar.delete_platform') }}
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <!-- =========================================================== -->
                </div>
                <button
                    type="button"
                    class="btn btn-sm btn-success btn-plus"
                    @click="addPlatform()"
                >
                    {{ $t('sidebar.add_platform') }}
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm'],
    methods: {
        addPlatform() {
            this.form.platforms.push({
                name: '',
                logo: '',
                cover_width: '',
                cover_height: '',
                profile_width: '',
                profile_height: '',
                post_width: '',
                post_height: '',
                display: 1,
            })
        },
        // $platformMethods
        removePlatform(index) {
            if (this.typeForm == 'edit') {
                if (this.form.platforms[index].id) {
                    this.form.deletedPlatforms.push(this.form.platforms[index].id)
                }
            }
            this.form.platforms.splice(index, 1)
        },
    }
  }
</script>
