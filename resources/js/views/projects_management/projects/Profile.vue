<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <router-link
                    class="btn btn-sm btn-dark"
                    :to="{name: 'home'}"
                    v-if="$can('profile-projects')"
                >
                    <i class="fas fa-eye"></i>
                    {{ $t('projects_table.view_project') }}
                </router-link>

                <!-- btn new task -->
                <button
                    type="button"
                    class="btn btn-primary btn-sm"
                >
                    {{ $t('sidebar.New_task') }}
                </button>
                <!-- ./btn new task -->

                <!-- btn accepte -->
                <button
                    type="button"
                    v-if="!$can('admin-projects-management')"
                    class="btn btn-success btn-sm"
                    v-text="$t('global.accepte_now')"
                ></button>
                    <!-- @click="accepteProject(modelData.id)" -->
                <!-- ./btn accepte -->

                <!-- btn edit row -->
                <btn-edit v-if="$can('edit-projects')" :model="modelData" :modelName="idPage"></btn-edit>
                <!-- ./btn edit row -->

            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <!-- ================================= lead_data ================================= -->
                            <div class="wrapper-section-data">
                                <!-- row -->
                                <div class="row">
                                    <!-- title   ===  client_data -->
                                    <div class="col-12">
                                        <div class="form-title">
                                            <h3 class="text" v-text="$t('projects_table.client_data')"></h3>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->


                                    <!-- lead_id -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_id') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.name"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- lead_phone -->
                                    <div
                                        class="col-sm-6 col-lg-4 col-xl-3"
                                        v-if="(!$can('admin-projects-management') && modelData.designer_id != $auth.id) || $can('admin-projects-management')"
                                    >
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_phone') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.phone"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- lead_whatsapp_phone -->
                                    <div
                                        class="col-sm-6 col-lg-4 col-xl-3"
                                        v-if="(!$can('admin-projects-management') && modelData.designer_id != $auth.id) || $can('admin-projects-management')"
                                    >
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.lead_whatsapp_phone') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.whatsapp_phone"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_name -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_name') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.company_name"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_scope -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_scope') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.company_scope"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- company_email -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('projects_table.company_email') }}</label>
                                            <div class="content" v-text="modelData.contract.lead.company_email"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- ads_amount -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('lead_contracts_table.ads_amount') }}</label>
                                            <div class="content">
                                                <div class="amount">
                                                    {{ modelData.contract.ads_amount }}
                                                    {{ $t('global.currency') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                    <!-- contract_number -->
                                    <div class="col-sm-6 col-lg-4 col-xl-3">
                                        <div class="profile-field-group">
                                            <label>{{ $t('lead_contracts_table.id') }}</label>
                                            <div class="content" v-text="modelData.contract.id"></div>
                                        </div>
                                    </div>
                                    <!-- =========================================================== -->

                                </div>
                                <!-- ./row -->
                            </div>
                            <!-- ./wrapper-section-data -->
                            <!-- ============================================================================= -->

                            <!-- row -->
                            <div class="row">
                                <!-- ================================= platforms ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">

                                            <!-- title   ===  platforms -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('projects_table.platforms')"></h3>
                                                </div>
                                            </div>

                                            <!-- =========================================================== -->
                                            <!-- platforms -->
                                            <div class="col-12">
                                                <div class="form-group-input">
                                                    <div class="form-plus form-plus-color form-platform-in-project" v-for="platform in modelData.platforms" :key="platform.id">
                                                        <div class="form-plus-input form-group-input platform-check">
                                                            <div class="platform-shape">
                                                                <div class="name">{{ platform.original_platform.name | capitalize }}</div>
                                                                <div class="logo">
                                                                    <img :src="$domain + platform.original_platform.logo" width="40px">
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-plus-input form-group-input form-plus-fw">
                                                            <!-- need platform -->
                                                            <div class="col-12" v-if="platform.need_platform == true">
                                                                <div class="profile-field-group">
                                                                    <label>{{ $t('projects_table.need_platform') }}</label>
                                                                    <div class="content" v-text="platform.need_name"></div>
                                                                </div>
                                                            </div>

                                                            <!-- url -->
                                                            <div class="col-12" v-if="platform.need_platform == false">
                                                                <div class="profile-field-group">
                                                                    <label>{{ $t('projects_table.url_platform') }}</label>
                                                                    <div class="content">
                                                                        <a :href="platform.url" target="_blank" v-text="platform.url"></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- ./url -->
                                                            <!-- ====================================================== -->

                                                            <!-- auth -->
                                                            <div class="col-12" v-if="platform.need_platform == false && platform.original_platform.name != 'facebook' && (platform.auth.username != null || platform.auth.password != null) && (!$can('admin-projects-management') && modelData.designer_id != $auth.id) || $can('admin-projects-management')">
                                                                <div class="form-group-input">
                                                                    <div class="profile-field-group">
                                                                            <div class="multi-inputs multi-inputs-inline">
                                                                                <div class="profile-field-group">
                                                                                    <label>Username</label>
                                                                                    <div class="content" v-text="platform.auth.username"></div>
                                                                                </div>
                                                                                <div class="profile-field-group">
                                                                                    <label>Password</label>
                                                                                    <div class="content" v-text="platform.auth.password"></div>
                                                                                </div>
                                                                            </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- auth -->
                                                            <!-- ====================================================== -->
                                                        </div>
                                                    </div>
                                                    <!-- ./ form plus -->
                                                </div>
                                            </div>
                                            <!-- ./platforms -->
                                            <!-- =========================================================== -->

                                        </div>
                                    </div>
                                </div>


                                <!-- ================================= payments ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  payments -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('global.payments')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- payments -->
                                            <div class="col-12" v-if="modelData.contract.payments.length">
                                                <div
                                                    class="row services-in-profile"
                                                    v-for="payment in modelData.contract.payments"
                                                    :key="payment.id">
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <div class="content">
                                                                <div class="name">
                                                                    {{ payment.date }}
                                                                    <br>
                                                                    {{ payment.description }}
                                                                </div>
                                                                <div class="amount">
                                                                    {{ payment.amount }}
                                                                    {{ $t('global.currency') }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>



                                <!-- ================================= client_info ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  client_info -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('projects_table.client_info')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- client_info -->
                                            <div class="col-12">
                                                <div class="row services-in-profile">
                                                    <!-- phone_numbers -->
                                                    <div class="col-12" v-if="modelData.phone_numbers.length">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.phone_numbers') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-text="phone.number"
                                                                v-for="phone in modelData.phone_numbers.filter(p => p.number != null)"
                                                                :key="phone.number"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    <!-- ./phone_numbers -->
                                                    <!-- =========================================================== -->

                                                    <!-- addresses -->
                                                    <div class="col-12" v-if="modelData.addresses.length">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.addresses') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-text="address.address"
                                                                v-for="address in modelData.addresses.filter(p => p.address != null)"
                                                                :key="address.address"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    <!-- ./addresses -->
                                                    <!-- =========================================================== -->

                                                    <!-- emails -->
                                                    <div class="col-12" v-if="modelData.emails.length">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.emails') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-text="email.email"
                                                                v-for="email in modelData.emails.filter(p => p.email != null)"
                                                                :key="email.email"
                                                            ></div>
                                                        </div>
                                                    </div>
                                                    <!-- ./emails -->
                                                    <!-- =========================================================== -->

                                                    <!-- websites -->
                                                    <div class="col-12" v-if="modelData.websites.length">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.websites') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-for="website in modelData.websites.filter(p => p.url != null)"
                                                                :key="website.url"
                                                            >
                                                                <a :href="website.url" v-text="website.url"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- ./websites -->
                                                    <!-- =========================================================== -->

                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>



                                <!-- ================================= designs_info ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  designs_info -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('projects_table.designs_info')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- designer_id -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.designer_id') }}</label>
                                                    <div class="content">
                                                        {{ modelData.designer != null ? modelData.designer.name : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- designer_deadline -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.designer_deadline') }}</label>
                                                    <div class="content">
                                                        <span class="badge badge-primary" v-text="modelData.designer_deadline_days || 0"></span>
                                                        {{ $t('global.days') }}
                                                        ,
                                                        <span class="badge badge-primary" v-text="modelData.designer_deadline_hours || 0"></span>
                                                        {{ $t('global.hours') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- designer_status -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.designer_status') }}</label>
                                                    <div class="content">
                                                        <div v-if="modelData.designer_activated_at != null">
                                                            <div v-if="modelData.designer_accepted_at == null">
                                                                {{ $t('global.activated_at') }}
                                                                <div class="text-primary font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.designer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                            <div v-if="
                                                                modelData.designer_activated_at != null &&
                                                                modelData.designer_accepted_at != null &&
                                                                modelData.designer_done_at == null
                                                            ">
                                                                {{ $t('global.in_progress') }}
                                                                <span class="text-primary italic bold">
                                                                    {{ modelData.designer_progress }}%
                                                                </span>
                                                            </div>
                                                            <div v-if="modelData.designer_done_at != null">
                                                                {{ $t('global.done_at') }}
                                                                <div class="text-success font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.designer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-danger" v-else v-text="$t('global.disactive')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- designs_count -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.designs_count') }}</label>
                                                    <div class="content" v-text="modelData.designs_count"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- need_cover -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.need_cover') }}</label>
                                                    <div class="content">
                                                        <span v-if="modelData.need_cover" class="badge badge-success" v-text="$t('global.yes')"></span>
                                                        <span v-else class="badge badge-danger" v-text="$t('global.no')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- need_profile -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.need_profile') }}</label>
                                                    <div class="content">
                                                        <span v-if="modelData.need_profile" class="badge badge-success" v-text="$t('global.yes')"></span>
                                                        <span v-else class="badge badge-danger" v-text="$t('global.no')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- need_logo -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.need_logo') }}</label>
                                                    <div class="content">
                                                        <span v-if="modelData.need_logo" class="badge badge-success" v-text="$t('global.yes')"></span>
                                                        <span v-else class="badge badge-danger" v-text="$t('global.no')"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- logo_src -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.logo_src') }}</label>
                                                    <div class="content">
                                                        <a
                                                            v-if="modelData.logo_src != null"
                                                            class="btn btn-success btn-sm"
                                                            :href="$domain + modelData.logo_src"
                                                            download="logo-source"
                                                            v-text="$t('global.download_logo_src')"
                                                        ></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- colors_favorite -->
                                            <div class="col-12" v-if="modelData.colors_favorite.length">
                                                <div class="row services-in-profile">
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.colors_favorite') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-for="color in modelData.colors_favorite.filter(c => c.color != null)"
                                                                :key="color.color"
                                                            >
                                                                <span v-text="color.color"></span>
                                                                <span :style="{backgroundColor: color.color, width: '40px', height: '40px', display: 'inline-block'}"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- ./colors_favorite -->
                                            <!-- =========================================================== -->

                                            <!-- design_info -->
                                            <div class="col-12">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.design_info') }}</label>
                                                    <div class="content" v-html-lines="modelData.design_info"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- gallery -->
                                            <div class="col-12" v-if="modelData.gallery.length">
                                                <div class="profile-field-group">
                                                    <div class="d-block mb-2 overflow-hidden">
                                                        <label class="float-left custom-lable" v-text="$t('projects_table.gallery')"></label>
                                                        <button
                                                            type="button"
                                                            class="btn btn-success btn-sm float-right"
                                                            v-text="$t('global.download_all')"
                                                            @click="donwloadAllGallery"
                                                        ></button>
                                                    </div>
                                                    <div class="content">
                                                        <div class="gallery">
                                                            <div class="image" v-for="(image, index) in modelData.gallery" :key="index">
                                                                <a
                                                                    class="btn btn-success"
                                                                    :href="$domain + image.value"
                                                                    :download="`image-${image.id}`"
                                                                    v-text="$t('global.download')"
                                                                ></a>
                                                                <img :src="$domain + image.value">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                        </div>
                                    </div>
                                </div>



                                <!-- ================================= marketing_info ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  marketing_info -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('projects_table.marketing_info')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- marketer_id -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.marketer_id') }}</label>
                                                    <div class="content">
                                                        {{ modelData.marketer != null ? modelData.marketer.name : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- marketer_deadline -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.marketer_deadline') }}</label>
                                                    <div class="content">
                                                        <span class="badge badge-primary" v-text="modelData.marketer_deadline_days || 0"></span>
                                                        {{ $t('global.days') }}
                                                        ,
                                                        <span class="badge badge-primary" v-text="modelData.marketer_deadline_hours || 0"></span>
                                                        {{ $t('global.hours') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- marketer_status -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.marketer_status') }}</label>
                                                    <div class="content">
                                                        <div v-if="modelData.marketer_activated_at != null">
                                                            <div v-if="modelData.marketer_accepted_at == null">
                                                                {{ $t('global.activated_at') }}
                                                                <div class="text-primary font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.marketer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                            <div v-if="
                                                                modelData.marketer_activated_at != null &&
                                                                modelData.marketer_accepted_at != null &&
                                                                modelData.marketer_done_at == null
                                                            ">
                                                                {{ $t('global.in_progress') }}
                                                                <span class="text-primary italic bold">
                                                                    {{ modelData.marketer_progress }}%
                                                                </span>
                                                            </div>
                                                            <div v-if="modelData.marketer_done_at != null">
                                                                {{ $t('global.done_at') }}
                                                                <div class="text-success font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.marketer_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-danger" v-else v-text="$t('global.disactive')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- posts_count -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.posts_count') }}</label>
                                                    <div class="content" v-text="modelData.posts_count"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- posts_count single -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.single') }}</label>
                                                    <div class="content" v-text="modelData.posts_type.single"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- posts_count single -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.single') }}</label>
                                                    <div class="content" v-text="modelData.posts_type.single"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- posts_count grouped -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.grouped') }}</label>
                                                    <div class="content" v-text="modelData.posts_type.grouped"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- posts_count cover_post -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.posts_count') + ' ' + $t('global.projects_posts_type.cover_post') }}</label>
                                                    <div class="content" v-text="modelData.posts_type.cover_post"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- client_products -->
                                            <div class="col-12">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.client_products') }}</label>
                                                    <div class="content" v-html-lines="modelData.client_products"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- client_offers -->
                                            <div class="col-12">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.client_offers') }}</label>
                                                    <div class="content" v-html-lines="modelData.client_offers"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- competitors_links -->
                                            <div class="col-12" v-if="modelData.competitors_links.length">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.competitors_links') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-for="(link, index) in modelData.competitors_links.filter(link => link.url != null)"
                                                                :key="index"
                                                            >
                                                                <div>
                                                                    <a :href="link.url" v-text="link.url"></a>
                                                                </div>
                                                                <div v-html-lines="link.note"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                        </div>
                                    </div>
                                </div>



                                <!-- ================================= ads_info ================================= -->
                                <div class="col-md-6">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- title   ===  ads_info -->
                                            <div class="col-12">
                                                <div class="form-title">
                                                    <h3 class="text" v-text="$t('projects_table.ads_info')"></h3>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- advertiser_id -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.advertiser_id') }}</label>
                                                    <div class="content">
                                                        {{ modelData.advertiser != null ? modelData.advertiser.name : '' }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- advertiser_deadline -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.advertiser_deadline') }}</label>
                                                    <div class="content">
                                                        <span class="badge badge-primary" v-text="modelData.advertiser_deadline_days || 0"></span>
                                                        {{ $t('global.days') }}
                                                        ,
                                                        <span class="badge badge-primary" v-text="modelData.advertiser_deadline_hours || 0"></span>
                                                        {{ $t('global.hours') }}
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- advertiser_status -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.advertiser_status') }}</label>
                                                    <div class="content">
                                                        <div v-if="modelData.advertiser_activated_at != null">
                                                            <div v-if="modelData.advertiser_accepted_at == null">
                                                                {{ $t('global.activated_at') }}
                                                                <div class="text-primary font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.advertiser_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                            <div v-if="
                                                                modelData.advertiser_activated_at != null &&
                                                                modelData.advertiser_accepted_at != null &&
                                                                modelData.advertiser_done_at == null
                                                            ">
                                                                {{ $t('global.in_progress') }}
                                                                <span class="text-primary italic bold">
                                                                    {{ modelData.advertiser_progress }}%
                                                                </span>
                                                            </div>
                                                            <div v-if="modelData.advertiser_done_at != null">
                                                                {{ $t('global.done_at') }}
                                                                <div class="text-success font-11 italic bold">
                                                                    <span v-text="moment(String(modelData.advertiser_activated_at)).format('YYYY MMMM DD - hh:mm A')"></span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="badge badge-danger" v-else v-text="$t('global.disactive')"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- sponsored_posts_count -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.sponsored_posts_count') }}</label>
                                                    <div class="content" v-text="modelData.sponsored_posts_count"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- days_count -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.days_count') }}</label>
                                                    <div class="content" v-text="modelData.days_count"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- day_budget -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.day_budget') }}</label>
                                                    <div class="content" v-text="modelData.day_budget"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- targeted_age -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.targeted_age') }}</label>
                                                    <div class="content">
                                                        {{ $t('global.from') }}
                                                        <span class="badge badge-primary" v-text="modelData.targeted_age.min"></span>
                                                        {{ $t('global.to') }}
                                                        <span class="badge badge-primary" v-text="modelData.targeted_age.max"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                            <!-- targeted_gender -->
                                            <div class="col-sm-6 col-lg-4">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.targeted_gender') }}</label>
                                                    <div class="content">
                                                        <span
                                                            class="badge badge-primary"
                                                            v-if="modelData.targeted_gender.male"
                                                            v-text="$t('projects_table.male')"
                                                        ></span>
                                                        <span
                                                            class="badge badge-primary"
                                                            v-if="modelData.targeted_gender.female"
                                                            v-text="$t('projects_table.female')"
                                                        ></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->


                                            <!-- targeted_places -->
                                            <div class="col-12" v-if="modelData.targeted_places.length">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="profile-field-group">
                                                            <label>{{ $t('projects_table.targeted_places') }}</label>
                                                            <div
                                                                class="content mb-1"
                                                                v-for="(place, index) in modelData.targeted_places.filter(place => place.place != null)"
                                                                :key="index"
                                                            >
                                                                <div v-text="place.place"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- =========================================================== -->
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->

                                        </div>
                                    </div>
                                </div>

                                <!-- ================================= note ================================= -->
                                <div class="col-12">
                                    <div class="wrapper-section-data">
                                        <div class="row">
                                            <!-- note -->
                                            <div class="col-12">
                                                <div class="profile-field-group">
                                                    <label>{{ $t('projects_table.note') }}</label>
                                                    <div class="content" v-text="modelData.note"></div>
                                                </div>
                                            </div>
                                            <!-- =========================================================== -->
                                        </div>
                                    </div>
                                </div>


                            </div><!-- ./row -->
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>
export default {
    data() {
      return {
        urlModel: '/projectmanagement/projects',
        modelData: {
            id: '',
            designer_id: '',
            designer_deadline_days: '', // days number
            designer_deadline_hours: '', // hours number
            marketer_id: '',
            marketer_deadline_days: '', // days number
            marketer_deadline_hours: '', // hours number
            advertiser_id: '',
            advertiser_deadline_days: '', // days number
            advertiser_deadline_hours: '', // hours number

            addresses: [],
            phone_numbers: [],
            websites: [],
            emails: [],

            designs_count: '', // integer
            need_logo: false, // boolean
            logo_src: '', // file
            logo_ext: '', // file extension
            need_cover: false, // boolean
            need_profile: false, // boolean
            colors_favorite: [],
            design_info: '', // textarea
            gallery: [],
            posts_type: {
                single: '',
                grouped: '',
                cover_post: ''
            },
            posts_count: '', // integer
            client_products: '', // textarea
            client_offers: '', // textarea
            competitors_links: [], // json
            sponsored_posts_count: '', // integer
            targeted_places: [], // json
            targeted_gender: {
                male: true,
                female: true
            }, // json
            targeted_age: {
                min: 13,
                max: 65
            }, // json
            days_count: '', // integer
            day_budget: '', // integer
            note: '',
            platforms: [],

            designer_activated_at: null,
            marketer_activated_at: null,
            advertiser_activated_at: null,

            designer_accepted_at: null,
            marketer_accepted_at: null,
            advertiser_accepted_at: null,

            designer_progress: 0,
            marketer_progress: 0,
            advertiser_progress: 0,

            designer_done_at: null,
            marketer_done_at: null,
            advertiser_done_at: null,
            created_at: "",

            contract: {
                lead: {
                    name: '',
                    phone: '',
                    whatsapp_phone: '',
                    company_name: '',
                    company_scope: '',
                },
                payments: [],
                ads_amount: ''
            },
        },

        idPage: 'projects',
        breadcrumb: []
      }
    },
    methods: {
        donwloadAllGallery() {
            this.$downloadMultiImage(this.modelData.gallery)
        },

        getProject(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const project = response.data.project
                    if (project != null) {
                        this.modelData = project
                    } else {
                        this.$router.push({name: 'projects'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getProject(this.$route)
                }, 1000)
            })
        },

        destroyModel() {
            this.$destroyRow(this.modelData.id, this.urlModel).then(() => {
                this.$router.push({name: 'projects'})
            })
        }
    },
    mounted() {
        this.getProject(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.projects_management'), to: {name: 'projects_management-model'}},
            {label: this.$t('sidebar.projects'), to: {name: 'projects'}},
            {label: this.$t('global.project_profile'), active: true},
        ]

    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.project_profile')
        })
    }
}
</script>
