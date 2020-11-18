<template>
    <button
        type="submit"
        :disabled="form.busy"
        class="btn btn-success btn-sm float-right">
        {{ text && text != null ? text : $t('global.update') }}
        
        <span v-if="form.busy" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
    </button>
</template>


<script>
    export default {
        props: ['form', 'text']
    }
</script>

