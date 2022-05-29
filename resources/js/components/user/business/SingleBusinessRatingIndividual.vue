<template>
  <div class="flex text-5xl font-semibold text-right text-primary-400">
    <star-rating
      v-if="this.rating"
      :star-size="35"
      :increment="0.5"
      :show-rating="true"
      :read-only="true"
      v-model="rating"
    ></star-rating>
    <span v-else class="flex justify-between align-between">
      <h3 class="text-primary-400 text-6xl mr-5">-.-</h3>
      <span class="text-left">
        <star-rating
        class="-mb-5"
          :star-size="35"
          :increment="0.5"
          :show-rating="false"
          :read-only="true"
          :rating="0"
        ></star-rating>
        <span class="text-gray-400 text-sm mr-auto"> 0 Bewertung </span>
      </span>
    </span>
  </div>
</template>

<script>
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
  },
  data() {
    return {
      rating: false,
    };
  },
  methods: {
    calculateAverageRating() {
      if (this.business.user.reviews.length) {
        let average = 0;

        this.business.user.reviews.forEach((review) => {
          average += review.average;
        });

        this.rating = average / this.business.user.reviews.length;
      } else {
        return false;
      }
    },
  },
  mounted() {
    this.calculateAverageRating();
  },
};
</script>
