<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <router-link :to="{name: 'web_development-model'}" class="nav-link link-model" v-text="$t('sidebar.web_development')"></router-link>
                </li>
            </template>

            <template v-slot:links>

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'websites'}" class="nav-link">{{ $t('sidebar.websites') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'hostings'}" class="nav-link">{{ $t('sidebar.hostings') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'domains'}" class="nav-link">{{ $t('sidebar.domains') }}</router-link>
                </li>
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <!-- <li class="nav-item">
                    <router-link :to="{name: 'home'}" class="nav-link">{{ $t('sidebar.informations') }}</router-link>
                </li> -->
                <!-- ./nav item ============================================ -->

                <!-- nav item -->
                <li class="nav-item">
                    <router-link :to="{name: 'web_reports'}" class="nav-link">{{ $t('sidebar.reports') }}</router-link>
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
          if (newVal === 'web_development-model') {
              this.$router.push({name: 'websites'})
          }
      }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.web_development')
            if (to.name === 'web_development-model') {
                vm.$router.push({name: 'websites'})
            }
        })


        next(vm => {
            to.meta.title = vm.$t('sidebar.web_development')
        })
    }
}
</script>

