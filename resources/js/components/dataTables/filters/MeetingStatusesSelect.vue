<template>
    <!-- Rules -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-walking text-warning"></i>
            {{ $t('meetings_table.status') }}
        </div>
        <div class="content-filter">
            <select class="custom-select custom-select-sm dataTable-filter-select" v-model="tableData.status" @change="getData()">
                <option value="">{{$t('global.all')}}</option>
                <option value="none">{{$t('global.none_status')}}</option>
                <option
                    v-for="status in meeting_statuses"
                    :key="status.value"
                    v-text="status.label"
                    :value="status.value">
                </option>
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
          meeting_statuses: [
              {label: 'Done', value: 'done'},
              {label: 'Next meeting', value: 'next_meeting'},
              {label: 'Project delay', value: 'project_delay'},
              {label: 'Refused offer', value: 'refused_offer'},
              {label: 'Rejected', value: 'rejected'},
          ]
      }
  }
}
</script>

