<template>
  <div class="p-5 border border-gray-200 rounded shadow lg:w-1/3 h-3/5">
    <span class="font-semibold text-gray-500"> Nach Behandlung filtern </span>
    <select
      class="block w-full px-3 py-2 my-2 text-base text-gray-900 bg-white border-2 border-gray-200 rounded-lg focus:outline-none focus:border-primary-400"
      name=""
      id=""
    >
      <option selected>Alle Bewertungen</option>
    </select>
    <span class="mt-10 font-semibold text-gray-500">
      Nach Sternen filtern
    </span>
    <div class="w-full">
      <div class="flex items-center p-1">
        <input
          type="checkbox"
          class="w-5 h-5 my-2 form-checkbox text-orange"
          @click="changeStars(5)"
          value="5"
        />
        <star-rating
          :rating="5"
          :star-size="20"
          :read-only="true"
          :increment="0.01"
          :show-rating="false"
        ></star-rating>
                <span class="opacity-30">5</span>

      </div>
      <div class="flex items-center p-1">
        <input
          type="checkbox"
          class="w-5 h-5 my-2 form-checkbox text-orange"
          @click="changeStars(4)"
          value="4"
        />
        <star-rating
          :rating="4"
          :star-size="20"
          :read-only="true"
          :increment="0.01"
          :show-rating="false"
        ></star-rating>

        <span class="opacity-30">4</span>
      </div>
      <div class="flex items-center p-1">
        <input
          type="checkbox"
          class="w-5 h-5 my-2 form-checkbox text-orange"
          @click="changeStars(3)"
        />
        <star-rating
          :rating="3"
          :star-size="20"
          :read-only="true"
          :increment="0.01"
          :show-rating="false"
        ></star-rating>

        <span class="opacity-30">3</span>
      </div>
      <div class="flex items-center p-1">
        <input
          type="checkbox"
          class="w-5 h-5 my-2 form-checkbox text-orange"
          @click="changeStars(2)"
        />
        <star-rating
          :rating="2"
          :star-size="20"
          :read-only="true"
          :increment="0.01"
          :show-rating="false"
        ></star-rating>

        <span class="opacity-30">2</span>
      </div>
      <div class="flex items-center p-1">
        <input
          type="checkbox"
          class="w-5 h-5 my-2 form-checkbox text-orange"
          @click="changeStars(1)"
        />
        <star-rating
          :rating="1"
          :star-size="20"
          :read-only="true"
          :increment="0.01"
          :show-rating="false"
        ></star-rating>

        <span class="opacity-30">1</span>
      </div>
    </div>
  </div>
</template>
<script>
import StarRating from "vue-star-rating";
import { complexToQueryString } from "@/util/util";

export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  components: {
    StarRating,
  },
  data() {
    return {
      reviews: [],
      filters: {
        service: null,
        stars: [],
      },
    };
  },
  watch: {
    filters: {
      handler() {
        this.getReviews();
      },
      deep: true,
      immediate: true,
    },
  },
  methods: {
    changeStars(id) {
      if (!this.filters.stars.includes(id)) {
        this.filters.stars.push(id);
      } else {
        this.filters.stars.splice(this.filters.stars.indexOf(id), 1); //deleting
      }
    },
    async getReviews() {
      try {
        const query = complexToQueryString(this.filters);
        let response = await this.axios.get(
          `/businesses/${this.user.id}/review/filter?${query}`
        );
        this.reviews = [...response.data.data];

        this.$emit("changeReviews", this.reviews);
      } catch (error) {
        console.log("getReviews", error);
      }
    },
  },
};
</script>