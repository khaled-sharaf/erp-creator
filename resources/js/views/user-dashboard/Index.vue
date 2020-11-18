<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'user-dashboard-model'}" class="nav-link link-model">
                        {{ $t('sidebar.dashboard') }}
                    </router-link>
                </li>
            </template>

            <template v-slot:links>
            </template>
        </navbar>
        <!-- /.navbar -->

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <h2>Dashboard Test</h2>
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
            to.meta.title = vm.$t('sidebar.dashboard')
        })
    }
}
</script>

