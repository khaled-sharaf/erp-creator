<style scoped>
  .table .btn-sm{
    font-size: .7rem;
  }
</style>
<template>
  <div>
    <router-link :to="{name: 'agenda'}" class="btn btn-secondary btn-sm">
      <i class="fas fa-arrow-left"></i>
    </router-link>

    <div class="container">
      <table class="table table-hover">
        <tbody>
          <tr v-for="(event, index) in trashed_events" :key="index">
            <th scope="row">{{index + 1}}</th>
            <td>{{event.event_name}}</td>
            <td>
              <button class="btn btn-success btn-sm">
                <i class="fas fa-redo text-white"></i>
              </button>
            </td>
            <td>
              <button class="btn btn-danger btn-sm">
                <i class="fas fa-trash-alt text-white"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>


  </div>
</template>

<script>
export default {
  data(){
    return {
      trashed_events: {},
    }
  },
  methods: {
    onlyTrashed(){
      axios.get('agenda/trashed')
        .then((resp) => {
            console.log(resp.data);
            this.trashed_events = resp.data;
        })
        .catch((err) => console.log(err.response.data));
    },

  },

  mounted() {
    this.onlyTrashed();
  },
}
</script>
