<template>
  <div class="flex justify-center overflow-hidden font-sans min-w-screen">
    <div class="w-full">
      <div class="my-6 p-3 bg-gray-200 rounded shadow-md">
        <h2>Filters:</h2>
        <div class="w-full flex flex-row mt-3">
          <select
            v-model="filters.status"
            name="tpe"
            id=""
            class="w-1/4 mx-3 p-3 bg-white shadow"
          >
            <option value="" selected>Search By Type</option>
            <option value="pending">Pending</option>
            <option value="succeed">Succeed</option>
          </select>
        </div>
      </div>
      <div class="my-6 bg-white rounded shadow-md overflow-x-auto">
        <table class="w-full table-auto min-w-max">
          <thead>
            <tr
              class="text-sm leading-normal text-gray-600 uppercase bg-gray-200"
            >
              <!-- <th class="px-6 py-3 text-left">User Business Id</th> -->
              <th class="px-6 py-3 text-left">Business Email</th>
              <!-- <th class="px-6 py-3 text-left">User Customer Id</th> -->
              <th class="px-6 py-3 text-left">Customer Email</th>
              <th class="px-6 py-3 text-left">Amount</th>
              <th class="px-6 py-3 text-left">Youmas Revenue</th>
              <th class="px-6 py-3 text-left">Business Revenue</th>
              <th class="px-6 py-3 text-left">Status</th>
              <th class="px-6 py-3 text-left">Payout</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="transaction in transactions"
              :key="transaction.id"
            >
              <!-- <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="mr-2 flex items-center justify-center">
                    {{ transaction.business_id }}
                  </div>
                </div>
              </td> -->
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">{{
                    transaction.business.email
                  }}</span>
                </div>
              </td>
              <!-- <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ transaction.customer_id }}</span>
                </div>
              </td> -->
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">{{
                    transaction.customer.email
                  }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">€{{ transaction.amount }} </span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize"
                    >€{{ transaction.youmas_revenue }}
                  </span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize"
                    >€{{ transaction.business_revenue }}
                  </span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">{{ transaction.status }}</span>
                </div>
              </td>
              <td>
                <a
                  v-if="transaction.status == 'pending'"
                  @click="approveTransaction(transaction)"
                  class="btn cursor-pointer p-2 bg-primary-400 rounded ml-3"
                  >Approve</a
                >
                <span
                  class="btn cursor-pointer p-2 bg-primary-400 rounded ml-3"
                  v-else
                >
                  Completed
                </span>
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
  </div>
</template>
<script>
import { complexToQueryString } from "@/util/util";

export default {
  data() {
    return {
      filters: {
        status: "",
      },
      selectedTransaction: "",
      transactions: null,
      pagination: {
        current_page: 1,
      },
    };
  },
  watch: {
    filters: {
      handler() {
        this.getTransactions();
      },
      deep: true,
    },
  },
  methods: {
    async approveTransaction(transaction) {
      this.selectedTransaction = transaction;
      let data = {
        transfer_group: this.selectedTransaction.order_id,
        amount: this.selectedTransaction.amount,
        business_id: this.selectedTransaction.business_id,
      };
      let response = await this.axios.post(
        `/admin/transactions/${this.selectedTransaction.id}/approve`,
        data
      );
      console.log(this.selectedTransaction);
    },
    async getTransactions() {
      const query = complexToQueryString({
        page: this.pagination.current_page,
        status: this.filters.status,
      });

      let response = await this.axios.get(
        `/admin/transactions/filter?${query}`
      );

      this.transactions = response.data.data;
      this.pagination = response.data.pagination;
    },
    // async deleteUser(user) {
    //   try {
    //     let response = await this.axios.delete(`/admin/users/${user.id}`);
    //     this.users = response.data.data;
    //     this.pagination = response.data.pagination;
    //   } catch (error) {
    //     this.response.message =
    //       "There has been an error, please try again later.";
    //     this.response.status = 422;
    //   }
    // },

    changePage(page) {
      console.log("page", page);
      this.pagination.current_page = page;
      this.getUsers();
    },
  },

  mounted() {
    this.getTransactions();
  },
};
</script>
