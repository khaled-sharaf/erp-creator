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
        :excelFieldsExcepted="excelFieldsExcepted"
    >

        <tbody>
            <tr
                role="row"
                v-for="(supplier, index) in dataTable"
                :key="supplier.id"
                :data-id="supplier.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{supplier.id}}
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ supplier.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('company_name') != -1" class="company_name">
                    {{ supplier.company_name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('phone') != -1" class="phone">
                    <a :href="'tel:' + supplier.phone">{{supplier.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('whatsapp_phone') != -1" class="whatsapp_phone">
                    <a target="_blank" v-link-whatsapp="supplier.whatsapp_phone">{{supplier.whatsapp_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('email') != -1" class="email">
                    <a :href="'mailto:' + supplier.email">{{supplier.email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('logo') != -1" class="logo" style="text-align:center;">
                    <img class="avatar-table" :src="$domain + supplier.logo">
                </td>

                <td v-show="tableData.columns.indexOf('address') != -1" class="address">
                    {{ supplier.address }}
                </td>

                <td v-show="tableData.columns.indexOf('note') != -1" class="note">
                    {{ supplier.note }}
                </td>
                
                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="supplier.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="supplier.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <!-- btn view profile -->
                    <btn-view-profile :model="supplier" :modelName="idPage"></btn-view-profile>
                    <!-- ./btn view profile -->

                    <!-- btn edit row -->
                    <btn-edit :model="supplier" :modelName="idPage"></btn-edit>
                    <!-- ./btn edit row -->

                    <!-- btn delete row -->
                    <btn-delete :model="supplier" :modelName="idPage" @destroyRow="destroyRow(supplier.id)"></btn-delete>
                    <!-- ./btn delete row -->

                    <!-- btn restore row -->
                    <btn-restore :model="supplier" :modelName="idPage" @restoreRow="restoreRow(supplier.id)"></btn-restore>
                    <!-- ./btn restore row -->

                    <!-- btn force delete row -->
                    <!-- <btn-force-delete :model="supplier" :modelName="idPage" @forceDeleteRow="forceDeleteRow(supplier.id)"></btn-force-delete> -->
                    <!-- ./btn force delete row -->
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
        idPage: 'suppliers',
        urlGetDataTable: '/accounting/suppliers',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "name" },
            { label: "", name: "company_name" },
            { label: "", name: "phone" },
            { label: "", name: "whatsapp_phone" },
            { label: "", name: "email" },
            { label: "", name: "address" },
            { label: "", name: "logo" },
            { label: "", name: "note" },

            { label: "", name: "created_at" },
            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['note', 'logo'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['logo', 'updated_at'],
    };
  },


  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'company_name',
        'phone',
        'whatsapp_phone',
        'email',
        'address'
    ])
    this.breadcrumb = [
        {label: this.$t('sidebar.accounting'), to: {name: 'accounting-model'}},
        {label: this.$t('sidebar.suppliers'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_supplier'), to: {name: this.idPage + '-create'}}

  },

  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.suppliers')
      })
  }
};
</script>

