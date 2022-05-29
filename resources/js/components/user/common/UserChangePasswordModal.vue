<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <section class="md:py-20">
          <div
            class="container w-full h-full max-w-2xl mx-auto shadow-md md:w-3/4"
          >
            <div class="flex items-center h-10 pl-5 bg-primary-400">
              <p class="text-lg text-secondary-400">Passwort ändern</p>
              <button
                @click="closeModal"
                class="p-2 py-1 ml-auto mr-5 font-bold rounded-md shadow-md bg-primary-700 h-7"
              >
                X
              </button>
            </div>

            <div class="space-y-0 bg-white">
              <div class="flex flex-row p-4 space-x-3">
                <div class="flex flex-col w-1/2">
                  <label class="text-sm text-gray-400">Neues Password</label>
                  <div class="inline-flex w-full border">
                    <div
                      class="flex items-center justify-center w-2/12 bg-gray-100"
                    >
                      <i class="fas fa-signature"></i>
                    </div>
                    <input
                      v-model="form.password"
                      type="password"
                      class="w-10/12 p-2 focus:outline-none focus:text-gray-600"
                      placeholder="New Password"
                    />
                  </div>
                </div>
                <div class="flex flex-col w-1/2">
                  <label class="text-sm text-gray-400">Passwort wiederholen</label>
                  <div class="inline-flex w-full border">
                    <div
                      class="flex items-center justify-center w-2/12 bg-gray-100"
                    >
                      <i class="fas fa-signature"></i>
                    </div>
                    <input
                      v-model="form.repeat_password"
                      type="password"
                      class="w-10/12 p-2 focus:outline-none focus:text-gray-600"
                      placeholder="Repeat Password"
                    />
                  </div>
                </div>
              </div>
              <div class="w-full px-4 pb-2" v-if="errors.password">
                <div
                  class="flex items-center px-4 py-3 text-sm font-bold text-white bg-red-500"
                  role="alert"
                >
                  <p>{{ response.message }}</p>
                </div>
              </div>

              <hr />

              <div class="w-full p-4 text-right text-gray-500">
                <button
                  class="inline-flex items-center mr-4 focus:outline-none"
                  @click="changePassword"
                >
                  Passwort ändern
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
  data() {
    return {
      form: {
        password: null,
        repeat_password: null,
      },
      errors: {
        password: false,
      },
      response: {
        message: null,
        status: "",
      },
    };
  },
  methods: {
    closeModal() {
      this.$emit("closeModal");
    },
    changePassword() {
      if (!this.form.password || !this.form.repeat_password) {
        this.errors.password = true;
        this.response.message = "All fields are required";
        return;
      }

      if (this.form.password != this.form.repeat_password) {
        this.errors.password = true;
        this.response.message = "Passwords do not match";
        return;
      }

      this.$emit("changePassword", this.form.password);
      this.closeModal();
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
