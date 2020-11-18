<style lang="scss">

</style>

<template>
    <div class="sidebar-layout">
        <aside class="main-sidebar elevation-4 sidebar-dark-danger">
            <!-- Brand Logo -->
            <router-link :to="{name: 'home'}" class="brand-link">
                <img src="https://creatorad.com/web/image/res.company/1/logo?unique=d6a653c" alt="logo" class="brand-image">
                <!-- <img :src="$domain + $settings.logo" :alt="$settings.site_name + ' logo'" class="brand-image"> -->
                <!-- <span class="brand-text font-weight-light">{{ $settings.site_name_ar }}</span> -->
            </router-link>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img :src="$domain + $auth.image" class="img-circle elevation-2" alt="Admin Image">
                </div>
                <div class="info">
                    <router-link class="d-block" :to="{name: 'edit-user', params: {user: $auth, id: $auth.id}}">{{ $auth.name }}</router-link>
                </div>
            </div>

            <!-- Sidebar Menu-->
             <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" id="nav-sidebar-global" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                    <!-- <li class="nav-item has-treeview menu-open"> -->

                    <!-- =============================== Dashboard ================================== -->
                    <li class="nav-item">
                        <router-link :to="{name: 'home'}" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{$t('global.dashboard')}}
                            <!-- <span class="right badge badge-danger">New</span> -->
                        </p>
                        </router-link>
                    </li>


                    <!-- =============================== users ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                {{ $t('sidebar.users') }}
                                <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                                <!-- <span class="badge badge-info right">130</span> -->
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'users'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_users') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-user'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_user') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>


                    <!-- =============================== settings ================================== -->
                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            {{ $t('sidebar.settings') }}
                            <i class="fas right" :class="$i18n.locale == 'ar' ? 'fa-angle-right' : 'fa-angle-left'"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <router-link :to="{name: 'settings'}" class="nav-link">
                                    <i class="far fa-eye nav-icon"></i>
                                    <p> {{ $t('global.show') + ' ' + $t('sidebar.all_settings') }} </p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{name: 'create-setting'}" class="nav-link">
                                    <i class="fas fa-plus nav-icon"></i>
                                    <p> {{ $t('global.create') + ' ' + $t('sidebar.new_setting') }} </p>
                                </router-link>
                            </li>
                        </ul>
                    </li>

                </ul>

            </nav>

            <!-- /.sidebar-menu -->

            </div>
            <!-- /.sidebar -->
        </aside>
    </div>
</template>


<script>

export default {
    name: 'sidebar',
    data() {
        return {
        }
    },
    mounted() {

    }
}
</script>
