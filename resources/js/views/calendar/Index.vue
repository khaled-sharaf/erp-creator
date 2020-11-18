<template>
    <div>
         <!-- Navbar -->
        <navbar>
            <template v-slot:link-model>
                <li class="nav-item">
                    <span class="nav-link link-model" v-text="$t('sidebar.calendar')"></span>
                </li>
            </template>

            <template v-slot:links>
                <li class="nav-item">
                    <router-link :to="{name: 'agenda'}" class="nav-link active router-link-active">{{$t('sidebar.agenda')}}</router-link>
                </li>

                <!-- <li class="nav-item">
                    <router-link :to="{name: 'calendar'}" class="nav-link">Calendar</router-link>
                </li> -->

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
          if (newVal === 'calendar-model') {
              this.$router.push({name: 'agenda'})
          }
      }
    },

    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.calendar')
            if (to.name === 'calendar-model') {
                vm.$router.push({name: 'agenda'})
            }
        })


        next(vm => {
            to.meta.title = vm.$t('sidebar.web_development')
        })
    }
}
</script>

