<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'projects_management-model'}" class="nav-link link-model" v-text="$t('sidebar.projects')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-projects')">
                    <router-link :to="{name: 'projects'}" class="nav-link">{{ $t('global.n_all') + ' ' + $t('sidebar.projects') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'home'}" class="nav-link">{{ $t('sidebar.tasks') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('edit-platforms')">
                    <router-link :to="{name: 'platforms'}" class="nav-link">{{ $t('sidebar.platforms') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('reports-projects-management')">
                    <router-link :to="{name: 'reports-projects-management'}" class="nav-link">{{ $t('sidebar.reports') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->
            </template>
        </navbar>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <router-view/>
        </div>

    </div>
</template>


<script>
export default {
    data() {
        return {

        }
    },
    methods: {

    },

    watch: {
        "$route.name"(newVal) {
            if (newVal === 'projects_management-model') {
                this.$router.push({name: 'projects'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.projects_management')
            if (to.name === 'projects_management-model') {
                vm.$router.push({name: 'projects'})
            }
        })
    }
}
</script>

