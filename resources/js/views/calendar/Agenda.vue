<style scoped>
@import "~@fullcalendar/core/main.css";
@import "~@fullcalendar/daygrid/main.css";
.fc-title {
  color: #fff;
}
.fc-title:hover {
  cursor: pointer;
}
</style>

<template>
  <div>
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <!-- .................... -->
          <!-- <a href="" class="only-trashed btn btn-danger btn-sm"
            @click.prevent="onlyTrashed" v-if="trashed_event">Only Trashed</a> -->

        <!-- <button @click="handleMonthIncrement">Next Month</button> -->
          <div class="col-auto d-flex my-4">
            <div class="align-self-center mr-auto">
              <router-link :to="{name: 'agenda-trashed'}" class="btn btn-danger btn-sm">Trashed Events</router-link>
            </div>
            <div class="input-group ml-auto w-25">
            <button class="btn btn-link nextSearchResult btn-sm" @click="nextResultS" hidden>
              <i class="fas fa-arrow-circle-left d-flex align-self-center text-dark" style="font-size: 1.2rem;"></i>
            </button>
              <input class="form-control form-control-sm w-50" id="searchInput" @keyup="searchEvent" v-model="search"
                  type="search" placeholder="Search" aria-label="Search">

              <div class="input-group-prepend input-group-sm">
                <div class="input-group-text">
                  <a href="" class="" @click.prevent="searchEvent">
                    <i class="fa fa-search" style="color:#fff;"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <div class="col-12">
          <!-- :header = "{
              left: 'title',
              center: 'dayGridMonth, timeGridWeek, timeGridDay, listWeek',
              right: 'today prev next'
            }" -->
          <Fullcalendar
            :plugins="calendarPlugins"
            :events="events"
            :selectable = "true"
            :editable = "true"
            :header = "{
              center: 'title',
              right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
              left: 'prev,next today'
            }"
            @eventClick="showEvent"
            @select="handleSelect"
            @eventDrop="handleEventDrop"


            ref="fullCalendar"
            defaultView="dayGridMonth"
            :options="calendarOptions"
            :weekends="calendarWeekends"
            @eventResize="eventResize"
            navLinks="true"
            timeZone="UTC"

            @event-deleted="rerenderCalendar"
            id="calendar"
          />
        </div>
      </div>
    </div>


    <!-- AgendaModal -->
    <!-- Modal -->
    <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <form @submit.prevent>
            <div class="form-group">
              <label for="event_name">Event Name</label>
              <input type="text" id="event_name" class="form-control" v-model="newEvent.event_name">
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="start_date">Start Date</label>
                  <input
                    type="date"
                    id="start_date"
                    class="form-control"
                    v-model="newEvent.start_date"
                  >
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="end_date">End Date</label>
                  <input type="date" id="end_date" class="form-control" v-model="newEvent.end_date">
                </div>
              </div>
              <div class="col-md-6 mb-4" v-if="addingMode">
                <button class="btn btn-sm btn-primary" @click="addNewEvent">Save Event</button>
              </div>
              <template v-else>
                <div class="col-md-6 mb-4">
                  <button class="btn btn-sm btn-success" @click="updateEvent">Update</button>
                  <button class="btn btn-sm btn-danger" @click="deleteEvent">Delete</button>
                  <!-- <button class="btn btn-sm btn-secondary" @click="addingMode = !addingMode">Cancel</button> -->
                  <button class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
              </template>
            </div>
          </form>


          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->

  </div>
</template>

<script>
import Fullcalendar from "@fullcalendar/vue";
import DayGridPlugin from "@fullcalendar/daygrid";
import InteractionPlugin from "@fullcalendar/interaction";
import TimeGridPlugin    from '@fullcalendar/timegrid'
import ListPlugin        from '@fullcalendar/list'
import moment from 'moment'
import axios from "axios"

import "@fullcalendar/core/main.css"
import "@fullcalendar/daygrid/main.css"
import "@fullcalendar/timegrid/main.css"

export default {
  components: {
    Fullcalendar
  },
  data() {
    return {
      urlModel: '/agenda',
      trashed_event: false,
      search: '',

      calendarPlugins: [DayGridPlugin, InteractionPlugin, TimeGridPlugin, ListPlugin],
      events: "",
      newEvent: {
        event_name: "",
        start_date: "",
        end_date: ""
      },
      addingMode: true,
      indexToUpdate: "",
      nextEventSearch: 0,



      /* Full Calendar Options Start */
      calendarWeekends: true,
      calendarOptions: {
          eventLimit: true,
          views: {
              timeGrid: {
                  eventLimit: 4
              },
              monthGrid: {
                  eventLimit: 4
              },
              dayGrid: {
                  eventLimit: 4,
              }
          },
      },
      /* Full Calendar Options End */
    };
  },
  created() {
    this.getEvents();


    Fire.$on('searching', () => {
      let query = this.search;
      axios.get('/agenda/find-event?q=' + query)
      .then((data) => {
        this.events = data.data.data;

        $(".nextSearchResult").attr("hidden", false);

        // let calendarApi = this.$refs.fullCalendar.getApi();
        // calendarApi.gotoDate( this.events[this.events.length-1].start )
      })
      .catch(() => {

      });
    });
  },
  methods: {
    nextResultS: function(e) {
      let calendarApi = this.$refs.fullCalendar.getApi();
      Fire.$emit('searching');
      // console.log(this.events.length);
      if(this.nextEventSearch < this.events.length)
      {

        calendarApi.gotoDate( this.events[this.nextEventSearch].start )
        this.nextEventSearch += 1;
        console.log("tttt");

      }else{
        console.log("ppp");

        $(".nextSearchResult").attr("disabled", true);
      }

    },

    handleMonthIncrement: function(arg) {
      // update calendar
      let calendarApi = this.$refs.fullCalendar.getApi();
      // calendarApi.next();
      // calendarApi.prevYear();
      // calendarApi.gotoDate( '2018-06-01' )
    },

    searchEvent() {
      Fire.$emit('searching');
    },

    handleEventDrop(e){
      const { id, title, start, end } = this.events.find(
        event => event.id === +e.event.id
      );
      let updatedEventData = {
        event_name: title,
        start_date: this.formatDashDate(e.event.start),
        end_date: this.formatDashDate(e.event.end)
      }
      axios.put(this.urlModel + '/' + e.event.id, updatedEventData)
        .then( ({data}) => {
          console.log('Event has been updated.');
        })
        .catch( error => {
          e.revert()
          console.log('Oops, something bad happened while updating your event.');
        })
    },
    formatDate(date) {
      return moment.utc(date).format('DD/MM/YY HH:mm')
    },
    formatDashDate(date) {
      return moment.utc(date).format('YYYY-MM-DD')
    },
    eventResize(e) {
      const { id, title, start, end } = this.events.find(
        event => event.id === +e.event.id
      );

      let updatedEventData = {
        event_name: title,
        start_date: this.formatDashDate(e.event.start),
        end_date: this.formatDashDate(e.event.end)
      }
      axios.put(this.urlModel + '/' + e.event.id, updatedEventData)
        .then( ({data}) => {
          console.log('Appointment duration updated.');
        })
        .catch( error => {
          e.revert()
          console.log('Oops, couldn\'t update appointment duration. Sorry.');
        })
    },
    rerenderCalendar() {
      this.$refs.fullCalendar.getApi().refetchEvents()
    },




    handleSelect(arg) {
      this.addingMode = true;
      this.resetForm();
      $("#eventModal").modal("show");
      $("#eventModal h5").html("Create Event");
    },
    addNewEvent() {
      axios
        .post(this.urlModel, {
          ...this.newEvent
        })
        .then(data => {
          this.getEvents(); // update our list of events
          $("#eventModal").modal("hide");
        })
        .catch(err =>
          console.log("Unable to add new event!", err.response.data)
        );
    },
    showEvent(arg) {
      $("#eventModal").modal("show");
      $("#eventModal h5").html("Update Event");
      this.addingMode = false;
      const { id, title, start, end } = this.events.find(
        event => event.id === +arg.event.id
      );
      this.indexToUpdate = id;
      this.newEvent = {
        event_name: title,
        start_date: start,
        end_date: end
      };
    },
    updateEvent() {
      axios
        .put(this.urlModel + '/' + this.indexToUpdate, {
          ...this.newEvent
        })
        .then(res => {
          console.log(res);
          $("#eventModal").modal("hide");
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to update event!", err.response.data)
        );
    },
    deleteEvent() {
      axios
        .delete(this.urlModel + '/' + this.indexToUpdate)
        .then(resp => {
          console.log(resp.data);

          $("#eventModal").modal("hide");
          this.getEvents();
          this.addingMode = !this.addingMode;
        })
        .catch(err =>
          console.log("Unable to delete event!", err.response.data)
        );
    },
    getEvents() {
      axios
        .get(this.urlModel)
        .then(resp => {
          this.events = resp.data.calendar;

          if(resp.data.trashed != 0){
            this.trashed_event = true;
          }
        })
        // .then(resp => (this.events = resp.data.data))
        .catch(err => console.log(err.response.data));
    },
    resetForm() {
      Object.keys(this.newEvent).forEach(key => {
        return (this.newEvent[key] = "");
      });
    }
  },
  watch: {
    indexToUpdate() {
      return this.indexToUpdate;
    }
  }
};
</script>
