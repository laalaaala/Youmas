<template>
  <div class="container px-10 mx-auto lg:px-4">
    <div class="max-w-3xl mx-auto my-10 text-center">
      <div class="mt-5 lg:mt-10">
        <select v-model="selectedPlan" name="" id="" class="bg-transparent lg:text-xl">
          <option value="1">Einmalig</option>
          <option value="2">6 Monate</option>
          <option value="3">12 Monate</option>
        </select>
      </div>
    </div>
    <div class="justify-center mt-6 lg:items-center pricing-plans xl:gap-x-5 lg:flex-col xl:flex-row lg:flex lg:-mx-4 lg:mt-20">
      <div class="my-4 my-24 pricing-plan-wrap lg:w-1/2 2xl:w-1/3 lg:my-6 lg:pb-20 xl:pb-0 xl:h-100">
        <div
          class="flex flex-col max-w-md mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan"
        >
          <div class="relative py-6 shadow-lg rounded-t-2xl">
            <div class="flex items-center justify-center w-1/2 mx-auto">
              <div
                class="absolute p-6 py-16 transition-colors duration-300 rounded-full bg-primary-400 -top-20 ml-1/3 pricing-amount"
              >
                <div class="">
                  <span
                    v-if="selectedPlan == 1"
                    class="text-4xl font-semibold text-black"
                    >€00.00</span
                  >
                  <span
                    v-if="selectedPlan == 2"
                    class="text-4xl font-semibold text-black"
                    >€00.00</span
                  >
                  <span
                    v-if="selectedPlan == 3"
                    class="text-4xl font-semibold text-black"
                  >
                    €00.00</span
                  >
                </div>
              </div>
            </div>

           <div class="p-6 mt-20 lg:pt-8 lg:pb-0">
              <h4 class="mb-2 text-2xl leading-tight">
                Starter
              </h4>
              <p class="text-black">Kostenlose 30-Tage -Testversion. Du kannst alle Funktionen für 30 Tage kostenfrei ausprobieren.</p>
            </div>
          </div>

          <div class="py-3 bg-gray-200 bg-opacity-25">
            <ul class="text-sm leading-loose uppercase text-secondary-400">
              <li>Barzahlung</li>
            </ul>
          </div>
          <div class="py-6 shadow-lg rounded-2xl">
            <div class="py-4 mt-auto">
              <a
                href="/businesses/subscriptions"
                class="w-40 px-6 py-3 text-sm font-medium text-center text-white rounded-full custom-button bg-primary-400 hover:border-primary-400 lg:text-lg"
              >
                Testmonat starten
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="my-4 my-24 pricing-plan-wrap lg:w-1/2 2xl:w-1/3 lg:my-6 lg:pb-20 xl:pb-0 xl:h-100">
        <div
          class="flex flex-col max-w-md mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan"
        >
          <div class="relative py-6 shadow-lg rounded-t-2xl">
            <div class="flex items-center justify-center w-1/2 mx-auto">
              <div
                class="absolute p-6 py-16 transition-colors duration-300 bg-black rounded-full -top-20 ml-1/3 pricing-amount"
              >
                <div class="">
                  <span
                    v-if="selectedPlan == 1"
                    class="text-4xl font-semibold text-white"
                    >€49.99</span
                  >
                  <span
                    v-if="selectedPlan == 2"
                    class="text-4xl font-semibold text-white"
                    >€47.49</span
                  >
                  <span
                    v-if="selectedPlan == 3"
                    class="text-4xl font-semibold text-white"
                  >
                    €44.99</span
                  >
                </div>
              </div>
            </div>

           <div class="p-6 mt-20 lg:pt-8 lg:pb-0">
              <h4 class="mb-2 text-2xl leading-tight">
                Pro
              </h4>
              <p class="text-black">Für Einzelkämpfer und kleine <br> Salons oder Studios.</p>
            </div>
          </div>

          <div class="py-3 bg-gray-200 bg-opacity-25">
            <ul class="text-sm leading-loose uppercase text-secondary-400">
              <li>Barzahlung</li>
            </ul>
          </div>
          <div class="py-6 shadow-lg rounded-2xl">
            <div class="py-4 mt-auto">
              <a
                href="/businesses/subscriptions"
                class="w-40 px-6 py-3 text-sm font-medium text-center text-white rounded-full custom-button bg-secondary-400 hover:border-primary-400 lg:text-lg"
              >
                Partner werden
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="my-4 my-24 pricing-plan-wrap lg:w-1/2 2xl:w-1/3 lg:my-6 lg:pb-20 xl:pb-0 xl:h-100">
        <div
          class="flex flex-col max-w-md mx-auto text-center bg-white border-t-4 border-white border-solid pricing-plan"
        >
          <div class="relative py-6 shadow-lg rounded-t-2xl">
            <div class="flex items-center justify-center w-1/2 mx-auto">
              <div
                class="absolute p-6 py-16 transition-colors duration-300 rounded-full -top-20 ml-1/3 pricing-amount bg-primary-400"
              >
                <div class="">
                  <span
                    v-if="selectedPlan == 1"
                    class="text-4xl font-semibold text-black"
                    >€39.99</span
                  >
                  <span
                    v-if="selectedPlan == 2"
                    class="text-4xl font-semibold text-black"
                    >€37.99</span
                  >
                  <span
                    v-if="selectedPlan == 3"
                    class="text-4xl font-semibold text-black"
                  >
                    €35.99</span
                  >
                </div>
              </div>
            </div>

            <div class="p-6 mt-20 lg:pt-8 lg:pb-0">
              <h4 class="mb-2 text-2xl leading-tight">
                Premium
              </h4>
              <p class="text-black">Für große Betriebe oder Betriebe mit mehreren Standorten.</p>
            </div>
          </div>

          <div class="py-3 bg-gray-200 bg-opacity-25">
            <ul class="text-sm leading-loose uppercase text-secondary-400">
              <li>Barzahlung (Credit Card, Apple/Google pay)</li>
            </ul>
          </div>
          <div class="py-6 shadow-lg rounded-2xl">
            <div class="py-4 mt-auto">
              <a
                href="/businesses/subscriptions"
                class="w-40 px-6 py-3 text-sm font-medium text-center text-gray-600 rounded-full custom-button-inverted bg-primary-400 hover:border-primary-400 lg:text-lg"
              >
                Partner werden
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      response: {
        status: "",
        message: "",
      },
      selectedPlan: 1,
    };
  },
};
</script>