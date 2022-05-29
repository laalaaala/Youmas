<template>
  <div class="flex justify-center overflow-hidden font-sans min-w-screen">
    <CustomerBookingTableMobile
      :bookings="bookings"
      @cancelBooking="cancelBooking"
      class="md:hidden"
    />
    <div class="hidden w-full md:flex">
      <div class="my-6 overflow-x-auto bg-white rounded shadow-md">
        <table class="w-full table-auto min-w-max">
          <thead>
            <tr
              class="text-sm leading-normal uppercase text-secondary-400 bg-primary-400"
            >
              <th class="px-6 py-3 text-left">Datum</th>
              <th class="px-6 py-3 text-left">Uhrzeit</th>
              <th class="px-6 py-3 text-left">Unternehmen</th>
              <th class="px-6 py-3 text-left">Anschrift</th>
              <th class="px-6 py-3 text-left">Dienstleistung</th>
              <th class="px-6 py-3 text-left">Mitarbeiter</th>
              <th class="px-6 py-3 text-left">Gesamtpreis</th>
              <th class="px-6 py-3 text-left">Status</th>
              <th class="px-6 py-3 text-left">Aktion</th>
            </tr>
          </thead>
          <tbody class="text-sm font-light text-gray-600">
            <tr
              class="border-b border-gray-200 hover:bg-gray-100"
              v-for="booking in bookings"
              :key="booking.id"
            >
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <div class="flex items-center justify-center mr-2">
                    {{ booking.start | moment("DD.MM.YYYY HH:mm") }}
                  </div>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span>{{ booking.end | moment("DD.MM.YYYY HH:mm") }}</span>
                </div>
              </td>
              <td class="px-6 py-3 text-left">
                <div class="flex items-center">
                  <span class="capitalize">{{
                    booking.employee.business.name
                  }}</span>
                </div>
              </td>
              <td>
                <div class="flex items-center">
                  <span class="capitalize">
                    {{
                      booking.employee.business.user.location.formatted_address
                    }}
                  </span>
                </div>
              </td>
              <td>
                <div class="flex items-center justify-center">
                  <span class="capitalize">
                    {{ booking.service.name }}
                  </span>
                </div>
              </td>
              <td>
                <div class="flex items-center justify-center">
                  <span class="capitalize">
                    {{ booking.employee.first_name }}
                    {{ booking.employee.last_name }}
                  </span>
                </div>
              </td>
              <td>
                <div class="flex items-center justify-center">
                  <span class="capitalize"> €{{ booking.total_price }} </span>
                </div>
              </td>
              <td>
                <div class="flex items-center justify-center">
                  <span v-if="booking.status == 'cancelled'" class="capitalize">
                    Storniert
                  </span>
                  <span v-if="booking.status == 'pending'" class="capitalize">
                    Ausstehend
                  </span>
                  <span v-if="booking.status == 'completed'" class="capitalize">
                    Abgeschlossen
                  </span>
                </div>
              </td>
              <td v-if="booking.status != 'cancelled'">
                <div class="flex items-center justify-center">
                  <span class="capitalize">
                    <button
                      class="px-4 py-2 text-white uppercase bg-red-500 rounded"
                      @click="cancelBooking(booking)"
                    >
                      stornieren
                    </button>
                  </span>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <!-- Delete confirmation dialog -->
    <vue-confirm-dialog></vue-confirm-dialog>
  </div>
</template>
<script>
import CustomerBookingTableMobile from "./CustomerBookingTableMobile.vue";
export default {
  props: {
    bookings: {
      type: Array,
      required: true,
    },
  },
  components: {
    CustomerBookingTableMobile,
  },
  data() {
    return {
      pagination: {
        current_page: 1,
      },
    };
  },
  methods: {
    async cancelBooking(booking) {
      // this.selectedEvent = event;
      this.$confirm({
        message: `Are you sure you want cancel the booking?`,
        button: {
          no: "No",
          yes: "Yes",
        },
        callback: async (confirm) => {
          if (confirm) {
            // if (booking.transaction_id) {
            //   await fetch(
            //     `/dashboard/transactions/${booking.transaction_id}/refund/`,
            //     {
            //       method: "POST",
            //     }
            //   );
            // }

            await fetch(`/dashboard/bookings/${booking.id}`, {
              method: "PUT",
              headers: {
                Accept: "application/json",
                "Content-Type": "application/json",
              },
              body: JSON.stringify({ status: "cancelled"}),
            });

            location.reload();
          }
        },
      });
    },
  },
};
</script>