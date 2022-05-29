<template>
  <div class="mt-2">
    <h1 class="text-2xl">Revenue</h1>
    <apexchart
      width="500"
      type="line"
      :options="options"
      :series="series"
    ></apexchart>
  </div>
</template>
<script>
import moment from "moment";

export default {
  props: {
    period: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      options: {
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
      },
      series: [
        {
          name: "Total Revenue",
          data: [],
        },
      ],
    };
  },
  watch: {
    period: {
      handler() {
        this.getRevenueData();
      },
      immediate: true,
    },
  },
  methods: {
    // Get data comprehended in "period"
    async getRevenueData() {
      /**
       * Set Month X Axis
       */
      let period = this.period;

      let today = moment();
      if (period == "month") {
        let firstDayMonth = moment().startOf("month");
        let days = [];
        let startDate = firstDayMonth.format("DD-MM-YYYY");
        let endDate = today.format("DD-MM-YYYY");

        days.push(moment(firstDayMonth).format("MMMM D"));
        while (firstDayMonth < today) {
          firstDayMonth.add(1, "day");
          days.push(moment(firstDayMonth).format("MMMM D"));
        }

        this.options = {
          xaxis: {
            categories: days,
          },
        };

        try {
          let response = await this.axios.get(
            `/admin/stats/revenue?period=month&first_day=${startDate}&today=${endDate}`
          );
          this.series = [response.data.data];
        } catch (error) {}
      } else if (period == "year") {
        let firstDay = moment().subtract(1, "years");
        let today = moment();
        let startDate = firstDay.format("DD-MM-YYYY");
        let endDate = today.format("DD-MM-YYYY");

        // console.log(firstDay);

        let months = [];

        // console.log("format", firstDay.format("MMMM"));
        months.push(moment(firstDay).format("MMMM"));
        while (firstDay < today) {
          firstDay.add(1, "month");
          months.push(moment(firstDay).format("MMMM Y"));
        }

        this.options = {
          xaxis: {
            categories: months,
          },
        };

        try {
          let response = await this.axios.get(
            `/admin/stats/revenue?period=year&first_day=${startDate}&today=${endDate}`
          );

          this.series = [response.data.data];
        } catch (error) {}
      }
    },
  },
  beforeMount() {
    this.getRevenueData();
  },
};
</script>