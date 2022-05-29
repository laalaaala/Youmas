<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <section class="lg:py-20">
          <div
            class="container w-full h-full max-w-2xl mx-auto shadow-md lg:w-3/4"
          >
            <div class="flex items-center h-10 pl-5 bg-primary-400">
              <p class="text-lg text-tertiary-400">Buchungserstellung</p>
              <button
                @click="closeModal"
                class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md bg-primary-700 h-7"
              >
                X
              </button>
            </div>

            <div class="space-y-0 bg-white">
              <div
                class="flex flex-wrap items-center w-full p-4 text-gray-500 lg:inline-flex lg:space-y-4 flex-rwo"
              >
                <div
                  class="flex flex-row mx-auto space-x-4 space-y-0 lg:w-full"
                >
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Dienstleitung</label>

                    <BookingServiceMultiSelect
                      @addService="addService"
                      :services="services"
                      :business="business"
                    />
                    <p class="text-red-400" v-if="false">
                      This file is required
                    </p>
                  </div>
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Mitarbeiter</label>
                    <div class="inline-flex w-full border">
                      <div class="w-2/12 py-2 text-center bg-gray-100">
                        <i class="fas fa-user"></i>
                      </div>

                      <select v-model="form.employee" class="w-full bg-white">
                        <option
                          :value="employee.id"
                          v-for="employee in employees"
                          :key="employee.id"
                        >
                          {{ employee.first_name }} {{ employee.last_name }}
                        </option>
                      </select>
                    </div>
                    <!-- <p
                      class="text-red-400"
                      v-if="this.errors.duration.required"
                    >
                      This file is required
                    </p> -->
                  </div>
                </div>
                <div
                  class="flex flex-row mx-auto mt-3 space-x-4 space-y-0 lg:w-full"
                >
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Startdatum</label>
                    <div class="inline-flex w-full">
                      <vc-date-picker
                        v-model="form.start_date"
                        mode="dateTime"
                        is24hr
                      >
                        <template v-slot="{ inputValue, inputEvents }">
                          <input
                            class="px-2 py-1 border rounded focus:outline-none focus:border-blue-300"
                            :value="inputValue"
                            v-on="inputEvents"
                          />
                        </template>
                      </vc-date-picker>
                    </div>
                    <!-- <p class="text-red-400" v-if="this.errors.price.required">
                      This file is required
                    </p> -->
                  </div>
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">End date</label>
                    <div class="inline-flex w-full border">
                      <input
                        v-model="form.end_date"
                        type="datetime-local"
                        id="birthdaytime"
                        name="birthdaytime"
                        disabled
                      />
                    </div>
                    <!-- <p
                      class="pl-4 text-red-400"
                      v-if="this.errors.subcategory.required"
                    >
                      Please select a category
                    </p> -->
                  </div>
                </div>
              </div>

              <hr />

              <div class="w-full p-4 text-right text-gray-500">
                <button
                  class="
                    inline-flex
                    items-center
                    mr-4
                    focus:outline-none
                    text-tertiary-400
                    hover:text-white
                    text-sm
                    py-2.5
                    px-5
                    rounded-md
                    bg-primary-400
                    hover:bg-secondary-400 hover:shadow-lg
                  "
                  @click="createBooking"
                >
                  erstellen
                </button>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </transition>
</template>

<script>
import BookingServiceMultiSelect from "./BookingServiceMultiSelect";
import moment from "moment";

export default {
  props: {
    business: Object,
  },
  components: {
    BookingServiceMultiSelect,
  },
  data() {
    return {
      employees: [],
      services: [],
      form: {
        employee: null,
        service: null,
        service_duration: null,
        start_date: null,
        end_date: null,
      },
    };
  },
  watch: {
    "form.start_date": {
      handler() {
        let date = moment(this.form.start_date)
          .add(this.form.service_duration, "minutes")
          .format("YYYY-MM-DDTHH:mm");
        console.log("date", date);
        this.form.end_date = date;
      },
    },
  },
  methods: {
    closeModal() {
      this.$emit("closeCreateModal");
    },
    async getEmployees() {
      let response = await this.axios.get(
        `/dashboard/business/employees/filter`
      );

      this.employees = response.data.data;
      this.form.employee = this.employees[0].id;
    },
    async getServices() {
      try {
        let response = await this.axios.get(
          `/dashboard/business/${this.business.id}/services/`
        );
        this.services = response.data.data;
      } catch (error) {
        console.log("error", error);
      }
    },
    addService(service) {
      this.form.service = service.id;
      console.log("service", service);
      this.form.service_duration = service.duration;
    },
    async createBooking() {
      try {
        let response = await this.axios.post(
          `/dashboard/business/${this.business.id}/bookings/`,
          this.form
        );
        window.location.reload();
      } catch (error) {
        console.log("error", error);
      }
    },
  },
  mounted() {
    this.getEmployees();
    this.getServices();
  },
};
</script>

<style lang="css">
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
