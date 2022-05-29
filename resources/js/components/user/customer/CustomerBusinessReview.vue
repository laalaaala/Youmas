<template>
  <div class="flex flex-col px-5 py-10">
    <h1 class="mx-auto mb-10 text-2xl text-secondary-400">
      Leave a review to {{ business.name }}
    </h1>
    <div class="flex flex-col">
      <div class="flex w-full my-3">
        <span class="w-1/3">Ambient</span>
        <star-rating
          :star-size="20"
          :increment="0.5"
          :read-only="false"
          v-model="rating.ambient"
          class="ml-auto"
        ></star-rating>
      </div>
      <hr />
      <div class="flex w-full my-3">
        <span class="w-1/3">Service</span>
        <star-rating
          :star-size="20"
          :increment="0.5"
          :read-only="false"
          v-model="rating.service"
          class="ml-auto"
        ></star-rating>
      </div>
      <hr />

      <div class="flex w-full my-3">
        <span class="w-1/3">Cleanliness</span>
        <star-rating
          :star-size="20"
          :increment="0.5"
          :read-only="false"
          v-model="rating.cleanliness"
          class="ml-auto"
        ></star-rating>
      </div>
    </div>
    <hr />

    <div class="flex flex-col w-full mt-5">
      <span class="mb-2">Comment</span>
      <textarea
        class="p-2 border"
        name=""
        id=""
        rows="10"
        v-model="rating.comment"
        placeholder="Leave a comment ..."
      ></textarea>
      <button
        class="px-10 py-3 mt-5 font-bold uppercase border border-black rounded bg-primary-400 text-secondary-400"
        @click="createReview"
      >
        Review
      </button>
    </div>
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
      rating: {
        ambient: 5,
        service: 5,
        cleanliness: 5,
        comment: "",
      },
      token: "",
    };
  },
  methods: {
    async createReview() {
      try {
        console.log("business", this.business);
        let response = await this.axios.post(
          `/businesses/${this.business.user.id}/review?token=${this.token}`,
          this.rating
        );

        window.location.replace("/dashboard");
      } catch (error) {}
    },
  },
  mounted() {
    const urlParams = new URLSearchParams(window.location.search);
    const token = urlParams.get("token");

    if (!token) {
      window.location.replace("/dashboard");
    }

    this.token = token;
  },
};
</script>