<template>
  <div class="flex justify-center overflow-hidden font-sans min-w-screen">
    <div class="w-full">
      <div class="p-3 my-6 bg-gray-200 rounded shadow-md">
        <h2>Filters:</h2>
        <div class="flex flex-row w-full mt-3">
          <input
            v-model="filters.email"
            type="text"
            placeholder="Search By Email"
            class="w-1/4 p-3 mx-3 rounded shadow"
          />
          <input
            v-model="filters.name"
            type="text"
            placeholder="Search By Name"
            class="w-1/4 p-3 mx-3 rounded shadow"
          />
          <select
            v-model="filters.type"
            name="tpe"
            id=""
            class="w-1/4 p-3 mx-3 bg-white shadow"
          >
            <option value="" selected>Search By Type</option>
            <option value="customer">Customer</option>
            <option value="business">Business</option>
          </select>
        </div>
      </div>
      <div class="my-6 overflow-x-auto bg-white rounded shadow-md">
        <table class="w-full table-auto min-w-max">
          <thead>
            <tr
              class="text-sm leading-normal text-gray-600 uppercase bg-gray-200"
            >
              <th class="px-6 py-3 text-left">Email</th>
              <th class="px-6 py-3 text-left">Telefon</th>
              <th class="px-6 py-3 text-left">Type</th>
              <th class="px-6 py-3 text-left">Actions</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="user in users"
              :key="user.id"
            >
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="flex items-center justify-center mr-2">
                    {{ user.email }}
                  </div>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ user.phone }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">{{ user.type }}</span>
                </div>
              </td>
              <td class="flex flex-row items-center px-6 py-3 text-center">
                <div class="flex item-center">
                  <div
                    class="w-4 mr-2 transform cursor-pointer hover:text-purple-500 hover:scale-110"
                    @click="deleteUser(user)"
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
                <div>
                  <a
                    v-if="user.type != 'admin'"
                    :href="`/admin/login-as-user/${user.id}`"
                    class="p-2 mx-1 font-bold text-white uppercase rounded bg-primary-400 text-secondary-400"
                    >LogIn As</a
                  >
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
          class="w-10 h-10 p-1 mr-5 text-base text-lg font-semibold tracking-wide border rounded shadow appearance-none border-primary-400 text-primary-400"
          @click="changePage(pagination.current_page - 1)"
          v-if="pagination.current_page != 1"
        ></button>
        <button
          class="w-10 h-10 p-1 mr-5 text-base text-lg font-semibold tracking-wide border rounded shadow appearance-none border-primary-400 text-primary-400"
          v-for="(page, index) in pagination.last_page"
          :key="index"
          @click="changePage(page)"
        >
          {{ page }}
        </button>
        <button
          class="w-10 h-10 p-1 mr-5 text-base text-lg font-semibold tracking-wide border rounded shadow appearance-none border-primary-400 text-primary-400"
          @click="changePage(pagination.current_page + 1)"
          v-if="pagination.current_page != pagination.last_page"
        >
          >
        </button>
      </div>
    </div>
  </div>
</template>
<script>
import { complexToQueryString } from "@/util/util";

export default {
  data() {
    return {
      filters: {
        name: "",
        email: "",
        type: "",
      },
      users: null,
      pagination: {
        current_page: 1,
      },
    };
  },
  watch: {
    filters: {
      handler() {
        this.getUsers();
      },
      deep: true,
    },
  },
  methods: {
    async getUsers() {
      const query = complexToQueryString({
        page: this.pagination.current_page,
        name: this.filters.name,
        email: this.filters.email,
        type: this.filters.type,
      });

      let response = await this.axios.get(`/admin/users/filter?${query}`);

      this.users = response.data.data;
      this.pagination = response.data.pagination;
    },
    async deleteUser(user) {
      try {
        let response = await this.axios.delete(`/admin/users/${user.id}`);
        this.users = response.data.data;
        this.pagination = response.data.pagination;
      } catch (error) {
        this.response.message =
          "There has been an error, please try again later.";
        this.response.status = 422;
      }
    },

    changePage(page) {
      console.log("page", page);
      this.pagination.current_page = page;
      this.getUsers();
    },
  },

  mounted() {
    this.getUsers();
  },
};
</script>
