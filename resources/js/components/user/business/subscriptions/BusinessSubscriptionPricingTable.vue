<template>
  <div
    class="flex-col justify-center mt-6 pricing-plans lg:flex lg:-mx-4 lg:mt-12"
  >
    <!-- Plan duration select -->
    <div class="max-w-3xl mx-auto text-center">
      <div class="mt-5">
        <select
          v-model="period"
          name=""
          id=""
          class="bg-transparent outline-none"
        >
          <option value="1">Einmalig</option>
          <option value="2">6 Monate</option>
          <option value="3">12 Monate</option>
        </select>
      </div>
    </div>
    <!-- Pricing cards -->
    <div class="grid w-full mt-20 gap-y-20 xl:gap-y-0 xl:flex xl:flex-row xl:h-100">
      <div
        v-if="!user.subscription"
        class="w-full my-4 pricing-plan-wrap xl:w-1/3 lg:my-6"
      >
        <div
          class="flex flex-col max-w-sm mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan"
        >
          <div class="relative py-6 shadow-lg rounded-t-2xl">
            <div class="flex items-center justify-center w-1/2 mx-auto">
              <div
                class="absolute p-6 py-16 transition-colors duration-300 rounded-full -top-20 ml-1/3 pricing-amount bg-primary-400"
              >
                <div class="">
                  <span class="text-4xl font-semibold text-black">€ 0.00</span>
                </div>
              </div>
            </div>

            <div class="p-6 mt-20 lg:py-8">
              <h4 class="mb-2 text-2xl font-normal leading-tight">
                Starter
              </h4>
              <p class="text-sm text-gray-600">
                Kostenlose 30-Tage -Testversion. Du kannst alle Funktionen für 30 Tage kostenfrei ausprobieren.
              </p>
            </div>
          </div>

          <div class="py-3 bg-gray-200 bg-opacity-25">
            <ul class="text-sm leading-loose uppercase text-secondary-400">
              <li>Barzahlung</li>
            </ul>
          </div>
          <div class="py-6 shadow-lg rounded-2xl">
            <div class="py-4 mt-auto">
              <button
                @click="createTrial()"
                class="w-40 px-6 py-3 text-sm font-medium text-center text-white rounded-full custom-button-inverted bg-secondary-400 hover:border-primary-400 lg:text-lg"
              >
                Testmonat starten
              </button>
            </div>
          </div>
        </div>
      </div>
      <div
        :class="user.subscription ? 'lg:w-1/2' : 'w-full xl:w-1/3'"
        class="flex flex-col max-w-sm mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan lg:my-6"
      >
        <div class="relative py-6 shadow-lg rounded-t-2xl">
          <div class="flex items-center justify-center w-1/2 mx-auto">
            <div
              class="absolute p-6 py-16 transition-colors duration-300 bg-black rounded-full -top-20 ml-1/3 pricing-amount"
            >
              <div class="">
                <span
                  v-if="period == 1"
                  class="text-4xl font-semibold text-white"
                  >€49.99</span
                >
                <span
                  v-if="period == 2"
                  class="text-4xl font-semibold text-white"
                  >€47.49</span
                >
                <span
                  v-if="period == 3"
                  class="text-4xl font-semibold text-white"
                >
                  €44.99</span
                >
              </div>
            </div>
          </div>

          <div class="p-6 mt-20 lg:py-8">
            <h4 class="mb-2 text-2xl font-normal leading-tight">
              Pro
            </h4>
            <p class="text-sm text-gray-600">Für Einzelkämpfer und kleine <br> Salons oder Studios.</p>
          </div>
        </div>

        <div class="py-3 bg-gray-200 bg-opacity-25">
          <ul class="text-sm leading-loose uppercase text-secondary-400">
            <li>Barzahlung</li>
          </ul>
        </div>
        <div class="py-6 shadow-lg rounded-2xl">
          <div class="py-4 mt-auto">
            <button
              @click="choosePlan('silver')"
              class="w-40 px-6 py-3 text-sm font-medium text-center text-white rounded-full custom-button bg-secondary-400 hover:border-primary-400 lg:text-lg"
            >
              Partner werden
            </button>
          </div>
        </div>
      </div>
      <div class="w-full my-4 pricing-plan-wrap xl:w-1/3 lg:my-6">
        <div
          class="flex flex-col max-w-sm mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan"
        >
          <div class="relative py-6 shadow-lg rounded-t-2xl">
            <div class="flex items-center justify-center w-1/2 mx-auto">
              <div
                class="absolute p-6 py-16 transition-colors duration-300 rounded-full -top-20 ml-1/3 pricing-amount bg-primary-400"
              >
                <div class="">
                  <span
                    v-if="period == 1"
                    class="text-4xl font-semibold text-black"
                    >€39.99</span
                  >
                  <span
                    v-if="period == 2"
                    class="text-4xl font-semibold text-black"
                    >€37.99</span
                  >
                  <span
                    v-if="period == 3"
                    class="text-4xl font-semibold text-black"
                  >
                    €35.99</span
                  >
                </div>
              </div>
            </div>

            <div class="p-6 mt-20 lg:py-8">
              <h4 class="mb-2 text-2xl font-normal leading-tight">
                Premium
              </h4>
              <p class="text-sm text-gray-600">Für große Betriebe oder Betriebe mit mehreren Standorten.</p>
            </div>
          </div>

          <div class="py-3 bg-gray-200 bg-opacity-25">
            <ul class="text-sm leading-loose uppercase text-secondary-400">
              <li>Barzahlung (Credit Card, Apple/Google pay)</li>
            </ul>
          </div>
          <div class="py-6 shadow-lg rounded-2xl">
            <div class="py-4 mt-auto">
              <button
                @click="choosePlan('gold')"
                class="w-40 px-6 py-3 text-sm font-medium text-center text-white rounded-full custom-button-inverted bg-primary-400 hover:border-primary-400 lg:text-lg"
              >
                Partner werden
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      period: 1,
    };
  },
  methods: {
    choosePlan(plan) {
      let data = {
        plan: plan,
        period: this.period,
      };
      this.$emit("changePlan", data);
    },
    async createTrial() {
      let data = {
        planName: "trial",
      };
      let response = await this.axios.post(
        "/businesses/subscriptions/create-stripe-subscription",
        data
      );

      window.location.replace("/dashboard");
    },
  },
};
</script>