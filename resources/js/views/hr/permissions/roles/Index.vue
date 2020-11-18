<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb" :btnCreate="btnCreate"></header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="wrapper-roles show-roles">
                            <div class="wrapper-role" v-for="(role, indexRole) in roles" :key="role.id">
                                <div class="role-header" @click.self="showRole(role)">
                                    <h5 class="name" @click="showRole(role)">
                                        {{ role.name | slug | capitalize }}
                                    </h5>
                                    <div class="actions">
                                        <button
                                            type="button"
                                            class="btn btn-primary btn-sm waves-effect"
                                            v-text="$t('sidebar.edit_role')"
                                            @click="showEditMode(role)"
                                            v-if="(!modeEdit || (modeEdit && roleActive != role.id)) && $can('edit-roles')"
                                        ></button>
                                        <button
                                            type="button"
                                            class="btn btn-secondary btn-sm waves-effect"
                                            v-text="$t('global.cancel')"
                                            @click="cancelEditMode(role)"
                                            v-if="modeEdit && roleActive == role.id"
                                        ></button>
                                        <button
                                            type="button"
                                            class="btn btn-success btn-sm waves-effect"
                                            v-text="$t('global.update')"
                                            @click="updateRole(role.id)"
                                            v-if="modeEdit && roleActive == role.id"
                                        ></button>
                                        <button
                                            type="button"
                                            class="btn btn-danger btn-sm waves-effect"
                                            v-text="$t('global.delete')"
                                            @click="deleteRole(role.id)"
                                            v-if="$can('delete-roles')"
                                        ></button>
                                    </div>
                                </div>
                                <vue-slide :active="roleActive == role.id" :duration="600" :use-hidden="true">
                                    <div class="inner-role">
                                        <div class="global-form-handel">
                                            <!-- role-name-edit -->
                                            <div class="role-name-edit row" v-if="modeEdit && roleForm.id == role.id">
                                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                                    <div class="form-group form-group-input">
                                                        <label>{{ $t('roles_table.name') }}</label>
                                                        <input
                                                            v-model="roleForm.name"
                                                            type="text"
                                                            class="form-control form-control-sm"
                                                            :class="{ 'is-invalid': roleForm.errors.has('name') }"
                                                        >
                                                        <has-error :form="roleForm" field="name"></has-error>
                                                    </div>
                                                </div>
                                                <!-- ================================================================= -->
                                                <!-- actions -->
                                                <div class="col-sm-6 col-lg-4 col-xl-3">
                                                    <div class="form-group form-group-input">
                                                        <label v-text="$t('global.actions')"></label>
                                                        <div>
                                                            <button type="button" class="btn btn-dark waves-effect btn-sm btn-toggle-all-permissions" v-text="$t('global.toggle')"></button>
                                                            <button type="button" class="btn btn-dark waves-effect btn-sm" v-text="$t('global.add_all')" @click="addAllPermisssions"></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- ./actions -->
                                                <!-- ================================================================= -->
                                            </div>
                                            <!-- ./role-name-edit -->
                                            <!-- =========================================================== -->
                                        </div>

                                        <div class="permissions" :class="{'wrapper-invalid': roleForm.errors.has('permissions') }">
                                            <div class="wrapper-group" v-for="(group, indexGroup) in groups" :key="group.id">
                                                <div class="group-header">
                                                    <div class="group-name">{{ group.name | slug | capitalize }}</div>
                                                    <div class="actions">
                                                        <button
                                                            type="button"
                                                            class="btn btn-dark waves-effect btn-sm btn-toggle-permissions-in-group"
                                                            v-text="$t('global.toggle')"
                                                            v-if="modeEdit && roleForm.id == role.id"
                                                        ></button>
                                                        <button
                                                            type="button"
                                                            class="btn btn-dark waves-effect btn-sm"
                                                            v-text="$t('global.add_all')"
                                                            @click="addAllPermisssionsInGroup(group.permissions)"
                                                            v-if="modeEdit && roleForm.id == role.id"
                                                        ></button>
                                                    </div>
                                                </div>
                                                <div class="inner-permission" v-for="(permission, indexPer) in group.permissions" :key="permission.id">
                                                    <div class="custom-control custom-switch">
                                                        <input
                                                            type="checkbox"
                                                            class="custom-control-input input-permission"
                                                            :disabled="!modeEdit || (modeEdit && roleForm.id != role.id)"
                                                            :id="'permission_' + indexRole + indexGroup + indexPer + permission.name"
                                                            :value="permission.name"
                                                            v-model="roleForm.permissions"
                                                            >
                                                        <label class="custom-control-label label-permission"  :for="'permission_' + indexRole + indexGroup + indexPer + permission.name">
                                                            {{ permission.name | slug | capitalize }}
                                                        </label>
                                                    </div>
                                                </div>
                                                <!-- ./inner-permission -->
                                            </div>
                                            <!-- ./wrapper-permission -->
                                        </div>
                                        <input
                                            type="hidden"
                                            class="form-control"
                                            :class="{ 'is-invalid': roleForm.errors.has('permissions') }"
                                        >
                                        <has-error :form="roleForm" field="permissions"></has-error>
                                        <!-- ./permissions -->

                                    </div>
                                </vue-slide>
                            </div>
                            <div class="alert alert-info" v-if="!roles.length" v-text="$t('messages.not_found_roles')"></div>
                        </div>
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- card -->
            </div>
            <!--/. container -->
        </section>
    </div>
</template>


<script>
import MixinChangeLocaleMessages from "./../../../../mixins/MixinChangeLocaleMessages"

export default {
    mixins: [
        MixinChangeLocaleMessages
    ],
    components: {

    },
    data() {
      return {
        urlModel: '/hr/roles',
        urlGetPermissions: '/hr/permissions',
        roles: [],
        groups: [],
        roleActive: '',
        modeEdit: false,
        roleForm: new Form({
            id: '',
            name: '',
            permissions: []
        }),
        idPage: 'roles',
        typePage: 'edit',
        breadcrumb: [],
        btnCreate: {}
      }
    },
    methods: {
        async getPermissions() {
            await axios.get(this.urlGetPermissions).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    if (typeof data === 'object') {
                        this.groups = data.data
                    } else {
                        setTimeout(() => {
                            this.getPermissions()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getPermissions()
                }, 500)
            })
        },
        getRoles() {
            axios.get(this.urlModel).then(response => {
                if (response.status === 200) {
                    const data = response.data
                    if (typeof data === 'object') {
                        this.roles = data.data
                    } else {
                        setTimeout(() => {
                            this.getRoles()
                        }, 500)
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getRoles()
                }, 500)
            })
        },
        showRole(role) {
            this.modeEdit = false
            if (this.roleActive == role.id) {
                this.roleActive = ''
            } else {
                this.roleActive = role.id
                this.roleForm.fill(role)
            }
        },
        showEditMode(role) {
            this.modeEdit = true
            this.roleForm.fill(role)
            this.roleActive = role.id
        },
        cancelEditMode(role) {
            this.roleForm.fill(role)
            this.modeEdit = false
        },
        updateRole(id) {
            loadReq(this.$Progress)
            this.roleForm.put(this.urlModel + '/' + id).then(response => {
                if (response.status === 200) {
                    let roles = response.data.data
                    this.roles = roles
                    let getCurrentRole = this.roles.find(role => role.id === id)
                    this.cancelEditMode(getCurrentRole)
                    ToastReq.fire({
                        text: this.success_msg
                    })
                }
            }).catch(response => {
                ToastFailed.fire({
                    title: this.failed_title + "!",
                    text: this.failed_msg,
                })
                this.$Progress.fail()
            });
        },
        deleteRole(id) {
            this.$destroyRow(id, this.urlModel).then(() => {
                this.roles = this.roles.filter(role => role.id != id)
            })
        },

        addAllPermisssions() {
            let permissions = []
            this.groups.forEach(group => {
                group.permissions.forEach(permission => {
                    permissions.push(permission.name)
                })
            })
            this.roleForm.permissions = permissions
        },
        addAllPermisssionsInGroup(permissionsGroup) {
            let oldPermissions = [...this.roleForm.permissions]
            permissionsGroup.forEach(permission => {
                if (oldPermissions.indexOf(permission.name) == -1) {
                    oldPermissions.push(permission.name)
                }
            })
            this.roleForm.permissions = oldPermissions
        },
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.roles'), active: true},
        ]
        this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_role'), to: {name: this.idPage + '-create'}, viewIf: $can('create-roles')}

        $('.show-roles').on('click', '.btn-toggle-all-permissions', function () {
            $(this).parentsUntil('.wrapper-roles.show-roles').find('.permissions .label-permission').click()
        })
        $('.show-roles').on('click', '.btn-toggle-permissions-in-group', function () {
            $(this).parentsUntil('.permissions').find('.label-permission').click()
        })
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.roles')
            vm.$nextTick(() => {
                vm.getPermissions().then(() => {
                    vm.getRoles()
                })
            })
        })
    }
}
</script>
