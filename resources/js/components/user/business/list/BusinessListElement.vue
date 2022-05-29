<template>
  <div
    class="w-full p-5 mt-3 mb-5 bg-white border rounded-lg shadow-sm"
    style="box-shadow: rgb(204, 204, 204) 0px 0px 6px"
  >
    <div class="lg:flex items-top">
      <div class="w-full lg:w-2/6">
        <carousel
          :per-page="1"
          :pagination-enabled="true"
          :navigationEnabled="true"
          :autoplay="true"
          navigationNextLabel="<i class='p-2 flex items-center fa fa-chevron-right bg-yellow-300 bg-opacity-70  h-8 w-8 rounded-full' style='position: absolute;
    right: 20px;' aria-hidden='true'></i>"
          navigationPrevLabel="<i class='p-2 flex items-center fa fa-chevron-left bg-yellow-300 bg-opacity-70 h-8 w-8 rounded-full' style='position: absolute;
    left: 20px;' aria-hidden='true'></i>"
          :navigationClickTargetSize="5"
          :loop="true"
        >
          <slide
            v-for="picture in business.pictures"
            :key="picture.id"
            class="h-64 w-32 overflow-hidden"
          >
            <img
              :src="picture.link"
              style="object-fit: contain; max-width: none"
          /></slide>
        </carousel>
      </div>
      <div class="block w-full lg:w-4/6 lg:flex">
        <div class="w-full ml-7 items-left justify-left lg:flex lg:flex-col">
          <div class="w-full text-sm my-2">
            <a
              :href="`/businesses/${business.id}`"
              class="my-4 text-2xl font-semibold text-heading-400"
            >
              {{ business.name }}
            </a>
          </div>
          <div class="flex flex-col lg:flex-row my-2">
            <BusinessRating :business="business" />
          </div>
          <div class="w-5/6 text-sm lg:text-xl">
            <div>
              {{ business.user.location.zip_code }},
              {{ business.user.location.city }}
            </div>
          </div>
          <div></div>
          <div
            class="mt-2 text-secondary-400 text-bold text-md lg:text-xl"
            style="overflow: hidden"
          >
            {{ business.description }}
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BusinessRating from "../common/BusinessRating.vue";

export default {
  components: {
    BusinessRating
  },
  props: {
    business: {
      type: Object,
      required: true
    }
  }
};
</script>
<style>
.VueCarousel-navigation-button:focus {
  outline: none !important;
}
.VueCarousel-pagination {
  position: absolute;
  bottom: 0;
}
.VueCarousel-dot {
  color: #fff;
  opacity: 50%;
}
.VueCarousel-dot--active {
  background-color: #fff !important;
  opacity: 100%;
}
</style>