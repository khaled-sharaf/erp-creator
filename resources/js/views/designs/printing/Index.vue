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
    <header-comp :breadcrumb="breadcrumb" :btnCreate="btnCreate" :type="'button'" :data-toggle="'modal'" :data-target="'#leadPrinting'" :href="''">
    </header-comp>

    <section class="leads">
      <div class="container">
        <div class="row">

          <div v-for="item of leads" :key="item.id" class="col-md-3">
          <!-- <div v-for="(item, index) of leads" :key="item.id" class="col-md-3"> -->
            <div class="card">
              <router-link :to="{path: 'printing/' + item.id + '/profile'}" class="folder">
                <h6><i class="fa fa-folder ml-2"></i><span class="text-tab">{{item.name | capitalize}}</span></h6>
              </router-link>
            </div>

          </div>
        </div>
      </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="leadPrinting" tabindex="-1" role="dialog" aria-labelledby="leadPrintingLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="leadPrintingLabel">{{ $t('printing_table.add_new') }}</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <form @submit.prevent="createLeadPrinting">
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
      urlModel: '/design/printing',
      leads: [],
      dataLeads: {},
      designers: {},
      form: new Form({
        printing_name: '',
        lead_id: '',
        user_id: '',
        photo: '',
      }),
      breadcrumb: [],
      btnCreate: {},
      idPage: 'printing',
      typePage: 'create',
    };
  },
  methods: {

    loadLeads(){
      loadReq(this.$Progress);
      axios.get(this.urlModel).then(({data}) => {

        this.dataLeads = data.leads;
        this.designers = data.designers;
        data.leads.forEach(element => {

          if(element.printings != 0){
            this.leads.push(element);
          }
        });
      });
    },
    // itemDetails(id){
    //   this.$router.push(this.urlModel + "/" + id + "/profile");
    // },
    createLeadPrinting(){
      loadReq(this.$Progress);
      this.form.post(this.urlModel).then((e) => {
        // Fire.$emit('AfterCreate');
        $('#leadPrinting').modal('hide');

        this.$router.push({name: 'printing'});
        // this.$router.go(1);
        this.form.reset();

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
        {label: this.$t('printing_table.printing_name'), active: true},
    ]
    this.btnCreate = {label: this.$t('global.create') + ' ' + this.$t('sidebar.add_new_printing')}

  },
  beforeRouteEnter(to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('sidebar.printing_designs')
        })
  }
};
</script>
