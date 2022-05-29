<template>
  <div
    class="grid justify-center max-w-5xl mt-10 md:pb-20 lg:pb-0 lg:grid-cols-3 lg:mt-0 lg:justify-start gap-x-5 gap-y-5"
  >
    <div class="lg:mb-0">
      <input
        ref="autocomplete"
        id="autocomplete"
        placeholder="Standort"
        class="block w-full px-8 py-3 pr-8 text-gray-500 placeholder-gray-500 border rounded-full shadow-xl outline-none appearance-none lg:h-16 border-grey-lighter"
      />
      <gmaps-map @mounted="ready" style="visibility: hidden; height: 0px">
        <gmaps-marker :position="markerPos" />
      </gmaps-map>
    </div>
    <div class="">
      <div class="relative">
        <select
          class="block w-full px-8 py-3 pr-8 text-gray-500 bg-white border rounded-full shadow-xl outline-none appearance-none lg:h-16 bg-grey-lighter"
          id="grid-state"
          name="business_type"
          v-model="form.branch"
        >
          <option value="any">Alle</option>
          <option value="1">Hair Saloon</option>
          <option value="2">Tattoo/Piercing Studio</option>
          <option value="3">Beauty Saloon</option>
          <option value="4">Massagestudio</option>
        </select>
        <div
          class="absolute flex items-center px-2 mt-1 text-gray-500 pointer-events-none lg:mt-2 pin-y pin-r top-4 right-4"
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
    </div>
    <div class="">
      <div class="relative">
        <select
          class="block w-full px-8 py-3 pr-8 text-gray-500 bg-white border rounded-full shadow-xl outline-none appearance-none lg:h-16 bg-grey-lighter border-grey-lighter"
          id="grid-state"
          name="radius"
          v-model="form.radius"
        >
          <option value="5">5km</option>
          <option value="10">10km</option>
          <option value="20">20km</option>
          <option value="50">50km</option>
          <option value="100">100km</option>
        </select>
        <div
          class="absolute flex items-center px-2 mt-1 pointer-events-none lg:mt-2 pin-y pin-r text-grey-darker top-4 right-4"
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
    </div>
    <div class="flex items-top">
      <button
        class="
          w-full
          p-3
          lg:h-16
          mt-0.5
          text-white
          rounded-full
          bg-secondary-400
          focus:outline-none
          focus:ring-2
          ring-yellow-300 ring-offset-2
          font-medium
          text-md
          lg:text-2xl
          font-poppins
        "
        @click="goToBusinessList"
      >
        Suchen
      </button>
    </div>
  </div>
</template>

<script>
import { gmapsMap, gmapsMarker } from "x5-gmaps";
import { complexToQueryString } from "@/util/util";

export default {
  components: { gmapsMap, gmapsMarker },
  data() {
    return {
      autocomplete: null,
      places: null,
      map: null,
      markerPos: { lat: -27, lng: 153 },
      form: {
        branch: "any",
        lng: null,
        lat: null,
        radius: 5,
        address: null,
      },
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
      console.log("place", place);
      if (place.geometry) {
        this.form.lng = place.geometry.location.lng();
        this.form.lat = place.geometry.location.lat();
        this.form.address = place.formatted_address;

        this.map.panTo(place.geometry.location);
        this.markerPos = place.geometry.location;
      }
    },
    async goToBusinessList() {
      const query = complexToQueryString(this.form);
      window.location.href = `/businesses?${query}`;
    },
  },
};
</script>

<style lang="css"></style>