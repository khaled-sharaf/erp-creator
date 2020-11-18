<template>
    <div>
        <!-- Content Header (Page header) -->
        <header-comp :breadcrumb="breadcrumb">
            <template slot="btns">
                <!-- btn assign permissions -->
                <router-link
                    :to="{name: 'assign-permissions-to-user', params: {id: modelData.id}}"
                    v-text="$t('sidebar.permissions')"
                    class="btn btn-success btn-sm btn-table-actions text-white"
                    v-if="$can('permission-users')"
                >
                </router-link>
                <!-- ./btn assign permissions -->

                <!-- btn edit -->
                <btn-edit v-if="$can('edit-users')" :model="modelData" :modelName="idPage"></btn-edit>
                <!-- ./btn edit -->

                <!-- print -->
                <!-- <button type="button" class="btn btn-primary" v-print="printObject">
                    {{ $t('datatable.print') }}
                    <i class="fas fa-print"></i>
                </button> -->
                <!-- ./print -->
            </template>
        </header-comp>

        <!-- /.content-header -->
        <section class="content">
            <div class="container-fulid">
                <div class="card">
                    <!-- card-body -->
                    <div class="card-body">
                        <div class="profile-wrapper" id="profile-wrapper">
                            <!-- row -->
                            <div class="row">

                                <div class="col-md-3 col-xl-2 col-12">
                                    <div class="profile-image circel">
                                        <img :src="$domain + modelData.photo" alt="user photo">
                                    </div>
                                </div><!-- ./col-md -->

                                <!-- col-md -->
                                <div class="col-md-9 col-xl-10 col-12">

                                    <div class="row">


                                        <!-- title   ===  registration_data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.registration_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- name -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.name') }}</label>
                                                <div class="content" v-text="modelData.name"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- email -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{$t('users_table.email')}}</label>
                                                <div class="content">
                                                    <a :href="'mailto:' + modelData.email">{{modelData.email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- title   ===  personal data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.personal_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- name_ar -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.name_ar') }}</label>
                                                <div class="content" v-text="modelData.name_ar"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.phone">{{modelData.phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- home_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.home_phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.home_phone">{{modelData.home_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- emergency_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.emergency_phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.emergency_phone">{{modelData.emergency_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- country -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.country') }}</label>
                                                <div class="content" v-text="modelData.country"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- city -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.city') }}</label>
                                                <div class="content" v-text="modelData.city"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- address -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.address') }}</label>
                                                <div class="content" v-text="modelData.address"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- nationality -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.nationality') }}</label>
                                                <div class="content" v-text="modelData.nationality"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- marital_status -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.marital_status') }}</label>
                                                <div class="content" v-text="modelData.marital_status"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- gender -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.gender') }}</label>
                                                <div class="content" v-text="modelData.gender"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- birth_date -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.birth_date') }}</label>
                                                <div class="content" v-text="modelData.birth_date"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- id_cart -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.id_cart') }}</label>
                                                <div class="content" v-text="modelData.id_cart"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->



                                        <!-- title   ===  Education -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.education')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- certificate_level -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.certificate_level') }}</label>
                                                <div class="content" v-text="modelData.certificate_level"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- school -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.school') }}</label>
                                                <div class="content" v-text="modelData.school"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->




                                        <!-- title   ===  word_data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.word_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- work_phone -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.work_phone') }}</label>
                                                <div class="content">
                                                    <a :href="'tel:' + modelData.work_phone">{{modelData.work_phone}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- work_email -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.work_email') }}</label>
                                                <div class="content">
                                                    <a :href="'mailto:' + modelData.work_email">{{modelData.work_email}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- work_address -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.work_address') }}</label>
                                                <div class="content" v-text="modelData.work_address"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- bank_account_number -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.bank_account_number') }}</label>
                                                <div class="content" v-text="modelData.bank_account_number"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- visa_number -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.visa_number') }}</label>
                                                <div class="content">
                                                    <span class="text-danger" v-text="modelData.visa_number" v-if="showVisaNumber"></span>
                                                    <button type="button" class="btn btn-sm btn-secondary" v-if="modelData.visa_number != null" @click="showVisaNumber = !showVisaNumber">
                                                        {{ showVisaNumber ? $t('global.hide') : $t('global.show') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- visa_expire_date -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.visa_expire_date') }}</label>
                                                <div class="content" v-text="modelData.visa_expire_date"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->




                                        <!-- title   ===  job_data -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.job_data')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- department -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.department_id') }}</label>
                                                <div class="content" v-text="modelData.job_title != null ? modelData.job_title.department.name : ''"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- job_title -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.job_title_id') }}</label>
                                                <div class="content" v-text="modelData.job_title != null ? modelData.job_title.name : ''"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- hiring_date -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.hiring_date') }}</label>
                                                <div class="content" v-text="modelData.hiring_date"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- salary -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.salary') }}</label>
                                                <div class="content" v-text="modelData.salary != null ? modelData.salary + ' ' + $t('global.currency') : ''"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <div class="col-12"></div>
                                        <br>

                                        <!-- active -->
                                        <div class="col-sm-6 col-lg-4 col-xl-3">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.active') }}</label>
                                                <div class="content">
                                                    <span v-if="modelData.active">
                                                        <i class="far fa-check-circle"></i>
                                                        {{ $t('users_table.activate.on') }}
                                                    </span>
                                                    <span v-else>
                                                        <i class="far fa-times-circle"></i>
                                                        {{ $t('users_table.activate.off') }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <div class="col-12"></div>
                                        <br>

                                        <!-- document_note -->
                                        <div class="col-12">
                                            <div class="profile-field-group">
                                                <label>{{ $t('users_table.document_note') }}</label>
                                                <div class="content" v-text="modelData.document_note"></div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                        <!-- title   ===  documents -->
                                        <div class="col-12">
                                            <div class="form-title">
                                                <h3 class="text" v-text="$t('users_table.documents')"></h3>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->

                                        <!-- title   ===  documents -->
                                        <div class="col-12" v-if="modelData.documents.length">
                                            <div class="row">
                                                <div class="col-12" v-if="!showDocuments">
                                                    <button
                                                        type="button"
                                                        class="btn btn-primary btn-sm"
                                                        v-text="$t('users_table.show_documents')"
                                                        @click="showDocumentsFn"
                                                    ></button>
                                                </div>

                                                <!-- documents -->
                                                <div class="col-12" v-if="showWrapperDocuments">
                                                    <vue-slide :active="showDocuments" :duration="1000" :use-hidden="true">
                                                        <div class="profile-field-group">
                                                            <div class="d-block mb-2 overflow-hidden">
                                                                <button
                                                                    type="button"
                                                                    class="btn btn-success btn-sm float-right"
                                                                    v-text="$t('global.download_all')"
                                                                    @click="$downloadMultiImage(modelData.documents, 'document')"
                                                                ></button>
                                                            </div>
                                                            <div class="content">
                                                                <div class="gallery">
                                                                    <div class="image" v-for="(image, index) in modelData.documents" :key="index">
                                                                        <a
                                                                            class="btn btn-success"
                                                                            :href="$domain + image.value"
                                                                            :download="`document-${image.id}`"
                                                                            v-text="$t('global.download')"
                                                                        ></a>
                                                                        <img :src="$domain + image.value">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </vue-slide>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- =========================================================== -->


                                    </div>
                                    <!-- ./row -->
                                </div><!-- ./col-md -->


                            </div><!-- ./row -->
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
export default {
    data() {
      return {
        showVisaNumber: false,
        urlModel: '/hr/users',
        showDocuments: false,
        showWrapperDocuments: false,
        modelData: {
          name: "",
          name_ar: "",
          email: "",
          password: "",
          password_confirmation: "",
          phone: "",
          home_phone: "",
          emergency_phone: "",
          country: "",
          city: "",
          address: "",
          photo: "images/user-avatar/default-avatar.png",
          nationality: "",
          marital_status: "",
          gender: "",
          birth_date: "",
          id_cart: "",

          work_phone: "",
          work_email: "",
          work_address: "",
          bank_account_number: "",
          visa_number: "",
          visa_expire_date: "",

          certificate_level: "",
          school: "",

          job_title_id: "",
          work_period_id: "",

          hiring_date: "",
          salary: "",
          documents: [],
          active: "",

          document_note: "",
        },

        idPage: 'users',
        breadcrumb: [],
        printObject: {
            id: "profile-wrapper",
            popTitle: ''
        }
      }
    },
    methods: {
        getUser(route) {
            axios.get(this.urlModel + '/' + route.params.id).then(response => {
                if (response.status === 200) {
                    const user = response.data.user
                    if (user != null) {
                        this.modelData = user
                        this.printObject.popTitle = 'Profile ( ' + this.modelData.name + ' )'
                    } else {
                        this.$router.push({name: 'users'})
                    }
                }
            })
            .catch(errors => {
                setTimeout(() => {
                    this.getUser(this.$route)
                }, 1000)
            })
        },

        showDocumentsFn() {
            this.showWrapperDocuments = true
            setTimeout(() => {
                this.showDocuments = true
            }, 100)
        }
    },
    mounted() {
        this.getUser(this.$route)
        this.breadcrumb = [
            {label: this.$t('sidebar.hr'), to: {name: 'hr-model'}},
            {label: this.$t('sidebar.users'), to: {name: 'users'}},
            {label: this.$t('global.user_profile'), active: true},
        ]
    },
    watch: {
        "$route.params.id"(val) {
            this.getUser(this.$route)
        }
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.user_profile')
        })
    }
}
</script>
