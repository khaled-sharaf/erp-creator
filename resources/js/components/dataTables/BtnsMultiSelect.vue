
<template>
    <div class="dataTables_btns_multi_select no-selected">

        <!-- dataTables_buttons_action -->
        <div class="dataTables_buttons_action">
            <button
                v-if="tableData.trashed != 0 && checkPermissionDelete('delete')"
                class="btn btn-danger btn-sm btn-multi-select btn-delete-all"
                @click.prevent="deleteResotreMulti('delete')"
            >
                {{ $t('global.delete') }}
                <i class="fas fa-trash"></i>
            </button>


            <button
                v-if="tableData.trashed != 1 && checkPermissionDelete('restore')"
                class="btn btn-success btn-sm btn-multi-select btn-restore-all"
                @click.prevent="deleteResotreMulti('restore')"
            >
                {{ $t('global.restore') }}
                <i class="fas fa-undo-alt"></i>
            </button>


            <button
                v-if="tableData.trashed == 0 && checkPermissionDelete('force-delete')"
                class="btn btn-danger btn-sm btn-multi-select btn-force-delete-all"
                @click.prevent="deleteResotreMulti('force_delete')"
            >
                {{ $t('global.force_delete') }}
                <i class="far fa-trash-alt"></i>
            </button>
        </div>
        <!-- ./dataTables_buttons_action -->

        <!-- countItemsSelected -->
        <div class="count-selected" v-if="tableData.countItemsSelected > 0">
            <span class="num" v-text="tableData.countItemsSelected"></span>
            {{ $t('datatable.items_selected') }}
        </div>
        <!-- ./countItemsSelected -->


    </div>
</template>


<script>
export default {
    props: [
        "tableData",
        "deleteResotreMulti",
    ],

    methods: {
        checkPermissionDelete(type) {
            if (
                (this.$route.name === 'users' && $can(type + '-users')) ||
                (this.$route.name === 'departments' && $can(type + '-departments')) ||
                (this.$route.name === 'requests' && $can(type + '-requests')) ||
                (this.$route.name === 'leads' && $can(type + '-leads')) ||
                (this.$route.name === 'clients' && $can(type + '-clients')) ||
                (this.$route.name === 'meetings' && $can(type + '-meetings')) ||
                (this.$route.name === 'services' && $can(type + '-services')) ||
                (this.$route.name === 'quotations' && $can(type + '-quotations')) ||
                (this.$route.name === 'lead_contracts' && $can(type + '-lead_contracts')) ||
                (this.$route.name === 'projects' && $can(type + '-projects')) ||
                (this.$route.name === 'banks' && $can(type + '-banks')) ||
                (this.$route.name === 'cashs' && $can(type + '-cashs')) ||
                (this.$route.name === 'partners' && $can(type + '-partners')) ||
                (this.$route.name === 'suppliers' && $can(type + '-suppliers')) ||
                (this.$route.name === 'payments' && $can(type + '-payments')) ||
                (this.$route.name === 'expenses' && $can(type + '-expenses')) ||
                (this.$route.name === 'fixed_assets' && $can(type + '-fixed_assets')) ||
                (this.$route.name === 'purchase_orders' && $can(type + '-purchase_orders'))
            ) {
                return true
            }
            return false
        }
    },
}
</script>
