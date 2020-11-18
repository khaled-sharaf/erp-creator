<template>
    <router-link
        v-show="model.deleted_at == null"
        :to="{name: `${modelName}-profile`, params: {id: model.id}}"
        class="btn btn-dark btn-show-profile btn-table-actions btn-sm link-router-in-table"
        :data-name="`${modelName}-profile`"
        :data-params='`{"id": ${model.id}}`'
    >
        {{ text != null ? text : $t('global.view') }}
        <i class="fas fa-eye"></i>
    </router-link>
</template>

<script>
    export default {
        props: ['model', 'modelName', 'text']
    }
</script>
