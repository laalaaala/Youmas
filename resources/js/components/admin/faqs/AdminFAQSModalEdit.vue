<template>
  <vue-modaltor
    :visible="true"
    @hideModal="toggleEditModal"
    :resize-width="{ 1200: '60%', 992: '80%', 768: '90%' }"
    :animation-panel="'modal-slide-bottom'"
  >
    >
    <template #body>
      <div class="w-full flex justify-center">
        <button
          class="
            border
            px-10
            py-3
            uppercase
            text-xl text-secondary-300
            bg-primary-100
            absolute
          "
          style="right: 5%"
          @click="toggleEdit()"
          v-if="!edit"
          id="switch"
        >
          <span v-if="!edit">Edit <i class="fas fa-pen"></i></span>
        </button>
        <button
          class="
            border
            px-10
            py-3
            uppercase
            text-xl text-secondary-300
            bg-primary-100
            absolute
          "
          style="right: 5%"
          v-else
          @click="
            toggleEdit();
            updateFaq();
          "
          id="switch"
        >
          <span>Confirm <i class="fas fa-check"></i></span>
        </button>
        <div class="w-1/2 flex flex-col justify-center mt-5" id="view">
          <div class="flex flex-col mb-5">
            <h1
              class="
                font-bold
                text-3xl text-secondary-100 text-center
                uppercase
              "
              v-if="!edit"
            >
              {{ faq.title }}
            </h1>
            <input
              class="border pl-2 pr-10 py-3"
              name="title"
              type="text"
              placeholder="Title"
              v-else
              v-model="faq.title"
            />
          </div>
          <div class="flex flex-col">
            <p class="text-xl text-secondary-300" v-if="!edit">
              {{ faq.content }}
            </p>
            <textarea
              class="border pl-2 pr-10 py-3"
              name="content"
              cols="30"
              rows="10"
              v-model="faq.content"
              v-else
            ></textarea>
          </div>
        </div>
      </div>

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
    faq: {
      type: Object,
      default: () => {},
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
      edit: false,
    };
  },
  methods: {
    toggleEditModal() {
      this.$emit("toggleEditModal");
    },
    toggleEdit() {
      this.edit = !this.edit;
    },
    async updateFaq() {
      try {
        let data = {
          id: this.faq.id,
          title: this.faq.title,
          content: this.faq.content,
        };
        let response = await this.axios.post(
          `/admin/faqs/${this.faq.id}/update`,
          data
        );
        this.response.status = response.status;
        this.response.message = response.data.message;
      } catch (error) {
        console.log("error", error);
        this.response.status = error.status;
        this.response.message = error.response.data.message;
      }
      setTimeout(window.location.reload(), 5000);
    },
  },
};
</script>