<style lang="scss">

</style>

<template>
    <div class="navbar-layout">
        <nav class="main-header navbar navbar-expand navbar-dark navbar-dark">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <router-link :to="{name: 'home'}" class="nav-link link-home"><i class="fas fa-th-large"></i></router-link>
                </li>
                <slot name="link-model"></slot>

                <li class="model-links" v-click-outside="hideMenuInMobileFn">
                    <span
                        v-if="$route.name != 'home' && $route.name != 'user-dashboard-model'"
                        class="nav-item d-inline-block d-lg-none btn-show-model-links"
                        @click="showMenuInMobile = !showMenuInMobile"
                        >
                        <a href="javascript:void(0)" class="nav-link"><i class="fas fa-bars"></i></a>
                    </span>
                    <ul
                        class="navbar-nav links d-lg-flex"
                        :class="{'d-none': !showMenuInMobile}"
                    >
                        <slot name="links"></slot>
                    </ul>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto nav-links-right">
                <!-- ================================================================= -->
                <!-- notifications -->
                <li class="nav-item dropdown calls">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fas fa-phone"></i>
                    </a>

                    <div class="dropdown-menu links-dropdown-menu-global">
                        <router-link :to="{name: 'users-profile', params: {id: $auth.id}}" class="dropdown-item" v-text="$t('global.staff')"></router-link>
                        <router-link :to="{name: 'users-profile', params: {id: $auth.id}}" class="dropdown-item" v-text="$t('global.clients')"></router-link>
                        <router-link :to="{name: 'users-profile', params: {id: $auth.id}}" class="dropdown-item" v-text="$t('global.vendors')"></router-link>
                    </div>

                </li>

                <!-- ================================================================= -->
                <!-- notifications -->
                <li class="nav-item dropdown has-notifications message">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fas fa-comment-alt"></i>
                        <span class="count-notif" v-text="15"></span>
                    </a>

                    <div class="dropdown-menu">
                        <!-- ========================= header =============================== -->
                        <span class="dropdown-header" v-text="$t('global.latest_messages')"></span>

                        <!-- ========================= links =============================== -->
                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-image">
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        <div><strong>Mohamed</strong></div>
                                        Hello this is last message for this user
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-image">
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        <div><strong>Ahmed</strong></div>
                                        Hello this is last message for this user
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-image">
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        <div><strong>Wafaa</strong></div>
                                        Hello this is last message for this user
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-image">
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                       <div><strong>Hadeer</strong></div>
                                        Hello this is last message for this user
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <!-- ========================= footer =============================== -->
                        <router-link :to="{name: 'users'}" class="dropdown-item dropdown-footer" v-text="$t('global.all_messages')"></router-link>
                    </div>
                </li>

                <!-- ================================================================= -->
                <!-- notifications -->
                <li class="nav-item dropdown has-notifications notifications">
                    <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="true">
                        <i class="fas fa-bell"></i>
                        <span class="count-notif" v-text="'99+'"></span>
                    </a>

                    <div class="dropdown-menu">
                        <!-- ========================= header =============================== -->
                        <span class="dropdown-header" v-text="$t('global.the_notifications')"></span>

                        <!-- ========================= links =============================== -->

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="'1' === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Sara
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            05:23 PM - 15 Jan
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>

                        <router-link :to="{name: 'users-create'}" class="dropdown-item">
                            <div class="notif-box">
                                <div class="icon">
                                    <span class="inner-icon" v-if="1 === 1">
                                        <i class="fas fa-bell"></i>
                                    </span>
                                    <span class="inner-image" v-else>
                                        <img :src="$domain + $auth.photo">
                                    </span>
                                </div>
                                <div class="wrapper-content">
                                    <div class="notif-content">
                                        {{ $t('global.notif_create_user') }}

                                        <strong>
                                            Abdallah Mokhtar
                                        </strong>
                                    </div>
                                    <div class="notif-time">
                                        <i class="far fa-clock"></i>
                                        <span class="time">
                                            09:45 AM - 29 Dec
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </router-link>


                        <!-- ========================= footer =============================== -->
                        <router-link :to="{name: 'users'}" class="dropdown-item dropdown-footer" v-text="$t('global.all_notifications')"></router-link>
                    </div>
                </li>



                <!-- ================================================================= -->
                <!-- langs -->
                <div class="separator-v d-none d-lg-block"></div>
                    <li class="nav-item dropdown nav-item-langs">
                        <a class="nav-link nav-link-lang" @click.prevent="setLocaleAndRefresh('en')" :disabled="$i18n.locale === 'en'">EN</a>
                        <a class="nav-link nav-link-lang" @click.prevent="setLocaleAndRefresh('ar')" :disabled="$i18n.locale === 'ar'">AR</a>
                    </li>
                <div class="separator-v"></div>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav nav-links-right d-md-none link-show-sidebar">
                <li class="nav-item">
                    <a class="nav-link" href="#" @click.prevent="showSidebar = !showSidebar"><i class="fas fa-ellipsis-v"></i></a>
                    <!-- :class="{'fa-arrow-left': $i18n.locale === 'en', 'fa-arrow-right': $i18n.locale === 'ar'}" -->
                </li>
            </ul>

            <ul class="navbar-nav ml-auto nav-links-right custom-sidebar-profile" :class="{'show-sidebar': showSidebar}">
                <li class="nav-item dropdown">
                    <a class="nav-link btn-show-menu-profile" :data-toggle="!showSidebar ? 'dropdown' : ''" href="#" aria-expanded="true">
                        <span v-text="$auth.name"></span>
                        <i class="fas fa-sort-down"></i>
                        <img class="user-image" :src="$domain + $auth.photo">
                    </a>

                    <div class="dropdown-menu">
                        <router-link :to="{name: 'users-profile', params: {id: $auth.id}}" class="dropdown-item" v-text="$t('global.user_profile')"></router-link>
                        <router-link :to="{name: 'users-edit', params: {id: $auth.id}}" class="dropdown-item" v-text="$t('global.edit_profile')"></router-link>
                        <router-link :to="{name: 'general-settings'}" class="dropdown-item" v-text="$t('sidebar.settings')"></router-link>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" :href="$domain_admin + '/logout'">
                            {{ $t('global.logout') }}
                            <i class="fas fa-power-off"></i>
                        </a>
                        <form id="logout-form" :action="$domain_admin + 'logout'" method="POST" style="display: none;">
                            <input type="hidden" name="_token" :value="csrf_token">
                        </form>
                    </div>
                </li>
            </ul>

            <div class="overlay-sidebar" v-if="showSidebar" @click.prevent="showSidebar = !showSidebar"></div>
        </nav>
    </div>
</template>


<script>
export default {
    name: 'navbar',
    data() {
        return {
            csrf_token: window.csrf_token,
            showMenuInMobile: false,
            showSidebar: false,
        }
    },
    methods: {
        hideMenuInMobileFn() {
            this.showMenuInMobile = false
        },

        setLocaleAndRefresh(locale) {
            localStorage.setItem('locale', locale)
            window.location.reload(true)
        },

        setLocale(locale) {
            const msgs = require(`../lang/${locale}.json`)
            this.$i18n.setLocaleMessage(locale, msgs)
            this.$i18n.locale = locale
            let myMainRtlCss = locale == 'ar' ? 'admin/css/main-rtl.css' : 'admin/css/main.css'
            let styleMyMain = document.getElementById('style-my-main')
            styleMyMain.setAttribute('href', this.$domain + myMainRtlCss)
            axios.defaults.headers.common['locale'] = locale
        },
    },

    watch: {
        "$route.name"(newVal) {
            this.hideMenuInMobileFn()
        }
    },

    mounted() {
        if (localStorage.getItem('locale') != null) {
            this.setLocale(localStorage.getItem('locale'))
        } else {
            localStorage.setItem('locale', this.$i18n.locale)
        }

        $('.has-notifications .dropdown-menu').overlayScrollbars({
            scrollbars: {
                autoHide: 'm',
            }
        });
    },
}
</script>
