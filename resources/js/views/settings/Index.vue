<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'settings-model'}" class="nav-link link-model" v-text="$t('sidebar.settings')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <li class="nav-item" v-if="$can('index-general-settings')">
                    <router-link :to="{name: 'general-settings'}" class="nav-link">{{ $t('sidebar.general-settings') }}</router-link>
                </li>
                <li class="nav-item" v-if="$can('edit-lead-statuses')">
                    <router-link :to="{name: 'lead-statuses'}" class="nav-link">{{ $t('sidebar.lead_statuses') }}</router-link>
                </li>
                <li class="nav-item" v-if="$can('edit-sales-commissions')">
                    <router-link :to="{name: 'sales-commissions'}" class="nav-link">{{ $t('sidebar.sales_commissions') }}</router-link>
                </li>
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
    watch: {
        "$route.name"(newVal) {
            if (newVal === 'settings-model') {
                this.$router.push({name: 'general-settings'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            if (to.name === 'settings-model') {
                vm.$router.push({name: 'general-settings'})
            }
            to.meta.title = vm.$t('sidebar.settings')
        })
    }
}
</script>

