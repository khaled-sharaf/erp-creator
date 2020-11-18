<template>
  <div>
    <div class="modal-body">
              <div class="form-group">
                <!-- <label>Username</label> -->
                <input v-model="form.media_name" type="text" name="media_name" :placeholder="$t('social_media_table.media_name')"
                  class="form-control" :class="{ 'is-invalid': form.errors.has('media_name') }">
                <has-error :form="form" field="media_name"></has-error>
              </div>

              <select v-model="form.user_id" class="custom-select custom-select my-2">
                <option value="" disabled hidden>{{ $t('sidebar.choose_designer') }}</option>

                <option v-for="item in designers" :key="item.id" name="user_id" :value="item.id"
                class="form-control" :class="{ 'is-invalid': form.errors.has('user_id') }">
                  {{item.name}}
                </option>
                <has-error :form="form" field="user_id"></has-error>
              </select>



              <select v-model="form.lead_id" class="custom-select custom-select my-2">
                <option value="" disabled hidden>{{ $t('sidebar.choose_lead') }}</option>

                <option v-for="item in dataLeads" :key="item.id" name="lead_id" :value="item.id"
                class="form-control" :class="{ 'is-invalid': form.errors.has('lead_id') }">
                  {{item.name}}
                </option>
                <has-error :form="form" field="lead_id"></has-error>
              </select>

              <upload-image
                  :form="form"
                  propertyName="photo"
                  :required="true"
                  :domain="$domain"
              ></upload-image>
            </div>
            <data-table :btnCreate="btnCreate" />

            <div class="modal-footer">
              <button type="button" v-on:click="closeForm" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>

              <btn-create :form="form" :text="$t('social_media_table.add_new_media')"></btn-create>
            </div>
  </div>
</template>
<script>
export default {
  props: ['form', 'closeForm'],
  data(){
    return {
      urlModel: '/design/social-media',
      leads: [],
      dataLeads: {},
      designers: {},
      btnCreate: {},
    }
  },
  methods: {
    loadLeads(){
      loadReq(this.$Progress);
      axios.get(this.urlModel).then(({data}) => {

        this.dataLeads = data.leads;
        this.designers = data.designers;

        this.$Progress.finish();
      });
    },
  },

    mounted() {
      this.loadLeads();
    }
}
</script>
