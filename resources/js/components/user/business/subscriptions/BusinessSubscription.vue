<template>
  <div class="pb-6 text-center pricing-table-2 md:pb-12">
    <h1
      class="-mb-10 font-bold uppercase lg:hidden text-8xl opacity-5"
      style="font: normal normal 900 40px/60px Poppins"
    >
      PAKETE
    </h1>
    <h1
      class="hidden -mb-24 font-bold uppercase lg:block text-8xl opacity-5"
      style="font: normal normal 900 103px/129px Poppins"
    >
      PAKETE
    </h1>

    <h1 class="text-2xl lg:text-6xl">Unsere Preismodelle</h1>
    <span
      class="w-full p-3 font-bold text-white bg-red-400"
      v-if="user.subscription && user.subscription.status == 'inactive'"
    >
      Your account is deactivated, please buy a package.
    </span>
    <div class="flex flex-col px-4 mx-auto">
      <!-- Pricing table -->
      <BusinessSubscriptionPricingTable
        v-show="!plan"
        :user="user"
        @cardEventGenerate="cardEventGenerate"
        @changePlan="changePlan"
      />

      <!-- Stripe Payment -->
      <BusinessSubscriptionStripePayment
        ref="childComponent"
        :plan="plan"
        :period="period"
        :user="user"
        v-show="plan"
      />
    </div>
  </div>
</template>

<script>
import BusinessSubscriptionPricingTable from "./BusinessSubscriptionPricingTable.vue";
import BusinessSubscriptionStripePayment from "./BusinessSubscriptionStripePayment.vue";
export default {
  components: {
    BusinessSubscriptionPricingTable,
    BusinessSubscriptionStripePayment,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      plan: "",
      period: 1,
    };
  },
  methods: {
    cardEventGenerate() {
      this.$refs.childComponent.cardEventGenerate();
    },
    changePlan(data) {
      this.plan = data.plan;
      this.period = data.period;
    },
  },
};
</script>