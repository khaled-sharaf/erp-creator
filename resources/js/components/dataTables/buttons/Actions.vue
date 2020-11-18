<template>
    <div class="menu-actions">
		<div class="dropdown">
            <button
                class="btn btn-secondary btn-sm btn-table-actions dropdown-toggle"
                :class="classes"
                type="button"
                :id="'dropdownMenuButton-' + _uid"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
                v-text="$t('global.actions')"
            ></button>

            <div class="dropdown-menu" :aria-labelledby="'dropdownMenuButton-' + _uid">

                <slot name="start-btns"></slot>

                <!-- view profile -->
                <router-link
                    v-if="model.deleted_at == null && showButton(allows.viewModel) && $can('profile-' + modelName)"
                    :class="classesButton(allows.viewModel)"
                    class="dropdown-item link-router-in-table"
                    :to="{name: `${modelName}-profile`, params: {id: model.id}}"
                    :data-name="`${modelName}-profile`"
                    :data-params='`{"id": ${model.id}}`'
                >
                    <i class="fas fa-eye"></i>
                    {{ textButton(allows.viewModel) ? textButton(allows.viewModel) : $t('global.view_profile') }}
                </router-link>
                <!-- ./view profile -->
                <!-- =============================================================== -->

                <!-- edit model -->
                <router-link
                    v-if="model.deleted_at == null && showButton(allows.editModel) && $can('edit-' + modelName)"
                    :class="classesButton(allows.editModel)"
                    class="dropdown-item link-router-in-table text-primary"
                    :to="{name: `${modelName}-edit`, params: {id: model.id}}"
                    :data-name="`${modelName}-edit`"
                    :data-params='`{"id": ${model.id}}`'
                >
                    <i class="fas fa-edit"></i>
                    {{ textButton(allows.editModel) ? textButton(allows.editModel) : $t('global.edit') }}
                </router-link>
                <!-- ./edit model -->
                <!-- =============================================================== -->

                <slot name="before-delete"></slot>

                <!-- delete model -->
                <a
                    v-if="model.deleted_at == null && showButton(allows.deleteModel) && $can('delete-' + modelName)"
                    :class="classesButton(allows.deleteModel)"
                    class="dropdown-item btn-delete-row text-danger"
                    :href="`${$domain_admin + modelName}/destroy`"
                    @click.prevent="$emit('destroyRow')"
                >
                    <i class="fas fa-trash"></i>
                    {{ textButton(allows.deleteModel) ? textButton(allows.deleteModel) : $t('global.delete') }}
                </a>
                <!-- ./delete model -->
                <!-- =============================================================== -->

                <!-- restore model -->
                <a
                    v-if="model.deleted_at != null && showButton(allows.restoreModel) && $can('restore-' + modelName)"
                    :class="classesButton(allows.restoreModel)"
                    class="dropdown-item btn-restore-row text-success"
                    :href="`${$domain_admin + modelName}/restore`"
                    @click.prevent="$emit('restoreRow')"
                >
                    <i class="fas fa-undo-alt"></i>
                    {{ textButton(allows.restoreModel) ? textButton(allows.restoreModel) : $t('global.restore') }}
                </a>
                <!-- ./restore model -->
                <!-- =============================================================== -->

                <!-- force delete model -->
                <a
                    v-if="model.deleted_at != null && showButton(allows.forceDeleteModel) && $can('force-delete-' + modelName)"
                    :class="classesButton(allows.forceDeleteModel)"
                    class="dropdown-item btn-delete-row force-delete text-danger"
                    :href="`${$domain_admin + modelName}/force-delete`"
                    @click.prevent="$emit('forceDeleteRow')"
                >
                    <i class="fas fa-trash-alt"></i>
                    {{ textButton(allows.forceDeleteModel) ? textButton(allows.forceDeleteModel) : $t('global.force_delete') }}
                </a>
                <!-- ./force delete model -->
                <!-- =============================================================== -->


                <slot name="end-btns"></slot>


                <!-- more buttons -->
                <!-- link -->
                <router-link
                    v-for="(button, index) in moreButtons"
                    :key="index"
                    v-if="(typeof button.viewIf === 'undefined' ? true : button.viewIf) && typeof button.to !== 'undefined' && typeof button.onClick === 'undefined'"
                    v-show="typeof button.showIf === 'undefined' ? true : button.showIf"
                    :class="button.classes"
                    :to="button.to"
                    class="dropdown-item"
                >
                    <span v-text="button.text ? button.text : $t('global.button') + ' ' + (index + 1)"></span>
                    <span v-html="button.icon ? button.icon : ''"></span>
                </router-link>

                <!-- action -->
                <a
                    v-for="(button, index) in moreButtons"
                    :key="index"
                    href="javascript:void(0)"
                    v-if="(typeof button.viewIf === 'undefined' ? true : button.viewIf) && typeof button.to === 'undefined' && typeof button.onClick === 'function'"
                    v-show="typeof button.showIf === 'undefined' ? true : button.showIf"
                    :class="button.classes"
                    class="dropdown-item"
                    @click="button.onClick()"
                >
                    <span v-text="button.text ? button.text : $t('global.button') + ' ' + (index + 1)"></span>
                    <span v-html="button.icon ? button.icon : ''"></span>
                </a>

                <!-- ./more buttons -->

                <slot name="after-more-buttons"></slot>

            </div>
        </div>
    </div>

</template>

<script>
    export default {
        props: {
            model: {
                type: Object,
            },
            modelName: {
                type: String,
            },
            classes: String || Object || Array,
            allows: {
                type: Object,
                default() {
                    return {
                        viewModel: true,
                        editModel: true,
                        deleteModel: true,
                        forceDeleteModel: true,
                        restoreModel: true,
                    }
                }
            },
            moreButtons: Array,
            // moreButtons: [
            //     {
            //         viewIf: true,
            //         showIf: false,
            //         classes: 'text-white bg-info',
            //         text: 'add new item',
            //         icon: '<i class="fas fa-edit"></i>',
            //         to: {name: 'home'}
            //         onClick() {
            //         }
            //     },
            // ]
        },

        data() {
            return {
            }
        },

        methods: {
            showButton(objectButton) {
                if (this.model != null &&  (objectButton === false || objectButton === null))
                    return false
                return true
            },

            classesButton(objectButton) {
                if (this.showButton(objectButton)) {
                    if (typeof objectButton === 'object') {
                        if (objectButton.classes) {
                            if (typeof objectButton.classes === 'object') {
                                return objectButton.classes
                            } else if (typeof objectButton.classes === 'string') {
                                return objectButton.classes.split(' ')
                            }
                        }
                    }
                }
                return []
            },

            textButton(objectButton) {
                if (this.showButton(objectButton)) {
                    if (typeof objectButton === 'object') {
                        if (objectButton.text) {
                            if (typeof objectButton.text === 'string') {
                                return objectButton.text
                            }
                        }
                    } else if (typeof objectButton === 'string') {
                        return objectButton
                    }
                }
                return false
            },
        },
    }
</script>


<style lang="scss" scoped>
    .menu-actions {
        display: inline-block;
        .dropdown {
            .dropdown-menu {
                .dropdown-item {
                    &:hover, &:focus {
                        background-color: #EEE;
                    }
                    &:active, &.active {
                        background-color: #DDD;
                        color: #333;
                    }
                }
            }
        }
    }
</style>