<template>
    <span v-if="model != null">
        <router-link
            class="link-router-in-table"
            :to="{name: `${modelName}`, params: {id: model.id}}"
            :data-name="`${modelName}`"
            :data-params='`{"id": ${model.id}}`'
        >
            {{ model.name | capitalize }}
        </router-link>
    </span>
</template>

<script>
    export default {
        props: ['model', 'modelName']
    }
</script>
