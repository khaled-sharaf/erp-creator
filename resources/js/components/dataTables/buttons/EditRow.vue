<template>
        <!-- :href="`${$domain_admin}/${modelName}/${model.id}/edit`" -->
    <router-link
        v-show="model.deleted_at == null"
        :to="{name: `${modelName}-edit`, params: {id: model.id}}"
        :class="['btn btn-primary btn-edit-row btn-table-actions btn-sm', classes, {'link-router-in-table': inTable}]"
        :data-name='inTable ? `${modelName}-edit`: ""'
        :data-params='inTable ? `{"id": ${model.id}}`: ""'
    >
        <!-- :data-params='inTable ? `{"${[modelName]}": ${JSON.stringify(model)}, "id": ${model.id}}`: ""' -->
        <slot></slot>
        {{ text != null ? text : $t('global.edit') }}
        <i class="fas fa-edit"></i>
    </router-link>
</template>

<script>
    export default {
        props: {
            model: Object,
            modelName: String,
            text: String,
            classes: String,
            inTable: {
                type: Boolean,
                default: true
            }
        }
    }
</script>
