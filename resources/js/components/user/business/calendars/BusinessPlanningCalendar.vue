<template>
  <div>
    <!-- Employee selector -->
    <select
      name="employee"
      id=""
      v-model="selectedEmployee"
      @change="getEmployeeWorkingHours"
    >
      <option value="all" selected>Alle</option>
      <option
        v-for="employee in employees"
        :key="employee.id"
        :value="employee"
      >
        {{ employee.first_name }} {{ employee.last_name }}
      </option>
    </select>
    <!-- Calendar -->
    <vue-cal
      :time-from="6 * 60"
      :time-to="23 * 60"
      :disable-views="['years', 'year', 'month', 'day']"
      :hide-weekdays="[7]"
      :events="events"
      locale="de"
      :on-event-click="deleteEvent"
    >
    </vue-cal>
    <!-- Delete confirmation dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>

    <!-- Employee planning form -->
    <div class="p-5 mt-8 border" v-if="selectedEmployee != 'all'">
      <div class="font-sans">
        <a
          href="#"
          class="text-base font-bold no-underline  lg:text-sm text-primary-400 hover:underline"
          >Mitarbeiterplanung</a
        >
        <h1 class="pt-6 font-sans text-xl text-gray-900 break-normal"></h1>
        <hr class="border-b border-secondary-400" />
        <p class="px-5 py-2 text-white bg-primary-400">Zeiten hinzufügen</p>
        <div class="flex flex-col flex-wrap xl:flex-row">
          <div class="mt-5 xl:w-1/4">
            <label class="mr-5" for="">Startdatum / Uhrzeit</label>
          </div>
          <div class="xl:mt-5 xl:w-1/4">
            <vc-date-picker v-model="startDateTime" mode="dateTime" is24hr>
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="px-2 py-1 border rounded  focus:outline-none focus:border-blue-300"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </vc-date-picker>
          </div>
          <div class="mt-5 xl:my-5 xl:w-1/4">
            <label class="mr-5" for="">Enddatum / Uhrzeit</label>
          </div>
          <div class="xl:my-5 xl:w-1/4">
            <vc-date-picker v-model="endDateTime" mode="dateTime" is24hr>
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="px-2 py-1 border rounded  focus:outline-none focus:border-blue-300"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </vc-date-picker>
          </div>
          <div class="mt-5 xl:mt-0">
            <label for="multiple">Mehrere Tage</label>
            <input type="checkbox" id="multiple" v-model="multiple" />
          </div>

          <div class="flex w-full">
            <div class="ml-auto">
              <button
                @click="addTimeForEmployee"
                class="px-6 py-2 mr-5 font-bold border rounded-lg  bg-primary-400 hover:bg-primary-400 hover:text-white border-primary-400"
                :disabled="disabledAddTimeButton"
              >
                Add
              </button>
            </div>
          </div>
          <div
            class="w-full px-4 py-3 mt-2 text-green-900 bg-green-100 border-t-4 border-green-500 rounded-b shadow-md "
            role="alert"
            v-if="response.status == 200"
          >
            <div class="flex">
              <div class="py-1">
                <svg
                  class="w-6 h-6 mr-4 text-teal-500 fill-current"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                  />
                </svg>
              </div>
              <div>
                <p class="text-sm">
                  {{ response.message }}
                </p>
              </div>
            </div>
          </div>
        </div>
        <p class="px-5 py-2 mt-5 text-white bg-red-400">Zeiten entfernen</p>
        <div class="flex flex-col flex-wrap xl:flex-row">
          <div class="mt-5 xl:w-fit">
            <label class="mr-5" for="">den Zeitraum von</label>
          </div>
          <div class="xl:mt-5 xl:w-1/4">
            <vc-date-picker v-model="removeDateStart" mode="date" is24hr>
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="px-2 py-1 border rounded  focus:outline-none focus:border-blue-300"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </vc-date-picker>
          </div>
          <div class="mt-5 xl:my-5 xl:w-fit">
            <label class="mr-5" for="">bis</label>
          </div>
          <div class="xl:my-5 xl:w-1/4">
            <vc-date-picker v-model="removeDateEnd" mode="date" is24hr>
              <template v-slot="{ inputValue, inputEvents }">
                <input
                  class="px-2 py-1 border rounded  focus:outline-none focus:border-blue-300"
                  :value="inputValue"
                  v-on="inputEvents"
                />
              </template>
            </vc-date-picker>
          </div>
          <!-- <div class="mt-5 xl:mt-0">
            <label for="multiple">Multiple days</label>
            <input type="checkbox" id="multiple" v-model="multiple" />
          </div> -->

          <div class="flex w-full">
            <div class="ml-auto">
              <button
                @click="removeTimeForEmployee"
                class="px-6 py-2 mr-5 font-bold text-white bg-red-400 border rounded-lg  hover:bg-red-700 hover:text-white border-primary-400"
                :disabled="disabledRemoveTimeButton"
              >
                entfernen
              </button>
            </div>
          </div>
          <div
            class="w-full px-4 py-3 mt-2 text-red-900 bg-red-100 border-t-4 border-red-500 rounded-b shadow-md "
            role="alert"
            v-if="removeResponse.status == 200"
          >
            <div class="flex">
              <div class="py-1">
                <svg
                  class="w-6 h-6 mr-4 text-teal-500 fill-current"
                  xmlns="http://www.w3.org/2000/svg"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
                  />
                </svg>
              </div>
              <div>
                <p class="text-sm">
                  {{ removeResponse.message }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
import moment from "moment";
import "vue-cal/dist/i18n/de.js";

export default {
  props: {
    employees: {
      type: Array,
      required: true,
    },
  },
  components: { VueCal },
  data() {
    return {
      selectedEmployee: "all",
      startDateTime: new Date(),
      endDateTime: new Date(),
      multiple: false,
      removeDateStart: new Date(),
      removeDateEnd: new Date(),
      disabledAddTimeButton: false,
      disabledRemoveTimeButton: false,
      response: {
        message: "",
        status: null,
      },
      removeResponse: {
        message: "",
        status: null,
      },
      events: [],
    };
  },
  methods: {
    async deleteEvent(event, e) {
      // this.selectedEvent = event;
      console.log(event);
      this.$confirm({
        message: `Are you sure you want to delete this time for ${event.title}?`,
        button: {
          no: "No",
          yes: "Yes",
        },
        callback: async (confirm) => {
          if (confirm) {
            try {
              let response = await this.axios.delete(
                `/dashboard/employees/${event.employee_id}/working-hours`,
                { data: { workingHoursId: event.id } }
              );

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
          start: event.start,
          end: event.end,
          title: event.employee_name,
          class: event.class,
          background: event.background,
        };
      });

      return normalizedEvents;
    },
    async getEmployeeWorkingHours() {
      if (this.selectedEmployee == "all") {
        var response = await this.axios.get(
          "/dashboard/employees/working-hours"
        );
      } else {
        var response = await this.axios.get(
          `/dashboard/employees/${this.selectedEmployee.id}/working-hours`
        );
      }

      this.events = this.normalizeEvents(response.data.data);
    },
    async addTimeForEmployee() {
      this.disabledAddTimeButton = true;

      let event = {
        startDateTime: this.startDateTime,
        endDateTime: this.endDateTime,
        title: this.selectedEmployee.name,
        class: `event-${this.selectedEmployee.id}`, // Creating generic classes
      };
      if (this.multiple) {
        console.log("multiple event", event);

        let endTime = moment(this.endDateTime).format("hh:mm:ss a");
        let startDate = moment(this.startDateTime).format("YYYY-MM-DD");

        console.log("START", startDate);
        let currentEndDate = moment(`${startDate} ${endTime}`).format(
          "YYYY-MM-DD HH:mm"
        );

        console.log("startDateTime", this.startDateTime);
        console.log(
          "startDateTime2",
          this.startDateTime.format("YYYY-MM-DD HH:mm")
        );
        event = {
          startDateTime: this.startDateTime.format("YYYY-MM-DD HH:mm"),
          endDateTime: currentEndDate,
          title: this.selectedEmployee.name,
          class: `event-${this.selectedEmployee.id}`, // Creating generic classes
        };

        console.log("first event", event);

        this.createEvent(event);

        let amountOfDays = Math.abs(
          moment(this.startDateTime).diff(this.endDateTime, "days")
        ); // =1

        let currentStartDate = this.startDateTime;

        for (let i = 0; i <= amountOfDays; i++) {
          currentStartDate = moment(currentStartDate).add(1, "days").format();
          currentEndDate = moment(currentEndDate).add(1, "days").format();

          event = {
            startDateTime: currentStartDate,
            endDateTime: currentEndDate,
            title: this.selectedEmployee.name,
            class: `event-${this.selectedEmployee.id}`, // Creating generic classes
          };

          this.createEvent(event);
        }
      } else {
        console.log("event", event);

        this.createEvent(event);
      }

      this.response.message = "Zeiten erfolgreich hinzugefügt";
      this.response.status = 200;

      setInterval(() => {
        this.disabledAddTimeButton = false;
      }, 3000);
    },
    async removeTimeForEmployee() {
      let timeRangeToDelete = {
        start: this.removeDateStart.format("YYYY-MM-DD"),
        end: this.removeDateEnd.format("YYYY-MM-DD"),
      };
      try {
        let response = await this.axios.post(
          `/dashboard/employees/${this.selectedEmployee.id}/working-hours/mass-deletion`,
          timeRangeToDelete
        );
        this.removeResponse.message = response.data.message;
        this.removeResponse.status = response.status;
        setTimeout(function () {
          window.location.reload();
        }, 1000);
      } catch (error) {
        console.log("error", error);
        this.removeResponse.message = error.response.data.message;
        this.removeResponse.status = error.response.status;
      }
    },
    async createEvent(event) {
      try {
        event.startDateTime = moment(event.startDateTime).format("LLL");
        event.endDateTime = moment(event.endDateTime).format("LLL");

        let response = await this.axios.post(
          `/dashboard/employees/${this.selectedEmployee.id}/working-hours`,
          event
        );

        this.events = this.normalizeEvents(response.data.data);
      } catch (error) {
        console.log("tzhere has been an error", error);
      }
    },
  },

  mounted() {
    this.getEmployeeWorkingHours();
  },
};
</script>
<style lang="css">
.vuecal__event {
  display: flex;
  flex-direction: column;
  align-content: center;
  justify-content: center;
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
