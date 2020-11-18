<template>
  <div>
    <header-comp :breadcrumb="breadcrumb" :btnModal="btnModal"> </header-comp>

    <section class="leads">
      <div class="leads-container">
        <div>
          <!-- <div class="col-auto mb-4">
            <div class="input-group ml-auto w-25">
              <input
                class="form-control form-control-sm w-50"
                @keyup="seachWeb"
                v-model="search"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />

              <div class="input-group-prepend input-group-sm">
                <div class="input-group-text">
                  <a href="" class="" @click.prevent="seachWeb">
                    <i class="fa fa-search" style="color:#fff;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div> -->

          <form class="mb-3">
            <div class="row">
              <div class="col-md-2"><strong>Search:</strong></div>
              <div class="col-md-7">
                <input
                  v-model="search"
                  type="search"
                  class="form-control"
                  placeholder="Search"
                />
              </div>
            </div>
          </form>
        </div>
        <div class="row">
          <!-- <div v-for="(item, index) of leads" :key="item.id" class="col-md-3"> -->
          <div v-for="(item, i) in left" :key="i" class="col-md-3">
            <!-- {{left}} -->
            <div class="card">
              <router-link
                :to="{ path: 'websites/' + item.id + '/profile' }"
                class="folder"
              >
                <h6>
                  <i class="fa fa-folder ml-2"></i
                  ><span class="text-tab">{{ item.name | capitalize }}</span>
                </h6>
              </router-link>
            </div>
          </div>

          <div v-if="searchResultNotFound" class="not-found">
            <p></p>
          </div>
        </div>
        <div class="paginate-folder">
          <pagination
            :data="dataLeads"
            :limit="2"
            @pagination-change-page="search == '' ? getResults : searchData"
          >
            <!-- @pagination-change-page="getResults" -->
          </pagination>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div
      class="modal fade"
      id="website"
      tabindex="-1"
      role="dialog"
      aria-labelledby="websiteLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header py-2">
            <h5 class="modal-title" id="websiteLabel">
              {{ $t("sidebar.add_new_website") }}
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
              @click="closeForm"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createLeadWebsite">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.website_name"
                  type="text"
                  name="website_name"
                  :placeholder="$t('websites_table.website_name')"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('website_name') }"
                />
                <has-error :form="form" field="website_name"></has-error>
              </div>

              <!-- <select
                v-model="form.lead_id"
                class="custom-select custom-select mt-1"
              >
                <option value="" disabled>{{
                  $t("websites_table.select_lead")
                }}</option>

                <option
                  v-for="item in leads_companies"
                  :key="item.id"
                  name="lead_id"
                  :value="item.id"
                  class="form-control"
                >
                  {{ item.name }}
                </option>
              </select> -->

              <!-- <template> -->
                  <!-- @values="form.lead_id" -->
                <v-selectpage
                  :data="list"
                  name="lead_id"
                  v-model="form.lead_id"
                  :value="list.id"
                  key-field="id"
                  show-field="name"
                  :search-column="list.name"
                  language="en"
                  :placeholder='$t("websites_table.select_lead")'
                  :title='$t("websites_table.select_lead")'
                  class=""
                ></v-selectpage>
              <!-- </template> -->

              <div v-if="errorLead">
                <span class="text-danger text-sm">{{
                  $t("websites_table.required_lead")
                }}</span>
              </div>

              <div class="mt-3">
                <v-select
                  multiple
                  taggable
                  v-model="form.user_id"
                  :options="users"
                  label="name"
                  :placeholder="$t('websites_table.select_developer')"
                />

                <div v-if="errorUser">
                  <span class="text-danger text-sm">{{
                    $t("websites_table.required_user")
                  }}</span>
                </div>
              </div>

              <div class="form-group mt-3">
                <!-- accept=".jpg,.jpeg,.png" -->
                <input
                  type="file"
                  ref="document"
                  name="document"
                  @change="uploadDocument"
                  :class="{ 'is-invalid': form.errors.has('document') }"
                />
                <has-error :form="form" field="document"></has-error>
              </div>

              <!-- <textarea rows="10" v-model="form.document"></textarea> -->
            </div>

            <!-- <data-table :btnCreate="btnCreate" /> -->

            <div class="modal-footer py-2">
              <button
                type="button"
                @click="closeForm"
                class="btn btn-secondary btn-sm"
                data-dismiss="modal"
              >
                Close
              </button>
              <btn-create
                :form="form"
                :text="$t('projects_table.add_website')"
              ></btn-create>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script src="./assets/js/main"></script>
