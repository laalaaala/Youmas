<template>
  <div class="relative p-5 mt-10 space-y-4 bg-white rounded-sm shadow-sm xl:w-1/4">
    <p class="font-bold">
      <i class="far fa-clock"></i>
      Öffnungszeiten
    </p>
    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Montag </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.monday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.monday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>
    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Dienstag </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.tuesday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.tuesday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>

    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Mittwoch </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.wednesday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.wednesday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>
    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Donnerstag </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.thursday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.thursday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>

    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Freitag </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.friday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.friday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>

    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour"></div>
        <span class="text-normal"> Samstag </span>
      </div>
      <div class="grid w-1/2 grid-cols-2 space-x-1 text-right">
        <select name="opening" v-model="hours.saturday.start">
          <option value="07:00">07:00</option>
          <option value="08:00">08:00</option>
          <option value="09:00">09:00</option>
          <option value="10:00">10:00</option>
          <option value="11:00">11:00</option>
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
        </select>
        <select name="closing" v-model="hours.saturday.end">
          <option value="12:00">12:00</option>
          <option value="13:00">13:00</option>
          <option value="14:00">14:00</option>
          <option value="15:00">15:00</option>
          <option value="16:00">16:00</option>
          <option value="17:00">17:00</option>
          <option value="18:00">18:00</option>
          <option value="19:00">19:00</option>
          <option value="20:00">20:00</option>
          <option value="21:00">21:00</option>
          <option value="22:00">22:00</option>
        </select>
      </div>
    </div>

    <div class="flex w-full my-2">
      <div class="w-1/2 text-left">
        <div class="hour-closed"></div>
        <span class="text-normal">Sonntag</span>
      </div>
      <div class="w-1/2 text-right">Geschlossen</div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      hours: {
        monday: {
          start: "",
          end: "",
        },
        tuesday: {
          start: "",
          end: "",
        },
        wednesday: {
          start: "",
          end: "",
        },
        thursday: {
          start: "",
          end: "",
        },
        friday: {
          start: "",
          end: "",
        },
        saturday: {
          start: "",
          end: "",
        },
      },
    };
  },
  watch: {
    hours: {
      handler() {
        this.updateOpeningHours();
      },
      deep: true,
    },
  },
  methods: {
    async updateOpeningHours() {
      let response = await this.axios.put("/businesses/opening-hours", this.hours);
      console.log("response", response.data.data);
    },
    async getOpeningHours() {
      let response = await this.axios.get("/businesses/opening-hours");

      response.data.data.map((hour) => {
        this.hours[hour.day].start = hour.start.slice(0, -3);
        this.hours[hour.day].end = hour.end.slice(0, -3);
      });
    },
  },
  mounted() {
    this.getOpeningHours();
  },
};
</script>