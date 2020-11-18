<template>
    <!-- Rules -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="far fa-plus-square text-info"></i>
            {{ $t('leads_table.created_by') }}
        </div>
        <div class="content-filter">
            <select class="custom-select custom-select-sm dataTable-filter-select" v-model="tableData.created_by" @change="getData()">
                <option value="">{{$t('global.all')}}</option>
                <option 
                    v-for="user in users"
                    :value="user.id"
                    :key="user.id"
                    v-text="user.name"
                ></option>
            </select>
        </div>
    </div>
    <!-- ./box-->
</template>





<script>
export default {
    props: [
    'tableData',
    'getData'
  ],
  data() {
    return {
      users: []
    }
  },

  computed: {
    //   users() {
    //     const users = []
    //     this.dataTable.forEach(lead => {
    //         if (lead.created_by_user != null) {
    //             users.push(lead.created_by_user)
    //         }
    //     })
    //     return [...new Set(users.map(o => JSON.stringify(o)))].map(s => JSON.parse(s))
    //   }
  },



  mounted() {
    $getUsersSelect().then(users => {
        this.users = users
    })
  }
}
</script>

