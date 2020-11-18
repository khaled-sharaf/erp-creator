<template>
    <data-table
        :idPage="idPage"
        :showSettings="showSettings"
        :breadcrumb="breadcrumb"
        :btnCreate="btnCreate"
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

        :excelFields="excelFields"
    >

        <!-- <template v-slot:btns>
            <router-link
                class="btn btn-info"
                :to="{name: 'users'}"
            >
                test
                <i class="fas fa-plus"></i>
            </router-link>
        </template> -->

        <tbody>
            <tr
                role="row"
                v-for="(user, index) in dataTable"
                :key="user.id"
                :data-id="user.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{user.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{user.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('photo') != -1" class="photo">
                    <div class="staff-in-table">
                        <div
                            class="image designer"
                        >
                            <img :src="$domain + user.photo">
                        </div>
                    </div>
                </td>

                <td v-show="tableData.columns.indexOf('name_ar') != -1" class="name_ar">
                    {{user.name_ar }}
                </td>

                <td v-show="tableData.columns.indexOf('email') != -1" class="email">
                    <a :href="'mailto:' + user.email">{{user.email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('phone') != -1" class="phone">
                    <a :href="'tel:' + user.phone">{{user.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('home_phone') != -1" class="home_phone">
                    <a :href="'tel:' + user.home_phone">{{user.home_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('emergency_phone') != -1" class="emergency_phone">
                    <a :href="'tel:' + user.emergency_phone">{{user.emergency_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('country') != -1" class="country">
                    {{user.country }}
                </td>

                <td v-show="tableData.columns.indexOf('city') != -1" class="city">
                    {{user.city }}
                </td>

                <td v-show="tableData.columns.indexOf('nationality') != -1" class="nationality">
                    {{user.nationality }}
                </td>

                <td v-show="tableData.columns.indexOf('id_cart') != -1" class="id_cart">
                    {{user.id_cart }}
                </td>

                <td v-show="tableData.columns.indexOf('work_phone') != -1" class="work_phone">
                    <a :href="'tel:' + user.work_phone">{{user.work_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('work_email') != -1" class="work_email">
                    <a :href="'mailto:' + user.work_email">{{user.work_email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('work_address') != -1" class="work_address">
                    {{user.work_address }}
                </td>

                <td v-show="tableData.columns.indexOf('job_title_id') != -1" class="job_title_id">
                    {{ user.job_title != null ? user.job_title.name : '' }}
                </td>

                <td v-show="tableData.columns.indexOf('hiring_date') != -1" class="hiring_date">
                    {{ user.hiring_date }}
                </td>

                <td v-show="tableData.columns.indexOf('salary') != -1" class="salary">
                    {{ user.salary != null ? user.salary + ' ' + $t('global.currency') : '' }}
                </td>

                <td v-show="tableData.columns.indexOf('active') != -1" class="active">
                    <span v-if="user.active">
                        <i class="far fa-check-circle"></i>
                        {{ $t('users_table.activate.on') }}
                    </span>
                    <span v-else>
                        <i class="far fa-times-circle"></i>
                        {{ $t('users_table.activate.off') }}
                    </span>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="user.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="user.created_at"></relative-date>
                </td>


                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="user"
                        :modelName="idPage"
                        @destroyRow="destroyRow(user.id)"
                        @forceDeleteRow="forceDeleteRow(user.id)"
                        @restoreRow="restoreRow(user.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn assign permissions -->
                            <router-link
                                :to="{name: 'assign-permissions-to-user', params: {id: user.id}}"
                                class="dropdown-item"
                                v-if="$can('permission-users') && user.deleted_at == null"
                            >
                                <i class="fas fa-lock"></i>
                                {{ $t('sidebar.permissions') }}
                            </router-link>
                            <!-- ./btn assign permissions -->
                        </template>
                    </menu-actions>
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
        idPage: 'users',
        urlGetDataTable: '/hr/users',
        // filters: ['rules', 'trashed', 'activation', 'display', 'created-between'],
        filters: ['trashed', 'activation', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "name" },
            { label: "", name: "photo" },
            { label: "", name: "name_ar" },
            { label: "", name: "email" },
            { label: "", name: "phone" },
            { label: "", name: "home_phone" },
            { label: "", name: "emergency_phone" },
            { label: "", name: "country" },
            { label: "", name: "city" },
            { label: "", name: "nationality" },
            { label: "", name: "id_cart" },
            { label: "", name: "work_phone" },
            { label: "", name: "work_email" },
            { label: "", name: "work_address" },
            { label: "", name: "job_title_id" },
            // { label: "", name: "work_period_id" },
            { label: "", name: "hiring_date" },
            { label: "", name: "salary" },
            { label: "", name: "active" },
            { label: "", name: "updated_at" },
            { label: "", name: "created_at" },
        ],
        columnsExceptedSorting: ['job_title_id'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {}
    };
  },
  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'email',
        'name_ar',
        'phone',
        'home_phone',
        'emergency_phone',
        'country',
        'city',
        'nationality',
        'id_cart',
        'work_phone',
        'work_email',
        'work_address',
        'salary'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
        {label: this.$t('sidebar.users'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_user'), to: {name: this.idPage + '-create'}, viewIf: $can('create-users')}

    this.excelFields = {
        [this.$t(this.idPage + '_table.job_title_id')]: {
            field: 'job_title',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.active')]: {
            field: 'active',
            callback: (value) => {
                return value == 1 ? this.$t(this.idPage + '_table.activate.on') : this.$t(this.idPage + '_table.activate.off')
            }
        }

    }
  },
  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.users')
      })
  }
};
</script>

