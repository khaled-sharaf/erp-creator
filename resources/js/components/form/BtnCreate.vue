<template>
    <button
        type="submit"
        :disabled="form.busy"
        @click="submit"
        class="btn btn-primary btn-sm float-right"
        :class="{'btn-info mx-3': createType && createType === 'again'}"
        >
        {{ createType && createType === 'again' ? 
            (text && text != null ? text : $t('global.create_again')) :
            (text && text != null ? text : $t('global.create'))
        }}
        <span v-if="form.busy" class="btn-loader"><img :src="$domain + 'admin/images/btn-loader.gif'"></span>
    </button>
</template>


<script>
    export default {
        props: ['form', 'text', 'createType'],
        methods: {
            submit() {
                this.form.create_again = this.createType && this.createType === 'again'
            }
        },
    }
</script>

