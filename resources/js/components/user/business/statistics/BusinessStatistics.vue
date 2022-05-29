<template>
  <!-- /Title -->
  <div
    class="p-5 mt-5 bg-white rounded-sm shadow-sm flex-col items-center"
    id="app"
  >
    <div class="flex flex-row gap-2">
      <button class="bg-primary-400 px-4 py-2" @click="period = 'month'">
        MONTH
      </button>
      <button class="bg-primary-400 px-4 py-2" @click="period = 'year'">
        YEAR
      </button>
    </div>
    <BusinessStatisticsChart :period="period" @changeTotals="changeTotals" />

    <div class="flex flex-row justify-center mt-10">
      <div class="w-10/12 text-center">
        <label for="">Total Buchunungen</label>
        <br />
        <label>{{ totals.bookings }}</label>
      </div>
      <div class="w-1/3 text-center">
        <label for="">Total Umsatz</label>
        <br />
        <label>{{ totals.revenue }}</label>
      </div>
      <div class="w-1/3 text-center">
        <label for="">Total Stornienungen</label>
        <br />
        <label>{{ totals.cancellations }}</label>
      </div>
    </div>
  </div>
</template>

<script>
import BusinessStatisticsChart from "./BusinessStatisticsChart.vue";
export default {
  components: {
    BusinessStatisticsChart,
  },
  data() {
    return {
      totals: {
        bookings: 2,
        revenue: 2,
        cancellations: 3,
      },
      period: "month",
    };
  },
  methods: {
    changeTotals(totals) {
      this.totals = totals;
    },
  },
};
</script>