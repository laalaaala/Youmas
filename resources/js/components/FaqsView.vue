<template>
  <div class="flex justify-center w-full bg-white">
    <div class="flex flex-col justify-center px-10 pt-16 lg:my-20 lg:px-0 xl:w-2/3">
      <!-- <div class="w-full mx-auto my-16 text-center">
        <h1
          class="-mb-10 font-bold uppercase lg:hidden text-8xl opacity-5"
          style="font: normal normal 900 40px/60px Poppins"
        >
          FAQ's
        </h1>
        <h1
          class="hidden -mb-20 text-4xl font-bold uppercase lg:block lg:text-8xl opacity-5"
          style="font: normal normal 900 103px/129px Poppins"
        >
          FAQ's
        </h1>

        <h1 class="text-2xl lg:text-6xl">FAQ's</h1>
        <p class="w-full mt-10 text-xl text-center text-black">
          Wir haben alle Antworten für Sie
        </p>
      </div> -->

      <h1 class="text-2xl lg:text-6xl">{{ page }}</h1>
      <div v-for="faq in faqs" :key="faq.id">
        <div
          class="w-full px-5 py-5 font-sans text-sm font-medium text-left bg-white border-2 border-gray-200 cursor-pointer text-secondary-100 md:text-xl focus:outline-none font-extralight"
          :class="
            faq.id == faqs.length
              ? ''
              : '' || faq.id == 1
              ? 'rounded-t-3xl'
              : ''
          "
          @click="toggleContent"
        >
          {{ faq.title }}
          <span class="custom-rotation">
            <i
              class="float-right text-sm cursor-pointer plus-icon custom-transition fas fa-plus"
            ></i>
          </span>
        </div>
        <div
          :class="faq.id == faqs.length ? 'rounded-b-3xl' : ''"
          class="h-0 overflow-hidden text-xs bg-white border-2 border-t-0 border-gray-200 text-secondary-100 md:text-lg custom-transition2"
        >
          <p class="p-5 font-light">
            {{ faq.content }}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<style>
.custom-transition {
  transition: all 0.3s ease-in-out;
}

.custom-transition2 {
  transform: scaleY(0);
  transform-origin: top;
  transition: transform 0.3s ease;
}

.custom-transition3 {
  transform: scaleY(1) !important;
  transition: transform 0.3s ease;
}

.custom-rotation {
  transform: rotate(180deg);
}
</style>

<script>
export default {
  props: {
    faqs: {
      type: Array,
      required: true,
    },
  },
  data() {
    return {};
  },
  methods: {
    toggleContent(e) {
      let title = e.target;
      let content = e.target.parentNode.childNodes[2];
      let plus = e.target.parentNode.childNodes[0].childNodes[1].childNodes[0];
      title.classList.toggle("border-b-0");
      content.classList.toggle("custom-transition3");
      content.classList.toggle("h-0");
      content.classList.toggle("h-auto");
      plus.classList.toggle("custom-rotation");
    },
  },
};
</script>