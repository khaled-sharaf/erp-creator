<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'crm-model'}" class="nav-link link-model" v-text="$t('sidebar.crm')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-leads')">
                    <router-link :to="{name: 'leads'}" class="nav-link">{{ $t('sidebar.leads') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-quotations')">
                    <router-link :to="{name: 'quotations'}" class="nav-link">{{ $t('sidebar.quotations') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-meetings')">
                    <router-link :to="{name: 'meetings'}" class="nav-link">{{ $t('sidebar.meetings') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-lead_contracts')">
                    <router-link :to="{name: 'lead_contracts'}" class="nav-link">{{ $t('sidebar.lead_contracts') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-clients')">
                    <router-link :to="{name: 'clients'}" class="nav-link">{{ $t('sidebar.clients') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('index-services')">
                    <router-link :to="{name: 'services'}" class="nav-link">{{ $t('sidebar.services') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('reports-crm')">
                    <router-link :to="{name: 'crm_reports'}" class="nav-link">{{ $t('sidebar.reports') }}</router-link>
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
    watch: {
        "$route.name"(newVal) {
            if (newVal === 'crm-model') {
                this.$router.push({name: 'crm_reports'})
            }
        }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.crm')
            if (to.name === 'crm-model') {
                vm.$router.push({name: 'crm_reports'})
            }
        })
    }
}
</script>

