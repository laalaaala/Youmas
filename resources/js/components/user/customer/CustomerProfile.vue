<template>
  <div
    class="h-full p-5 pt-5 rounded-sm lg:pt-16 lg:pb-60 xl:px-24"
    style="background: #f4f4f2"
  >
    <div
      class="flex items-center px-2 space-x-2 font-semibold leading-8 text-gray-900 "
    >
      <div class="flex flex-row items-center w-1/2 py-2">
        <span clas="text-green-500">
          <svg
            class="h-5 mr-3"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
            ></path>
          </svg>
        </span>
        <span class="font-normal tracking-wide lg:text-3xl">Benutzerinfos</span>
        <a
          class="flex flex-row items-center justify-center px-1 mt-0 text-center rounded cursor-pointer "
          @click="editing = !editing"
        >
          <i v-if="!editing" class="ml-2 text-sm fas fa-pen"></i>
          <i v-if="editing" class="ml-2 fas fa-check"></i>
        </a>
      </div>
      <div class="flex w-1/2 ml-auto text-right">
        <a
          class="flex flex-row items-center justify-center px-4 py-2 ml-auto text-xs text-center rounded shadow-md cursor-pointer bg-primary-400 xl:w-3/6 lg:text-lg"
          @click="dialog = !dialog"
        >
          Passwort ändern
        </a>
      </div>
    </div>
    <div class="mt-5 text-gray-700 xl:mt-16">
      <div class="grid text-sm lg:grid-cols-3">
        <div class="flex flex-col">
          <div class="px-4 py-2 pb-0 text-lg font-medium text-secondary-400">
            Vorname
          </div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="p-2 pl-0 text-lg text-gray-500">{{
              form.first_name
            }}</span>
            <input
              v-model="form.first_name"
              type="text"
              class="w-full p-2 border"
              v-else
            />
          </div>
        </div>
        <div class="flex flex-col">
          <div class="px-4 py-2 pb-0 text-lg font-medium text-secondary-400">
            Nachname
          </div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="px-2 pl-0 text-lg text-gray-500">{{
              form.last_name
            }}</span>
            <input
              v-model="form.last_name"
              type="text"
              class="w-full p-2 border"
              v-else
            />
          </div>
        </div>

        <div class="flex flex-col">
          <div class="px-4 py-2 pb-0 text-lg font-medium text-secondary-400">
            Email
          </div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="px-2 pl-0 text-lg text-gray-500"
              >{{ form.email }}
            </span>
            <input
              v-model="form.email"
              type="text"
              class="w-full p-2 border"
              v-else
            />
          </div>
        </div>
        <div class="flex flex-col">
          <div class="px-4 py-2 pb-0 text-lg font-medium text-secondary-400">
            Geburtsdatum
          </div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="px-2 pl-0 text-lg text-gray-500">{{
              form.date_of_birth | moment("DD/MM/YYYY")
            }}</span>
            <input
              v-model="form.date_of_birth"
              type="date"
              class="w-full p-2 border"
              v-else
            />
          </div>
        </div>
        <div class="grid text-sm">
          <div class="flex flex-col">
            <div class="px-4 py-2 pb-0 text-lg font-medium text-secondary-400">
              Telefonnummer 
            </div>
            <div class="px-4 py-2">
              <div class="px-2 pl-0 text-lg text-gray-500" v-if="!editing">
                {{ form.phone }}
              </div>
              <input
                v-model="form.phone"
                type="text"
                class="w-full p-2 border"
                v-else
              />
            </div>
          </div>
        </div>
      </div>

      <div class="flex flex-col">
        <div class="w-1/4 px-4 py-2 text-lg font-semibold">Anschrift</div>
        <div
          v-if="!editing"
          class="w-3/4 px-6 py-2 pt-0 pl-4 text-lg text-gray-500"
        >
          {{ form.street }} {{ form.street_number }} ({{ form.zip_code }}),
          {{ form.city }}
        </div>
        <div
          v-else
          class="flex grid flex-row flex-wrap w-full px-4 py-2 text-sm lg:grid-cols-3"
        >
          <div class="flex flex-col mb-2">
            <label for="Street">Straße</label>
            <div class="px-4 py-2 pl-0">
              <input
                v-model="form.street"
                type="text"
                placeholder="Street"
                class="w-full p-2 border"
              />
            </div>
          </div>
          <div class="flex flex-col mb-2">
            <label for="Street" class="lg:ml-4">Hausnummer</label>
            <div class="px-4 py-2 pl-0 lg:pl-4">
              <input
                v-model="form.street_number"
                type="text"
                placeholder="Street Number"
                class="w-full p-2 border"
              />
            </div>
          </div>
          <div class="flex flex-col mb-2">
            <label for="Street" class="lg:ml-4">Stadt</label>
            <div class="px-4 py-2 pl-0 lg:pl-4">
              <input
                v-model="form.city"
                type="text"
                placeholder="City"
                class="w-full p-2 border"
              />
            </div>
          </div>
          <div class="flex flex-col mb-2">
            <label for="Street">PLZ</label>
            <div class="px-4 py-2 pl-0">
              <input
                v-model="form.zip_code"
                type="text"
                placeholder="Zip Code"
                class="w-full p-2 border"
              />
            </div>
          </div>
        </div>
      </div>
    </div>
    <UserChangePasswordModal
      v-if="dialog"
      @closeModal="closeModal"
      @changePassword="changePassword"
    />
  </div>
</template>


<script>
import UserChangePasswordModal from "../common/UserChangePasswordModal.vue";

export default {
  components: {
    UserChangePasswordModal,
  },

  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      editing: false,
      dialog: false,
      form: {
        first_name: this.user.customer.first_name,
        last_name: this.user.customer.last_name,
        date_of_birth: this.user.customer.date_of_birth,
        email: this.user.email,
        phone: this.user.phone,
        password: this.user.password,
        street: this.user.location.street,
        street_number: this.user.location.street_number,
        zip_code: this.user.location.zip_code,
        city: this.user.location.city,
        formatted_address: "",
      },
    };
  },
  watch: {
    editing: {
      handler(val) {
        this.saveProfileData();
      },
    },
  },
  methods: {
    saveProfileData() {
      this.form.formatted_address =
        this.form.street +
        " " +
        this.form.street_number +
        ", " +
        this.form.zip_code +
        " " +
        this.form.city;
      this.axios.put("/dashboard/profile", this.form);
    },
    closeModal() {
      this.dialog = false;
    },
    async changePassword(new_password) {
      let data = {
        password: new_password,
      };
      console.log("data", data);
      try {
        let response = await this.axios.put(
          "/dashboard/profile/password",
          data
        );
      } catch (error) {
        console.log("error");
      }
    },
  },
};
</script>