<template>
  <div class="w-full">
    <div
      class="justify-center w-screen px-5 py-10 lg:flex lg:pt-24 lg:min-h-screen"
    >
      <div
        class="w-full h-full bg-white rounded lg:w-1/5 lg:p-10 lg:ml-5 lg:shadow-md"
      >
        <h3
          class="text-xl font-semibold text-center text-primary-400 lg:text-left"
        >
          Filters
        </h3>
        <hr class="hidden w-1/6 border-t-2 lg:block border-primary-400" />

        <h1 class="mt-4 text-xl font-semibold text-heading-400">Kategorie</h1>
        <div class="flex flex-col mt-3 mb-8">
          <label class="inline-flex items-center mt-3"
            ><input
              type="radio"
              name="company_type"
              value="1"
              class="w-5 h-5 form-checkbox text-orange custom-radio"
              style="appearance: checkbox !important"
              v-model="filters.branch"
            />
            <span class="ml-2 font-medium text-paragraph-400"
              >Hairdressers</span
            ></label
          >
          <label class="inline-flex items-center mt-3">
            <input
              type="radio"
              name="company_type"
              value="2"
              class="w-5 h-5 form-checkbox text-orange custom-radio"
              style="appearance: checkbox !important"
              v-model="filters.branch"
            />
            <span class="ml-2 font-medium text-paragraph-400"
              >Tattoo/Piercing Studio</span
            ></label
          >
          <label class="inline-flex items-center mt-3">
            <input
              type="radio"
              name="company_type"
              value="3"
              class="w-5 h-5 form-checkbox text-orange custom-radio"
              style="appearance: checkbox !important"
              v-model="filters.branch"
            />
            <span class="ml-2 font-medium text-paragraph-400"
              >Beauty Saloon</span
            ></label
          >
          <label class="inline-flex items-center mt-3">
            <input
              type="radio"
              name="company_type"
              value="4"
              class="w-5 h-5 form-checkbox text-orange custom-radio"
              style="appearance: checkbox !important"
              v-model="filters.branch"
            />
            <span class="ml-2 font-medium text-paragraph-400"
              >Massage Studio </span
            ></label
          >

          <label class="inline-flex items-center mt-3"
            ><input
              type="radio"
              value="any"
              class="w-5 h-5 form-checkbox text-orange custom-radio"
              style="appearance: checkbox !important"
              v-model="filters.branch"
            />
            <span class="ml-2 font-medium text-paragraph-400">Alle</span></label
          >
        </div>
        <h1 class="mt-5 text-xl font-semibold text-heading-400">Standort</h1>
        <div class="mt-3 mb-8 lg:w-full">
          <input
            ref="autocomplete"
            id="autocomplete"
            placeholder="Location"
            class="block w-full px-4 py-3 pr-8 border rounded appearance-none bg-grey-lighter border-grey-lighter text-grey-darker"
          />
          <gmaps-map @mounted="ready" style="visibility: hidden">
            <gmaps-marker :position="markerPos" />
          </gmaps-map>
        </div>

        <h3 class="text-xl font-semibold text-heading-400">Radius</h3>
        <div class="relative mt-3 mb-8">
          <select
            class="block w-full px-4 py-3 pr-8 border rounded appearance-none bg-grey-lighter border-grey-lighter text-grey-darker"
            id="grid-state"
            v-model="filters.radius"
          >
            <option value="5">5km</option>
            <option value="10">10km</option>
            <option value="20">20km</option>
            <option value="50">50km</option>
            <option value="100">100km</option>
          </select>
          <div
            class="absolute top-0 right-0 flex items-center px-2 mt-4 pointer-events-none pin-y pin-r text-grey-darker"
          >
            <svg
              class="w-4 h-4"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
              />
            </svg>
          </div>
        </div>
        <div>
          <!-- <h3 class="text-xl font-semibold text-heading-400">Rating</h3>
          <div class="flex">
            <BusinessListRatingFilter @changeRating="changeRating" />
          </div> -->
          <div class="mt-10 middle">
            <a
              class="p-3 text-white rounded-md cursor-pointer bg-secondary-400 hover:bg-primary-400 focus:outline-none focus:ring-2 ring-yellow-300 ring-offset-2"
              @click="filterBusinesses"
            >
              Suchen
            </a>
          </div>
        </div>
      </div>
      <div class="flex flex-col w-full lg:w-3/5 lg:px-5">
        <h1 class="mt-4 mb-2 text-xl font-semibold text-primary-400">
          Ergebnisse ({{ localBusinesses.length }})
        </h1>
        <!-- Business Element -->
        <BusinessListElement
          v-for="business in localBusinesses"
          :key="business.id"
          :business="business"
        />

        <!-- Pagination -->
        <div class="bottom-0 flex justify-center w-full mt-auto text-center">
          <button
            class="w-10 h-10 p-1 mr-5 text-base text-lg font-semibold tracking-wide border rounded shadow appearance-none border-primary-400 text-primary-400"
          >
            1
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import BusinessListRatingFilter from "./BusinessListRatingFilter.vue";
import BusinessListElement from "./BusinessListElement.vue";
import { gmapsMap, gmapsMarker } from "x5-gmaps";
import { complexToQueryString } from "@/util/util";

export default {
  components: {
    BusinessListRatingFilter,
    BusinessListElement,
    gmapsMap,
    gmapsMarker,
  },
  data() {
    return {
      autocomplete: null,
      places: null,
      map: null,
      markerPos: { lat: -27, lng: 153 },
      filters: {
        branch: 1,
        lng: null,
        lat: null,
        radius: 5,
        rating: 5,
      },
      imageArray: [
        "https://cdn.pixabay.com/photo/2015/12/12/15/24/amsterdam-1089646_1280.jpg",
        "https://cdn.pixabay.com/photo/2016/02/17/23/03/usa-1206240_1280.jpg",
        "https://cdn.pixabay.com/photo/2015/05/15/14/27/eiffel-tower-768501_1280.jpg",
        "https://cdn.pixabay.com/photo/2016/12/04/19/30/berlin-cathedral-1882397_1280.jpg",
      ],
      localBusinesses: [],
    };
  },
  methods: {
    ready(map) {
      this.map = map;
      this.$GMaps().then((maps) => {
        this.places = new maps.places.PlacesService(map);
        this.autocomplete = new maps.places.Autocomplete(
          this.$refs.autocomplete
        );
        this.autocomplete.addListener("place_changed", this.updateLocation);
      });
    },
    updateLocation() {
      const place = this.autocomplete.getPlace();
      if (place.geometry) {
        this.filters.lng = place.geometry.location.lng();
        this.filters.lat = place.geometry.location.lat();

        this.map.panTo(place.geometry.location);
        this.markerPos = place.geometry.location;
      }
    },
    changeRating(rating) {
      this.filters.rating = rating;
    },
    async filterBusinesses() {
      const query = complexToQueryString(this.filters);
      let response = await this.axios.get(`/businesses/filter?${query}`);

      this.localBusinesses = response.data.data;
    },
  },
  mounted() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const lat = urlParams.get("lat");
    const lng = urlParams.get("lng");
    const radius = urlParams.get("radius");
    const address = urlParams.get("address");
    const branch = urlParams.get("branch");

    if (branch) {
      this.filters.branch = branch;
    }

    if (lat) {
      this.filters.lat = lat;
    }

    if (lng) {
      this.filters.lng = lng;
    }

    if (radius) {
      this.filters.radius = radius;
    }

    if (address) {
      document.querySelector("#autocomplete").value = address;
    }

    this.filterBusinesses();
  },
};
</script>
