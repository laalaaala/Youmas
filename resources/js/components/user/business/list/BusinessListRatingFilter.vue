<template>
  <div class="flex w-full text-sm font-semibold text-right text-primary-400">
    <star-rating
      :star-size="20"
      :rating="4.5"
      :increment="1"
      :read-only="false"
      v-model="rating"
    ></star-rating>
  </div>
</template>

<script>
import StarRating from "vue-star-rating";

export default {
  data() {
    return {
      rating: 5,
    };
  },
  watch: {
    rating: {
      handler(val) {
        this.filter();
      },
    },
  },
  components: {
    StarRating,
  },
  methods: {
    filter() {
      /**
       * Change value in parent
       */
      try {
        this.$emit("changeRating", this.rating);
      } catch (error) {
        console.log("error", error);
      }
    },
  },
};
</script>
