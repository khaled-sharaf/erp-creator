<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'plans-model'}" class="nav-link link-model" v-text="$t('sidebar.plans')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'marketing_plan'}" class="nav-link">{{ $t('sidebar.marketing_plan') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'business_plan'}" class="nav-link">{{ $t('sidebar.business_plan') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'analysis'}" class="nav-link">{{ $t('sidebar.analysis') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'proposals'}" class="nav-link">{{ $t('sidebar.proposals') }}</router-link>
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

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.plans')
        })
    }
}
</script>

