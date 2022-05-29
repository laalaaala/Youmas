<template>
  <div>
    <vue-dropzone
      v-if="local_pictures.length < 6"
      ref="uploadImage"
      id="dropzone"
      :options="dropzoneOptions"
      @vdropzone-success="uploadComplete"
    ></vue-dropzone>
    <h2 v-else class="w-full text-2xl text-center text-secondary-400">
      You can only upload up to 6 pictures.
    </h2>

    <carousel
      :loop="true"
      :per-page="3"
      :paginationEnabled="false"
      :navigationEnabled="true"
      navigationNextLabel="<i class='flex items-center w-8 h-8 p-2 bg-yellow-300 rounded-full fa fa-chevron-right bg-opacity-70' style='position: absolute;
    right: 20px;' aria-hidden='true'></i>"
      navigationPrevLabel="<i class='flex items-center w-8 h-8 p-2 bg-yellow-300 rounded-full fa fa-chevron-left bg-opacity-70' style='position: absolute;
    left: 20px;' aria-hidden='true'></i>"
      class="my-6"
    >
      <slide
        v-for="picture in local_pictures"
        :key="picture.id"
        class="mr-3 overflow-hidden lg:h-64 lg:w-64"
      >
        <i
          class="absolute top-0 right-0 mt-2 mr-2 text-2xl text-red-400 shadow-md cursor-pointer fa fa-trash"
          @click="deleteImage(picture.id)"
        ></i>
        <img :src="picture.link" style="object-fit: cover;
              max-width: none;
              width: 100%;
              height: 100%;"
      /></slide>
    </carousel>
  </div>
</template>

<script>
import vue2Dropzone from "vue2-dropzone";
import "vue2-dropzone/dist/vue2Dropzone.min.css";
import { Carousel, Slide } from "vue-carousel";

export default {
  components: {
    Carousel,
    Slide,
    vueDropzone: vue2Dropzone,
  },
  data() {
    return {
      local_pictures: [],
      dropzoneOptions: {
        url: "/businesses/pictures",
        thumbnailWidth: 150,
        maxFilesize: 15,
        dictDefaultMessage: "Drop your images or click to upload",
      },
    };
  },
  methods: {
    uploadComplete(file, response) {
      console.log("response", response);
      this.$refs.uploadImage.removeFile(file);
      this.local_pictures = [...response.data];
    },
    async getPictures() {
      let response = await this.axios.get("/businesses/pictures");
      this.local_pictures = [...response.data.data];
    },
    async deleteImage(picture_id) {
      let response = await this.axios.delete(
        `/businesses/pictures/${picture_id}`
      );
      this.local_pictures = [...response.data.data];
    },
  },
  mounted() {
    this.getPictures();
  },
};
</script>
