
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- title   ===  sales_commissions -->
            <div class="col-12">
                <div class="form-title">
                    <h3 class="text" v-text="$t('sidebar.sales_commissions')"></h3>
                </div>
            </div>
            <!-- =========================================================== -->



            <div class="col-lg-8 col-xl-6">

                <div class="form-plus form-plus-color" v-for="(commission, index) in form.commissions" :key="index">
                    <div class="form-plus-input form-group-input form-plus-fw">
                        <select
                            class="custom-select custom-select-sm"
                            :class="{ 'is-invalid': form.errors.has(`commissions.${index}.sales_id`) }"
                            v-model="commission.sales_id"
                        >
                            <option disabled value="" v-text="$t('sales_commissions_table.sales_id')"></option>
                            <option 
                                v-for="user in users"
                                :value="user.id"
                                :key="user.id"
                                v-text="user.name"
                            ></option>
                        </select>
                        <has-error :form="form" :field="`commissions.${index}.sales_id`"></has-error>
                    </div>
                    <div class="form-plus-color-input form-group-input">
                        <input
                            v-model="commission.commission"
                            type="text"
                            class="form-control form-control-sm"
                            :class="{ 'is-invalid': form.errors.has(`commissions.${index}.commission`) }"
                            :placeholder="$t('sales_commissions_table.commission')"
                        >
                        <has-error :form="form" :field="`commissions.${index}.commission`"></has-error>
                    </div>
                    <button
                        type="button"
                        class="btn btn-sm btn-danger btn-plus"
                        v-if="index > 0 ||  index === 0 && form.commissions.length > 1"
                        @click="removeCommission(index)"
                    >
                        {{ $t('sidebar.delete_commission') }}
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- =========================================================== -->
                </div>
                <button
                    type="button"
                    class="btn btn-sm btn-success btn-plus"
                    @click="addCommission()"
                >
                    {{ $t('sidebar.add_commission') }}
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm'],
    components: {
    },
    data() {
      return {
            users: []
      }
    },

    methods: {
        addCommission() {
            this.form.commissions.push({sales_id: '', commission: ''})
        },
        removeCommission(index) {
            if (this.typeForm == 'edit') {
                if (this.form.commissions[index].id) {
                    this.form.deletedCommissions.push(this.form.commissions[index].id)
                }
            }
            this.form.commissions.splice(index, 1)
        },
    },

    mounted() {
        $getUsersSelect().then(users => {
            this.users = users
        })
    }


  }
</script>
