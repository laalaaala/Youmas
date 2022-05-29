<template>
  <div id="Customer-Calendar">
    <vue-cal
    locale="de"
      :time-from="6 * 60"
      :time-to="23 * 60"
      :disable-views="['years', 'year', 'month', 'day']"
      :hide-weekdays="[7]"
      :events="events"
      :on-event-click="viewEvent"
    >
    </vue-cal>
    <!-- Delete confirmation dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
    <div v-if="showViewModal">
      <div
        class="fixed top-0 left-0 w-screen h-full bg-black bg-opacity-50"
      ></div>
      <div
        class="fixed z-50 flex flex-col w-1/3 h-auto m-auto bg-red-400 shadow-md top-1/3 left-1/3"
      >
        <div class="flex items-center h-10 pl-5 bg-primary-400">
          <div
            class="flex flex-row items-center w-full h-10 pl-5 bg-primary-400"
          >
            <p class="text-lg text-secondary-400">
              Service: {{ selectedEvent.class }}
            </p>
            <button
              @click="showViewModal = false"
              class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md bg-primary-700 h-7"
            >
              X
            </button>
          </div>
        </div>
        <div class="pb-5 bg-white">
          <span
            class="flex flex-row items-center justify-center w-full mt-5 text-xl text-center "
          >
          </span>
          <div class="flex flex-row w-1/2 mx-auto mt-5">
            <span class="w-1/2 text-center text-md">
              Time Start: {{ selectedEvent.start | moment("hh:mm") }} hs
            </span>
            <span class="w-1/2 text-center text-md">
              Time End: {{ selectedEvent.end | moment("hh:mm") }}hs
            </span>
          </div>
          <div
            v-if="selectedEvent.status == 'pending'"
            class="flex items-center justify-center w-full"
          >
            <button
              class="px-6 py-2 mt-5 font-bold text-white bg-red-500 rounded-lg"
              @click="deleteEvent"
            >
              Buchung stornieren
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
import 'vue-cal/dist/i18n/de.js'


export default {
  props: {
    bookings: {
      type: Array,
      required: true,
    },
  },
  components: { VueCal },
  data() {
    return {
      selectedEvent: "",
      showViewModal: false,
      selectedEmployee: "all",
      startDateTime: new Date(),
      endDateTime: new Date(),
      events: [],
    };
  },
  methods: {
    viewEvent(event) {
      this.selectedEvent = event;
      this.showViewModal = true;
    },

    async deleteEvent(event, e) {
      // this.selectedEvent = event;
      console.log(event);
      this.$confirm({
        message: `Are you sure you want cancel the booking for ${event.title}?`,
        button: {
          no: "No",
          yes: "Yes",
        },
        callback: async (confirm) => {
          if (confirm) {
            console.log("selectedEvent", this.selectedEvent);
            let booking = this.selectedEvent;

            if (booking.transaction_id) {
              await fetch(
                `/dashboard/transactions/${booking.transaction_id}/refund/`,
                {
                  method: "POST",
                }
              );
            }

            await fetch(`/dashboard/bookings/${booking.id}`, {
              method: "PUT",
              headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
              },
              body: JSON.stringify({ status: "cancelled" }),
            });

            location.reload();
          }
        },
      });
    },
    normalizeEvents(events) {
      let normalizedEvents = events.map((event) => {

        return {
          id: event.id,
          employee_id: event.employee_id,
          transaction_id: event.transaction_id,
          start: event.start,
          end: event.end,
          title: event.title,
          class: event.class,
          background: event.background,
          status: event.status,
        };
      });

      return normalizedEvents;
    },
  },

  mounted() {
    this.events = this.normalizeEvents(this.bookings);
  },
};
</script>
<style lang="css">
#Customer-Calendar .vuecal__event {
  display: flex;
  flex-direction: column;
  align-content: center;
  justify-content: center;
  background-color: #f6cd3e;
  border: 1px solid #f6cd3e;
}

.vuecal__event.lunch {
  background: repeating-linear-gradient(
    45deg,
    transparent,
    transparent 10px,
    #f2f2f2 10px,
    #f2f2f2 20px
  ); /* IE 10+ */
  color: #999;
  display: flex;
  justify-content: center;
  align-items: center;
}
.vuecal__event.lunch .vuecal__event-time {
  display: none;
  align-items: center;
}

.vuecal__event.event-1 {
  background-color: rgba(253, 156, 66, 0.85);
  border: 1px solid #e9882e;
  color: #fff;
}

.vuecal__event.event-2 {
  background-color: #c2095a;
  border: 1px solid #c2095a;
  color: #fff;
}

.vuecal__event.event-3 {
  background-color: #17c3b2;
  border: 1px solid #17c3b2;
  color: #fff;
}

.vuecal__event.event-4 {
  background-color: #2f242c;
  border: 1px solid #2f242c;
  color: #fff;
}

.vuecal__event.event-5 {
  background-color: #688e26;
  border: 1px solid #688e26;
  color: #fff;
}

.vuecal__event.event-6 {
  background-color: #071e22;
  border: 1px solid #071e22;
  color: #fff;
}

.vuecal__event.event-7 {
  background-color: #d1d646(253, 156, 66, 0.85);
  border: 1px solid #d1d646;
  color: #fff;
}

.vuecal__title-bar {
  background-color: #f6cd3e;
}

.vuecal__menu {
  background-color: #f6cd3e;
}

.vuecal__event {
  cursor: pointer;
}
</style>
