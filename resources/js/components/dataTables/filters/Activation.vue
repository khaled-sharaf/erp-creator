<template>
    <!-- Activation -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-check text-success"></i>
            {{ $t('datatable.activation') }}
        </div>
        <div class="content-filter">
            <span
                class="btn-filter"
                :class="tableData.active == '1' ? 'active' : ''"
                @click="tableData.active = '1'; getData();"
                v-text="$t('datatable.active')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.active == '0' ? 'active' : ''"
                @click="tableData.active = '0'; getData();"
                v-text="$t('datatable.not_active')"
            >
            </span>
            <span
                class="btn-filter"
                :class="tableData.active == '' ? 'active' : ''"
                @click="tableData.active = ''; getData();"
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

