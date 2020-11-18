<template>
    <date-picker
        v-model="tableData.range"
        lang="eng"
        :range='true'
        type="date"
        :formate="format"
        :confirm="true"
        v-on:confirm="getData()"
        popup-class	="my-2"
    >
    </date-picker>
</template>

<script>
    import DatePicker from 'vue2-datepicker';
    export default {
        props: [
            'tableData',
            'getData',
            'columns'
        ],
        components: { DatePicker },
        data:()=>({
            range: '',
            format: 'YYYY-MM-DD',
        }),
        methods: {
            dateFormat(classes, date){
                console.log(date);

                return classes
            }
        }
    }
</script>
<style lang="scss" scoped>
    .mx-datepicker.mx-datepicker-range{
        margin: 1em 0;
    }
</style>