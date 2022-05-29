<template>
  <vue-modaltor
    :visible="createOpen"
    @hideModal="toggleCreateModal"
    :resize-width="{ 1200: '60%', 992: '80%', 768: '90%' }"
    :animation-panel="'modal-slide-bottom'"
  >
    >
    <template #body>
      <div class="w-full flex justify-center">
        <div class="w-1/2 flex flex-col justify-center mt-5">
          <div class="flex flex-col mb-5">
            <label for="title">Title</label>
            <input
              class="border pl-2 pr-10 py-3"
              name="title"
              type="text"
              placeholder="Title"
              v-model="form.title"
            />
          </div>
          <div class="flex flex-col">
            <label for="content">Content</label>
            <textarea
              class="border pl-2 pr-10 py-3"
              name="content"
              cols="30"
              rows="10"
              v-model="form.content"
            ></textarea>
          </div>
          <button
            class="
              px-10
              py-3
              font-bold
              uppercase
              rounded
              bg-primary-400
              text-secondary-400
              mt-5
              border border-black
            "
            @click="createFaq"
          >
            Submit
          </button>
          <div
            v-if="response.status == 200"
            class="bg-green-400 text-white w-full p-3 text-center mt-5"
          >
            {{ response.message }}
          </div>
          <div
            v-if="response.status == 422"
            class="bg-red-400 text-white w-full p-3 text-center"
          >
            {{ response.message }}
          </div>
        </div>
      </div>
    </template>
  </vue-modaltor>
</template>
<style>
.modaltor__overlay {
  background: transparent !important;
}

.modaltor__panel {
  background: #ffffff !important;
  padding: 20px;
  height: 50%;
  margin: auto;
  color: black !important;
  width: 50% !important;
}
</style>
<script>
export default {
  props: {
    createOpen: {
      type: Boolean,
      required: true,
    },
  },
  data() {
    return {
      form: {
        title: "",
        content: "",
      },
      response: {
        status: "",
        message: "",
      },
    };
  },
  methods: {
    toggleCreateModal() {
      this.$emit("toggleCreateModal");
    },
    async createFaq() {
      try {
        let data = this.form;
        let response = await this.axios.post(`/admin/faqs/create`, data);
        this.response.status = response.status;
        this.response.message = response.data.message;
      } catch (error) {
        console.log("error", error);
        this.response.status = error.status;
        this.response.message = error.response.data.message;
      }
      console.log(this.response.message);
      setTimeout(window.location.reload(), 5000);
    },
  },
};
</script>