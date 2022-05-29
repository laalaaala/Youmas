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
                class="flex flex-wrap items-center w-full p-4 text-gray-500 lg:inline-flex lg:space-y-4 flex-rwo"
              >
                <div
                  class="flex flex-row mx-auto space-x-4 space-y-0 lg:w-full"
                >
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Name</label>
                    <div class="inline-flex w-full border">
                      <div
                        class="flex items-center justify-center w-2/12 bg-gray-100 "
                      >
                        <i class="fas fa-signature"></i>
                      </div>
                      <input
                        v-model="form.name"
                        type="text"
                        class="w-10/12 p-2 focus:outline-none focus:text-gray-600"
                        placeholder="Name"
                      />
                    </div>
                  </div>
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400"
                      >Dauer in Minuten</label
                    >
                    <div class="inline-flex w-full border">
                      <div class="w-2/12 py-2 text-center bg-gray-100">
                        <i class="fas fa-clock"></i>
                      </div>
                      <select v-model="form.duration" class="w-full bg-white">
                        <option value="15">15 Minutes</option>
                        <option value="30">30 Minutes</option>
                        <option value="45">45 Minutes</option>
                        <option value="60">60 Minutes</option>
                        <option value="75">75 Minutes</option>
                        <option value="90">90 Minutes</option>
                        <option value="105">105 Minutes</option>
                        <option value="120">120 Minutes</option>
                        <option value="135">135 Minutes</option>
                        <option value="150">150 Minutes</option>
                        <option value="165">165 Minutes</option>
                        <option value="180">180 Minutes</option>
                        <option value="195">195 Minutes</option>
                        <option value="210">210 Minutes</option>
                        <option value="225">225 Minutes</option>
                        <option value="240">240 Minutes</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div
                  class="flex flex-row mx-auto mt-3 space-x-4 space-y-0 lg:w-full"
                >
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Price</label>
                    <div class="inline-flex w-full border">
                      <div
                        class="flex items-center justify-center w-2/12 bg-gray-100 "
                      >
                        <i class="fas fa-euro-sign"></i>
                      </div>
                      <input
                        v-model="form.price"
                        type="text"
                        class="w-10/12 p-2 focus:outline-none focus:text-gray-600"
                        placeholder="Price"
                      />
                    </div>
                  </div>
                  <div class="flex flex-col w-1/2">
                    <label class="text-sm text-gray-400">Subcategory</label>
                    <div class="inline-flex w-full border">
                      <div class="w-2/12 py-2 text-center bg-gray-100">
                        <i class="fab fa-cuttlefish"></i>
                      </div>
                      <select
                        name=""
                        id=""
                        v-model="form.subcategory"
                        class="w-full bg-white"
                      >
                        <option
                          :value="subcategory.id"
                          v-for="subcategory in sub_categories"
                          :key="subcategory.id"
                        >
                          {{ subcategory.name }}
                        </option>
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
              <div v-if="response.status" class="p-1 mt-0">
                <div
                  class="relative px-6 py-4 my-3 mb-4 text-center text-white bg-green-500 border-0 rounded "
                  v-if="response.status == 200"
                >
                  <span class="inline-block mr-8 align-middle">
                    {{ response.message }}
                  </span>
                </div>
                <div
                  class="relative px-6 py-4 my-3 mb-4 text-center text-white bg-red-500 border-0 rounded "
                  v-if="response.status == 422"
                >
                  <span class="inline-block mr-8 align-middle">
                    {{ response.message }}
                  </span>
                </div>
              </div>
              <div class="w-full p-4 text-right text-gray-500">
                <button
                  class="inline-flex items-center mr-4 focus:outline-none"
                  @click="updateService"
                >
                  Update
                </button>
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
    service: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      serviceCategories: null,
      serviceCategorySubcategories: null,
      sub_categories: [],
      form: {
        id: this.service.id,
        name: this.service.name,
        price: this.service.price,
        duration: this.service.duration,
        subcategory: this.service.sub_category.id,
        // sub_categories: [],
      },
      //   categories: [],
      response: {
        message: "",
        status: "",
      },
    };
  },

  methods: {
    editEmployee() {
      this.$emit("closeEditModal");
    },
    closeModal() {
      this.$emit("closeEditModal");
    },
    // addEmployeeService(sub_category) {
    //   this.form.sub_categories.push(category.id);
    // },
    // removeEmployeeService(index) {
    //   this.form.sub_categories.splice(index, 1);
    // },
    async updateService() {
      this.$emit("updateService", this.form);
    },
    async getSubCategories() {
      try {
        let response = await this.axios.get(
          `/dashboard/services/subcategories/`
        );
        this.sub_categories = response.data.data;
      } catch (error) {
        console.log("error", error);
      }
    },
  },
  mounted() {
    this.getSubCategories();
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
