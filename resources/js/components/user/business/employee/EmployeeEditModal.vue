<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <section class="lg:py-20">
          <div
            class="container w-full h-full max-w-2xl mx-auto shadow-md lg:w-3/4"
          >
            <div class="flex items-center h-10 bg-primary-400">
              <button
                @click="closeModal"
                class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md bg-primary-700 h-7"
              >
                X
              </button>
            </div>

            <div class="space-y-0 bg-white">
              <div
                class="items-center w-full p-4 space-y-0 text-gray-500 lg:inline-flex lg:space-y-0"
              >
                <h2 class="max-w-sm mx-auto lg:w-1/3">Profilbild</h2>
                <div class="max-w-sm mx-auto space-y-0 lg:w-2/3">
                  <div>
                    <label class="text-sm text-gray-400">Profilbild</label>
                    <div class="inline-flex w-full border">
                      <!-- <div class="w-1/12 pt-2 bg-gray-100">
                        <svg
                          fill="none"
                          class="w-6 mx-auto text-gray-400"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          />
                        </svg>
                      </div> -->
                      <input
                        @change="onFileChange"
                        type="file"
                        class="w-11/12 p-2 focus:outline-none focus:text-gray-600"
                        placeholder="12341234"
                      />
                    </div>
                  </div>
                </div>
              </div>
              <hr />
              <div
                class="items-center w-full p-4 space-y-0 text-gray-500 lg:inline-flex lg:space-y-0"
              >
                <h2 class="max-w-sm mx-auto lg:w-1/3">Persönliche</h2>
                <div class="max-w-sm mx-auto space-y-0 lg:w-2/3">
                  <div>
                    <label class="text-sm text-gray-400">Vorname</label>
                    <div class="inline-flex w-full border">
                      <div class="w-1/12 pt-2 bg-gray-100">
                        <svg
                          fill="none"
                          class="w-6 mx-auto text-gray-400"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          />
                        </svg>
                      </div>
                      <input
                        v-model="form.first_name"
                        type="text"
                        class="w-11/12 p-2 focus:outline-none focus:text-gray-600"
                        placeholder="Vorname"
                      />
                    </div>
                  </div>
                  <div>
                    <label class="text-sm text-gray-400">Nachname</label>
                    <div class="inline-flex w-full border">
                      <div class="w-1/12 pt-2 bg-gray-100">
                        <svg
                          fill="none"
                          class="w-6 mx-auto text-gray-400"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          />
                        </svg>
                      </div>
                      <input
                        v-model="form.last_name"
                        type="text"
                        class="w-11/12 p-2 focus:outline-none focus:text-gray-600"
                        placeholder="Nachname"
                      />
                    </div>
                  </div>
                  <div>
                    <label class="text-sm text-gray-400">Geschlecht</label>
                    <div class="inline-flex w-full border">
                      <div class="w-1/12 pt-2 bg-gray-100">
                        <svg
                          fill="none"
                          class="w-6 mx-auto text-gray-400"
                          viewBox="0 0 24 24"
                          stroke="currentColor"
                        >
                          <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                          />
                        </svg>
                      </div>
                      <select name="" id="" class="w-full" v-model="form.genre">
                        <option value="male">Männlich</option>
                        <option value="female">Weiblich</option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>

              <hr />
              <div
                class="items-center w-full p-8 space-y-0 text-gray-500 lg:inline-flex lg:space-y-0"
              >
                <h2 class="max-w-sm mr-auto">Dienstleitungen</h2>

                <div
                  class="w-full max-w-sm pl-2 mx-auto space-y-0 lg:pl-9 lg:inline-flex"
                >
                  <EmployeeServiceMultiSelect
                    @addService="addEmployeeService"
                    @removeService="removeEmployeeService"
                    :services="services"
                    :employee="employee"
                  />
                </div>
              </div>

              <hr />
              <div v-if="response.status" class="p-1 mt-0">
                <div
                  class="relative px-6 py-4 my-3 mb-4 text-center text-white bg-green-500 border-0 rounded"
                  v-if="response.status == 200"
                >
                  <span class="inline-block mr-8 align-middle">
                    {{ response.message }}
                  </span>
                </div>
                <div
                  class="relative px-6 py-4 my-3 mb-4 text-center text-white bg-red-500 border-0 rounded"
                  v-if="response.status == 422"
                >
                  <span class="inline-block mr-8 align-middle">
                    {{ response.message }}
                  </span>
                </div>
              </div>
              <div class="w-full p-4 text-right text-gray-500">
                <button
                  class="inline-flex items-center mr-4 focus:outline-none"
                  @click="updateEmployee"
                >
                  Update
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
import EmployeeServiceMultiSelect from "./EmployeeServiceMultiSelect.vue";

export default {
  props: {
    employee: {
      type: Object,
      required: true,
    },
  },
  components: {
    EmployeeServiceMultiSelect,
  },

  data() {
    return {
      serviceCategories: null,
      serviceCategorySubcategories: null,
      form: {
        id: this.employee.id,
        profile_picture: "",
        genre: this.employee.genre,
        first_name: this.employee.first_name,
        last_name: this.employee.last_name,
        business_id: this.employee.business_id,
        services: [],
      },
      services: [],
      response: {
        message: "",
        status: "",
      },
    };
  },

  methods: {
    editEmployee() {
      this.$emit("closeEditModal");
    },
    closeModal() {
      this.$emit("closeEditModal");
    },
    onFileChange(e) {
      this.form.profile_picture = e.target.files[0];
    },
    addEmployeeService(service) {
      this.form.services.push(service.id);
    },
    removeEmployeeService(index) {
      this.form.services.splice(index, 1);
    },
    async updateEmployee() {
      this.$emit("updateEmployee", this.form);
    },
    async getServices() {
      try {
        let response = await this.axios.get(
          `/dashboard/business/${this.form.business_id}/services/`
        );
        this.services = response.data.data;
      } catch (error) {
        console.log("error", error);
      }
    },
  },
  mounted() {
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
