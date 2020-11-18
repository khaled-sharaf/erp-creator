
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- title   ===  lead_statuses -->
            <div class="col-12">
                <div class="form-title">
                    <h3 class="text" v-text="$t('sidebar.lead_statuses')"></h3>
                </div>
            </div>
            <!-- =========================================================== -->



            <div class="col-lg-8 col-xl-6">

                <div class="form-plus form-plus-color" v-for="(status, index) in form.statuses" :key="index">
                    <div class="form-plus-input form-group-input form-plus-fw">
                        <input
                            v-model="status.name"
                            type="text"
                            class="form-control form-control-sm"
                            :placeholder="$t('lead_statuses_table.name')"
                            :class="{ 'is-invalid': form.errors.has(`statuses.${index}.name`) }"
                        >
                        <has-error :form="form" :field="`statuses.${index}.name`"></has-error>
                    </div>
                    <div class="form-plus-color-input form-group-input">
                        <input
                            v-model="status.color"
                            type="color"
                            class="form-control form-control-sm"
                        >
                    </div>
                    <button
                        type="button"
                        class="btn btn-sm btn-danger btn-plus"
                        v-if="index > 0 ||  index === 0 && form.statuses.length > 1"
                        @click="removeStatus(index)"
                    >
                        {{ $t('sidebar.delete_status') }}
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- =========================================================== -->
                </div>
                <button
                    type="button"
                    class="btn btn-sm btn-success btn-plus"
                    @click="addStatus()"
                >
                    {{ $t('sidebar.add_status') }}
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
      }
    },

    methods: {
        addStatus() {
            this.form.statuses.push({name: '', color: '#333333'})
        },
        removeStatus(index) {
            if (this.typeForm == 'edit') {
                if (this.form.statuses[index].id) {
                    this.form.deletedStatuses.push(this.form.statuses[index].id)
                }
            }
            this.form.statuses.splice(index, 1)
        },
    }


  }
</script>
