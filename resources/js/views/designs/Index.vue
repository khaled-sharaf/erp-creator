<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'designs-model'}" class="nav-link link-model" v-text="$t('sidebar.designs')"></router-link>
                </li>
            </template>

            <template v-slot:links>

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'logos'}" class="nav-link">{{ $t('sidebar.logos') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'social-media'}" class="nav-link">{{ $t('sidebar.social_media_designs') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'printing'}" class="nav-link">{{ $t('sidebar.printing_designs') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'home'}" class="nav-link">{{ $t('sidebar.reports') }}</router-link>
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
                logos: 0,
                requests: 33,
                vacations: 20,
                contracts: 30
            },
            urlGetCounts: '/designs-models-counts'
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
            if (newVal === 'designs-model') {
                this.$router.push({name: 'logos'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.designs')
            if (to.name === 'designs-model') {
                vm.$router.push({name: 'logos'})
            }
            // vm.getCountsAllModels()
        })
    }
}
</script>

