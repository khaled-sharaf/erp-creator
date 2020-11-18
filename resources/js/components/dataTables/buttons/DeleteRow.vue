<template>
    <a
        v-show="model.deleted_at == null"
        :href="`${$domain_admin + modelName}/destroy`"
        :class="['btn btn-danger btn-delete-row btn-table-actions btn-sm', classes]"
        @click.prevent="$emit('destroyRow')"
    >
        <slot></slot>
        {{ $t('global.delete') }}
        <i class="fas fa-trash"></i>
    </a>
</template>

<script>
    export default {
        props: ['model', 'modelName', 'classes']
    }
</script>
