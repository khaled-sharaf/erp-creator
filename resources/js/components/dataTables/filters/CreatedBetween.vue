<template>
    <!-- Created Between -->
    <div class="box-filter">
        <div class="filter-title">
            <i class="fas fa-clock text-info"></i>
            {{ $t('datatable.created_between') }}
        </div>
        <div class="content-filter">
            <span class="input-date">
                <date-picker
                        v-model="tableData.from_date"
                        type="date"
                        value-type="format"
                        format="YYYY-MM-DD"
                        :placeholder="$t('global.from')"
                        :lang="$langDatePicker"
                    ></date-picker>
            </span>
            <span class="input-date">
                <date-picker
                    v-model="tableData.to_date"
                    type="date"
                    value-type="format"
                    format="YYYY-MM-DD"
                    :placeholder="$t('global.to')"
                    :lang="$langDatePicker"
                ></date-picker>
            </span>
        </div>
    </div>

    <!-- ./box-->
    <!-- </div> -->
</template>





<script>
export default {
    props: [
        "tableData"
    ],
}
</script>

