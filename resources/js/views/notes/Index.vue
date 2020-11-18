<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'notes-model'}" class="nav-link link-model" v-text="$t('sidebar.notes')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'todos'}" class="nav-link">{{ $t('sidebar.todos') }}</router-link>
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
            if (newVal === 'notes-model') {
                this.$router.push({name: 'todos'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.notes')
            if (to.name === 'notes-model') {
                vm.$router.push({name: 'todos'})
            }
        })
    }
}
</script>

