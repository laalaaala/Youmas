<template>
  <div class="p-5 bg-white rounded-sm shadow-lg">
    <div
      class="flex items-center px-4 space-x-2 font-semibold leading-8 text-gray-900 "
    >
      <div class="flex flex-row items-center w-1/2">
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
        <span class="tracking-wide">Über Youmas</span>
      </div>
      <div class="w-1/2 ml-auto text-right">
        <a
          class="flex flex-row items-center justify-center w-1/6 px-4 ml-auto text-center rounded shadow-md cursor-pointer "
          :class="editing ? 'bg-green-400' : 'bg-primary-400'"
          @click="editing = !editing"
        >
          <p v-if="!editing">Edit</p>
          <i v-if="!editing" class="ml-2 fas fa-pen"></i>
          <p v-if="editing" @click="saveProfileData">Save</p>
          <i v-if="editing" class="ml-2 fas fa-check"></i>
        </a>
      </div>
    </div>
    <div class="mt-5 text-gray-700">
      <div class="grid text-sm lg:grid-cols-2">
        <div class="grid grid-cols-2">
          <div class="px-4 py-2 font-semibold">Email</div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="p-2">{{ form.email }} </span>
            <input
              v-model="form.email"
              type="text"
              class="max-w-full p-2 border"
              v-else
            />
          </div>
        </div>
      </div>
      <div class="grid text-sm lg:grid-cols-2">
        <div class="grid grid-cols-2">
          <div class="px-4 py-2 font-semibold">Password</div>
          <div class="px-4 py-2">
            <span v-if="!editing" class="p-2">*********</span>
            <input
              v-model="form.password"
              type="text"
              class="max-w-full p-2 border"
              v-else
            />
          </div>
        </div>

        <div class="grid grid-cols-2">
          <div class="px-4 py-2 font-semibold">Telefon</div>
          <div class="px-4 py-2">
            <div class="p-2" v-if="!editing">
              {{ form.phone }}
            </div>
            <input
              v-model="form.phone"
              type="text"
              class="max-w-full p-2 border"
              v-else
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    user: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      editing: false,
      form: {
        email: this.user.email,
        password: this.user.password,
        phone: this.user.phone,
      },
    };
  },
  methods: {
    saveProfileData() {
      this.axios.put("/dashboard/profile", this.form);
    },
  },
};
</script>