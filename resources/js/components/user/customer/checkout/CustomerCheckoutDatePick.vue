<template>
  <div class="md:flex">
    <div class="flex flex-col justify-center md:w-1/2">
      <div class="relative flex justify-center mb-5">
        <div
          name="employee"
          class="flex flex-row items-center w-10/12 px-3 py-2 text-base text-gray-900 bg-white border-2 rounded-lg cursor-pointer  border-primary-400 focus:outline-none focus:border-indigo-500"
          id="employee"
          @click="showDropdown = !showDropdown"
        >
          <div class="flex flex-row items-center">
            <img
              v-if="selectedEmployee.profile_picture"
              class="object-cover object-center w-8 h-8 mr-3 rounded-full"
              :src="selectedEmployee.profile_picture"
              alt=""
            />
            <img
              v-esle
              class="object-cover object-center w-8 h-8 mr-3 rounded-full"
              src="/images/profile_placeholder.png"
              alt=""
            />
            {{ selectedEmployee.first_name }} {{ selectedEmployee.last_name }}
          </div>
          <i class="ml-auto cursor-pointer fa fa-chevron-down"></i>
        </div>
        <div
          v-if="showDropdown"
          class="absolute z-50 w-10/12 bg-white shadow cursor-pointer  md:top-20 top-14 lg:top-14 xl:left-8 2xl:left-12 left-7 md:left-5"
        >
          <div
            class="flex flex-row items-center w-full px-3 py-2 transition-all duration-300 rounded-lg cursor-pointer  hover:bg-gray-300"
            @click="selectEmployee(employee)"
            :value="employee.id"
            v-for="employee in employees"
            :key="employee.id"
          >
            <img
              class="object-cover object-center w-8 h-8 mr-3 rounded-full cursor-pointer "
              :src="employee.profile_picture"
              alt=""
              v-if="employee.profile_picture"
            />
            <img
              v-else
              class="object-cover object-center w-8 h-8 mr-3 rounded-full cursor-pointer "
              src="/images/profile_placeholder.png"
              alt=""
            />
            {{ employee.first_name }} {{ employee.last_name }}
          </div>
        </div>
      </div>
      <div>
        <vc-date-picker
          class="m-auto"
          v-model="booking.date"
          :disabled-dates="{ weekdays: [1] }"
          :min-date="new Date()"
        />
      </div>
    </div>

    <div class="mt-10 overflow-y-scroll md:w-1/2 h-96 lg:mt-0">
      <table class="w-full h-10 rounded shadow-md overflow-h-scroll">
        <thead class="sticky top-0 block" scope="col">
          <tr class="flex text-left">
            <th
              scope="col"
              class="w-full p-4 font-normal bg-white border border-gray-300"
            >
              <h4 class="u-slab">
                {{ selectedEmployee.first_name }}
                {{ selectedEmployee.last_name }}
              </h4>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr class="flex text-left">
            <th
              scope="col"
              class="flex flex-col w-full border border-t-0 border-gray-300"
            >
              <ul>
                <li
                  v-for="(item, index) in timeBlocks"
                  :key="index"
                  :class="
                    checkSelectedTime(item) ? 'bg-gray-200 hour-selected' : ''
                  "
                  @click="addTime(item)"
                  class="flex flex-wrap items-center justify-between p-4 mb-4 text-gray-500 cursor-pointer  sm:no-wrap hover:bg-gray-200"
                >
                  <p class="mr-auto font-normal hour u-slab text-md md:text-xl">
                    {{ item | moment("HH:mm") }}
                  </p>
                  <p class="u-slab md:text-xl text-md text-primary-400">
                    €{{ bookingTotalPrice() }}
                  </p>
                </li>
              </ul>
            </th>
          </tr>
        </tbody>
      </table>
      <span v-if="timeBlocks == ''"
        >Es gibt keine verfügbaren Stunden für diesen Mitarbeiter</span
      >
    </div>
  </div>
</template>
<script>
import moment from "moment";

export default {
  props: {
    employees: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {
      showDropdown: false,
      selectedEmployee: null,
      booking: {
        services: [],
        employee: this.employees[0].id,
        employee_name: this.employees[0].first_name,
        date: moment().format(),
        total_price: 0,
        total_duration: 0,
        time: "",
      },
      timeBlocks: [],
    };
  },
  watch: {
    booking: {
      handler() {
        this.$emit("updateBooking", this.booking);
      },
      deep: true,
      immediate: true,
    },
    "booking.employee": {
      handler(val) {
        this.selectedEmployee = this.employees.filter((employee) => {
          return employee.id == val;
        })[0];
        this.getEmployeeAvailableTime(this.selectedDate);
      },
      immediate: true,
    },
    "booking.date": {
      async handler(val) {
        let date = moment(val).format("l LT");
        this.selectedDate = date;
        this.getEmployeeAvailableTime(date);
      },
      immediate: true,
    },
    // "booking.total_duration": {
    //   async handler(val) {
    //     this.getEmployeeAvailableTime(this.selectedDate);
    //   },
    //   immediate: true,
    // },
  },
  methods: {
    selectEmployee(employee) {
      this.booking.employee = employee.id;
      this.selectedEmployee = employee;
      this.showDropdown = !this.showDropdown;
    },
    // Calculates total price of booking
    bookingTotalPrice() {
      let totalPrice = 0;

      this.booking.services.forEach((service) => {
        totalPrice += service.price;
      });

      return totalPrice;
    },
    // Calculates total duration of booking
    bookingTotalDuration() {
      let totalTime = 0;
      this.booking.services.forEach((service) => {
        totalTime += service.duration;
      });

      return totalTime;
    },
    // Changes timelist element class
    checkSelectedTime(item) {
      let booking_datetime = moment(this.booking.time).format(
        "YYYY-MM-DD HH:mm"
      );
      let current_datetime = moment(item).format("YYYY-MM-DD HH:mm");

      if (booking_datetime == current_datetime) {
        return true;
      } else {
        return false;
      }
    },
    // Get employee available hours as per date
    async getEmployeeAvailableTime(date) {
      let response = await this.axios.get(
        `/dashboard/employees/${this.selectedEmployee.id}/available-hours?date=${date}&duration=${this.booking.total_duration}`
      );

      let workingHours = response.data.data;
      var result = [];
      workingHours.forEach((workingHour) => {
        var current = moment(workingHour);
        result.push(current.format("YYYY-MM-DD HH:mm"));
      });
      this.timeBlocks = [...result];
    },
    addTime(item) {
      this.booking.time = item;
    },
  },
  mounted() {
    // Booking calculations
    this.booking.services = JSON.parse(localStorage.getItem("services"));
    this.booking.total_price = this.bookingTotalPrice();
    this.booking.total_duration = this.bookingTotalDuration();
  },
};
</script>