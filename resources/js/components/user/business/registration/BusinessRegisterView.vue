<template>
  <div>
    <input type="text" value="company" hidden name="type" />
    <div class="pt-3 my-3 bg-gray-200 rounded">
      <label class="block mb-2 ml-3 text-sm font-bold text-gray-700" for="email"
        >Unternehmensname</label
      >
      <input
        v-model="form.name"
        name="name"
        type="text"
        id="name"
        class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
        required
      />
    </div>
    <p class="text-red-400" v-if="this.errors.name.required">
      Der Unternehmensname ist Pflicht
    </p>
    <div class="w-full lg:mb-0">
      <div class="pt-3 my-3 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="location"
          >Anschrift</label
        >
        <input
          name="location"
          ref="autocomplete"
          id="autocomplete"
          required
          placeholder="Muster Str. 149, Musterstadt , Germany"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
        />
        <p class="text-red-400" v-if="this.validation_errors.street">
          Das ist ein Pflichtfeld
        </p>
      </div>
      <gmaps-map @mounted="ready" style="visibility: hidden">
        <gmaps-marker :position="markerPos" />
      </gmaps-map>
    </div>
    <p class="text-red-400" v-if="this.errors.location.required">
      Please provide a valid location
    </p>
    <select
      v-model="form.branch"
      class="w-full p-3 text-black transition duration-500 bg-white border rounded border-primary-400 focus:outline-none focus:border-secondary-400"
      name="branch"
    >
      <option value="" disabled selected>Bereich auswählen</option>
      <option value="1">Hair Saloon</option>
      <option value="2">Tattoo/Piercing Studio</option>
      <option value="3">Beauty Saloon</option>
      <option value="4">Massagestudio</option>
    </select>
    <p class="text-red-400" v-if="this.errors.branch.required">
      Bitte wählen Sie einen Bereich aus
    </p>
    <div class="flex">
      <div class="w-1/2 pt-3 my-3 mr-2 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >Straße</label
        >
        <input
          v-model="form.location.street"
          name="email"
          type="text"
          id="email"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-300 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          disabled
          required
        />
        <p class="text-red-400" v-if="this.validation_errors.street">
          Das ist ein Pflichtfeld
        </p>
      </div>
      <div class="w-1/2 pt-3 my-3 ml-1 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >Hausnummer</label
        >
        <input
          v-model="form.location.street_number"
          name="phone"
          type="number"
          id="phone"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-300 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          disabled
          required
        />
        <p class="text-red-400" v-if="this.validation_errors.street_number">
          Das ist ein Pflichtfeld
        </p>
      </div>
    </div>
    <div class="flex">
      <div class="w-1/2 pt-3 my-3 mr-2 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >Stadt</label
        >
        <input
          v-model="form.location.city"
          name="email"
          type="text"
          id="email"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-300 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
          disabled
        />
        <p class="text-red-400" v-if="this.validation_errors.city">
          Das ist ein Pflichtfeld
        </p>
      </div>
      <div class="w-1/2 pt-3 my-3 ml-1 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >PLZ</label
        >
        <input
          v-model="form.location.zip_code"
          name="phone"
          type="number"
          id="phone"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-300 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
          disabled
        />
        <p class="text-red-400" v-if="this.validation_errors.zip_code">
          Das ist ein Pflichtfeld
        </p>
      </div>
    </div>
    <div class="flex">
      <div class="w-1/2 pt-3 my-3 mr-2 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >Email</label
        >
        <input
          v-model="form.email"
          name="email"
          type="text"
          id="email"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
        />
        <div class="w-full bg-white">
          <p class="text-red-400" v-if="this.errors.email.required">
            Bitte tragen Sie ihre Email ein
          </p>
        </div>
      </div>
      <div class="w-1/2 pt-3 my-3 ml-1 bg-gray-200 rounded">
        <label
          class="block mb-2 ml-3 text-sm font-bold text-gray-700"
          for="email"
          >Telefon</label
        >
        <input
          v-model="form.phone"
          name="phone"
          type="number"
          id="phone"
          class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
          required
        /><br />
        <div class="w-full bg-white">
          <p class="text-red-400" v-if="this.errors.phone.required">
            Bitte tragen Sie ihre Telefonnummer ein
          </p>
        </div>
      </div>
    </div>
    <div class="flex">
      <div class="w-1/2 pt-3 mb-3 mr-2 bg-gray-200 rounded">
        <div class="w-full bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="email"
            >Ansprechpartner</label
          >
          <input
            v-model="form.person_to_contact"
            name="person_to_contact"
            type="text"
            id="person_to_contact"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
            required
          />
        </div>
        <div class="w-full bg-white">
          <p class="text-red-400" v-if="this.errors.person_to_contact.required">
            Bitte tragen Sie einen Ansprechpartner ein
          </p>
        </div>
      </div>
      <div class="w-1/2 pt-3 mb-3 ml-1 rounded">
        <div class="w-full bg-gray-200 rounded">
          <label
            class="block mb-2 ml-3 text-sm font-bold text-gray-700"
            for="email"
            >UstID</label
          >
          <input
            v-model="form.ust_id"
            name="ust_id"
            type="text"
            id="ust_id"
            class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-400"
            required
          />
        </div>
        <div class="w-full bg-white">
          <p class="text-red-400" v-if="this.errors.ust_id.required">
            Bitte tragen Sie ihre UstID ein
          </p>
        </div>
      </div>
    </div>

    <div class="pt-3 bg-gray-200 rounded">
      <label
        class="block mb-2 ml-3 text-sm font-bold text-gray-700"
        for="password"
        >Password</label
      >
      <input
        v-model="form.password"
        name="password"
        type="password"
        id="password"
        class="w-full px-3 pb-3 text-gray-700 transition duration-500 bg-gray-200 border-b-4 border-gray-300 rounded focus:outline-none focus:border-secondary-600"
        required
      />
    </div>
    <p class="text-red-400" v-if="this.errors.password.required">
      Das ist ein Pflichtfeld
    </p>

    <div
      v-if="response.status == 422"
      class="w-full p-3 text-center text-white bg-red-400"
    >
      {{ response.message }}
    </div>
    <div class="flex flex-row items-center w-full mt-5">
      <input type="checkbox" @click="termsConditions = !termsConditions" />
      <span class="ml-5 text-xs"
        >Hiermit akzeptiere ich die
        <a href="https://www.iubenda.com/privacy-policy/22508480" class="font-bold text-primary-400" target="_blank">Datenschutzbestimmungen</a> und die
        <a href="https://www.iubenda.com/nutzungsbedingungen/22508480 " class="font-bold text-primary-400" target="_blank"
          >allgemeinen Geschäftsbestimmungen
        </a></span
      >
    </div>
    <div class="w-full bg-white">
      <p class="text-red-400" v-if="this.validation_errors.termsConditions">
        Sie müssen die Allgemeinen Geschäftsbedingungen akzeptieren
      </p>
    </div>
    <div class="flex w-full mt-6">
      <button
        @click="registerCompany"
        class="px-3 py-2 mx-auto font-bold text-white transition duration-200 rounded shadow-lg bg-primary-400 hover:bg-secondary-700 hover:shadow-xl"
        type="submit"
      >
        Registrieren
      </button>
    </div>
  </div>
</template>

<script>
import { gmapsMap, gmapsMarker } from "x5-gmaps";

export default {
  components: { gmapsMap, gmapsMarker },
  data() {
    return {
      termsConditions: false,
      autocomplete: null,
      places: null,
      map: null,
      markerPos: { lat: -27, lng: 153 },
      response: {
        message: "",
        status: "",
      },
      form: {
        type: "business",
        name: "",
        email: "",
        phone: "",
        branch: "",
        person_to_contact: "",
        ust_id: "",
        password: "",
        location: {
          lng: null,
          lat: null,
          street_number: null,
          street: null,
          city: null,
          zip_code: null,
          formatted_address: null,
        },
      },
      validation_errors: {
        street: false,
        street_number: false,
        zip_code: false,
        city: false,
        termsConditions: false,
      },
      errors: {
        name: {
          required: false,
        },
        email: {
          required: false,
        },
        phone: {
          required: false,
        },
        branch: {
          required: false,
        },
        person_to_contact: {
          required: false,
        },
        ust_id: {
          required: false,
        },
        password: {
          required: false,
        },
        location: {
          required: false,
        },
      },
    };
  },
  methods: {
    async registerCompany() {
      let errors = 0;
      if (!this.form.name) {
        this.errors.name.required = true;
        errors = 1;
      } else {
        this.errors.name.required = false;
      }
      if (!this.form.email) {
        this.errors.email.required = true;
        errors = 1;
      } else {
        this.errors.email.required = false;
      }
      if (!this.form.phone) {
        this.errors.phone.required = true;
        errors = 1;
      } else {
        this.errors.phone.required = false;
      }
      if (!this.form.branch) {
        this.errors.branch.required = true;
        errors = 1;
      } else {
        this.errors.branch.required = false;
      }
      if (!this.form.person_to_contact) {
        this.errors.person_to_contact.required = true;
        errors = 1;
      } else {
        this.errors.person_to_contact.required = false;
      }
      if (!this.form.ust_id) {
        this.errors.ust_id.required = true;
        errors = 1;
      } else {
        this.errors.ust_id.required = false;
      }
      if (!this.form.password) {
        this.errors.password.required = true;
        errors = 1;
      } else {
        this.errors.password.required = false;
      }

      if (!this.form.location.street_number) {
        this.validation_errors.street_number = true;
        errors = 1;
      } else {
        this.validation_errors.street_number = false;
      }

      if (!this.form.location.street) {
        this.validation_errors.street = true;
        errors = 1;
      } else {
        this.validation_errors.street = false;
      }

      if (!this.form.location.zip_code) {
        this.validation_errors.zip_code = true;
        errors = 1;
      } else {
        this.validation_errors.zip_code = false;
      }

      if (!this.form.location.city) {
        this.validation_errors.city = true;
        errors = 1;
      } else {
        this.validation_errors.city = false;
      }
      if (!this.termsConditions) {
        this.validation_errors.termsConditions = true;
        errors = 1;
      } else {
        this.validation_errors.termsConditions = false;
      }

      if (errors) {
        return false;
      }

      try {
        await this.axios.post("/register", this.form);
        window.location.replace("/login?verify=1");
      } catch (error) {
        this.response.status = 422;
        console.log("errors", error.response.data.errors);
        if (error.response.data.errors.email) {
          this.response.message = error.response.data.errors.email[0];
        } else if (error.response.data.errors.phone) {
          this.response.message = error.response.data.errors.phone[0];
        }
      }
    },
    ready(map) {
      this.map = map;
      this.$GMaps().then((maps) => {
        this.places = new maps.places.PlacesService(map);
        this.autocomplete = new maps.places.Autocomplete(
          this.$refs.autocomplete
        );
        this.autocomplete.addListener("place_changed", this.updateLocation);
      });
    },
    updateLocation() {
      const place = this.autocomplete.getPlace();
      this.form.location.lng = null;
      this.form.location.lat = null;
      this.form.location.street_number = null;
      this.form.location.street = null;
      this.form.location.city = null;
      this.form.location.zip_code = null;
      if (place.geometry) {
        this.form.location.lng = place.geometry.location.lng();
        this.form.location.lat = place.geometry.location.lat();
        console.log("LOCATION", this.form.location.lng, this.form.location.lat);
        this.map.panTo(place.geometry.location);
        this.markerPos = place.geometry.location;
      }
      this.form.location.formatted_address = place.formatted_address;
      place.address_components.forEach((component) => {
        console.log(component);
        if (component.types[0] == "street_number") {
          this.form.location.street_number = component.long_name;
        }
        if (component.types[0] == "route") {
          this.form.location.street = component.long_name;
        }
        if (component.types[0] == "locality") {
          this.form.location.city = component.long_name;
        }
        if (component.types[0] == "postal_code") {
          this.form.location.zip_code = component.long_name;
        }
      });
    },
  },
};
</script>