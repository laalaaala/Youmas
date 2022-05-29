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
              <th class="px-6 py-3 text-left">Name</th>
              <th class="px-6 py-3 text-left">Dauer (Min)</th>
              <th class="px-6 py-3 text-left">Preis</th>
              <th class="px-6 py-3 text-left">Kategorie</th>
              <th class="px-6 py-3 text-left">Unterkategorie</th>
              <th class="px-6 py-3 text-center">Aktion</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="service in localServices"
              :key="service.id"
            >
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="flex items-center justify-center mr-2">
                    {{ service.name }}
                  </div>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ service.duration }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>€{{ service.price }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ service.sub_category.category.name }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ service.sub_category.name }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-center">
                <div class="flex justify-center item-center">
                  <div
                    class="w-4 mr-2 transform cursor-pointer hover:text-purple-500 hover:scale-110"
                    @click="showEmployee(service)"
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
                    @click="editService(service)"
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
                    @click="deleteService(service)"
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
    <ServiceCreateModal
      v-if="showCreateModal"
      @createService="createService"
      @closeCreateModal="closeCreateModal"
   />
    <ServiceViewModal
      v-if="showViewModal"
      :service="selected_service"
      @closeViewModal="closeViewModal"
    />
    <ServiceEditModal
      :service="selected_service"
      @updateService="updateService"
      v-if="showEditModal"
      @closeEditModal="closeEditModal"
    />
  </div>
</template>
<script>
import ServiceCreateModal from "./ServiceCreateModal.vue";
import ServiceViewModal from "./ServiceViewModal.vue";
import ServiceEditModal from "./ServiceEditModal.vue";

export default {
  props: {
    services: {
      type: Array,
      required: true,
    },
  },
  components: {
    ServiceCreateModal,
    ServiceViewModal,
    ServiceEditModal,
  },
  data() {
    return {
      selected_service: "",
      localServices: this.services,
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
    async createService(service) {
      try {

        let response = await this.axios.post("/dashboard/services", service);

        this.response.message = response.data.message;
        this.response.status = response.status;
        this.localServices = response.data.data;

        this.showCreateModal = false;
      } catch (error) {
        console.log(error);
        this.response.message = "There has been an error creating the service";
        this.response.status = 422;
        this.showCreateModal = false;
      }
    },
    async updateService(service) {
      try {
        let response = await this.axios.post("/dashboard/services/update", service);
        this.response.message = response.data.message;
        this.response.status = response.status;
        this.localServices = response.data.data;
        this.showEditModal = false;
      } catch (error) {
        console.log(error);
        this.response.message = "There has been an error updating the service";
        this.response.status = 422;
        this.showEditModal = false;
      }
    },
    async deleteService(service) {
      try {
        let response = await this.axios.post(`services/${service.id}/delete`);
        this.response.message = response.data.message;
        this.response.status = response.status;
        console.log('before', this.localServices)
        this.localServices = response.data.data;
        console.log('after', this.localServices)
      } catch (error) {
        this.response.message =
          "There has been an error, please try again later.";
        this.response.status = 422;
      }
    },
    editService(service) {
      this.showEditModal = true;
      this.selected_service = service;
    },
    showEmployee(service) {
      this.showViewModal = true;
      this.selected_service = service;
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

};
</script>
