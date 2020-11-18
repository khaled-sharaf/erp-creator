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

        <template slot="more-filters">
            <created-by-select
                :getData="getData"
                :tableData="tableData"
                v-if="$can('admin-crm')"
            ></created-by-select>
        </template>


        <tbody>
            <tr
                role="row"
                v-for="(client, index) in dataTable"
                :key="client.id"
                :data-id="client.id"
                class="tr-general"
                :class="index % 2 == 0 ? 'even' : 'odd'"
            >

                <td v-show="tableData.columns.indexOf('index') != -1" class="index">
                    {{index + 1}}
                </td>

                <td v-show="tableData.columns.indexOf('id') != -1" class="id">
                    {{client.id}}
                </td>

                <td v-show="tableData.columns.indexOf('created_at') != -1" class="created_at">
                    <relative-date :date="client.created_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('created_by') != -1" class="created_by">
                    <created-by :model="client.created_by_user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('name') != -1" class="name">
                    {{ client.name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('phone') != -1" class="phone">
                    <a :href="'tel:' + client.phone">{{client.phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('whatsapp_phone') != -1" class="whatsapp_phone">
                    <a target="_blank" v-link-whatsapp="client.whatsapp_phone">{{client.whatsapp_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('assign_to') != -1" class="assign_to">
                    <created-by :model="client.user" :modelName="'users-profile'"></created-by>
                </td>

                <td v-show="tableData.columns.indexOf('email') != -1" class="email">
                    <a :href="'mailto:' + client.email">{{client.email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('id_cart') != -1" class="id_cart">
                    {{ client.id_cart }}
                </td>

                <td v-show="tableData.columns.indexOf('company_name') != -1" class="company_name">
                    {{ client.company_name | capitalize }}
                </td>

                <td v-show="tableData.columns.indexOf('company_phone') != -1" class="company_phone">
                    <a :href="'tel:' + client.company_phone">{{client.company_phone}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_email') != -1" class="company_email">
                    <a :href="'mailto:' + client.company_email">{{client.company_email}}</a>
                </td>

                <td v-show="tableData.columns.indexOf('company_logo') != -1" class="company_logo" style="text-align:center;">
                    <img class="avatar-table" :src="$domain + client.company_logo">
                </td>

                <td v-show="tableData.columns.indexOf('company_address') != -1" class="company_address">
                    {{ client.company_address }}
                </td>

                <td v-show="tableData.columns.indexOf('company_scope') != -1" class="company_scope">
                    {{ client.company_scope }}
                </td>

                <td v-show="tableData.columns.indexOf('note') != -1" class="note">
                    {{ client.note }}
                </td>

                <td v-show="tableData.columns.indexOf('updated_at') != -1" class="updated_at">
                    <relative-date :date="client.updated_at"></relative-date>
                </td>

                <td v-show="tableData.columns.indexOf('actions') != -1" class="actions">
                    <menu-actions
                        :model="client"
                        :modelName="idPage"
                        @destroyRow="destroyRow(client.id)"
                        @forceDeleteRow="forceDeleteRow(client.id)"
                        @restoreRow="restoreRow(client.id)"
                    >
                        <template v-slot:before-delete>
                            <!-- btn craete meeting -->
                            <!-- <a
                                v-if="lead.deleted_at == null && lead.user != null && $can('create-meetings')"
                                class="dropdown-item text-info"
                                @click="showCreateMeetingModal(lead)"
                            >
                                <i class="fas fa-user-friends"></i>
                                {{ $t('global.meeting') }}
                            </a> -->
                            <!-- ./btn craete meeting -->

                            <!-- btn craete lead_contracts -->
                            <router-link
                                v-if="client.deleted_at == null && client.user != null && $can('create-lead_contracts')"
                                class="dropdown-item text-success"
                                :to="{name: 'lead_contracts-create', params: {id: client.id}}"
                            >
                                <i class="fas fa-handshake"></i>
                                {{ $t('global.contract') }}
                            </router-link>
                            <!-- ./btn craete lead_contracts -->

                            <!-- btn craete quotations -->
                            <router-link
                                v-if="client.deleted_at == null && client.user != null && $can('create-quotations')"
                                class="dropdown-item text-secondary"
                                :to="{name: 'quotations-create', params: {id: client.id}}"
                            >
                                <i class="fas fa-dollar-sign"></i>
                                {{ $t('sidebar.quotation') }}
                            </router-link>
                            <!-- ./btn craete quotations -->
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
        idPage: 'clients',
        urlGetDataTable: '/crm/clients',
        filters: ['trashed', 'created-between', 'search'],
        columns: [
            { label: "", name: "id" },
            { label: "", name: "created_at" },
            { label: "", name: "created_by" },
            { label: "", name: "name" },

            { label: "", name: "phone" },
            { label: "", name: "whatsapp_phone" },
            { label: "", name: "assign_to" },
            { label: "", name: "email" },
            { label: "", name: "id_cart" },

            { label: "", name: "company_name" },
            { label: "", name: "company_phone" },
            { label: "", name: "company_email" },
            { label: "", name: "company_logo" },
            { label: "", name: "company_address" },
            { label: "", name: "company_scope" },
            { label: "", name: "note" },

            { label: "", name: "updated_at" },
        ],
        columnsExceptedSorting: ['assign_to', 'created_by', 'note', 'company_logo'],
        breadcrumb: [],
        btnCreate: {},
        excelFields: {},
        excelFieldsExcepted: ['company_logo', 'updated_at'],
        lead_statuses: [],
        currentMenuStatus: 0,
        currentDataCreateMeeting: {}
    };
  },

    methods: {
    },


  mounted() {
    this.tableData.searchColumns = this.tableData.searchColumns.concat([
        'id',
        'name',
        'phone',
        'whatsapp_phone',
        'email',
        'id_cart',
        'company_name',
        'company_phone',
        'company_email',
        'company_logo',
        'company_address',
        'company_scope'
    ])
    this.tableData.created_by = ''
    this.tableData.typeLead = 2
    this.breadcrumb = [
        {label: this.$t('sidebar.crm'), to: {name: 'crm-model'}},
        {label: this.$t('sidebar.clients'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_client'), to: {name: this.idPage + '-create'}, viewIf: $can('create-clients')}

    this.excelFields = {
        [this.$t(this.idPage + '_table.assign_to')]: {
            field: 'user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
        [this.$t(this.idPage + '_table.created_by')]: {
            field: 'created_by_user',
            callback: (value) => {
                return value != null ? value.name : ''
            }
        },
    }
  },
  beforeRouteEnter(to, from, next) {
      next(vm => {
          to.meta.title = vm.$t('sidebar.clients')
      })
  }
};
</script>

