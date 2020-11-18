
<template>
    <div>
        <!-- row -->
        <div class="row">


            <!-- name -->
            <div class="col-sm-8 col-md-6">
                <div class="form-group form-group-input">
                    <label class="required">{{ $t('departments_table.name') }}</label>
                    <input
                        v-model="form.name"
                        type="text"
                        class="form-control form-control-sm"
                        :class="{ 'is-invalid': form.errors.has('name') }"
                    >
                    <has-error :form="form" field="name"></has-error>
                </div>
            </div>
            <!-- =========================================================== -->


            <!-- title   ===  job_titles -->
            <div class="col-12">
                <div class="form-title">
                    <h3 class="text" v-text="$t('sidebar.job_titles')"></h3>
                </div>
            </div>
            <!-- =========================================================== -->



            <div class="col-sm-8 col-md-6">

                <div class="form-plus" v-for="(title, index) in form.job_titles" :key="index">
                    <div class="form-plus-input form-group-input form-plus-fw">
                        <input
                            v-model="title.name"
                            type="text"
                            class="form-control form-control-sm"
                            :placeholder="$t('job_titles_table.name')"
                            :class="{ 'is-invalid': form.errors.has(`job_titles.${index}.name`) }"
                        >
                        <has-error :form="form" :field="`job_titles.${index}.name`"></has-error>
                    </div>
                    <button
                        type="button"
                        class="btn btn-sm btn-danger btn-plus"
                        v-if="index > 0 ||  index === 0 && form.job_titles.length > 1"
                        @click="removeJobTitle(index)"
                    >
                        {{ $t('sidebar.delete_title') }}
                        <i class="fas fa-trash"></i>
                    </button>
                    <!-- =========================================================== -->
                </div>
                <button
                    type="button"
                    class="btn btn-sm btn-success btn-plus"
                    @click="addJobTitle()"
                >
                    {{ $t('sidebar.add_title') }}
                    <i class="fas fa-plus"></i>
                </button>
            </div>

        </div><!-- ./row -->
    </div>
</template>


<script>

export default {
    props: ['form', 'typeForm'],
    methods: {
        addJobTitle() {
            this.form.job_titles.push({name: ''})
        },
        removeJobTitle(index) {
            if (this.typeForm == 'edit') {
                if (this.form.job_titles[index].id) {
                    this.form.deletedJobTitles.push(this.form.job_titles[index].id)
                }
            }
            this.form.job_titles.splice(index, 1)
        },
    }


  }
</script>
