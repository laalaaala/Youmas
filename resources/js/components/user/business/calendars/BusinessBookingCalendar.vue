<template>
  <div>
    <div>
      <div class="flex flex-row justify-between mb-5">
        <select
          name="employee"
          id=""
          v-model="selectedEmployee"
          @change="getEmployeeBookings"
        >
          <option value="all" selected>All</option>
          <option
            v-for="employee in employees"
            :key="employee.id"
            :value="employee"
          >
            {{ employee.first_name }} {{ employee.last_name }}
          </option>
        </select>
        <button
          @click="showCreateModal = true"
          type="button"
          class="
            focus:outline-none
            text-white text-sm
            py-2.5
            px-5
            rounded-md
            bg-primary-400
            hover:bg-secondary-400 hover:shadow-lg
          "
        >
          Buchung erstellen
        </button>
      </div>
      <!-- Calendar -->
      <vue-cal
        :time-from="6 * 60"
        :time-to="23 * 60"
        locale="de"
        :disable-views="['years', 'year', 'month', 'day']"
        :hide-weekdays="[7]"
        :events="events"
        :on-event-click="viewEvent"
      >
      </vue-cal>
      <!-- Delete confirmation dialog -->
      <vue-confirm-dialog></vue-confirm-dialog>
    </div>
    <div v-if="showViewModal">
      <div
        class="fixed top-0 left-0 w-screen h-full bg-black bg-opacity-50"
      ></div>
      <div
        class="fixed z-50 flex flex-col w-1/3 h-auto m-auto bg-red-400 shadow-md  top-1/3 left-1/3"
      >
        <div class="flex items-center h-10 pl-5 bg-primary-400">
          <div
            class="flex flex-row items-center w-full h-10 pl-5 bg-primary-400"
          >
            <span
              class="font-bold"
              v-for="employee in employees"
              :key="employee.id"
            >
              <div v-if="employee.id == selectedEvent.employee_id">
                {{ selectedEvent.title }}, {{ employee.first_name }}
                {{ employee.last_name }}
              </div>
            </span>
            <button
              @click="showViewModal = false"
              class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md  bg-primary-700 h-7"
            >
              X
            </button>
          </div>
        </div>
        <div class="pb-5 bg-white">
          <span
            class="flex flex-row items-center justify-center w-full mt-5 text-xl text-center "
          >
            {{ customer.name }}
          </span>
          <span
            class="flex flex-row items-center justify-center w-full text-xl text-center "
          >
            {{ selectedEvent.start | moment("hh:mm") }} -
            {{ selectedEvent.end | moment("hh:mm") }}
          </span>
          <span
            class="flex flex-row items-center justify-center w-full text-xl text-center "
          >
            {{ customer.phone }}
          </span>
          <span
            class="flex flex-row items-center justify-center w-full mt-5 text-xl text-center capitalize "
          >
            {{ paymentStatus }}
            <i
              class="pl-2 fas"
              :class="[
                paymentStatus == 'bezahlt' || paymentStatus == 'completed'
                  ? 'fa-check text-green-400'
                  : '',
                paymentStatus == 'unbezahlt' ||
                paymentStatus == 'cancelled' ||
                paymentStatus == 'refunded'
                  ? 'fa-times text-red-400'
                  : '',
                paymentStatus == 'pending' || paymentStatus == 'aussteht'
                  ? 'fa-exclamation-triangle text-primary-400'
                  : '',
              ]"
            ></i>
          </span>
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
    <BusinessBookingCreateModal
      v-if="showCreateModal"
      @createBooking="createBooking"
      @closeCreateModal="closeModal"
      :business="user.business"
    />
  </div>
</template>

<script>
import BusinessBookingCreateModal from "./BusinessBookingCreateModal.vue";
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
import "vue-cal/dist/i18n/de.js";

export default {
  props: {
    user: {
      type: Object,
    },
    employees: {
      type: Array,
      required: true,
    },
  },
  components: { VueCal, BusinessBookingCreateModal },
  data() {
    return {
      customer: "",
      paymentStatus: "",
      selectedEvent: "",
      showCreateModal: false,
      showViewModal: false,
      selectedEmployee: "all",
      startDateTime: new Date(),
      endDateTime: new Date(),
      events: [],
    };
  },
  methods: {
    viewEvent(event) {
      console.log(event);
      if (!event.transaction_id) {
        this.paymentStatus = "unbezahlt";
      } else {
        this.getPaymentStatus(event.transaction_id);
      }
      this.getCustomerData(event.customer_id);
      this.selectedEvent = event;
      this.showViewModal = true;
    },
    async deleteEvent(event, e) {
      // this.selectedEvent = event;
      this.$confirm({
        message: `Wollen Sie die Buchung wirklich stornieren ${event.title}?`,
        button: {
          no: "Nein",
          yes: "Ja",
        },
        callback: async (confirm) => {
          if (confirm) {
            try {
              let refundResponse = await this.axios.post(
                `/dashboard/transactions/${this.selectedEvent.id}/refund/`
              );

              let response = await this.axios.delete(
                `/dashboard/employees/${this.selectedEvent.employee_id}/booked-hours`,
                { data: { bookingHoursId: this.selectedEvent.id } }
              );
              if (response.status == 200) {
                window.location.reload();
              }
              /**
               * Delete the element in local array
               */
              this.events = this.events.filter((item) => {
                return item.id != event.id;
              });
              // Prevent navigating to narrower view (default vue-cal behavior).
              e.stopPropagation();
            } catch (error) {
              console.log("error"), error;
            }
          }
        },
      });
    },
    normalizeEvents(events) {
      let normalizedEvents = events.map((event) => {
        return {
          id: event.id,
          employee_id: event.employee_id,
          customer_id: event.customer_id,
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
    async getCustomerData(id) {
      try {
        let response = await this.axios.get(`/businesses/customer/${id}`);
        this.customer = {
          name:
            response.data.customer_data.first_name +
            " " +
            response.data.customer_data.last_name,
          phone: response.data.user_data.phone,
        };
      } catch (error) {
        console.log("error", error);
      }
    },
    async getPaymentStatus(id) {
      try {
        let response = await this.axios.get(
          `/businesses/transaction/${id}/status`
        );
        this.paymentStatus = response.data.paymentStatus;
      } catch (error) {
        console.log("error", error);
      }
    },
    async getEmployeeBookings() {
      if (this.selectedEmployee == "all") {
        var response = await this.axios.get(
          "/dashboard/employees/booked-hours"
        );
      } else {
        var response = await this.axios.get(
          `/dashboard/employees/${this.selectedEmployee.id}/booked-hours`
        );
      }
      this.events = this.normalizeEvents(response.data.data);
    },
    async addTimeForEmployee() {
      let event = {
        startDateTime: this.startDateTime,
        endDateTime: this.endDateTime,
        title: this.selectedEmployee.name,
        class: `event-${this.selectedEmployee.id}`, // Creating generic classes
      };
      try {
        let response = await this.axios.post(
          `/dashboard/employees/${this.selectedEmployee.id}/booked-hours`,
          event
        );

        this.events = this.normalizeEvents(response.data.data);
      } catch (error) {
        console.log("there has been an error", error);
      }
    },
    closeModal() {
      this.showCreateModal = false;
    },

    createBooking() {},
  },

  mounted() {
    this.getEmployeeBookings();
  },
};
</script>
<style lang="css">
.vuecal__event {
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
