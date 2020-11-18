<template>
    <!-- Display -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-eye text-primary"></i>
            {{ $t('datatable.display') }}
        </div>
        <div class="content-filter">
            <span
                class="btn-filter"
                :class="tableData.display == '1' ? 'active' : ''"
                @click="tableData.display = '1'; getData();"
                v-text="$t('datatable.show')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.display == '0' ? 'active' : ''"
                @click="tableData.display = '0'; getData();"
                v-text="$t('datatable.hide')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.display == '' ? 'active' : ''"
                @click="tableData.display = ''; getData();"
                v-text="$t('datatable.all')"
            >
            </span>
        </div>
    </div>
    <!-- ./box-->
</template>





<script>
export default {
    props: [
    "tableData",
    'getData'
  ],
}
</script>

