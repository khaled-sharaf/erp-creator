<template>
    <a
        v-show="model.deleted_at != null"
        :href="`${$domain_admin + modelName}/force-delete`"
        class="btn btn-danger btn-delete-row force-delete btn-table-actions btn-sm"
        @click.prevent="$emit('forceDeleteRow')"
    >
        {{ $t('global.force_delete') }}
        <i class="far fa-trash-alt"></i>
    </a>
</template>

<script>
    export default {
        props: ['model', 'modelName']
    }
</script>
