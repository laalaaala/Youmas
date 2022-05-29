<template>
  <div class="mt-2 text-center">
    <h1 class="text-2xl"></h1>
    <apexchart
      width="100%"
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
      type: Number,
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
          name: "bookings",
          data: [],
        },
        {
          name: "revenue",
          data: [],
        },
        {
          name: "cancellations",
          data: [],
        },
      ],
    };
  },
  watch: {
    period: {
      handler() {
        this.getUsersData();
      },
      immediate: true,
    },
    series: {
      handler() {
        let reducer = (accumulator, curr) => accumulator + curr;
        let total_bookings = this.series[0].data.reduce(reducer);
        let total_revenue = this.series[1].data.reduce(reducer);
        let total_cancellations = this.series[2].data.reduce(reducer);

        let totals = {
          bookings: total_bookings,
          revenue: total_revenue,
          cancellations: total_cancellations,
        };

        this.$emit("changeTotals", totals);
      },
      deep: true,
    },
  },
  methods: {
    // Get data comprehended in "period"
    async getUsersData() {
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

        console.log("days", days);

        this.options = {
          xaxis: {
            categories: days,
          },
        };

        try {
          let response = await this.axios.get(
            `/dashboard/statistics/all?period=month&first_day=${startDate}&today=${endDate}`
          );

          console.log("series", response.data.data);
          this.series = response.data.data;
        } catch (error) {}
      } else if (period == "year") {
        let firstDay = moment().subtract(1, "years");
        let today = moment();
        let startDate = firstDay.format("DD-MM-YYYY");
        let endDate = today.format("DD-MM-YYYY");

        console.log(firstDay);

        let months = [];

        console.log("format", firstDay.format("MMMM"));
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
            `/dashboard/statistics/all?period=year&first_day=${startDate}&today=${endDate}`
          );

          console.log("series", response.data.data);
          this.series = response.data.data;
        } catch (error) {}
      }
    },
  },
  beforeMount() {
    this.getUsersData();
  },
};
</script>