<template>
    <div class="btn-plus-global">
        <div class="inner-btn waves-effect waves-light" v-click-outside="hideMenuFn" @click="openMenu = !openMenu">
            <i class="fas fa-plus"></i>
        </div>
        <div class="menu-nav" :class="{'hide-menu': !openMenu}">
            <ul class="menu-nav-ul">
                <slot></slot>
            </ul>
        </div>
    </div>
</template>


<script>

export default {
    data() {
        return {
            openMenu: false
        }
    },

    methods: {
        hideMenuFn() {
            this.openMenu = false
        }
    },

    mounted() {
        // const self = this
        // $('.menu-nav-ul').on('click', 'li, li a', function () {
        //     self.openMenu = false
        // })
        // this.popupItem = this.$el
    }
}
</script>



