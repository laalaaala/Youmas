<template>
  <div class="flex flex-col">
    <div class="flex flex-row gap-2">
      <button class="bg-primary-400 px-4 py-2" @click="period = 'month'">
        MONTH
      </button>
      <button class="bg-primary-400 px-4 py-2" @click="period = 'year'">
        YEAR
      </button>
    </div>
    <div class="flex flex-row">
      <UserStatsChart :period="period" />
      <RevenueStatsChart :period="period" />
    </div>
  </div>
</template>
<script>
import UserStatsChart from "./UserStatsChart.vue";
import RevenueStatsChart from "./RevenueStatsChart.vue";

export default {
  components: {
    UserStatsChart,
    RevenueStatsChart,
  },
  data() {
    return {
      period: "month",
    };
  },
};
</script>