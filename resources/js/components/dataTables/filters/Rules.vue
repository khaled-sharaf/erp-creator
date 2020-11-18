<template>
    <!-- Rules -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-key text-info"></i>
            {{ $t('datatable.rules') }}
        </div>
        <div class="content-filter">
            <span
                class="btn-filter"
                :class="tableData.rule == '1' ? 'active' : ''"
                @click="tableData.rule = '1'; getData();"
                v-text="$t('datatable.rules_filter.super_admin')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.rule == '2' ? 'active' : ''"
                @click="tableData.rule = '2'; getData();"
                v-text="$t('datatable.rules_filter.admin')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.rule == '0' ? 'active' : ''"
                @click="tableData.rule = '0'; getData();"
                v-text="$t('datatable.rules_filter.user')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.rule == '' ? 'active' : ''"
                @click="tableData.rule = ''; getData();"
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
    'tableData',
    'getData'
  ],
}
</script>

