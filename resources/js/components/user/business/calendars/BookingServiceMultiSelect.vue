<template>
  <div class="flex flex-col items-center w-full mx-auto">
    <div class="w-full">
      <div class="relative flex flex-col items-center">
        <div class="w-full svelte-1l8159u">
          <div
            class="flex p-1 bg-white border border-gray-200 rounded svelte-1l8159u"
          >
            <div class="flex flex-wrap flex-auto">
              <div
                class="flex items-center justify-center px-2 py-1 m-1 font-medium text-teal-700 bg-white bg-teal-100 border border-teal-300 rounded-full "
                v-for="(service, index) in selectedServices"
                :key="service.id"
              >
                <div
                  class="flex-initial max-w-full text-xs font-normal leading-none "
                >
                  {{ service.name }}
                </div>
                <div class="flex flex-row-reverse flex-auto">
                  <div>
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="100%"
                      height="100%"
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="w-4 h-4 ml-2 rounded-full cursor-pointer feather feather-x hover:text-teal-400"
                      @click="deselectService(index)"
                    >
                      <line x1="18" y1="6" x2="6" y2="18"></line>
                      <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                  </div>
                </div>
              </div>
              <div class="flex-1">
                <input
                  @click="show = !show"
                  readonly
                  placeholder=""
                  class="w-full h-full p-1 px-2 text-gray-800 bg-transparent outline-none appearance-none "
                />
              </div>
            </div>
            <div
              @click="show = !show"
              class="flex items-center w-8 py-1 pl-2 pr-1 text-gray-300 border-l border-gray-200 svelte-1l8159u"
            >
              <button
                class="w-6 h-6 text-gray-600 outline-none cursor-pointer focus:outline-none"
              >
                <i
                  v-if="!show"
                  class="fa fa-chevron-down"
                  aria-hidden="true"
                ></i>
                <i v-if="show" class="fa fa-chevron-up" aria-hidden="true"></i>
              </button>
            </div>
          </div>
        </div>
        <div
          v-if="show"
          class="absolute z-40 w-full overflow-y-auto bg-white rounded shadow top-100 lef-0 max-h-select svelte-5uyqqj"
        >
          <div class="flex flex-col w-full">
            <div
              class="w-full border-b border-gray-100 rounded-t cursor-pointer hover:bg-teal-100"
              v-for="service in services"
              :key="service.id"
              @click="selectService(service)"
            >
              <div
                class="relative flex items-center w-full p-2 pl-2 border-l-2 hover:border-teal-100"
                :class="
                  isSelected(service)
                    ? 'border-primary-400'
                    : 'border-transparent'
                "
              >
                <div class="flex items-center w-full">
                  <div class="mx-2 leading-6">{{ service.name }}</div>
                </div>
              </div>
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
    services: {
      type: Array,
      required: true,
    },
    employee: {
      type: Object,
      default: () => {},
    },
  },
  data() {
    return {
      show: false,
      selectedServices:
        this.employee && this.employee.services.length
          ? [...this.employee.services]
          : [],
    };
  },
  methods: {
    selectService(service) {
      /**
       * Check that is not selected
       */
      for (var i = 0; i < this.selectedServices.length; i++) {
        if (this.selectedServices[i].id === service.id) {
          return;
        }
      }
      this.selectedServices.push(service);
      this.$emit("addService", service);
    },
    isSelected(service) {
      return this.selectedServices.find((element) => {
        return element.id == service.id;
      });
    },
    deselectService(index) {
      this.selectedServices.splice(index, 1);
      this.$emit("removeService", index);
    },
  },
  mounted() {
    if (this.selectedServices.length && this.employee) {
      this.selectedServices.forEach((service) => {
        console.log(service);
        this.$emit("addService", service);
      });
    }
  },
};
</script>

<style>
.top-100 {
  top: 100%;
}
.bottom-100 {
  bottom: 100%;
}
.max-h-select {
  max-height: 300px;
}
</style>
