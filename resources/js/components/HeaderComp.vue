<template>
    <div class="header-comp">
        <div class="breadcrumb-wrapper">
            <nav aria-label="breadcrumb" v-if="breadcrumb.length">
                <ol class="breadcrumb">
                    <li
                        v-for="(link, index) in breadcrumb"
                        :key="index"
                        class="breadcrumb-item"
                        :class="{active: link.active}"
                        >
                        <router-link
                            v-if="!link.active"
                            :to="link.to"
                            v-text="link.label"
                        ></router-link>
                        <span v-else v-text="link.label"></span>
                    </li>
                </ol>
            </nav>
        </div><!-- /.col -->

        <div class="btns">
            <slot name="btns"></slot>
            <router-link
                class="btn btn-create-new"
                v-if="Object.keys(btnCreate).length && (typeof btnCreate.viewIf === 'undefined' ? true : btnCreate.viewIf)"
                :to="btnCreate.to || ''"
            >
                {{ btnCreate.label }}
                <i class="fas fa-plus"></i>
            </router-link>
            <button
                class="btn btn-create-new"
                v-if="Object.keys(btnModal).length && (typeof btnModal.viewIf === 'undefined' ? true : btnModal.viewIf)"
                data-toggle="modal" type="button" :data-target="btnModal.targetModal || ''"
            >
                {{ btnModal.label }}
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        breadcrumb: {
            type: Array,
            default: []
        },
        btnCreate: {
            type: Object,
            default: function () {
                return {}
            }
        },
        btnModal: {
            type: Object,
            default: function () {
                return {}
            }
        },
        modelTrigger: {
            type: String,
            default: ''
        },
    },
    data() {
        return {
        }
    },
}
</script>

