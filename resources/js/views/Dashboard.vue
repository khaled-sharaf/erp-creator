<template>
    <div>

         <!-- Navbar -->
        <navbar></navbar>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <!-- :style="{'background-image': 'url(' + $domain + 'images/bg-dashboard.jpg)'}" -->
        <div class="content-wrapper dashboard-wrapper">

            <!-- Main content -->
                <section class="content">
                    <div class="container">
                        <div class="icons-models">

                            <!-- =================== Dashboard ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-dashboard')">
                                <router-link class="icon-model dashboard" :to="{name: 'user-dashboard-model'}">
                                    <div class="icon">
                                        <i class="fas fa-tachometer-alt"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.dashboard') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== HR ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-hr')">
                                <router-link class="icon-model hr" :to="{name: 'hr-model'}">
                                    <div class="icon">
                                        <i class="fas fa-user-clock"></i>
                                    </div>
                                    <div class="link-name">
                                        HR
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== CRM ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-crm')">
                                <router-link class="icon-model crm" :to="{name: 'crm-model'}">
                                    <div class="icon">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <div class="link-name">
                                        CRM
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== accounting ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-accounting')">
                                <router-link class="icon-model accounting" :to="{name: 'accounting-model'}">
                                    <div class="icon">
                                        <i class="fas fa-calculator"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.accounting') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== projects_management ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-projects-management')">
                                <router-link class="icon-model projects_management" :to="{name: 'projects_management-model'}">
                                    <div class="icon">
                                        <i class="fas fa-tasks"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.projects_management') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== designs ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-designs')">
                                <router-link class="icon-model designs" :to="{name: 'designs-model'}">
                                    <div class="icon">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.designs') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== marketing ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-marketing')">
                                <router-link class="icon-model marketing" :to="{name: 'marketing-model'}">
                                    <div class="icon">
                                        <i class="fas fa-paint-brush"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.marketing') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== documents ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-documents')">
                                <router-link class="icon-model documents" :to="{name: 'documents-model'}">
                                    <div class="icon">
                                        <i class="fas fa-file-alt"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.documents') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== plans ===================== -->
                            <!-- <div class="wrapper-icon-model" v-if="$can('show-module-plans')">
                                <router-link class="icon-model plans" :to="{name: 'plans-model'}">
                                    <div class="icon">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.plans') }}
                                    </div>
                                </router-link>
                            </div> -->
                            <!-- ./icon-model -->

                            <!-- =================== notes ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-notes')">
                                <router-link class="icon-model notes" :to="{name: 'notes-model'}">
                                    <div class="icon">
                                        <i class="fas fa-lightbulb"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.notes') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== website ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-cp-website')">
                                <router-link class="icon-model website" :to="{name: 'website-model'}">
                                    <div class="icon">
                                        <i class="fas fa-globe-africa"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.website') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== web_development ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-web-development')">
                                <router-link class="icon-model web_development" :to="{name: 'web_development-model'}">
                                    <div class="icon">
                                        <i class="fas fa-code"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.web_development') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== calendar ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-calendar')">
                                <router-link class="icon-model calendar" :to="{name: 'calendar-model'}">
                                    <div class="icon">
                                        <i class="fas fa-calendar-alt"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.calendar') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->

                            <!-- =================== Settings ===================== -->
                            <div class="wrapper-icon-model" v-if="$can('show-module-settings')">
                                <router-link class="icon-model settings" :to="{name: 'settings-model'}">
                                    <div class="icon">
                                        <i class="fas fa-cog"></i>
                                    </div>
                                    <div class="link-name">
                                        {{ $t('sidebar.settings') }}
                                    </div>
                                </router-link>
                            </div>
                            <!-- ./icon-model -->


                        </div><!--/. container-fluid -->
                    </div>
                </section>

        </div>
        <!-- /.content-wrapper -->


    </div>
</template>


<script>
export default {
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.dashboard')
        })
    }
}
</script>
