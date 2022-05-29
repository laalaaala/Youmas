<template>
  <div class="flex justify-center font-sans min-w-screen">
    <div class="w-full">
      <div class="my-6 bg-white rounded overflow-x-auto">
        <button
          class="
            px-10
            py-3
            font-bold
            uppercase
            rounded
            bg-primary-400
            text-secondary-400
            mb-10
          "
          @click="toggleCreateModal"
        >
          New Faq
        </button>
        <table class="w-full table-auto min-w-max shadow-md">
          <thead>
            <tr
              class="text-sm leading-normal text-gray-600 uppercase bg-gray-200"
            >
              <th class="px-10 py-3 text-left">Title</th>
              <th class="px-10 py-3 text-left">Content</th>
              <th class="px-10 py-3 text-right w-2/12">Actions</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="faq in faqs"
              :key="faq.id"
            >
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="mr-2 flex items-center justify-center">
                    {{ faq.title }}
                  </div>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ faq.content }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-right">
                <div class="flex justify-end">
                  <div
                    class="
                      w-4
                      mr-2
                      transform
                      cursor-pointer
                      hover:text-purple-500
                      hover:scale-110
                    "
                    @click="deleteFaq(faq.id)"
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
                  <i
                    class="
                      fas
                      fa-pen
                      w-4
                      mr-2
                      transform
                      cursor-pointer
                      hover:text-purple-500
                      hover:scale-110
                      self-center
                    "
                    style="padding-top: 1px"
                    @click="
                      toggleEditModal();
                      selectedFaq = faq;
                    "
                  ></i>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <div
        class="bottom-0 flex justify-center w-full py-10 mt-auto text-center"
        style="background: #fbfbfb; margin-bottom: 40px"
      >
        <button
          class="
            w-10
            h-10
            p-1
            mr-5
            text-base text-lg
            font-semibold
            tracking-wide
            border
            rounded
            shadow
            appearance-none
            border-primary-400
            text-primary-400
          "
          @click="changePage(pagination.current_page - 1)"
          v-if="pagination.current_page != 1"
        ></button>
        <button
          class="
            w-10
            h-10
            p-1
            mr-5
            text-base text-lg
            font-semibold
            tracking-wide
            border
            rounded
            shadow
            appearance-none
            border-primary-400
            text-primary-400
          "
          v-for="(page, index) in pagination.last_page"
          :key="index"
          @click="changePage(page)"
        >
          {{ page }}
        </button>
        <button
          class="
            w-10
            h-10
            p-1
            mr-5
            text-base text-lg
            font-semibold
            tracking-wide
            border
            rounded
            shadow
            appearance-none
            border-primary-400
            text-primary-400
          "
          @click="changePage(pagination.current_page + 1)"
          v-if="pagination.current_page != pagination.last_page"
        >
          >
        </button>
      </div>
    </div>

    <CreateFaqModal
      :createOpen="createOpen"
      @toggleCreateModal="toggleCreateModal"
    />
    <EditFaqModal
      v-if="editOpen"
      :faq="selectedFaq"
      :editOpen="editOpen"
      @toggleEditModal="toggleEditModal"
    />
  </div>
</template>

<script>
import CreateFaqModal from "./AdminFAQSModalCreate.vue";
import EditFaqModal from "./AdminFAQSModalEdit.vue";
import { complexToQueryString } from "@/util/util";

export default {
  components: {
    CreateFaqModal,
    EditFaqModal,
  },
  data() {
    return {
      createOpen: false,
      editOpen: false,
      response: {
        status: "",
        message: "",
      },
      faqs: null,
      pagination: {
        current_page: 1,
      },
      selectedFaq: null,
    };
  },
  methods: {
    async getFaqs() {
      const query = complexToQueryString({
        page: this.pagination.current_page,
      });

      let response = await this.axios.get(`/admin/faqs/filter?${query}`);

      this.faqs = response.data.data;
      this.pagination = response.data.pagination;
    },
    changePage(page) {
      console.log("page", page);
      this.pagination.current_page = page;
      this.getFaqs();
    },
    async deleteFaq(id) {
      try {
        let response = await this.axios.post(`/admin/faqs/${id}/delete`);
        this.response.status = response.status;
        this.response.message = response.data.message;
      } catch (error) {
        console.log("error", error);
        this.response.status = error.status;
        this.response.message = error.response.data.message;
      }
      window.location.reload();
    },

    toggleCreateModal() {
      this.createOpen = !this.createOpen;
    },
    toggleEditModal() {
      this.editOpen = !this.editOpen;
    },
  },
  mounted() {
    this.getFaqs();
  },
};
</script>