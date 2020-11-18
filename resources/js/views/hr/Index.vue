<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'hr-model'}" class="nav-link link-model" v-text="$t('sidebar.hr')"></router-link>
                </li>
            </template>

            <template v-slot:links>

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-users')">
                    <router-link :to="{name: 'users'}" class="nav-link">{{ $t('sidebar.users') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-departments')">
                    <router-link :to="{name: 'departments'}" class="nav-link">{{ $t('sidebar.departments') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'requests'}" class="nav-link">{{ $t('sidebar.requests') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'attendances'}" class="nav-link">{{ $t('sidebar.attendances') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'vacations'}" class="nav-link">{{ $t('sidebar.vacations') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'evaluations'}" class="nav-link">{{ $t('sidebar.evaluations') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'payroll'}" class="nav-link">{{ $t('sidebar.payroll') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-roles')">
                    <router-link :to="{name: 'roles'}" class="nav-link">{{ $t('sidebar.roles') }}</router-link>
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
            counts: {
                users: 0,
                departments: 100,
                requests: 33,
                vacations: 20,
                contracts: 30
            },
            urlGetCounts: '/hr-models-counts'
        }
    },
    methods: {
        getCountsAllModels() {
            axios.get(this.urlGetCounts).then(response => {
                const data = response.data

                if (typeof data === 'object') {
                    if (response.status === 200) {
                        this.counts = response.data.counts
                    }
                } else {
                    setTimeout(() => {
                        this.getCountsAllModels()
                    }, 500)
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getCountsAllModels()
                }, 500)
            });
        }
    },

    watch: {
        "$route.name"(newVal) {
            if (newVal === 'hr-model') {
                this.$router.push({name: 'users'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.hr')
            if (to.name === 'hr-model') {
                vm.$router.push({name: 'users'})
            }
            // vm.getCountsAllModels()
        })
    }
}
</script>

