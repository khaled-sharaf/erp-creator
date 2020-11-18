import MixinsDatatable from "./../../../mixins/MixinsDatatable"
import MixinChangeLocaleMessages from "./../../../mixins/MixinChangeLocaleMessages"

import FormModel from './Form'

export default {
    mixins: [MixinsDatatable, MixinChangeLocaleMessages],
    name: 'index-logos',
    components: {
        FormModel,
    },
  data() {
    return {
      urlModel: '/design/logos',
      // leads: [],
      users: [],
      leads_companies: [],
      leads: {},
      left: {},
      dataLeads: {},
      designers: {},
      form: new Form({
        id: '',
        logo_name: '',
        user_id: '',
        lead_id: '',
        photo: '',
      }),
      breadcrumb: [],
      // btnCreate: {},
      btnModal: {},
      modalId: '#leadPortfolio',
      idPage: 'logos',
      typePage: 'create',

      search: '',
      searchResultNotFound: false,
      errorLead: false,
      errorUser: false,
    };
  },
  methods: {
    // loadLeads(){
    //   loadReq(this.$Progress);
    //   axios.get(this.urlModel).then(({data}) => {
    //     this.dataLeads = data.leads;
    //     this.designers = data.designers;
    //     data.leads.forEach(element => {
    //       if(element.logos != 0){
    //         this.leads.push(element);
    //       }
    //     });
    //   });
    // },
    getResults(page = 1) {
      loadReq(this.$Progress);
			axios.get( this.urlModel + '?page=' + page)
				.then(response => {
          this.dataLeads = response.data.leads; // pagination
          this.left = response.data.leads.data;
          this.leads_companies = response.data.leads_names;
          this.designers = response.data.designers;
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

    createLeadLogo(){
      loadReq(this.$Progress);
      this.form.post(this.urlModel).then((e) => {
        $('#leadPortfolio').modal('hide');
        console.log(this.form);

        console.log(e.data.logo);

        let leadObj = {
          // lead: {
            name: e.data.leadName,
            id: this.form.lead_id,
          // }
        };
        var logo = e.data.logo;
        var total = $.extend( leadObj, logo );
        // Check if the lead folder already exist
        var resultObject = this.searchExistingLead(e.data.leadName, this.left);
        if (!resultObject) {
          this.left.unshift(total);
        }
        // end Check


        this.form.reset();
        ToastReq.fire({
            text: this.success_msg
        })
      }).catch((response) => {
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
    searchExistingLead(nameKey, array){
      for (var i=0; i < array.length; i++) {
        if (array[i].lead.name == nameKey) {
          return array[i];
        }
      }
    },
    seachWeb() {
      let query = this.search;
      axios.get( this.urlModel + '/findweb?q=' + query)
      .then((data) => {
        if( data.data.data.length > 0 )
        {
          let result = [];
          this.searchResultNotFound = false;
          data.data.data.forEach(element => {
            let obj = {
              lead: {
                id: element.id,
                name: element.name
              }
            }
            result.push(obj);
          });
            this.left = result;
        }else{
          this.searchResultNotFound = true;
          this.left = {};
          $(".not-found p").html(this.$t('websites_table.no_result_found'));
        }

        if (this.search == '') {
          this.searchResultNotFound = false;
          $(".not-found p").html('');
          this.getResults();
        }
      })
    },
  },
  mounted() {
    // this.loadLeads();
    this.getResults();

    this.breadcrumb = [
        {label: this.$t('sidebar.designs'), to: {name: 'designs-model'}},
        {label: this.$t('sidebar.logos'), active: true},
    ]
    // this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_logo')}
    this.btnModal = {label: this.$t('global.create') + ' ' + this.$t('sidebar.new_logo'), targetModal:this.modalId}

  },
  beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.logos')
        })
  }
};
