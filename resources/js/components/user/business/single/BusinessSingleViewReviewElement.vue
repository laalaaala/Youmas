<template>
  <div class="pb-5 m-2 border-b border-gray-200 lg:m-5 lg:mt-0">
    <star-rating
      :rating="review.average"
      :star-size="20"
      :read-only="true"
      :increment="0.01"
      :show-rating="false"
    ></star-rating>

    <p class="my-3 text-sm">
      {{ review.comment }}
    </p>
    <span class="text-sm text-gray-400 text-semibold"
      >{{ review.customer.customer.first_name }}
      {{ review.customer.customer.last_name }}</span
    >
    <span class="text-gray-400 text-semibold">•</span>
    <span
      class="
        p-1
        text-sm text-gray-600
        border border-gray-200
        rounded-full
        text-semibold
      "
      >{{ review.service.name }}</span
    >
  </div>
</template>
<script>
import StarRating from "vue-star-rating";

export default {
  props: {
    review: {
      type: Object,
      required: true,
    },
  },
  components: {
    StarRating,
  },
};
</script>