<template>
  <div class="flex justify-center overflow-hidden font-sans min-w-screen">
    <div class="w-full">
      <div class="inline-block mt-2 mr-2">
        <button
          @click="showCreateModal = true"
          type="button"
          class="focus:outline-none text-white text-sm py-2.5 px-5 rounded-md bg-primary-400 hover:bg-secondary-400 hover:shadow-lg"
        >
          Hinzufügen
        </button>
      </div>

      <div class="my-6 overflow-x-auto bg-white rounded shadow-md">
        <table class="w-full table-auto min-w-max">
          <thead>
            <tr
              class="text-sm leading-normal text-gray-600 uppercase bg-gray-200"
            >
              <th class="px-6 py-3 text-left">Profilbild</th>
              <th class="px-6 py-3 text-left">Vorname</th>
              <th class="px-6 py-3 text-left">Nachname</th>
              <th class="px-6 py-3 text-center">Dienstleitungen</th>
              <th class="px-6 py-3 text-center">Geschlecht</th>
              <th class="px-6 py-3 text-center">Aktionen</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="employee in employees"
              :key="employee.id"
            >
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="relative flex items-center justify-center mr-2">
                    <img
                      v-if="
                        employee.genre == 'Masculine' &&
                        !employee.profile_picture
                      "
                      src="/images/male.jpg"
                      class="object-cover w-12 h-12 rounded-full"
                    />
                    <img
                      v-if="
                        employee.genre == 'Feminine' &&
                        !employee.profile_picture
                      "
                      src="/images/female.jpg"
                      class="object-cover w-12 h-12 rounded-full"
                    />
                    <i
                      v-if="employee.profile_picture"
                      class="absolute top-0 left-0 text-red-400 shadow-md cursor-pointer fa fa-trash text-red"
                      @click="deleteEmployeeImage(employee)"
                    >
                    </i>
                    <img
                      v-if="employee.profile_picture"
                      class="object-cover w-12 h-12 rounded-full"
                      :src="employee.profile_picture"
                    />
                  </div>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ employee.first_name }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ employee.last_name }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-center">
                <span
                  class="px-3 py-1 text-xs text-purple-600 bg-purple-200 rounded-full"
                  v-for="service in employee.services"
                  :key="service.id"
                  >{{ service.name }}</span
                >
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center justify-center">
                  <span class="capitalize">{{ employee.genre }}</span>
                </div>
              </td>

              <td class="px-6 py-3 text-center">
                <div class="flex justify-center item-center">
                  <div
                    class="w-4 mr-2 transform cursor-pointer hover:text-purple-500 hover:scale-110"
                    @click="showEmployee(employee)"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"
                      />
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"
                      />
                    </svg>
                  </div>
                  <div
                    class="w-4 mr-2 transform cursor-pointer hover:text-purple-500 hover:scale-110"
                    @click="editEmployee(employee)"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                      />
                    </svg>
                  </div>
                  <div
                    class="w-4 mr-2 transform cursor-pointer hover:text-purple-500 hover:scale-110"
                    @click="deleteEmployee(employee)"
                  >
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                      />
                    </svg>
                  </div>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
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
      </div>
    </div>
    <EmployeeCreateModal
      v-if="showCreateModal"
      @createEmployee="createEmployee"
      @closeCreateModal="closeCreateModal"
      :business="business"
    />
    <EmployeeViewModal
      v-if="showViewModal"
      :employee="selected_employee"
      @closeViewModal="closeViewModal"
    />
    <EmployeeEditModal
      :employee="selected_employee"
      @updateEmployee="updateEmployee"
      v-if="showEditModal"
      @closeEditModal="closeEditModal"
    />
  </div>
</template>
<script>
import EmployeeCreateModal from "./EmployeeCreateModal.vue";
import EmployeeViewModal from "./EmployeeViewModal.vue";
import EmployeeEditModal from "./EmployeeEditModal.vue";

export default {
  props: {
    business: {
      type: Object,
      required: true,
    },
  },
  components: {
    EmployeeCreateModal,
    EmployeeViewModal,
    EmployeeEditModal,
  },
  data() {
    return {
      selected_employee: "",
      employees: null,
      showCreateModal: false,
      showViewModal: false,
      showEditModal: false,
      response: {
        message: "",
        status: "",
      },
    };
  },

  methods: {
    async createEmployee(user) {
      try {
        let form = new FormData();
        console.log(user);
        form.append("image", user.profile_picture);
        form.append("first_name", user.first_name);
        form.append("last_name", user.last_name);
        form.append("genre", user.genre);
        form.append("business_id", user.business_id);
        form.append("services", JSON.stringify(user.services));

        let createResponse = await this.axios.post(
          "/dashboard/employees",
          form
        );
        console.log("create", createResponse);
        this.response.message = createResponse.data.message;
        this.response.status = createResponse.status;
        this.employees = createResponse.data.data;
        this.showCreateModal = false;
      } catch (error) {
        console.log(error);
        this.response.message = "There has been an error.";
        this.response.status = 422;
        this.showCreateModal = false;
      }
    },
    async updateEmployee(user) {
      try {
        let formPicture = new FormData();
        formPicture.append("image", user.profile_picture);

        if (user.profile_picture) {
          let profileResponse = await this.axios.post(
            `/employees/${user.id}/update-profile-picture`,
            formPicture
          );
        }
        let updateResponse = await this.axios.post(
          "/dashboard/employees/update",
          user
        );
        this.response.message = updateResponse.data.message;
        this.response.status = updateResponse.status;
        this.employees = updateResponse.data.data;
        this.showEditModal = false;
      } catch (error) {
        console.log(error);
        this.response.message = "There has been an error updating the profile";
        this.response.status = 422;
        this.showEditModal = false;
      }
    },
    async deleteEmployeeImage(employee) {
      try {
        let response = await this.axios.post(
          `employees/${employee.id}/deleteImage`
        );
        this.response.message = response.data.message;
        this.response.status = response.status;
        this.employees = response.data.data;
      } catch (error) {
        this.response.message =
          "There has been an error, please try again later.";
        this.response.status = 422;
      }
    },
    async deleteEmployee(employee) {
      try {
        let response = await this.axios.post(`employees/${employee.id}/delete`);
        this.response.message = response.data.message;
        this.response.status = response.status;
        this.employees = response.data.data;
      } catch (error) {
        this.response.message =
          "There has been an error, please try again later.";
        this.response.status = 422;
      }
    },
    editEmployee(employee) {
      this.showEditModal = true;
      this.selected_employee = employee;
    },
    showEmployee(employee) {
      this.showViewModal = true;
      this.selected_employee = employee;
    },
    async getEmployees() {
      let response = await this.axios.get(
        `/dashboard/business/employees/filter`
      );

      this.employees = response.data.data;
    },
    closeViewModal() {
      this.showViewModal = false;
    },
    closeEditModal() {
      this.showEditModal = false;
    },
    closeCreateModal() {
      this.showCreateModal = false;
    },
  },

  mounted() {
    this.getEmployees();
  },
};
</script>
