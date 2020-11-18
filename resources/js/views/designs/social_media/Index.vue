<style scope>
  .card{
    border-radius: .55rem;
    background: #fff;
    margin-bottom: 30px !important;
    width: 100%;
    box-shadow: 0 1px 2px 0 rgba(0,0,0,0.1);
  }
  .folder{
    padding: 10px;
    display: block;
    color: #777;
  }
  .folder:hover{
    text-decoration: none;
  }
  .text-tab{
    padding-left: 10px;
  }
</style>

<template>
  <div>
    <header-comp :breadcrumb="breadcrumb" :btnCreate="btnCreate" :type="'button'" :data-toggle="'modal'" :data-target="'#leadCampaign'" :href="''">
    </header-comp>

    <section class="leads">
      <div class="container">
        <div class="row">

          <div v-for="item of leads" :key="item.id" class="col-md-3">
            <div class="card">
              <router-link :to="{path: 'social-media/' + item.id + '/profile'}" class="folder">
                <h6><i class="fa fa-folder ml-2"></i><span class="text-tab">{{item.name | capitalize}}</span></h6>
              </router-link>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="leadCampaign" tabindex="-1" role="dialog" aria-labelledby="leadCampaignLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leadCampaignLabel">{{ $t('sidebar.add_new_media') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createLeadCampaign">
            <!-- model-body -->
              <form-model typeForm="create" :form="form" :closeForm="closeForm"></form-model>
            <!-- ./model-body -->
          </form>

        </div>
      </div>
    </div>

  </div>
</template>

<script>
import MixinsDatatable from "./../../../mixins/MixinsDatatable"
import MixinChangeLocaleMessages from "./../../../mixins/MixinChangeLocaleMessages"
import FormModel from './Form'

export default {
    mixins: [MixinsDatatable, MixinChangeLocaleMessages],
    components: {
        FormModel,
    },
  data() {
    return {
      urlModel: '/design/social-media',
      leads: [],
      dataLeads: {},
      designers: {},
      form: new Form({
        media_name: '',
        lead_id: '',
        user_id: '',
        photo: '',
      }),
      breadcrumb: [],
      btnCreate: {},
      idPage: 'social_media',
      typePage: 'create',
    };
  },
  methods: {
    loadLeads(){
      loadReq(this.$Progress);
      axios.get(this.urlModel).then(({data}) => {
        // console.log(data);

        this.dataLeads = data.leads;
        this.designers = data.designers;
        data.leads.forEach(element => {
          if(element.social_medias != 0){
            this.leads.push(element);
          }
        });
      });
    },
    createLeadCampaign(){
      loadReq(this.$Progress);
      this.form.post(this.urlModel).then((e) => {
        $('#leadCampaign').modal('hide');
        this.form.reset();
        this.$router.push({name: 'social-media'});
        ToastReq.fire({
            text: this.success_msg
        })
      }).catch(() => {
        ToastFailed.fire({
            title: this.failed_title + "!",
            text: this.failed_msg,
        })
        this.$Progress.fail();
      });
    },
    closeForm(){
      this.form.reset();
    }
  },
  mounted() {
    this.loadLeads();
    this.breadcrumb = [
        {label: this.$t('sidebar.designs'), to: {name: 'designs-model'}},
        {label: this.$t('sidebar.social_media'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.add_new_media')}

  },
  beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.social_media')
        })
  }
};
</script>
