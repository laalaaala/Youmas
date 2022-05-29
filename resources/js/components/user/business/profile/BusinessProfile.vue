<template>
  <div class="relative mt-5 bg-white rounded-sm shadow-sm md:p-5">
    <div
      class="items-center p-5 px-0 space-x-2 font-semibold leading-8 text-gray-900 md:flex md:px-4"
    >
      <div class="flex flex-row items-center w-1/2">
        <span clas="text-green-500">
          <svg
            class="h-5"
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
        <span class="tracking-wide">Infos über das Unternehmen</span>
      </div>
      <div class="flex flex-row ml-auto space-x-2 text-right md:w-1/2">
        <a
          class="flex flex-row items-center justify-center px-4 py-2 text-sm text-center bg-blue-400 rounded shadow-md cursor-pointer md:py-1 md:w-3/6 md:text-lg md:ml-auto"
          @click="dialog = !dialog"
        >
          Passwort ändern
        </a>
        <a
          class="flex flex-row items-center justify-center px-4 py-2 ml-auto text-sm text-center rounded shadow-md cursor-pointer md:py-1 md:text-lg md:w-1/2"
          :class="editing ? 'bg-green-400' : 'bg-primary-400'"
          @click="editing = !editing"
        >
          <p v-if="!editing">Bearbeiten</p>
          <i v-if="!editing" class="ml-2 fas fa-pen"></i>
          <p v-if="editing">Save</p>
          <i v-if="editing" class="ml-2 fas fa-check"></i>
        </a>
      </div>
    </div>
    <div class="text-gray-700">
      <div class="grid text-sm lg:grid-cols-2 lg:gap-x-10">
        <div class="grid mb-2 md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Geschäftsname</div>
          <div class="px-2 py-2" v-if="!editing">{{ form.name }}</div>
          <input
            v-model="form.name"
            type="text"
            class="max-w-full p-2 border"
            v-else
          />
        </div>
        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Branche</div>
          <div class="px-2 py-2">{{ user.business.branch.name }}</div>
        </div>
        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Ansprechspartner</div>
          <div class="px-2 py-2" v-if="!editing">
            {{ form.person_to_contact }}
          </div>
          <input
            v-model="form.person_to_contact"
            type="text"
            class="max-w-full p-2 border"
            v-else
          />
        </div>
        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Telefon</div>
          <div class="px-2 py-2" v-if="!editing">{{ form.phone }}</div>
          <input
            v-model="form.phone"
            type="text"
            class="max-w-full p-2 border"
            v-else
          />
        </div>
        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Email</div>
          <div class="py-2">
            <a
              v-if="!editing"
              :href="`mailto:${form.email}`"
              class="px-2 text-blue-800"
              >{{ form.email }}</a
            >
            <input
              v-model="form.email"
              type="text"
              class="w-full max-w-full p-2 border"
              v-else
            />
          </div>
        </div>
        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">UST ID</div>
          <div class="py-2">
            <span v-if="!editing" class="px-2">{{ form.ust_id }}</span>
            <input
              v-model="form.ust_id"
              type="text"
              class="w-full max-w-full p-2 border"
              v-else
            />
          </div>
        </div>

        <div class="grid md:grid-cols-2">
          <div class="px-2 py-2 font-semibold md:px-4">Addresse</div>
          <div class="px-2 py-2">
            {{ user.location.street }} {{ user.location.street_number }} ({{
              user.location.zip_code
            }}),
            {{ user.location.city }}
          </div>
        </div>
      </div>
    </div>
    <!-- /About -->
    <!-- Description -->
    <div class="p-5 px-0 mt-5 bg-white rounded-sm shadow-sm md:px-4">
      <div
        class="flex items-center px-4 space-x-2 font-semibold leading-8 text-gray-900"
      >
        <span clas="text-green-500">
          <svg
            class="h-5"
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
        <span class="tracking-wide">Beschreibung</span>
      </div>
      <div class="pl-4 text-gray-700">
        <div class="grid text-sm" v-if="!editing">
          {{ form.description }}
        </div>
        <textarea
          class="w-full p-3 border"
          v-else
          v-model="form.description"
          name=""
          id=""
          cols="30"
          rows="5"
        ></textarea>
      </div>
    </div>

    <UserChangePasswordModal
      v-if="dialog"
      @closeModal="closeModal"
      @changePassword="changePassword"
    />
  </div>

  <!-- /Description -->
</template>

<script>
import UserChangePasswordModal from "../../common/UserChangePasswordModal.vue";
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
      dialog: false,
      editing: false,
      form: {
        name: this.user.business.name,
        description: this.user.business.description,
        phone: this.user.phone,
        person_to_contact: this.user.business.person_to_contact,
        ust_id: this.user.business.ust_id,
        email: this.user.email,
      },
    };
  },
  watch: {
    editing: {
      handler(val) {
        if (!val) {
          this.saveProfileData();
        }
      },
      deep: true,
    },
  },
  methods: {
    async saveProfileData() {
      try {
        let response = await this.axios.put("/dashboard/profile", this.form);
      } catch (error) {
        alert("error");
        console.log(error);
      }
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
  mounted() {
    console.log("user", this.user);
  },
};
</script>