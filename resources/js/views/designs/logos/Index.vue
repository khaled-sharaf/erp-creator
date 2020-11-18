<style>
.card {
  border-radius: 0.55rem;
  background: #fff;
  margin-bottom: 30px !important;
  width: 100%;
  box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.1);
}
.folder {
  padding: 10px;
  display: block;
  color: #777;
}
.folder:hover {
  text-decoration: none;
}
.text-tab {
  padding-left: 10px;
}
.breadcrumb .btn-info {
  background-color: #0c8c97;
}
.breadcrumb .btn-info:hover {
  background-color: rgba(12, 140, 151, 0.8);
}
.text-sm {
  font-size: 80%;
}
.input-group-text {
  padding: 0.1rem 0.55rem;
  background-color: #343a40;
  border-top-right-radius: 0.25rem !important;
  border-bottom-right-radius: 0.25rem !important;
}
</style>

<template>
  <div>
    <header-comp
      :breadcrumb="breadcrumb"
      :btnModal="btnModal"
      >
    </header-comp>

    <!-- Button trigger modal -->
    <section class="leads">
      <div class="container">
        <div>
          <div class="col-auto mb-4">
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
          </div>
        </div>

        <div class="row">
          <!-- <div v-for="item of leads" :key="item.id" class="col-md-3"> -->
          <div v-for="(item, i) in left" :key="i" class="col-md-3">
            <!-- {{item}} -->
            <div class="card">
              <router-link
                :to="{ path: 'logos/' + item.id + '/profile' }"
                class="folder"
              >
                <h6>
                  <i class="fa fa-folder ml-2"></i>
                  <!-- <span class="text-tab">{{item.lead.name | capitalize}}</span> -->
                  <span class="text-tab">{{ item.name | capitalize }}</span>
                </h6>
              </router-link>
            </div>
          </div>

          <div v-if="searchResultNotFound" class="not-found">
            <p></p>
          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div
      class="modal fade"
      id="leadPortfolio"
      tabindex="-1"
      role="dialog"
      aria-labelledby="leadPortfolioLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header py-2">
            <h5 class="modal-title" id="leadPortfolioLabel">
              {{ $t("sidebar.add_new_lead_portfolio") }}
            </h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <!-- form -->
          <form @submit.prevent="createLeadLogo()" class="global-form-handel">
            <!-- model-body -->
            <form-model
              typeForm="create"
              :form="form"
              :errorLead="errorLead"
              :errorUser="errorUser"
            ></form-model>
            <!-- ./model-body -->
          </form>
          <!-- form -->
        </div>
      </div>
    </div>
  </div>
</template>

<script src="./main.js"></script>
