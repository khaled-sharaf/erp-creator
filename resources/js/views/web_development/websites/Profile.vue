<style scoped>
  /* .item-container{
    width: 90vw;
    margin: 0 auto;
    max-width: 1170px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    grid-column-gap: 1.5rem;
    grid-row-gap: 2rem;
  } */
  .item-container.row{
    display: inline-flex;
    margin: auto;
  }
  .breadcrumb {
    margin: 50px 10px 20px;
    padding: 0.6rem;
  }
  .docsBtn.btn{
    text-align: left;
    border: 1px solid #e9ecef;
    background-color: #e9ecef;
  }
  .docsBtn.btn-link {
    font-weight: 600;
    color: #425569eb;
  }
  .fa-1x{
    font-size: .8rem;
  }
  @media (max-width: 320px) {
    .item-container.row .card{
      width: 17rem !important;
    }
  }
</style>
<template>
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-between font-weight-bold fa-1x">
          <div class="d-flex">
            <li class="breadcrumb-item"><router-link to="/web_development/websites">{{ $t('sidebar.web_development') }}</router-link></li>
            <li class="breadcrumb-item"><router-link to="/web_development/websites">{{ $t('sidebar.websites') }}</router-link></li>
            <li class="breadcrumb-item active" aria-current="page">{{lead_name}}</li>
          </div>
          <button type="button" v-if="checkItems.length > 0" class="btn btn-danger btn-sm text-white" @click="deleteItems">
            {{ $t('sidebar.delete_selected_items') }}
          </button>
        </ol>
      </nav>

      <!-- <template>
        <VueDocPreview :value="value" :type="type" />
      </template> -->
<!-- style="margin-top:5rem;" -->
      <div class="container-fluid">
        <div class="item-container row">
          <!-- <div v-for="item in website" :key="item.id"> -->
          <div v-for="(item, index) in website" :key="index">
            <div class="col-md-3">
              <div class="card" style="width: 18rem;">
                <!-- Button trigger modal -->
                <button type="button" class="docsBtn btn btn-link" @click="showDocs(item, index)">
                  {{item.document |subDocs}}
                </button>
                <div class="card-body">
                  <div class="d-flex">
                    <input v-model="checkItems" :value="item.id" name="delete-website"
                      type="checkbox" class="align-self-center mr-2">
                    <p class="card-text">{{item.website_name}}</p>
                  </div>
                  <div class="d-block">
                    <div v-for="(user, index) in users[index]" :key="index">
                      <a href="" @click.prevent="">{{user.name | capitalize}}</a>
                    </div>
                    <div class="float-right">
                      <relative-date :date="item.created_at"></relative-date>
                    </div>
                    <div class="clearfix"></div>
                  </div>
                </div>
              </div>
            </div>
            <!-- flex-container-responsive -->
          </div>
          <!-- For loop End -->
        </div>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="docsModalLong" tabindex="-1" role="dialog" aria-labelledby="docsModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="docsModalLongTitle">View Document</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <template>
                <VueDocPreview :value="value[website_id]" :type="type" />
              </template>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>



    </div>
</template>


<script>
import VueDocPreview from 'vue-doc-preview'

export default {
    data() {
      return {
        urlModel: '/websites',
        website: {},
        users: [],
        lead_name: '',
        checkItems: [],

        website_id: '',

        value: "",
        type: "code",

        idPage: 'websites',
        typePage: 'delete',
        // deleteBtn: false
      }
    },
    filters: {
      subDocs: function(docs) {
        return docs.substring(21);
      }
    },
    components: {
      VueDocPreview
    },
    methods: {
      loadWebsite(){
        axios.get(this.urlModel + '/' + this.$route.params.id).then(({data}) => {
          // console.log(data);

          this.lead_name = data.lead_name;
          this.website = data.websites;
          this.users = data.users;

          // this.value = data.docs[2];
          this.value = data.docs;

        });
      },
      deleteItems(){
        if(this.checkItems == ''){
          Swal.fire(
            '',
            'You have to select items first ?',
            'question'
          )
        }
        else{
          Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
            if (result.value) {
              axios.post(this.urlModel + '/delete-selected-websites', {id: this.checkItems})
                .then(({data}) => {
                  console.log(data);

                  this.loadWebsite();
                  ToastReq.fire({
                      text: this.success_msg
                  })
                }).catch(() => {
                  ToastFailed.fire({
                      title: this.failed_title + "!",
                      text: this.failed_msg,
                  })
                });
            }
          });
        }
      },
      showDocs(item, index){
        $("#docsModalLong").modal('show');
        // console.log(item);
        // console.log(index);

        this.website_id = index;
      }
    },
    mounted() {
      this.loadWebsite();
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.website_profile')
        })
    }
}
</script>
