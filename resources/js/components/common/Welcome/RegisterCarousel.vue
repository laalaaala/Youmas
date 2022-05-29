<template>
  <div class="w-full" id="register-carousel">
    <!-- Register carousel -->

    <div class="container flex hidden py-32 mx-auto lg:flex">
      <div class="w-1/2 xl:pl-10 2xl:pl-50">
        <h1
          class="-mb-20 font-bold uppercase md:text-6xl lg:text-8xl opacity-5"
          style="font: normal normal 900 80px/100px Poppins"
        >
          Part
        </h1>
        <h1 class="mb-5 leading-snug md:text-4xl xl:text-5xl">
          Become Part of <br />
          The Comunity
        </h1>
        <i
          class="mx-5 ml-2 text-3xl cursor-pointer fas fa-long-arrow-alt-left"
          @click="changePage(currentPage - 1, 'minus')"
        ></i>
        <i
          class="text-3xl cursor-pointer fas fa-long-arrow-alt-right"
          @click="changePage(currentPage + 1, 'plus')"
        ></i>
      </div>
      <div class="w-1/2">
        <carousel
          class="flex flex-row gap-x-5"
          :per-page="1"
          :centerMode="true"
          :paginationEnabled="false"
          :loop="true"
          :navigateTo="currentPage"
          ref="registerCarousel"
        >
          <slide class="rounded-lg">
            <div class="flex flex-col justify-start w-3/4 p-10 2xl:w-2/3">
              <h1 class="mb-3 text-2xl text-center lg:text-left">As a company</h1>
               <p class="w-11/12 mb-10 text-center text-black lg:text-left">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text. Lorem Ipsum has been the industry's standard dummy
                text.
              </p>
              <a
                href="/register/company"
                class="w-2/3 px-6 py-4 ml-0 font-medium text-center text-white rounded-full md:w-full 2xl:w-2/3 custom-button"
                >Register as a company
              </a>
            </div>
          </slide>
          <slide class="rounded-lg">
            <div class="flex flex-col justify-start w-3/4 p-10 2xl:w-2/3">
              <h1 class="mb-3 text-2xl text-center lg:text-left">For Customers</h1>
              <p class="w-11/12 mb-10 text-center text-black lg:text-left">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text. Lorem Ipsum has been the industry's standard dummy
                text.
              </p>
              <a
                href="/register/company"
                class="w-3/4 px-6 py-4 ml-0 font-medium text-center text-white rounded-full lg:w-full 2xl:w-2/3 custom-button"
                >Register as a customer
              </a>
            </div>
          </slide>
        </carousel>
      </div>
    </div>
    <!-- Mobile register carousel -->
    <div class="container py-16 mx-auto lg:hidden">
      <h1
        class="-mb-10 font-bold text-center uppercase lg:hidden text-8xl opacity-5"
        style="font: normal normal 900 40px/60px Poppins"
      >
        Part
      </h1>
      <h1 class="w-1/2 mx-auto text-2xl text-center">
        Become Part of The Comunity
      </h1>
      <div class="flex flex-col w-full px-10 my-10">
        <h1 class="text-lg font-medium text-center lg:text-2xl">For Customers</h1>
        <p class="mx-10 mt-5 mb-10 text-sm text-center text-gray-400 lg:mt-0 lg:text-md lg:text-black lg:mx-0">
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry. 
        </p>
        <a
          href="/register/company"
          class="px-6 py-3 mx-auto font-medium text-center text-white rounded-full lg:mx-5 bg-secondary-400 hover:border-primary-400 md:w-1/2 lg:w-full"
          >Register as a customer
        </a>
      </div>
      <div class="flex flex-col w-full px-10 mt-20 mb-10">
        <h1 class="text-lg font-medium text-center lg:text-2xl">As a company</h1>
        <p class="mx-10 mt-5 mb-10 text-sm text-center text-gray-400 lg:mt-0 lg:text-md lg:text-black lg:mx-0">
          Lorem Ipsum is simply dummy text of the printing and typesetting
          industry.
        </p>
        <a
          href="/register/company"
          class="px-6 py-3 mx-auto font-medium text-center text-white rounded-full lg:mx-5 bg-secondary-400 custom-button hover:border-primary-400 hover:bg-primary-400 md:w-1/2 lg:w-full"
          >Register as a company
        </a>
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
        this.$refs.registerCarousel.goToPage(
          this.$refs.registerCarousel.currentPage - 1
        );
      } else {
        this.$refs.registerCarousel.goToPage(
          this.$refs.registerCarousel.currentPage + 1
        );
      }
    },
  },
};
</script>
<style scoped>
@media (min-width: 1024px) {
  #register-carousel {
    background: url("/images/home/community-background.jpg");
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover;
  }
}
</style>