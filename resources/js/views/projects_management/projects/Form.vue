
<template>
    <div>
        <div class="row">

            <!-- platforms -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">

                            <!-- title   ===  platforms -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('projects_table.platforms')"></h3>
                            </div>

                            <!-- platforms -->
                            <div class="row">
                                <!-- platforms -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <div class="form-plus form-plus-color form-platform-in-project" v-for="(platform, index) in form.platforms" :key="platform.id">

                                            <div class="form-plus-input form-group-input form-plus-fw" v-if="platform.platform_id == ''">
                                                <label>{{ $t('projects_table.choose_platform') }}</label>
                                                <vue-select
                                                    :options="platforms"
                                                    v-model="platform.platform_id"
                                                    label="name"
                                                    :reduce="platform => platform.id"
                                                >
                                                    <template v-slot:option="platform">
                                                        <div class="my-vue-select vue-select-leads">
                                                            <div class="lead-image">
                                                                <img class="image" :src="$domain + platform.logo">
                                                            </div>
                                                            <div class="lead-data">
                                                                <div class="text-data">
                                                                    <div class="section">
                                                                        <span class="title">{{ platform.name | capitalize }}</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </template>
                                                    <div slot="no-options">{{ $t('projects_table.not_found_platform') }}</div>
                                                </vue-select>
                                            </div>

                                            <div class="form-plus-input form-group-input platform-check" v-if="platform.platform_id != ''">
                                                <div class="platform-shape">
                                                    <div class="name">{{ getPlatform(platform.platform_id).name | capitalize }}</div>
                                                    <div class="logo">
                                                        <img :src="$domain + getPlatform(platform.platform_id).logo" width="40px">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-plus-input form-group-input form-plus-fw" v-if="platform.platform_id != ''">
                                                <!-- need platform -->
                                                <div class="form-group form-group-input platform-check-need">
                                                    <div class="custom-control custom-switch">
                                                        <input type="checkbox" class="custom-control-input" :id="`switch_need_platform_${index}`" v-model="platform.need_platform">
                                                        <label class="custom-control-label" :for="`switch_need_platform_${index}`">
                                                            <div class="value-label">
                                                                {{ $t('projects_table.need_platform') }}
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- ./need platform -->
                                                <!-- ====================================================== -->

                                                <!-- name -->
                                                <div class="form-group form-group-input" v-if="platform.need_platform">
                                                    <label>{{ $t('projects_table.name') }}</label>
                                                    <input
                                                        v-model="platform.need_name"
                                                        type="text"
                                                        class="form-control form-control-sm"
                                                        :placeholder="$t('projects_table.name')"
                                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.need_name`) }"
                                                    >
                                                    <has-error :form="form" :field="`platforms.${index}.need_name`"></has-error>
                                                </div>
                                                <!-- ./name -->
                                                <!-- ====================================================== -->

                                                <!-- url -->
                                                <div class="form-group form-group-input" v-if="!platform.need_platform">
                                                    <label>{{ $t('projects_table.url_platform') }}</label>
                                                    <input
                                                        v-model="platform.url"
                                                        type="text"
                                                        class="form-control form-control-sm"
                                                        placeholder="http://"
                                                        :class="{ 'is-invalid': form.errors.has(`platforms.${index}.url`) }"
                                                    >
                                                    <has-error :form="form" :field="`platforms.${index}.url`"></has-error>
                                                </div>
                                                <!-- ./url -->
                                                <!-- ====================================================== -->

                                                <!-- auth -->
                                                <div class="form-group form-group-input" v-if="!platform.need_platform && getPlatform(platform.platform_id).name != 'facebook'">
                                                    <label>{{ $t('projects_table.auth') }}</label>
                                                    <div class="multi-inputs multi-inputs-inline">
                                                        <div class="form-group form-group-input">
                                                            <input
                                                                v-model="platform.auth.username"
                                                                type="text"
                                                                class="form-control form-control-sm"
                                                                placeholder="Username (optional)"
                                                                :class="{ 'is-invalid': form.errors.has(`platforms.${index}.auth.username`) }"
                                                            >
                                                            <has-error :form="form" :field="`platforms.${index}.auth.username`"></has-error>
                                                        </div>
                                                        <div class="form-group form-group-input">
                                                            <input
                                                                v-model="platform.auth.password"
                                                                type="text"
                                                                class="form-control form-control-sm"
                                                                placeholder="Password (optional)"
                                                                :class="{ 'is-invalid': form.errors.has(`platforms.${index}.auth.password`) }"
                                                            >
                                                            <has-error :form="form" :field="`platforms.${index}.auth.password`"></has-error>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- auth -->
                                                <!-- ====================================================== -->

                                            </div>

                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removePlatform(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>

                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addPlatform"
                                            >
                                                {{ $t('projects_table.add_platform') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                        <!-- ./ form plus -->
                                    </div>
                                </div>
                                <!-- ./platforms -->
                                <!-- =========================================================== -->
                            </div>
                            <!-- ./row -->
                            <!-- =========================================================== -->
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->


            <!-- client_info -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">

                            <!-- title   ===  client_info -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('projects_table.client_info')"></h3>
                            </div>

                            <div class="row">
                                <!-- phone_numbers -->
                                <div class="col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.phone_numbers') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(phone, index) in form.phone_numbers" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="phone.number"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`phone_numbers.${index}.number`) }"
                                                    :placeholder="$t('projects_table.number')"
                                                >
                                                <has-error :form="form" :field="`phone_numbers.${index}.number`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                v-if="index > 0 ||  index === 0 && form.phone_numbers.length > 1"
                                                @click="removePhoneNumber(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addPhoneNumber()"
                                            >
                                                {{ $t('projects_table.add_phone') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./phone_numbers -->
                                <!-- =========================================================== -->


                                <!-- emails -->
                                <div class="col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.emails') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(email, index) in form.emails" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="email.email"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`emails.${index}.email`) }"
                                                    :placeholder="$t('projects_table.email')"
                                                >
                                                <has-error :form="form" :field="`emails.${index}.email`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removeEmail(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addEmail()"
                                            >
                                                {{ $t('projects_table.add_email') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./emails -->
                                <!-- =========================================================== -->

                                <!-- addresses -->
                                <div class="col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.addresses') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(address, index) in form.addresses" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="address.address"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`addresses.${index}.address`) }"
                                                    :placeholder="$t('projects_table.address')"
                                                >
                                                <has-error :form="form" :field="`addresses.${index}.address`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removeAddress(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addAddress()"
                                            >
                                                {{ $t('projects_table.add_address') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./addresses -->
                                <!-- =========================================================== -->

                                <!-- websites -->
                                <div class="col-xl-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.websites') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(website, index) in form.websites" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="website.url"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`websites.${index}.url`) }"
                                                    :placeholder="$t('projects_table.url')"
                                                >
                                                <has-error :form="form" :field="`websites.${index}.url`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removeWebsite(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addWebsite()"
                                            >
                                                {{ $t('projects_table.add_website') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./websites -->
                                <!-- =========================================================== -->

                            </div>
                            <!-- ./row -->

                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- designs_info -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">

                            <!-- title   ===  designs_info -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('projects_table.designs_info')"></h3>
                                <button
                                    type="button"
                                    :disabled="loadingFormDesigner"
                                    @click="activateUser('designer')"
                                    class="btn btn-primary btn-sm"
                                    v-if="form.designer_activated_at == null"
                                >
                                    {{ $t('global.activate') }}
                                    <span v-if="loadingFormDesigner" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                </button>
                                <div v-if="form.designer_activated_at != null">
                                    <div v-if="form.designer_accepted_at == null">
                                        {{ $t('global.activated_at') }}
                                        <div class="text-primary font-11 italic bold">
                                            <span v-text="moment(String(form.designer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                        </div>
                                    </div>
                                    <div v-if="
                                        form.designer_activated_at != null &&
                                        form.designer_accepted_at != null &&
                                        form.designer_done_at == null
                                    ">
                                        {{ $t('global.in_progress') }}
                                        <span class="text-primary italic bold">
                                            {{ form.designer_progress }}%
                                        </span>
                                    </div>
                                    <div v-if="form.designer_done_at != null">
                                        {{ $t('global.done_at') }}
                                        <span class="text-success italic bold">
                                            <div class="text-success font-11 italic bold">
                                                <span v-text="moment(String(form.designer_done_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- designs_info -->
                            <div class="row">

                                <!-- designs_count -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.designs_count') }}</label>
                                        <input
                                            v-model.number="form.designs_count"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('designs_count') }"
                                        >
                                        <has-error :form="form" field="designs_count"></has-error>
                                    </div>
                                </div>
                                <!-- ./designs_count -->
                                <!-- =========================================================== -->

                                <!-- need_cover and need_profile -->
                                <div class="col-md-6">
                                    <div class="multi-inputs multi-inputs-inline">

                                        <!-- need_cover -->
                                        <div class="form-group form-group-input">
                                            <label>{{ $t('projects_table.need_cover') }}</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch_need_cover" v-model="form.need_cover">
                                                <label class="custom-control-label" for="switch_need_cover">
                                                    <div class="value-label">
                                                        {{ form.need_cover == true ? $t('global.yes') : $t('global.no') }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>


                                        <!-- need_profile -->
                                        <div class="form-group form-group-input">
                                            <label>{{ $t('projects_table.need_profile') }}</label>
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch_need_profile" v-model="form.need_profile">
                                                <label class="custom-control-label" for="switch_need_profile">
                                                    <div class="value-label">
                                                        {{ form.need_profile == true ? $t('global.yes') : $t('global.no') }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- ./multi-inputs -->
                                </div>
                                <!-- ./need_cover and need_profile -->
                                <!-- =========================================================== -->


                                <!-- need_logo -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.need_logo') }}</label>
                                        <div class="form-group form-group-input">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch_need_logo" v-model="form.need_logo">
                                                <label class="custom-control-label" for="switch_need_logo">
                                                    <div class="value-label">
                                                        {{ form.need_logo == true ? $t('global.yes') : $t('global.no') }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./need_logo -->
                                <!-- =========================================================== -->


                                <!-- logo_src -->
                                <div class="col-md-6" v-if="!form.need_logo">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.logo_src') }}</label>
                                        <div class="custom-file">
                                            <input
                                                type="file"
                                                @change="uploadLogoSrc($event.target.files)"
                                                class="custom-file-input"
                                                :class="{ 'is-invalid': form.errors.has('logo_src') }"
                                            >
                                            <has-error :form="form" field="logo_src"></has-error>
                                            <label class="custom-file-label" for="customFile">
                                                {{ filename_logo == '' ? $t('global.choose_file') : filename_logo }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./logo_src -->
                                <!-- =========================================================== -->


                                <!-- colors_favorite -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.colors_favorite') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(color, index) in form.colors_favorite" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="color.color"
                                                    type="color"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`colors_favorite.${index}.color`) }"
                                                    :placeholder="$t('projects_table.color')"
                                                >
                                                <has-error :form="form" :field="`colors_favorite.${index}.color`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removeColor(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addColor()"
                                            >
                                                {{ $t('projects_table.add_color') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./colors_favorite -->
                                <!-- =========================================================== -->

                                <!-- design_info -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.design_info') }}</label>
                                        <textarea
                                            v-model="form.design_info"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('design_info') }"
                                        ></textarea>
                                        <has-error :form="form" field="design_info"></has-error>
                                    </div>
                                </div>
                                <!-- ./design_info -->
                                <!-- =========================================================== -->

                                <!-- gallery -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.gallery') }}</label>
                                        <upload-image
                                            :form="form"
                                            propertyName="gallery"
                                            :required="false"
                                            :domain="$domain"
                                            type="multiple"
                                            propertyDeletedName="deletedGallery"
                                        ></upload-image>
                                    </div>
                                </div>
                                <!-- ./gallery -->
                                <!-- =========================================================== -->



                                <!-- designer_id -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label v-text="$t('projects_table.designer_id')"></label>
                                        <vue-select
                                            :options="users"
                                            v-model="form.designer_id"
                                            label="name"
                                            :reduce="user => user.id"
                                        >
                                            <template v-slot:option="user">
                                                <div class="my-vue-select">
                                                    <div class="lead-image">
                                                        <img class="image" :src="$domain + user.photo">
                                                    </div>
                                                    <div class="lead-data">
                                                        <div class="text-data">
                                                            <div class="section">
                                                                <span class="title" v-text="user.name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="type">
                                                            <span class="badge badge-primary" v-if="user.job_title != null" v-text="user.job_title.name"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div slot="no-options">{{ $t('lead_contracts_table.not_found_user') }}</div>
                                        </vue-select>
                                    </div>
                                </div>
                                <!-- ./designer_id -->

                                <!-- designer_deadline -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.designer_deadline') }}</label>
                                        <div class="multi-inputs multi-inputs-inline">
                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.designer_deadline_days"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.days')"
                                                    :class="{ 'is-invalid': form.errors.has('designer_deadline_days') }"
                                                >
                                                <has-error :form="form" field="designer_deadline_days"></has-error>
                                            </div>

                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.designer_deadline_hours"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.hours')"
                                                    :class="{ 'is-invalid': form.errors.has('designer_deadline_hours') }"
                                                >
                                                <has-error :form="form" field="designer_deadline_hours"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./designer_deadline -->

                                <!-- =========================================================== -->
                                <div class="col-12" v-if="form.designer_activated_at == null">
                                    <br>
                                    <button
                                        type="button"
                                        :disabled="loadingFormDesigner"
                                        @click="activateUser('designer')"
                                        class="btn btn-primary btn-sm"
                                    >
                                        {{ $t('global.activate') }}
                                        <span v-if="loadingFormDesigner" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                    </button>
                                </div>

                            </div>
                            <!-- ./row -->
                            <!-- =========================================================== -->
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->



            <!-- marketing_info -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <!-- title   ===  marketing_info -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('projects_table.marketing_info')"></h3>
                                <button
                                    type="button"
                                    :disabled="loadingFormMarketer"
                                    @click="activateUser('marketer')"
                                    class="btn btn-primary btn-sm"
                                    v-if="form.marketer_activated_at == null"
                                >
                                    {{ $t('global.activate') }}
                                    <span v-if="loadingFormMarketer" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                </button>
                                <div v-if="form.marketer_activated_at != null">
                                    <div v-if="form.marketer_accepted_at == null">
                                        {{ $t('global.activated_at') }}
                                        <span class="text-primary italic bold">
                                            <div class="text-primary font-11 italic bold">
                                                <span v-text="moment(String(form.marketer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                            </div>
                                        </span>
                                    </div>
                                    <div v-if="
                                        form.marketer_activated_at != null &&
                                        form.marketer_accepted_at != null &&
                                        form.marketer_done_at == null
                                    ">
                                        {{ $t('global.in_progress') }}
                                        <span class="text-primary italic bold">
                                            {{ form.marketer_progress }}%
                                        </span>
                                    </div>
                                    <div v-if="form.marketer_done_at != null">
                                        {{ $t('global.done_at') }}
                                        <span class="text-success italic bold">
                                            <div class="text-success font-11 italic bold">
                                                <span v-text="moment(String(form.marketer_done_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <!-- posts_count -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.posts_count') }}</label>
                                        <input
                                            v-model.number="form.posts_count"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('posts_count') }"
                                        >
                                        <has-error :form="form" field="posts_count"></has-error>
                                    </div>
                                </div>
                                <!-- ./posts_count -->
                                <!-- =========================================================== -->

                                <!-- posts_type -->
                                <!-- posts_count single -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.single') }}</label>
                                        <input
                                            v-model.number="form.posts_type.single"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('posts_type.single') }"
                                        >
                                        <has-error :form="form" field="posts_type.single"></has-error>
                                    </div>
                                </div>
                                <!-- posts_count single -->
                                <!-- =========================================================== -->

                                <!-- posts_count grouped -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.grouped') }}</label>
                                        <input
                                            v-model.number="form.posts_type.grouped"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('posts_type.grouped') }"
                                        >
                                        <has-error :form="form" field="posts_type.grouped"></has-error>
                                    </div>
                                </div>
                                <!-- posts_count grouped -->
                                <!-- =========================================================== -->

                                <!-- posts_count cover_post -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.cover_post') }}</label>
                                        <input
                                            v-model.number="form.posts_type.cover_post"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('posts_type.cover_post') }"
                                        >
                                        <has-error :form="form" field="posts_type.cover_post"></has-error>
                                    </div>
                                </div>
                                <!-- posts_count cover_post -->
                                <!-- =========================================================== -->

                                <!-- client_products -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.client_products') }}</label>
                                        <textarea
                                            v-model="form.client_products"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('client_products') }"
                                        ></textarea>
                                        <has-error :form="form" field="client_products"></has-error>
                                    </div>
                                </div>
                                <!-- ./client_products -->
                                <!-- =========================================================== -->

                                <!-- client_offers -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.client_offers') }}</label>
                                        <textarea
                                            v-model="form.client_offers"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('client_offers') }"
                                        ></textarea>
                                        <has-error :form="form" field="client_offers"></has-error>
                                    </div>
                                </div>
                                <!-- ./client_offers -->
                                <!-- =========================================================== -->

                                <!-- competitors_links -->
                                <div class="col-12">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.competitors_links') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(link, index) in form.competitors_links" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <!-- url -->
                                                <div class="form-group-input">
                                                    <label>{{ $t('projects_table.url') }}</label>
                                                    <input
                                                        v-model="link.url"
                                                        type="text"
                                                        class="form-control form-control-sm"
                                                        :class="{ 'is-invalid': form.errors.has(`competitors_links.${index}.url`) }"
                                                        placeholder="http://"
                                                    >
                                                    <has-error :form="form" :field="`competitors_links.${index}.url`"></has-error>
                                                </div>
                                                <!-- ./url -->

                                                <!-- note -->
                                                <div class="form-group-input">
                                                    <label>{{ $t('projects_table.note') }}</label>
                                                    <textarea
                                                        v-model="link.note"
                                                        class="form-control form-control-sm note-textarea"
                                                        :class="{ 'is-invalid': form.errors.has(`competitors_links.${index}.note`) }"
                                                        :placeholder="$t('projects_table.note')"
                                                    >
                                                    </textarea>
                                                    <has-error :form="form" :field="`competitors_links.${index}.note`"></has-error>
                                                </div>
                                                <!-- ./note -->

                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                @click="removeCompetitorsLink(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addCompetitorsLink()"
                                            >
                                                {{ $t('projects_table.add_link') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./competitors_links -->
                                <!-- =========================================================== -->


                                <!-- marketer id -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label v-text="$t('projects_table.marketer_id')"></label>
                                        <vue-select
                                            :options="users"
                                            v-model="form.marketer_id"
                                            label="name"
                                            :reduce="user => user.id"
                                        >
                                            <template v-slot:option="user">
                                                <div class="my-vue-select">
                                                    <div class="lead-image">
                                                        <img class="image" :src="$domain + user.photo">
                                                    </div>
                                                    <div class="lead-data">
                                                        <div class="text-data">
                                                            <div class="section">
                                                                <span class="title" v-text="user.name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="type">
                                                            <span class="badge badge-primary" v-if="user.job_title != null" v-text="user.job_title.name"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div slot="no-options">{{ $t('lead_contracts_table.not_found_user') }}</div>
                                        </vue-select>
                                    </div>
                                </div>

                                <!-- marketer_deadline -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.marketer_deadline') }}</label>
                                        <div class="multi-inputs multi-inputs-inline">
                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.marketer_deadline_days"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.days')"
                                                    :class="{ 'is-invalid': form.errors.has('marketer_deadline_days') }"
                                                >
                                                <has-error :form="form" field="marketer_deadline_days"></has-error>
                                            </div>

                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.marketer_deadline_hours"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.hours')"
                                                    :class="{ 'is-invalid': form.errors.has('marketer_deadline_hours') }"
                                                >
                                                <has-error :form="form" field="marketer_deadline_hours"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <div class="col-12" v-if="form.marketer_activated_at == null">
                                    <br>
                                    <button
                                        type="button"
                                        :disabled="loadingFormMarketer"
                                        @click="activateUser('marketer')"
                                        class="btn btn-primary btn-sm"
                                    >
                                        {{ $t('global.activate') }}
                                        <span v-if="loadingFormMarketer" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                    </button>
                                </div>
                            </div>
                            <!-- ./row -->
                            <!-- =========================================================== -->
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->



            <!-- ads_info -->
            <div class="col-lg-6">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">

                            <!-- title   ===  ads_info -->
                            <div class="form-title">
                                <h3 class="text" v-text="$t('projects_table.ads_info')"></h3>
                                <button
                                    type="button"
                                    :disabled="loadingFormAdvertiser"
                                    @click="activateUser('advertiser')"
                                    class="btn btn-primary btn-sm"
                                    v-if="form.advertiser_activated_at == null"
                                >
                                    {{ $t('global.activate') }}
                                    <span v-if="loadingFormAdvertiser" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                </button>
                                <div v-if="form.advertiser_activated_at != null">
                                    <div v-if="form.advertiser_accepted_at == null">
                                        {{ $t('global.activated_at') }}
                                        <span class="text-primary italic bold">
                                            <div class="text-primary font-11 italic bold">
                                                <span v-text="moment(String(form.advertiser_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                            </div>
                                        </span>
                                    </div>
                                    <div v-if="
                                        form.advertiser_activated_at != null &&
                                        form.advertiser_accepted_at != null &&
                                        form.advertiser_done_at == null
                                    ">
                                        {{ $t('global.in_progress') }}
                                        <span class="text-primary italic bold">
                                            {{ form.advertiser_progress }}%
                                        </span>
                                    </div>
                                    <div v-if="form.advertiser_done_at != null">
                                        {{ $t('global.done_at') }}
                                        <span class="text-success italic bold">
                                            <div class="text-success font-11 italic bold">
                                                <span v-text="moment(String(form.advertiser_done_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                            </div>
                                        </span>
                                    </div>
                                </div>
                            </div>


                            <div class="row">

                                <!-- sponsored_posts_count -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.sponsored_posts_count') }}</label>
                                        <input
                                            v-model.number="form.sponsored_posts_count"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('sponsored_posts_count') }"
                                        >
                                        <has-error :form="form" field="sponsored_posts_count"></has-error>
                                    </div>
                                </div>
                                <!-- ./sponsored_posts_count -->
                                <!-- =========================================================== -->

                                <!-- days_count -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.days_count') }}</label>
                                        <input
                                            v-model.number="form.days_count"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('days_count') }"
                                        >
                                        <has-error :form="form" field="days_count"></has-error>
                                    </div>
                                </div>
                                <!-- ./days_count -->
                                <!-- =========================================================== -->

                                <!-- day_budget -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.day_budget') }}</label>
                                        <input
                                            v-model.number="form.day_budget"
                                            type="number"
                                            class="form-control form-control-sm"
                                            :class="{ 'is-invalid': form.errors.has('day_budget') }"
                                        >
                                        <has-error :form="form" field="day_budget"></has-error>
                                    </div>
                                </div>
                                <!-- ./day_budget -->
                                <!-- =========================================================== -->

                                <!-- targeted_gender -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.targeted_gender') }}</label>
                                        <div class="multi-inputs multi-inputs-inline">

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch_targeted_gender_male" v-model="form.targeted_gender.male">
                                                <label class="custom-control-label" for="switch_targeted_gender_male">
                                                    <div class="value-label">
                                                        {{ $t('projects_table.male') }}
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" id="switch_targeted_gender_female" v-model="form.targeted_gender.female">
                                                <label class="custom-control-label" for="switch_targeted_gender_female">
                                                    <div class="value-label">
                                                        {{ $t('projects_table.female') }}
                                                    </div>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./targeted_gender -->
                                <!-- =========================================================== -->


                                <!-- targeted_age -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.targeted_age') }}</label>
                                        <div class="multi-inputs multi-inputs-inline">
                                            <!-- min age -->
                                            <div class="form-group form-group-input">
                                                <label>{{ $t('projects_table.min_age') }}</label>
                                                <select
                                                    v-model="form.targeted_age.min"
                                                    class="custom-select custom-select-sm"
                                                    :class="{ 'is-invalid': form.errors.has('targeted_age.min') }"
                                                >
                                                    <option
                                                        v-for="n in 53"
                                                        :key="n"
                                                        :value="n + 12"
                                                        v-text="n + 12">
                                                    </option>
                                                </select>
                                                <has-error :form="form" field="targeted_age.min"></has-error>
                                            </div>
                                            <!-- ./min age -->

                                            <!-- max age -->
                                            <div class="form-group form-group-input">
                                                <label>{{ $t('projects_table.max_age') }}</label>
                                                <select
                                                    v-model="form.targeted_age.max"
                                                    class="custom-select custom-select-sm"
                                                    :class="{ 'is-invalid': form.errors.has('targeted_age.max') }"
                                                >
                                                    <option
                                                        v-for="n in 53"
                                                        :key="n"
                                                        :value="n + 12"
                                                        v-text="n + 12">
                                                    </option>
                                                </select>
                                                <has-error :form="form" field="targeted_age.max"></has-error>
                                            </div>
                                            <!-- ./max age -->

                                        </div>
                                    </div>
                                </div>
                                <!-- ./targeted_age -->
                                <!-- =========================================================== -->

                                <!-- targeted_places -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.targeted_places') }}</label>
                                        <div class="form-plus form-plus-color" v-for="(place, index) in form.targeted_places" :key="index">
                                            <div class="form-plus-input form-group-input form-plus-fw">
                                                <input
                                                    v-model="place.place"
                                                    type="text"
                                                    class="form-control form-control-sm"
                                                    :class="{ 'is-invalid': form.errors.has(`targeted_places.${index}.place`) }"
                                                    :placeholder="$t('projects_table.place')"
                                                >
                                                <has-error :form="form" :field="`targeted_places.${index}.place`"></has-error>
                                            </div>
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-danger btn-plus"
                                                v-if="index > 0 ||  index === 0 && form.targeted_places.length > 1"
                                                @click="removePlace(index)"
                                            >
                                                <i class="fas fa-trash"></i>
                                            </button>
                                            <!-- =========================================================== -->
                                        </div>
                                        <div class="bottom-services-contract">
                                            <button
                                                type="button"
                                                class="btn btn-sm btn-success btn-plus"
                                                @click="addPlace()"
                                            >
                                                {{ $t('projects_table.add_place') }}
                                                <i class="fas fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- ./targeted_places -->
                                <!-- =========================================================== -->


                                <div class="col-12"></div>

                                <!-- advertiser id -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label v-text="$t('projects_table.advertiser_id')"></label>
                                        <vue-select
                                            :options="users"
                                            v-model="form.advertiser_id"
                                            label="name"
                                            :reduce="user => user.id"
                                        >
                                            <template v-slot:option="user">
                                                <div class="my-vue-select">
                                                    <div class="lead-image">
                                                        <img class="image" :src="$domain + user.photo">
                                                    </div>
                                                    <div class="lead-data">
                                                        <div class="text-data">
                                                            <div class="section">
                                                                <span class="title" v-text="user.name"></span>
                                                            </div>
                                                        </div>
                                                        <div class="type">
                                                            <span class="badge badge-primary" v-if="user.job_title != null" v-text="user.job_title.name"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </template>
                                            <div slot="no-options">{{ $t('lead_contracts_table.not_found_user') }}</div>
                                        </vue-select>
                                    </div>
                                </div>

                                <!-- advertiser_deadline -->
                                <div class="col-md-6">
                                    <div class="form-group form-group-input">
                                        <label>{{ $t('projects_table.advertiser_deadline') }}</label>
                                        <div class="multi-inputs multi-inputs-inline">
                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.advertiser_deadline_days"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.days')"
                                                    :class="{ 'is-invalid': form.errors.has('advertiser_deadline_days') }"
                                                >
                                                <has-error :form="form" field="advertiser_deadline_days"></has-error>
                                            </div>

                                            <div class="form-group-input">
                                                <input
                                                    v-model="form.advertiser_deadline_hours"
                                                    type="number"
                                                    class="form-control form-control-sm"
                                                    :placeholder="$t('global.hours')"
                                                    :class="{ 'is-invalid': form.errors.has('advertiser_deadline_hours') }"
                                                >
                                                <has-error :form="form" field="advertiser_deadline_hours"></has-error>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- =========================================================== -->

                                <div class="col-12" v-if="form.advertiser_activated_at == null">
                                    <br>
                                    <button
                                        type="button"
                                        :disabled="loadingFormAdvertiser"
                                        @click="activateUser('advertiser')"
                                        class="btn btn-primary btn-sm"
                                    >
                                        {{ $t('global.activate') }}
                                        <span v-if="loadingFormAdvertiser" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
                                    </button>
                                </div>
                            </div>
                            <!-- ./row -->
                            <!-- =========================================================== -->
                        </div>
                        <!-- =========================================================== -->
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

            <!-- note -->
            <div class="col-12">
                <div class="wrapper-section-data">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group form-group-input">
                                <label>{{ $t('projects_table.note') }}</label>
                                <textarea
                                    v-model="form.note"
                                    class="form-control form-control-sm"
                                    :class="{ 'is-invalid': form.errors.has('note') }"
                                ></textarea>
                                <has-error :form="form" field="note"></has-error>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =========================================================== -->

        </div><!-- ./row -->
    </div>
</template>


<script>
export default {
    props: ['form', 'typeForm'],
    data() {
      return {
        users: [],
        platforms: [],
        filename_logo: '',
        loadingFormDesigner: false,
        loadingFormMarketer: false,
        loadingFormAdvertiser: false
      }
    },

    methods: {
        addPlatform() {
            this.form.platforms.push({
                platform_id: '',
                url: '',
                need_name: '',
                need_platform: false,
                auth: {
                    username: '',
                    password: ''
                }
            })
        },
        removePlatform(index) {
            if (this.typeForm == 'edit') {
                if (this.form.platforms[index].id) {
                    this.form.deletedPlatforms.push(this.form.platforms[index].id)
                }
            }
            this.form.platforms.splice(index, 1)
        },
        getPlatform(id) {
            return this.platforms.find(p => p.id == id)
        },


        addAddress() {
            this.form.addresses.push({address: ''})
        },
        removeAddress(index) {
            this.form.addresses.splice(index, 1)
        },

        addPhoneNumber() {
            this.form.phone_numbers.push({number: ''})
        },
        removePhoneNumber(index) {
            this.form.phone_numbers.splice(index, 1)
        },

        addWebsite() {
            this.form.websites.push({url: ''})
        },
        removeWebsite(index) {
            this.form.websites.splice(index, 1)
        },

        addEmail() {
            this.form.emails.push({email: ''})
        },
        removeEmail(index) {
            this.form.emails.splice(index, 1)
        },

        addColor() {
            this.form.colors_favorite.push({color: ''})
        },
        removeColor(index) {
            this.form.colors_favorite.splice(index, 1)
        },

        addPlace() {
            this.form.targeted_places.push({place: ''})
        },
        removePlace(index) {
            this.form.targeted_places.splice(index, 1)
        },

        addCompetitorsLink() {
            this.form.competitors_links.push({url: '', note: ''})
        },
        removeCompetitorsLink(index) {
            this.form.competitors_links.splice(index, 1)
        },

        uploadLogoSrc(files) {
            let file = null
            const self = this
            if (files.length) {
                file = files[0]
                if (file) {
                    if (file["size"] > 5000000) {
                        if (this.$i18n.locale == 'ar') {
                            Swal.fire(
                                "خطأ...",
                                `الحجم المسموح به للملف هو 5 ميجا بايت.`,
                                "error"
                            );
                        } else {
                            Swal.fire(
                                "Oops...",
                                `You are uploading a large file 5MB last.`,
                                "error"
                            );
                        }
                    } else {
                        this.filename_logo = file.name
                        let ext = file.name.substr(file.name.lastIndexOf('.'))
                        ext = ext == '.jpeg' ? '.jpg' : ext
                        self.form.logo_ext = ext
                        let reader = new FileReader()
                        reader.onloadend = () => {
                            self.form.logo_src = reader.result
                        }
                        reader.readAsDataURL(file)
                    }
                }
            }
        },

        activateUser(type) {
            this.$activeProject(this.form.id, type).then(res => {
                this.form[type + '_activated_at'] = this.moment(String(new Date())).format('YYYY-MM-DD hh:mm:ss')
            })
        },
    },

    computed: {

    },

    mounted() {
        $getPlatforms().then(platforms => {
            this.platforms = platforms.filter(p => p.display == 1)
            const getForm = setInterval(() => {
                if (this.form.id != '') {
                    clearInterval(getForm)
                    if (!this.form.platforms.length) {
                        this.platforms.filter(p => p.name == 'facebook' || p.name == 'instagram').forEach(platform => {
                            let newPlatform = {}
                            newPlatform.platform_id = platform.id
                            newPlatform.url = '',
                            newPlatform.need_name = '',
                            newPlatform.need_platform = false,
                            newPlatform.auth = {
                                username: '',
                                password: ''
                            }
                            this.form.platforms.push(newPlatform)
                        })
                    }
                }
            }, 500)
        })
        $getUsersSelect().then(users => {
            this.users = users.filter(user => user.job_title != null)
        })
    },
  }
</script>
