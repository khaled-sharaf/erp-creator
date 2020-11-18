<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'accounting-model'}" class="nav-link link-model" v-text="$t('sidebar.accounting')"></router-link>
                </li>
            </template>

            <template v-slot:links>
                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'contracts'}" class="nav-link">{{ $t('sidebar.lead_contracts') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link"
                        :class="{active: $route.name === 'banks' || $route.name === 'cashs' || $route.name === 'partners'}"
                        data-toggle="dropdown"
                        href="javaScript:void(0)"
                        aria-expanded="true">
                        {{ $t('sidebar.accounts') }}
                    </a>
                    <div class="dropdown-menu links-dropdown-menu">
                        <router-link class="dropdown-item" :to="{name: 'banks'}">{{ $t('sidebar.banks') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'cashs'}">{{ $t('sidebar.cashs') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'partners'}">{{ $t('sidebar.partners') }}</router-link>
                    </div>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item dropdown">
                    <a
                        class="nav-link"
                        :class="{active: $route.name === 'sales' ||
                                         $route.name === 'sales_returns' ||
                                         $route.name === 'purchases' ||
                                         $route.name === 'purchase_returns' ||
                                         $route.name === 'expenses' ||
                                         $route.name === 'supplier_reports' ||
                                         $route.name === 'client_reports' ||
                                         $route.name === 'fixed_assets'
                        }"
                        data-toggle="dropdown"
                        href="javaScript:void(0)"
                        aria-expanded="true">
                        {{ $t('sidebar.payments') }}
                    </a>
                    <div class="dropdown-menu links-dropdown-menu">
                        <router-link class="dropdown-item" :to="{name: 'sales'}">{{ $t('sidebar.sales') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'sales_returns'}">{{ $t('sidebar.sales_returns') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'purchases'}">{{ $t('sidebar.purchases') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'purchase_returns'}">{{ $t('sidebar.purchase_returns') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'supplier_reports'}">{{ $t('sidebar.supplier_reports') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'client_reports'}">{{ $t('sidebar.client_reports') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'expenses'}">{{ $t('sidebar.expenses') }}</router-link>
                        <router-link class="dropdown-item" :to="{name: 'fixed_assets'}">{{ $t('sidebar.fixed_assets') }}</router-link>
                    </div>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'suppliers'}" class="nav-link">{{ $t('sidebar.suppliers') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'purchase_orders'}" class="nav-link">{{ $t('sidebar.purchase_orders') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'income_list'}" class="nav-link">{{ $t('sidebar.income_list') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'budget'}" class="nav-link">{{ $t('sidebar.budget') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'taxes'}" class="nav-link">{{ $t('sidebar.taxes') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item" v-if="$can('reports-accounting')">
                    <router-link :to="{name: 'contracts'}" class="nav-link">{{ $t('sidebar.reports') }}</router-link>
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
    watch: {
        "$route.name"(newVal) {
            if (newVal === 'accounting-model') {
                this.$router.push({name: 'contracts'})
            }
        }
    },
    methods: {

    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.accounting')
            if (to.name === 'accounting-model') {
                vm.$router.push({name: 'contracts'})
            }
        })
    }
}
</script>

