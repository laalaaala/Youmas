<template>
  <div class="flex flex-col w-full mx-auto mt-10 lg:w-3/5 lg:px-10">
    <h1 class="pb-5 font-semibold text-gray-600 border-b border-gray-200">
      Salonbewertungen
    </h1>
    <div class="w-full mb-5 lg:flex">
      <div class="lg:w-1/3 flex items-center justify-center">
        <SingleBusinessRatingIndividual :business="business" />
      </div>
      <div class="lg:w-2/3 lg:flex">
        <div class="lg:w-1/2">
          <div class="flex w-full p-1 lg:border-b lg:border-gray-200">
            <div class="w-1/2 flex">
              <span class="text-gray-500 my-auto">Ambiente</span>
            </div>
            <div class="flex w-1/2">
              <BusinessSingleViewRatingBySeparated
                :business="business"
                :type="'ambient'"
              />
            </div>
          </div>
          <div class="flex w-full p-1">
            <div class="w-1/2 mr-auto flex">
              <span class="text-gray-500 my-auto">Sauberkeit</span>
            </div>
            <div class="flex w-1/2">
              <BusinessSingleViewRatingBySeparated
                :business="business"
                :type="'cleanliness'"
              />
            </div>
          </div>
        </div>
        <div class="lg:w-1/2">
          <div class="flex w-full p-1 lg:border-b lg:border-gray-200">
            <div class="w-1/2 mr-auto flex">
              <span class="text-gray-500 my-auto">Service</span>
            </div>
            <div class="flex w-1/2">
              <BusinessSingleViewRatingBySeparated
                :business="business"
                :type="'service'"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="mb-5 border-t-4 border-primary-400" />
    <div class="w-full mb-10 lg:flex">
      <BusinessSingleViewRatingFilter
        :user="business.user"
        @changeReviews="changeReviews"
      />
      <div class="mt-10 lg:w-2/3 lg:mt-0">
        <BusinessSingleViewReviewElement
          v-for="review in reviews"
          :key="review.id"
          :review="review"
        />
      </div>
    </div>
  </div>
</template>
<script>
import SingleBusinessRatingIndividual from "../SingleBusinessRatingIndividual.vue";
import BusinessSingleViewRatingBySeparated from "./BusinessSingleViewRatingBySeparated.vue";
import BusinessSingleViewRatingFilter from "./BusinessSingleViewRatingFilter.vue";
import BusinessSingleViewReviewElement from "./BusinessSingleViewReviewElement.vue";
import StarRating from "vue-star-rating";

export default {
  props: {
    business: {
      type: Object,
      required: true,
    },
  },
  components: {
    StarRating,
    SingleBusinessRatingIndividual,
    BusinessSingleViewRatingBySeparated,
    BusinessSingleViewRatingFilter,
    BusinessSingleViewReviewElement,
  },
  data() {
    return {
      reviews: [],
    }
  },
  methods: {
    changeReviews(reviews) {
      this.reviews = reviews;
    },
  },
};
</script>