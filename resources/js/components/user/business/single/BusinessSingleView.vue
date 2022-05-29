<template>
  <div
    class="justify-center w-screen min-h-screen px-5 pt-10 lg:px-10 lg:pt-24"
  >
    <div class="flex flex-col w-full mx-auto lg:w-3/5 lg:px-5">
      <div class="flex flex-row justify-between">
        <h1 class="mt-4 mb-2 text-3xl font-semibold text-black">
          {{ business.name }}
        </h1>
        <i
          class="text-3xl cursor-pointer far fa-heart"
          v-if="auth && !favorite"
          @click="addFavorite()"
        ></i>
        <i
          class="text-3xl cursor-pointer fas fa-heart"
          v-if="auth && favorite"
          @click="removeFavorite()"
        ></i>
      </div>
      <div
        class="w-1/5 my-2 text-sm leading-normal lg:py-3 text-paragraph-400 lg:leading-relaxed"
      >
        <business-rating :business="business"></business-rating>
      </div>
      <carousel
        :per-page="3"
        :pagination-enabled="true"
        :navigationEnabled="true"
        :autoplay="true"
        navigationNextLabel="<i class='flex items-center w-8 h-8 p-2 bg-yellow-300 rounded-full fa fa-chevron-right bg-opacity-70' style='position: absolute;
    right: 20px;' aria-hidden='true'></i>"
        navigationPrevLabel="<i class='flex items-center w-8 h-8 p-2 bg-yellow-300 rounded-full fa fa-chevron-left bg-opacity-70' style='position: absolute;
    left: 20px;' aria-hidden='true'></i>"
        :navigationClickTargetSize="5"
        :loop="true"
      >
        <slide
          v-for="picture in business.pictures"
          :key="picture.id"
          class="mr-5 overflow-hidden lg:w-64 lg:h-64"
        >
          <img
            :src="picture.link"
            style="
              object-fit: cover;
              max-width: none;
              width: 100%;
              height: 100%;
            "
          />
        </slide>
      </carousel>
      <div class="flex items-center w-full text-secondary-400">
        <i class="fas fa-map-marker-alt"></i>
        <p class="ml-5 text-normal">
          {{ business.user.location.formatted_address }}
        </p>
      </div>
    </div>
    <!-- cards group -->
    <div class="flex flex-col w-full mx-auto mt-10 lg:w-3/5">
      <h1 class="font-semibold text-gray-600 lg:">Alle Services</h1>
      <div
        class="flex w-full p-5 overflow-x-scroll bg-gray-100 lg:overflow-hidden"
      >
        <div
          class="block w-auto p-3 mx-2 text-center rounded shadow-xl cursor-pointer "
          :class="
            selectedCategory.id == serviceCategory.id
              ? 'bg-gray-200'
              : 'bg-white'
          "
          style="width: 96px; text-align: center"
          v-for="serviceCategory in businessServiceCategories"
          :key="serviceCategory.id"
          @click="selectCategory(serviceCategory)"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            width="75"
            height="50"
            viewBox="0 0 50 50"
          >
            <g fill="none" fill-rule="evenodd">
              <path d="M0 0h50v50H0z"></path>
              <path
                fill="#999"
                fill-rule="nonzero"
                d="M20 33a6 6 0 1 1-6 6V29c-1.782-.842-3.007-1.593-3.707-2.293L10 26.414V26c0-12.273 2.503-23 5-23 2.666 0 5 9.336 5 23v7zm-4.587-5.55l.587.266V39a4 4 0 1 0 3.199-3.92L18 35.323V26c0-7.12-.595-12.757-1.595-16.757-.39-1.56-.824-2.782-1.246-3.595a6.15 6.15 0 0 0-.1-.186c-.06.121-.124.257-.189.406-.426.978-.871 2.395-1.271 4.11-.974 4.172-1.57 9.518-1.598 15.575.65.52 1.795 1.164 3.412 1.897z"
              ></path>
              <path
                fill="#999"
                fill-rule="nonzero"
                d="M10 33a6 6 0 1 0 3.6 10.8 7.99 7.99 0 0 1-1.002-1.759 4 4 0 1 1-1.797-6.961l1.199.243v-5.082a17.609 17.609 0 0 1-2-1.192V33zM25 5h10c5.57 0 7 1.716 7 9 0 3.269-.424 5.67-1.465 9.487l-.372 1.359c-.141.52-.253.946-.355 1.356C39.264 28.377 39 30.118 39 32c0 1.156.057 2.171.2 4.012.252 3.233.275 4.315.015 5.382C38.937 42.534 38.358 43 37 43c-3.383 0-4.229-2.962-3.03-7.757.088-.35.195-.741.34-1.245l.41-1.398c.17-.58.298-1.038.417-1.484.587-2.214.812-3.82.588-5.14C35.405 24.096 34.125 23 32 23h-7v2h7c1.143 0 1.596.387 1.753 1.311.162.956-.032 2.34-.55 4.293-.113.427-.238.87-.403 1.436-.034.118-.329 1.118-.41 1.402-.152.526-.266.938-.36 1.315C30.562 40.63 31.81 45 37 45c2.29 0 3.664-1.106 4.158-3.132.333-1.365.309-2.516.037-6.012C41.055 34.066 41 33.09 41 32c0-1.696.24-3.283.748-5.313.099-.395.207-.808.346-1.318l.37-1.356C43.55 20.04 44 17.481 44 14c0-8.316-2.237-11-9-11H25v2z"
              ></path>
              <path
                fill="#999"
                fill-rule="nonzero"
                d="M25 9h10V7H25zM25 13h11v-2H25zM25 17h11v-2H25zM25 21h11v-2H25z"
              ></path>
              <circle cx="15" cy="23" r="1" fill="#999"></circle>
              <circle cx="10" cy="39" r="2" fill="#999"></circle>
              <circle cx="20" cy="39" r="2" fill="#999"></circle>
            </g>
          </svg>
          <span
            class="flex items-center justify-center h-10 text-sm text-gray-500"
            >{{ serviceCategory.name }}</span
          >
        </div>
      </div>
    </div>

    <!-- Sub Category List -->
    <div class="w-full mx-auto my-10 lg:flex lg:w-3/5 lg:px-5">
      <div class="pr-5 lg:w-1/3">
        <div
          class="flex p-3 border-t cursor-pointer"
          :class="
            selectedSubCategory.id == subCategory.id
              ? 'bg-gray-200'
              : 'hover:bg-gray-200'
          "
          v-for="subCategory in selectedCategory.sub_categories"
          :key="subCategory.id"
          @click="selectSubCategory(subCategory)"
        >
          <span class="text-gray-600">{{ subCategory.name }} </span>
          <span class="ml-1 font-bold text-gray-400"
            >({{ countBusinessServices(subCategory.services) }})</span
          >
          <div class="ml-auto discount"></div>
        </div>
      </div>
      <div class="lg:w-2/3">
        <div v-for="service in selectedSubCategory.services" :key="service.id">
          <div
            class="flex w-full p-2 border-b border-gray-200 cursor-pointer lg:p-5"
            v-if="service.business_id == business.id"
          >
            <div class="flex flex-col w-3/5 text-gray-600">
              <span>{{ service.name }}</span>
              <span>{{ service.duration }} Min.</span>
            </div>
            <div class="w-2/5 lg:flex">
              <div class="mr-2 text-right lg:w-1/2">
                <span class="font-bold"> €{{ service.price }} </span>
              </div>
              <div class="text-right lg:w-1/2 lg:text-center">
                <button
                  class="px-3 border-2 rounded btn border-primary-400 text-md"
                  @click="addServiceToCart(service)"
                  v-if="!serviceIsSelected(service)"
                >
                  Auswählen
                </button>
                <button
                  class="px-1 border-2 rounded btn bg-primary-400 border-primary-400 text-md"
                  @click="removeServiceFromCart(service)"
                  v-else
                >
                  Ausgewählt
                  <i class="fa fa-check" />
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Rating -->
    <BusinessSingleViewRating :business="business" />

    <div class="flex flex-col w-full mx-auto my-10 lg:w-3/5 lg:px-10">
      <h1 class="pb-5 font-semibold text-gray-600 border-b border-gray-200">
        Saloninfo
      </h1>
      <div class="w-full mt-5 bg-gray-200 lg:flex">
        <div class="lg:w-1/2">
          <GmapMap
            :center="position"
            :zoom="13"
            map-type-id="terrain"
            style="width: 100%; height: 300px"
          >
            <GmapMarker
              :position="{ lat: position.lat, lng: position.lng }"
              :clickable="true"
              :draggable="true"
            />
          </GmapMap>
        </div>
        <div class="p-5 lg:w-1/2">
          <div class="flex">
            <i class="fas fa-map-marker-alt"></i>
            <div class="ml-5">
              <p class="ml-2 font-semibold">
                {{ business.user.location.city }}
              </p>
              <p class="ml-2 font-normal">
                {{ business.user.location.formatted_address }}
              </p>
              <p class="ml-2 font-normal">
                {{ business.user.phone }}
              </p>
              <!-- <p class="ml-2 font-normal">Frankfurt am Main</p> -->
            </div>
          </div>
        </div>
      </div>
      <div class="w-full mt-5 lg:flex">
        <div class="lg:w-2/3">
          <div class="flex">
            <p class="text-normal">
              {{ business.description }}
              <br />
              <br />
              .
            </p>
          </div>
        </div>
        <div class="mt-5 lg:w-1/3 lg:p-5 lg:pt-0 lg:mt-0">
          <div
            class="flex w-full my-2"
            v-for="hour in business.opening_hours"
            :key="hour.id"
          >
            <div class="w-1/2 text-left">
              <div class="hour"></div>
              <span class="capitalize text-normal"> {{ hour.day }} </span>
            </div>
            <div class="w-1/2 text-right">
              {{ hour.start }} - {{ hour.end }}
            </div>
          </div>
          <div class="flex w-full my-2">
            <div class="w-1/2 text-left">
              <div class="hour-closed"></div>
              <span class="text-normal"> Sonntag </span>
            </div>
            <div class="w-1/2 text-right">Geschlossen</div>
          </div>
        </div>
      </div>
    </div>
    <!-- Cart -->
    <div
      class="flex items-center w-full h-16 p-5 mx-auto bg-white border border-gray-200 rounded lg:w-1/2"
      id="cart"
    >
      <div class="w-full lg:w-2/3">
        <h2 class="text-2xl">
          {{ cart.length }} Services - <strong>€{{ cartTotalPrice() }}</strong>
        </h2>
      </div>
      <div class="w-full ml-auto text-right lg:w-1/3">
        <button
          class="px-6 py-3 font-bold border-primary-400"
          :class="
            !cart.length
              ? 'bg-yellow-200 cursor-arrow'
              : 'bg-primary-400 hover:bg-primary-400 hover:text-white border'
          "
          @click="goToCheckout"
          :disabled="!cart.length"
        >
          Zur Kasse
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import BusinessRating from "../common/BusinessRating.vue";
import { Carousel, Slide } from "vue-carousel";
import StarRating from "vue-star-rating";
import BusinessSingleViewRating from "./BusinessSingleViewRating.vue";
export default {
  components: {
    StarRating,
    BusinessSingleViewRating,
    BusinessRating,
    Carousel,
    Slide,
  },
  props: {
    business: {
      type: Object,
      required: true,
    },
    businessServiceCategories: {
      type: Array,
      required: true,
    },
    is_favorite: {
      type: Boolean,
      required: false,
    },
    auth: { type: Boolean, required: false },
  },
  data() {
    return {
      options: {
        zoomControl: false,
        streetViewControl: false,
        draggable: false,
        fullscreenControl: false,
        mapTypeControl: false,
        mapTypeId: "roadmap",
      },
      favorite: this.is_favorite,
      data: [
        '<div class="example-slide">Slide 1</div>',
        '<div class="example-slide">Slide 2</div>',
        '<div class="example-slide">Slide 3</div>',
      ],
      selectedCategory: this.businessServiceCategories[0],
      selectedSubCategory: this.businessServiceCategories[0].sub_categories[0],
      cart: [],
    };
  },
  methods: {
    async addFavorite() {
      try {
        let response = await this.axios.post(
          `/favorites/${this.business.id}/add`
        );
        this.favorite = !this.favorite;
      } catch (error) {
        console.log("Error: ", error);
      }
    },
    async removeFavorite() {
      try {
        let response = await this.axios.post(
          `/favorites/${this.business.id}/remove`
        );
        this.favorite = !this.favorite;
      } catch (error) {
        console.log("Error: ", error);
      }
    },
    countBusinessServices(services) {
      let business = this.business;
      let totalServices = services.reduce(function (acc, val) {
        console.log(val.business_id, business.id);
        if (val.business_id == business.id) {
          return acc + 1;
        } else {
          return acc;
        }
      }, 0);

      return totalServices;
    },
    goToCheckout() {
      localStorage.setItem("services", JSON.stringify(this.cart));
      window.location.href = `/checkout/${this.business.id}`;
    },
    marker() {
      return {
        lat: this.position.lat,
        lng: this.position.lat,
      };
    },
    serviceIsSelected(service) {
      let isSelected = this.cart.filter((cartService) => {
        return cartService.id == service.id;
      }).length
        ? true
        : false;

      return isSelected;
    },
    selectCategory(category) {
      this.selectedCategory = category;
      this.selectedSubCategory = category.sub_categories[0];
    },
    selectSubCategory(subCategory) {
      this.selectedSubCategory = subCategory;
    },
    addServiceToCart(service) {
      this.cart.push(service);
    },
    removeServiceFromCart(service) {
      var index = this.cart
        .map((x) => {
          return x.id;
        })
        .indexOf(service.id);

      this.cart.splice(index, 1);
    },
    cartTotalPrice() {
      /** Sum all prices to get a total **/
      let totalPrice = 0;

      if (this.cart.length) {
        totalPrice = this.cart.reduce(function (acc, val) {
          return acc + val.price;
        }, 0);
      }

      console.log("test", totalPrice);

      return totalPrice;
    },
  },

  computed: {
    serviceCategories() {
      let categories = this.business.services.map((service) => {
        console.log(service.sub_category);
        return {
          name: service.sub_category,
        };
      });

      return categories;
    },
    position() {
      console.log("location lat", this.business.user.location.lat);
      let data = {
        lat: parseFloat(this.business.user.location.lat),
        lng: parseFloat(this.business.user.location.lng),
      };
      return data;
    },
  },
};
</script>

<style scoped>
.discount {
  width: 16px;
  height: 16px;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMCAwaDI0djI0SDB6Ii8+PGNpcmNsZSBzdHJva2U9IiMwMEIwQjkiIHN0cm9rZS13aWR0aD0iMiIgY3g9IjEyIiBjeT0iMTIiIHI9IjEwIi8+PHBhdGggZmlsbD0iIzAwQjBCOSIgZmlsbC1ydWxlPSJub256ZXJvIiBkPSJNMTMuMjQgNi4zOTFMOC45MTIgMTYuODQ0bDEuODQ4Ljc2NSA0LjMzLTEwLjQ1M3pNOCAxMWEyIDIgMCAxMDAtNCAyIDIgMCAwMDAgNHptOCA2YTIgMiAwIDEwMC00IDIgMiAwIDAwMCA0eiIvPjwvZz48L3N2Zz4=);
  background-size: contain;
}
.discount2 {
  width: 24px;
  height: 24px;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjQiIGhlaWdodD0iMjQiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGcgZmlsbD0ibm9uZSIgZmlsbC1ydWxlPSJldmVub2RkIj48cGF0aCBkPSJNMCAwaDI0djI0SDB6Ii8+PGNpcmNsZSBzdHJva2U9IiMwMEIwQjkiIHN0cm9rZS13aWR0aD0iMiIgY3g9IjEyIiBjeT0iMTIiIHI9IjEwIi8+PHBhdGggZmlsbD0iIzAwQjBCOSIgZmlsbC1ydWxlPSJub256ZXJvIiBkPSJNMTMuMjQgNi4zOTFMOC45MTIgMTYuODQ0bDEuODQ4Ljc2NSA0LjMzLTEwLjQ1M3pNOCAxMWEyIDIgMCAxMDAtNCAyIDIgMCAwMDAgNHptOCA2YTIgMiAwIDEwMC00IDIgMiAwIDAwMCA0eiIvPjwvZz48L3N2Zz4=);
  background-size: contain;
}
.hour {
  display: inline-block;
  width: 12px;
  height: 12px;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiI+PGNpcmNsZSBjeD0iMTc4IiBjeT0iNTM2IiByPSI2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTcyIC01MzApIiBmaWxsPSIjM2JhMTUwIi8+PC9zdmc+);
}
.hour-closed {
  display: inline-block;
  width: 12px;
  height: 12px;
  background-image: url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIxMiIgaGVpZ2h0PSIxMiI+PGNpcmNsZSBjeD0iMTc4IiBjeT0iNTM2IiByPSI2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTcyIC01MzApIiBmaWxsPSIjYjNiM2IzIi8+PC9zdmc+);
}
@media (max-width: 768px) {
  #cart {
    left: 0 !important;
    right: 0 !important;
  }
}
#cart {
  position: fixed;
  bottom: 0;
  left: 25%;
}
</style>
