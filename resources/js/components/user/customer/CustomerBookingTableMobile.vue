<template>
  <div class="flex flex-col pt-10 gap-y-8">
    <div
      v-for="booking in bookings"
      :key="booking.id"
      class="pb-4 text-black border-b border-primary-400"
    >
      <p class="text-black"><strong>Datum:</strong> {{ booking.start }}</p>
      <p class="text-black">
        <strong>Unternehmen:</strong> {{ booking.employee.business.name }}
      </p>
      <p class="text-black">
        <strong> Anschrift:</strong>
        {{ booking.employee.business.user.location.formatted_address }}
      </p>
      <p class="text-black">
        <strong>Gesamtpreis:</strong> €{{ booking.total_price }}
      </p>
      <p class="text-black">
        <strong>Status:</strong>
        <span v-if="booking.status == 'cancelled'" class="capitalize">
          Storniert
        </span>
        <span v-if="booking.status == 'pending'" class="capitalize">
          Ausstehend
        </span>
        <span v-if="booking.status == 'completed'" class="capitalize">
          Abgeschlossen
        </span>
      </p>
      <div class="w-full mx-auto mt-5" v-if="booking.status != 'cancelled'">
        <div class="flex items-center justify-center">
          <span class="capitalize">
            <button
              class="px-4 py-2 text-white uppercase bg-red-500 rounded"
              @click="cancelBooking(booking)"
            >
              Cancel
            </button>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    bookings: {
      type: Array,
      required: true,
    },
  },
  methods: {
    cancelBooking(booking) {
      this.$emit("cancelBooking", booking);
    },
  },
};
</script>t