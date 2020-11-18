<template>
    <data-table
        :idPage="idPage"
        :showSettings="showSettings"
        :breadcrumb="breadcrumb"
        :btnCreate="btnCreate"
        :hideMultiSelect="hideMultiSelect"
        :columns="columns"
        :themeTableClasses="viewTableClasses"
        :dataTable="dataTable"
        :tableData="tableData"
        :perPage="perPage"
        :successResponse="successResponse"
        :columnsView="tableData.columns"
        :columnsExcepted="tableData.filter.columnsExcept"
        :themeTableClassesFilter="tableData.filter.viewTable"
        :sortOrders="sortOrders"
        :pagination="pagination"
        :filters="filters"

        :toggleShowSettings="toggleShowSettings"
        :deleteResotreMulti="deleteResotreMulti"
        :getData="getData"
    >

        <tbody>
            <tr
                role="row"
                v-for="(setting, index) in dataTable"
                :key="setting.id"
                :data-id="setting.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{setting.id}}
                </td>

                <td v-show="tableData.columns.indexOf('slug') != -1" class="slug">
                    {{setting.slug}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{setting.name}}
                </td>

                <td v-show="tableData.columns.indexOf('value') != -1" class="value">
                    <img class="avatar-table" v-if="setting.value != null && setting.value.indexOf('images/settings/') === 0" :src="$domain + setting.value">
                    <span v-else>
                        <div class="view-text-editor" v-html="setting.value"></div>
                    </span>
                </td>

                <!-- <td v-show="tableData.columns.indexOf('user_id') != -1" class="user_id">
                    <created-by :model="setting"></created-by>
                </td> -->


                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="setting.updated_at"></relative-date>
                </td>


                <!-- <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="setting.created_at"></relative-date>
                </td> -->

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <!-- btn edit row -->
                    <btn-edit v-if="$can('edit-general-settings')" :model="setting" modelName="general-settings"></btn-edit>
                    <!-- ./btn edit row -->

                    <!-- btn delete row -->
                    <!-- <btn-delete :model="setting" modelName="setting" @destroyRow="destroyRow(setting.id)"></btn-delete> -->
                    <!-- ./btn delete row -->
                </td>
            </tr>
        </tbody>
    </data-table>
</template>


<script>
import MixinsDatatable from "./../../../mixins/MixinsDatatable"
export default {
    mixins: [MixinsDatatable],
    data() {
        return {
            idPage: 'general-settings',
            urlGetDataTable: '/setting/settings',
            hideMultiSelect: false,
            filters: ['search'],
            columns: [
                { label: "ID", name: "id" },
                { label: "Slug", name: "slug" },
                { label: "Name", name: "name" },
                { label: "Value", name: "value" },
                // { label: "created by", name: "user_id" },
                { label: "Updated at", name: "updated_at" },
                // { label: "Created at", name: "created_at" }
            ],
            columnsExceptedSorting: ['user_id', 'value'],
            breadcrumb: [],
            btnCreate: {},
        };
    },
    mounted() {
        this.breadcrumb = [
            {label: this.$t('sidebar.settings'), to: {name: 'settings-model'}},
            {label: this.$t('sidebar.general-settings'), active: true},
        ]
        this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_setting'), to: {name: this.idPage + '-create'}}
    },
    beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.general-settings')
        })
    },
};
</script>
