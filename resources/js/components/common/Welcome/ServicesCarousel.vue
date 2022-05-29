<template>
  <div>
    <div
      class="relative flex flex-col hidden py-20 text-center lg:flex pb-60 gap-y-10"
      id="services-carousel"
    >
      <h1
        class="font-bold uppercase text-8xl opacity-5 -mb-28"
        style="font: normal normal 900 103px/129px Poppins"
      >
        works
      </h1>

      <h1 class="text-5xl">Youmas Recent Works</h1>
      <carousel
        class="flex flex-row gap-x-5"
        style="z-index: 999;"
        :per-page="3"
        :centerMode="true"
        :paginationEnabled="false"
        :loop="true"
        :navigateTo="currentPage"
        ref="workCarousel"
      >
        <slide class="flex items-center justify-center p-10 rounded-lg">
          <img
            src="/images/home/carousel-1.png"
            alt="image"
            class="rounded-3xl"
          />
        </slide>
        <slide class="flex items-center justify-center p-10 rounded-lg">
          <img
            src="/images/home/carousel-2.png"
            alt="image"
            class="rounded-3xl"
          />
        </slide>
          <slide class="flex items-center justify-center p-10 rounded-lg">
          <img
            src="/images/home/carousel-3.png"
            alt="image"
            class="rounded-3xl"
          />
        </slide>
      
      </carousel>
      <div
        class="absolute flex justify-center w-full bottom-16"
        
      >
        <div
          class="flex flex-row items-end justify-between w-full max-w-5xl px-20 pb-10 bg-primary-400 h-96 rounded-2xl"
        >
          <div>
            <i
              class="text-4xl cursor-pointer fas fa-arrow-left"
              style="z-index: 999"
              @click="changePage(currentPage - 1, 'minus')"
            ></i>
          </div>
          <div>
            <h2 class="text-3xl font-poppins">Work title here</h2>
            <h3>Lorem ipsum dolor sit amet.</h3>
          </div>
          <div>
            <i
            style="z-index: 999"
              class="text-4xl cursor-pointer fas fa-arrow-right"
              @click="changePage(currentPage + 1, 'plus')"
            ></i>
          </div>
        </div>
      </div>
    </div>
    <div
      class="relative flex flex-col py-10 text-center bg-gray-100 bg-opacity-50 lg:hidden pb-60 gap-y-10" 
      id="services-carousel"
    >
      <h1
        class="-mb-20 font-bold uppercase text-8xl opacity-5"
        style="font: normal normal 900 40px/60px Poppins"
      >
        works
      </h1>

      <h1 class="text-2xl">Youmas Recent Works</h1>
      <carousel
        class="flex flex-row gap-x-5"
        :per-page="1"
        :centerMode="true"
        :paginationEnabled="false"
        :loop="true"
        :navigateTo="currentPage"
        ref="workCarouselMobile"
      >
        <slide class="w-2/3 p-5 rounded-lg">
          <img
            src="https://picsum.photos/700/500"
            alt="image"
            class="rounded-3xl"
          />
        </slide>
        <slide class="p-5 rounded-lg">
          <img
            src="https://picsum.photos/700/500"
            alt="image"
            class="rounded-3xl"
          />
        </slide>
      
      </carousel>
      <div
        class="absolute flex justify-center w-full bottom-16"
        style="z-index: 0"
      >
        <div
          class="flex flex-row items-end justify-between w-full max-w-5xl px-20 pb-10 h-1/2 rounded-2xl"
        >
          <div>
            <i
              class="text-xl cursor-pointer fas fa-arrow-left"
              @click="changePage(currentPage - 1, 'minus')"
            ></i>
          </div>
          <div>
            <h2 class="text-xl font-poppins">Work title here</h2>
            <h3 class="text-sm text-gray-400">
              Lorem is a long established fact that a reader will be distracted
              by the readable content.
            </h3>
          </div>
          <div>
            <i
              class="text-xl cursor-pointer fas fa-arrow-right"
              @click="changePage(currentPage + 1, 'plus')"
            ></i>
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
      currentPage: 0,
    };
  },
  methods: {
    changePage(page, direction) {
      if (direction == "minus") {
        console.log("minus");
        this.$refs.workCarousel.goToPage(
          this.$refs.workCarousel.currentPage - 1
        );
        this.$refs.workCarouselMobile.goToPage(
          this.$refs.workCarouselMobile.currentPage - 1
        );
      } else {
        this.$refs.workCarousel.goToPage(
          this.$refs.workCarousel.currentPage + 1
        );
        this.$refs.workCarouselMobile.goToPage(
          this.$refs.workCarouselMobile.currentPage + 1
        );
      }
    },
  },
};
</script>
<style>
#services-carousel .VueCarousel-inner {
  display: flex;
  column-gap: 0px;
}
</style>