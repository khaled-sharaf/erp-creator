<template>
    <!-- Rules -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-walking text-warning"></i>
            {{ $t('leads_table.lead_status_id') }}
        </div>
        <div class="content-filter">
            <select class="custom-select custom-select-sm dataTable-filter-select" v-model="tableData.lead_status_id" @change="getData()">
                <option value="">{{$t('global.all')}}</option>
                <option value="none">{{$t('global.none_status')}}</option>
                <option 
                    v-for="status in lead_statuses"
                    :value="status.id"
                    :key="status.id"
                    v-text="status.name"
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
    'getData',
    'lead_statuses'
  ],
  data() {
    return {
    //   lead_statuses: [],
    }
  },

  mounted() {
    // $getLeadStatuses().then(statuses => {
    //     this.lead_statuses = statuses
    // })
  }
}
</script>

