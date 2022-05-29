<template>
  <div class="flex w-full text-sm font-semibold text-primary-400">
    <star-rating
      v-if="this.rating"
      :star-size="22"
      :increment="0.5"
      :read-only="true"
      v-model="rating"
    ></star-rating>
    <span v-else class="flex">
      <h3 class="text-primary-400 text-2xl mr-2">-.-</h3>
      <star-rating
        :star-size="22"
        :increment="0.5"
        :read-only="true"
        :show-rating="false"
        :rating="0"
      ></star-rating>
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
  data() {
    return {
      rating: false,
    };
  },
  components: {
    StarRating,
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
