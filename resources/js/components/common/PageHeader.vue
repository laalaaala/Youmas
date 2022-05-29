<template>
  <div
    class="page-header h-60 lg:h-96 flex flex-col justify-center items-center"
  >
    <h1
      class="lg:hidden uppercase font-bold text-8xl opacity-5 -mb-10"
      style="font: normal normal 900 40px/60px Poppins;"
    >
      {{ title }}
    </h1>
    <h1
      class="hidden lg:block uppercase font-bold text-8xl opacity-5 -mb-20"
      style="font: normal normal 900 103px/129px Poppins"
    >
      {{ title }}
    </h1>

    <h1 class="text-2xl lg:text-6xl">{{ page }}</h1>

    <h3 class="text-sm lg:text-lg font-medium mt-2">
      Home / <span class="text-gray-400 underline font-medium">{{ title }}</span>
    </h3>
  </div>
</template>

<script>
export default {
  props: {
    page: {
      type: String,
      required: true,
    },
    title: {
      type: String,
      required: true,
    },
  },
};
</script>