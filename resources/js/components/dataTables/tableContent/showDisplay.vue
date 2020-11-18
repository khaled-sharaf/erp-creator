<template>
    <span>
        <span class="icon-info" v-if="model.display == 1">
            <i class="fas fa-eye"></i>
        </span>
        <span class="icon-warning" v-if="model.display == 0">
            <i class="fas fa-eye-slash"></i>
        </span>
    </span>
</template>


<<script>
    export default {
        props: ['model']
    }
</script>
