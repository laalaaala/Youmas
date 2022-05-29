<template>
  <div class="flex w-full text-lg font-semibold text-left text-primary-400">
    <star-rating
      v-if="rating"
      :star-size="20"
      :increments="0.1"
      :show-rating="false"
      :read-only="true"
      v-model="rating"
    ></star-rating>
<star-rating
      v-else
      :star-size="20"
      :increments="0.1"
      :show-rating="false"
      :read-only="true"
      :rating="0"
    ></star-rating>  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  props: {
    business: {
      type: Object,
      required: true,
    },
    type: {
      type: String,
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
    calculateRating() {
      let type = this.type;

      if (this.business.user.reviews.length) {
        let average = 0;

        this.business.user.reviews.forEach((review) => {
          average += review[`${type}`];
        });

        this.rating = average / this.business.user.reviews.length;
      } else {
        return false;
      }
    },
  },
  mounted() {
    this.calculateRating();
  },
};
</script>
<style scoped>
.vue-star-rating {
  flex-direction: row-reverse !important;
  align-items: flex-start !important;
}
.vue-star-rating-star {
  display: block !important;
}
.vue-star-rating-rating-text {
  margin-right: 20px;
}
</style>
