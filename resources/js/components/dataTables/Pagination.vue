<template>
  <div class="dataTables_pagination_inner" v-if="pagination.total > 0">
      <div class="dataTables_paginate">
        <paginate
            v-if="pagination.path != ''"
            v-model="pagination.currentPage"
            :page-count="Math.ceil(pagination.total / pagination.perPage)"
            :click-handler="gotopage"
            :next-text="`<i class='fas fa-angle-right'></i>`"
            :prev-text="`<i class='fas fa-angle-left'></i>`"
            :container-class="'pagination'"
            :page-class="'page-item'"
            :next-class="'next-item'"
            :prev-class="'prev-item'"
            :break-view-class="'break-view-class'"
            :disabled-class="'disabled-item'"
        >
            <!-- :hide-prev-next="true" -->
        </paginate>
    </div>

    <div class="dataTables_info">
        <span class="from">{{ pagination.from }}</span> -
        <span class="to">{{ pagination.to }}</span> /
        <span class="total">{{ pagination.total }}</span>
    </div>

  </div>
</template>


<script>

export default {
    props: ['pagination', 'getData'],
    methods: {
        gotopage(numPage) {
            this.getData(this.pagination.path + '?page=' + numPage)
        }
    },
}
</script>

