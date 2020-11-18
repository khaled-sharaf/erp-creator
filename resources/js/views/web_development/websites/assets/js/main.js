import '../css/_index.scss'

import MixinsDatatable from "../../../../../mixins/MixinsDatatable"
import MixinChangeLocaleMessages from "../../../../../mixins/MixinChangeLocaleMessages"

import Pagination from 'laravel-vue-pagination';
// import VueSelect from 'vue-select';
import * as VueSelect from '../../../../../plugins/vSelect';

export default {
  mixins: [MixinsDatatable, MixinChangeLocaleMessages],
  components: {VueSelect, Pagination},
  data() {
    return {
      users: [],
      leads_companies: [],
      list: [], //lead select option with pagination
      listName: '',

      urlModel: '/webdevelopment/websites',
      leads: {},
      left: {},
      dataLeads: {}, //pagination Data
      pagination: {
        current_page: 1,
      },

      designers: {},
      form: new Form({
        website_name: '',
        user_id: [],
        lead_id: '',
        document: '',
        text: ''
      }),

      breadcrumb: [],
      btnModal: {},
      modalId: '#website',
      idPage: 'websites',
      typePage: 'create',

      search: '',
      searchResultNotFound: false,
      errorLead: false,
      errorUser: false,
    };
  },
  methods: {
    // page = 1
    getResults() {
      loadReq(this.$Progress);
			// axios.get('/websites?page=' + page)
			axios.get(this.urlModel + '?page=' + this.pagination.current_page)
				.then(response => {
          this.dataLeads = response.data.leads; // pagination
          console.log(response.data);
          this.left = response.data.leads.data;

          this.list = response.data.leads_names;

          this.leads_companies = response.data.leads_names;
          response.data.designers.forEach(element => {
            this.addTag(element.name, element.id);
          });

				});
    },
    addTag (newTag, id) {
      const tag = {
        name: newTag,
        id: id,
      }
      this.users.push(tag);
    },
    createLeadWebsite(){
      loadReq(this.$Progress);
      this.form.post(this.urlModel).then((e) => {
        $('#website').modal('hide');

        let leadObj = {
          lead: {
            name: e.data.leadName,
            id: this.form.lead_id,
          }
        };
        var web = e.data.web;
        var total = $.extend( leadObj, web );
        // Check if the lead folder already exist
        var resultObject = this.searchExistingLead(e.data.leadName, this.left);
        if (!resultObject) {
          this.left.unshift(total);
        }
        // end Check

        this.form.reset();
        this.$refs.document.value = '';
        ToastReq.fire({
            text: this.success_msg
        })
      }).catch(() => {
        if (this.form.lead_id == '') {
          this.errorLead = true;
        }
        if (this.form.user_id == 0) {
          this.errorUser = true;
        }
        ToastFailed.fire({
            title: this.failed_title + "!",
            text: this.failed_msg,
        })
        this.$Progress.fail();
      });
    },
    uploadDocument(e){
      let file = e.target.files[0];
      const reader = new FileReader();
      let read = reader.readAsText(file);

      if(file['size'] < 150000){
        this.form.text = file.name;
        reader.onload = e => {
          this.form.document = e.target.result;
        }

      }else{
        ToastFailed.fire({
            title: this.failed_title + "!",
            text: this.failed_file_size,
        })
        this.$Progress.fail();
      }
    },
    searchExistingLead(nameKey, array){
      for (var i=0; i < array.length; i++) {
        if (array[i].lead.name == nameKey) {
          return array[i];
        }
      }
    },
    closeForm(){
      this.form.reset();
      this.$refs.document.value = '';
    },
    searchData(){
      loadReq(this.$Progress);
      axios.get( this.urlModel + '/' + this.search + '?page=' + this.pagination.current_page)
        .then(response => {
          // console.log(response);

          this.dataLeads = response.data.leads; // pagination
          this.left = response.data.leads.data;

          this.$Progress.finish()
        })
        .catch( e => {
          console.log(e);
          this.$Progress.fail()
        })

    },
    enableInputSearch(){
      $(".sp-search-input").disabled = false;
      console.log("kshvbd" + '\n' + $(".sp-search-input").val());

    }
  },
  watch: {
    search:function( newQ ){
      if (newQ == '') {
        this.getResults();
      } else {
        // console.log(newQ);
        this.searchData();
      }
    }
  },
  mounted() {
    this.getResults();
    this.breadcrumb = [
        {label: this.$t('sidebar.designs'), to: {name: 'designs-model'}},
        {label: this.$t('projects_table.websites'), active: true},
    ]
    this.btnModal = {label: this.$t('global.create') + ' ' + this.$t('websites_table.new_web'), targetModal:this.modalId}
  },
  beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.websites')
        })
  }
};
