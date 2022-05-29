<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <section class="lg:py-20">
          <div
            class="container w-full h-full max-w-2xl mx-auto shadow-md lg:w-3/4"
          >
            <div class="flex items-center h-10 pl-5 bg-primary-400">
              <p class="text-lg text-secondary-400">Dienstleistungsinfo</p>

              <button
                @click="closeModal"
                class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md bg-primary-700 h-7"
              >
                X
              </button>
            </div>
            <div class="space-y-0 bg-white">
              <div
                class="items-center w-full p-4 space-y-0 text-gray-500 lg:inline-flex lg:space-y-0"
              >
                <div
                  class="flex flex-row mx-auto space-x-4 space-y-0 lg:w-full"
                >
                  <div class="flex flex-col w-1/5 text-center">
                    <label class="text-sm text-gray-400">Name</label>
                    {{ selectedService.name }}
                  </div>
                  <hr class="my-1" />
                  <div class="flex flex-col w-1/5 text-center">
                    <label class="text-sm text-gray-400">Category</label>
                    {{ selectedService.sub_category.category.name }}
                  </div>
                  <hr class="my-1" />
                  <div class="flex flex-col w-1/5 text-center">
                    <label class="text-sm text-gray-400">Sub Category</label>
                    {{ selectedService.sub_category.name }}
                  </div>
                  <hr class="my-1" />
                  <div class="flex flex-col w-1/5 text-center">
                    <label class="text-sm text-gray-400">Duration</label>
                    {{ selectedService.duration }} minutes
                  </div>
                  <div class="flex flex-col w-1/5 text-center">
                    <label class="text-sm text-gray-400">Price</label>
                    €{{ selectedService.price }}
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>
  </transition>
</template>


<script>
export default {
  props: {
    service: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      selectedService: this.service,
    };
  },
  methods: {
    closeModal() {
      this.$emit("closeViewModal");
    },
  },
};
</script>

<style lang="css">
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  display: table;
  transition: opacity 0.3s ease;
}

.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}

.modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.33);
  transition: all 0.3s ease;
  font-family: Helvetica, Arial, sans-serif;
}

.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}

.modal-body {
  margin: 20px 0;
}

.modal-default-button {
  float: right;
}

/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */

.modal-enter {
  opacity: 0;
}

.modal-leave-active {
  opacity: 0;
}

.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>
