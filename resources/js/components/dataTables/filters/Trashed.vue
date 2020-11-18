<template>
    <!-- trashed -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-trash text-danger"></i>
            {{ $t('datatable.trash') }}
        </div>
        <div class="content-filter">
            <span
                class="btn-filter"
                :class="tableData.trashed == '1' ? 'active' : ''"
                @click="tableData.trashed = '1'; getData();"
                v-text="$t('datatable.not_trashed')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.trashed == '0' ? 'active' : ''"
                @click="tableData.trashed = '0'; getData();"
                v-text="$t('datatable.trashed')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.trashed == '2' ? 'active' : ''"
                @click="tableData.trashed = '2'; getData();"
                v-text="$t('datatable.all')"
            >
            </span>
        </div>
    </div>

</template>





<script>
export default {
    props: [
    'tableData',
    'getData'
  ],
}
</script>

