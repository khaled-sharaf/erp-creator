<style scoped>
  .item-container{
    width: 90vw;
    margin: 0 auto;
    max-width: 1170px;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    grid-column-gap: 1.5rem;
    grid-row-gap: 2rem;
  }
  .fa-1x{
    font-size: .8rem;
  }
</style>
<template>
    <div>
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb justify-content-between font-weight-bold fa-1x">
          <div class="d-flex">
            <li class="breadcrumb-item"><router-link to="/designs/logos">{{ $t('sidebar.designs') }}</router-link></li>
            <li class="breadcrumb-item"><router-link to="/designs/social-media">{{ $t('sidebar.social_media') }}</router-link></li>
            <li class="breadcrumb-item active" aria-current="page">{{lead_name}}</li>
          </div>
          <button type="button" class="btn btn-danger btn-sm text-white" @click="deleteItems">
            {{ $t('sidebar.delete_selected_items') }}
          </button>
        </ol>
      </nav>
      <div class="" style="margin-top:5rem;">
        <div class="item-container">
          <div v-for="item in medias" :key="item.id">
            <div class="card" style="width: 18rem;">
              <img class="card-img-top image designer" :src="$domain + item.photo" alt="items">
              <div class="card-body">
                <div class="d-flex">
                  <input v-model="checkItems" :value="item.id" name="delete-items" type="checkbox" class="align-self-center mr-2">
                  <p class="card-text">{{item.media_name}}</p>
                </div>
                <div class="d-flex justify-content-between">
                  <a href="" @click.prevent="">{{item.user.name | capitalize}}</a>
                  <relative-date :date="item.created_at"></relative-date>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</template>


<script>
export default {
    data() {
      return {
        urlModel: '/design/social-media',
        medias: {},
        lead_name: '',
        checkItems: [],
      }
    },
    methods: {
      loadMedia(){
        axios.get(this.urlModel + '/' + this.$route.params.id).then(({data}) => {
          this.lead_name = data.lead_name;
          this.medias = data.socialMedias;
        });
      },
      deleteItems(){
        if(this.checkItems == ''){
          Swal.fire(
            '',
            'You have to select items first ?',
            'question'
          )
        }else{
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
              axios.post(this.urlModel + '/delete-selected-media', {id: this.checkItems})
                .then(({data}) => {
                  // console.log(data);

                  this.loadMedia();
                  ToastReq.fire({
                    type: 'success',
                    title: 'Your items has been deleted.'
                  });
                }).catch(() => {
                  ToastFailed.fire({
                    type: 'error',
                    text: 'An error has been cought',
                  });
                });
            }
          });
        }
      }
    },
    mounted() {
      this.loadMedia();
    },
    beforeRouteEnter (to, from, next) {
        next(vm => {
            to.meta.title = vm.$t('global.social_media')
        })
    }
}
</script>
