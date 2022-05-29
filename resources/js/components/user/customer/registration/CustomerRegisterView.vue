<template>
  <div
    class="flex flex-col"
    method="POST"
    action="/register"
  >
    <input
      name="type"
      type="hidden"
      id="type"
      value="customer"
      class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
      required
    />
    <div>
      <div class="pt-3 my-3 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
        >
          Anrede
        </label>
        <select
          name="salutation"
          id=""
          class="block w-4/5 pb-4 mb-2 ml-2 text-sm font-bold text-gray-700 bg-transparent "
          v-model="form.salutation"
        >
          <option value="Herr">Herr</option>
          <option value="Frau">Frau</option>
        </select>
        <span
          class="invalid-feedback"
          role="alert"
          v-if="errors.salutation"
        >
          <strong>This field is required</strong>
        </span>
      </div>
      <div class="flex flex-row space-x-2">
        <div class="w-1/2 pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="email"
          >Vorname</label>
          <input
            name="first_name"
            type="text"
            id="first_name"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
            v-model="form.first_name"
            required
          />
          <span
            class="invalid-feedback"
            role="alert"
            v-if="errors.first_name"
          >
            <strong>This field is required</strong>
          </span>
        </div>
        <div class="w-1/2 pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="email"
          >Nachname</label>
          <input
            name="last_name"
            type="text"
            id="last_name"
            v-model="form.last_name"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
            required
          />
          <span
            class="invalid-feedback"
            role="alert"
            v-if="errors.last_name"
          >
            <strong>This field is required</strong>
          </span>
        </div>
      </div>
    </div>
    <div class="flex flex-col w-full lg:flex-row">
      <div class="lg:w-1/2 lg:mr-2">
        <div class="pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="location"
          >Straße</label>

          <input
            name="location"
            v-model="form.location.street"
            type="text"
            id="autocomplete"
            required
            placeholder="Straße"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          />
          <p
            class="text-red-400"
            v-if="this.errors.location.street"
          >
            Please provide a street
          </p>
        </div>
      </div>
      <div class="lg:w-1/2">
        <div class="pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="location"
          >
            Hausnummer
          </label>

          <input
            name="location"
            v-model="form.location.street_number"
            id="autocomplete"
            required
            type="number"
            placeholder="Hausnummer"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          />
          <p
            class="text-red-400"
            v-if="this.errors.location.street_number"
          >
            Please provide a street number
          </p>
        </div>
      </div>
    </div>
    <div class="flex flex-col w-full lg:flex-row">
      <div class="mr-2 lg:w-1/2">
        <div class="pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="location"
          >
            Stadt</label>

          <input
            name="location"
            v-model="form.location.city"
            id="autocomplete"
            required
            placeholder="Stadt"
            type="text"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          />
          <p
            class="text-red-400"
            v-if="this.errors.location.city"
          >
            Please provide a city
          </p>
        </div>
      </div>
      <div class="lg:w-1/2">
        <div class="pt-3 my-3 bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="location"
          >
            PLZ</label>

          <input
            name="location"
            v-model="form.location.zip_code"
            id="autocomplete"
            required
            placeholder="PLZ"
            type="number"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          />
          <p
            class="text-red-400"
            v-if="this.errors.location.zip_code"
          >
            Please provide a PLZ
          </p>
        </div>
      </div>
    </div>

    <div class="flex flex-row space-x-3">
      <div class="pt-3 my-3 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
        >Email</label>
        <input
          name="email"
          type="text"
          id="email"
          v-model="form.email"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
        />
        <span
          class="invalid-feedback"
          role="alert"
          v-if="errors.email"
        >
          <strong>This field is required</strong>
        </span>
      </div>
      <div class="pt-3 my-3 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="phone"
        >Telefon</label>
        <input
          v-model="form.phone"
          name="phone"
          type="text"
          id="phone"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
        />
        <span
          class="invalid-feedback"
          role="alert"
          v-if="errors.phone"
        >
          <strong>This field is required</strong>
        </span>
      </div>
    </div>
    <div class="pt-3 my-3 bg-gray-200 rounded">
      <label
        class="block mb-2 ml-3 text-sm font-bold text-gray-700"
        for="email"
      >Geburtsdatum</label>
      <input
        v-model="form.date_of_birth"
        name="date_of_birth"
        type="date"
        id="date_of_birth"
        class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
        required
      />
      <span
        class="invalid-feedback"
        role="alert"
        v-if="errors.date_of_birth"
      >
        <strong>This field is required</strong>
      </span>
    </div>

    <div class="pt-3 my-3 bg-gray-200 rounded">
      <label
        class="block mb-2 ml-3 text-sm font-bold text-gray-700"
        for="password"
      >Password</label>
      <input
        name="password"
        type="password"
        id="password"
        v-model="form.password"
        class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-600"
        required
      />
      <span
        class="invalid-feedback"
        role="alert"
        v-if="errors.password"
      >
        <strong>This field is required</strong>
      </span>
    </div>
    <div
      v-if="response.status == 422"
      class="w-full p-3 text-center text-white bg-red-400"
    >
      {{ response.message }}
    </div>
    <div class="flex flex-row items-center w-full mt-5">
      <input
        type="checkbox"
        @click="termsConditions = !termsConditions"
      />
      <span class="ml-5 text-xs">Hiermit akzeptiere ich die
        <a
          href="https://www.iubenda.com/privacy-policy/22508480"
          target="_blank"
          class="font-bold text-primary-400"
        >Datenschutzbestimmungen</a>
        und die
        <a
          href="https://www.iubenda.com/nutzungsbedingungen/22508480"
          target="_blank"
          class="font-bold text-primary-400"
        >allgemeinen Geschäftsbestimmungen
        </a></span>
    </div>
    <div class="w-full bg-white">
      <p
        class="text-red-400"
        v-if="this.errors.termsConditions"
      >
        Sie müssen die Allgemeinen Geschäftsbedingungen akzeptieren
      </p>
    </div>
    <button
      class="py-2 mt-6 font-bold text-white transition duration-200 rounded shadow-lg bg-primary-400 hover:bg-secondary-700 hover:shadow-xl"
      @click="registerCustomer"
    >
      Registrieren
    </button>
  </div>
</template>
<script>
import { gmapsMap, gmapsMarker } from "x5-gmaps";

export default {
  components: {
    gmapsMap,
    gmapsMarker,
  },
  data() {
    return {
      termsConditions: false,
      autocomplete: null,
      places: null,
      response: {
        message: "",
        status: "",
      },
      form: {
        salutation: "Herr",
        first_name: "",
        last_name: "",
        date_of_birth: "",
        email: "",
        password: "",
        phone: "",
        type: "customer",
        location: {
          street: null,
          street_number: null,
          city: null,
          zip_code: null,
          formatted_address: null,
        },
      },
      errors: {
        termsConditions: false,
        salutation: false,
        first_name: false,
        last_name: false,
        date_of_birth: false,
        email: false,
        password: false,
        phone: false,
        location: {
          street: false,
          street_number: false,
          city: false,
          zip_code: false,
          formatted_address: false,
        },
      },
    };
  },
  methods: {
    async registerCustomer() {
      try {
        let errors = 0;

        if (!this.form.first_name) {
          this.errors.first_name = true;
          errors = 1;
        } else {
          this.errors.first_name = false;
        }

        if (!this.form.last_name) {
          this.errors.last_name = true;
          errors = 1;
        } else {
          this.errors.last_name = false;
        }

        if (!this.form.email) {
          this.errors.email = true;
          errors = 1;
        } else {
          this.errors.email = false;
        }

        if (!this.form.phone) {
          this.errors.phone = true;
          errors = 1;
        } else {
          this.errors.phone = false;
        }

        if (!this.form.date_of_birth) {
          this.errors.date_of_birth = true;
          errors = 1;
        } else {
          this.errors.date_of_birth = false;
        }

        if (!this.form.password) {
          this.errors.password = true;
          errors = 1;
        } else {
          this.errors.password = false;
        }

        if (!this.form.location.street) {
          this.errors.location.street = true;
          errors = 1;
        } else {
          this.errors.location.street = false;
        }

        if (!this.form.location.street_number) {
          this.errors.location.street_number = true;
          errors = 1;
        } else {
          this.errors.location.street_number = false;
        }

        if (!this.form.location.city) {
          this.errors.location.city = true;
          errors = 1;
        } else {
          this.errors.location.city = false;
        }
        if (!this.form.location.zip_code) {
          this.errors.location.zip_code = true;
          errors = 1;
        } else {
          this.errors.location.zip_code = false;
        }
        if (!this.termsConditions) {
          this.errors.termsConditions = true;
          errors = 1;
        } else {
          this.errors.termsConditions = false;
        }
        if (errors) return;

        this.form.location.formatted_address =
          this.form.location.street +
          " " +
          this.form.location.street_number +
          ", " +
          this.form.location.zip_code +
          " " +
          this.form.location.city;
        try {
          let response = await this.axios.post("/register", this.form);
          window.location.replace("/login?verify=1");
        } catch (error) {
          console.log(error);
          this.response.status = 422;
          if (error.response.data.errors.email) {
            this.response.message = error.response.data.errors.email[0];
          } else if (error.response.data.errors.phone) {
            this.response.message = error.response.data.errors.phone[0];
          }
        }
      } catch (error) {}
    },
  },
};
</script>