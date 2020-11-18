<template>
  <div>
    <!-- Modal -->

            <div class="modal-body">
              <div class="form-group">
                <!-- <label>Username</label> -->
                <input v-model="form.logo_name" type="text" name="logo_name" :placeholder="$t('logos_table.logo_name')"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('logo_name') }">
                <has-error :form="form" field="logo_name"></has-error>
              </div>

              <select v-model="form.user_id" class="custom-select custom-select my-2">
                <option value="" disabled hidden>{{ $t('sidebar.choose_designer') }}</option>

                <option v-for="item in designers" :key="item.id" name="user_id" :value="item.id"
                class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                  {{item.name}}
                </option>
                <has-error :form="form" field="user_id"></has-error>
              </select>
              <div v-if="errorUser">
                  <span class="text-danger text-sm">{{
                    $t("logos_table.required_user")
                  }}</span>
                </div>


              <select v-model="form.lead_id" class="custom-select custom-select my-2">
                <option value="" disabled hidden>{{ $t('sidebar.choose_lead') }}</option>

                <option v-for="item in dataLeads" :key="item.id" name="lead_id" :value="item.id"
                class="form-control" :class="{ 'is-invalid': form.errors.has('lead_id') }">
                  {{item.name}}
                </option>
                <!-- <has-error :form="form" field="lead_id"></has-error> -->
              </select>
              <div v-if="errorLead">
                <span class="text-danger text-sm">{{
                  $t("websites_table.required_lead")
                }}</span>
              </div>



              <upload-image
                  :form="form"
                  propertyName="photo"
                  :required="true"
                  :domain="$domain"
              ></upload-image>
            </div>

            <data-table :btnCreate="btnCreate" />


            <div class="modal-footer py-2">
              <button type="button" @click="closeForm" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
              <!-- @click="addLeadLogos(lead)" -->
              <btn-create :form="form" :text="$t('logos_table.add_logo')"></btn-create>

              <!-- <button type="submit" class="btn btn-primary">Add</button> -->
            </div>
  </div>
</template>

<script>
export default {
  // props: ['form'],
  props: {
    form: Object,
    errorLead: {
      default: false
    },
    errorUser: {
      default: false
    }
  },
  data(){
    return {
      urlModel: '/design/logos',
      dataLeads: {},
      designers: {},
      btnCreate: {},
    }
  },
  methods: {
    loadLeads(page = 1){
      loadReq(this.$Progress);
      axios.get(this.urlModel + '?page=' + page).then(response => {
        console.log(response);

          this.dataLeads = response.data.leads.data; // pagination
          // this.leads_companies = response.data.leads_names;
          this.designers = response.data.designers;
          // response.data.designers.forEach(element => {
          //   this.addTag(element.name, element.id);
          // });


      });
      // axios.get(this.urlModel + '?page=' + page).then(({data}) => {
      //   this.dataLeads = data.leads;
      //   this.designers = data.designers;
      //   data.leads.forEach(element => {
      //     if(element.logos != 0){
      //       this.leads.push(element);
      //     }
      //   });
      //   this.$Progress.finish();
      // });
    },
    closeForm(){
      this.form.reset();
    }
  },

    mounted() {
      this.loadLeads();
    }
}
</script>
