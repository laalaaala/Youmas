<template>
  <div class="flex justify-center mx-auto my-10 md:w-11/12">
    <form-wizard
      class="w-10/12 md:w-2/3"
      title="Kasse"
      subtitle="Terminkalendar"
      shape="tab"
      color="#F6CD3E"
      :finishButtonText="'Kostenpfichtig buchen'"
    >
      <tab-content
        class="flex flex-col w-full py-5"
        title="Mitarbeiter und Termin auswählen"
      >
        <CustomerCheckoutDatePick
          :booking="booking"
          :employees="business.employees"
          @updateBooking="updateBooking"
        />

        <!-- <div class="flex flex-row items-center w-1/2 mt-5 ml-auto">
          <input type="checkbox" @click="termsConditions = !termsConditions" />
          <span class="ml-5"
            >Hiermit akzeptiere ich die
            <a href="#" class="font-bold text-primary-400"
              >Datenschutzbestimmungen</a
            >
            und die
            <a href="#" class="font-bold text-primary-400"
              >allgemeinen Geschäftsbestimmungen
            </a></span
          >
        </div> -->
        <div class="w-full bg-white">
          <p class="text-red-400" v-if="errors.termsConditions">
            Sie müssen die Allgemeinen Geschäftsbedingungen akzeptieren
          </p>
        </div>
      </tab-content>
      <tab-content class="py-5" title="Bestellung überprüfen & bezahlen">
        <CustomerCheckoutPayment
          v-if="showPaymentComponent"
          ref="CustomerCheckoutPayment"
          :booking="booking"
          :business-user="businessUser"
          :customer="customer"
          @updateTerms="updateTerms"
        />
      </tab-content>
      <template slot="footer" slot-scope="props">
        <div class="flex flex-col lg:flex-row wizard-footer-right" style="float: none !important">
          <div class="flex flex-col gap-2 lg:mr-auto lg:flex-row">
            <a
              class="flex justify-center w-full px-10 py-2 mb-5 mr-auto font-bold text-white uppercase rounded lg:mb-0 bg-primary-400"
              href="javascript:history.back()"
            >
              Abbrechen
            </a>

            <wizard-button
              class="flex px-10 py-2 font-bold text-white uppercase rounded lg:mr-auto bg-primary-400"
              v-if="props.activeTabIndex > 0 && props.isLastStep"
              @click.native="props.prevTab()"
              :style="props.fillButtonStyle"
              >Zurück</wizard-button
            >
          </div>

          <wizard-button
            :disabled="!booking.time"
            v-if="!props.isLastStep"
            @click.native="props.nextTab()"
            class="px-10 py-2 font-bold text-white uppercase rounded lg:ml-auto wizard-footer-right"
            :class="!booking.time ? 'bg-primary-200' : 'bg-primary-400'"
            :style="props.fillButtonStyle"
            >Weiter</wizard-button
          >

          <button
            v-else
            @click="submitPaymentForm"
            :disabled="!termsConditions"
            class="px-10 py-2 mt-5 font-bold text-white uppercase rounded lg:mt-0 lg:ml-auto wizard-footer-right finish-button bg-primary-400"
            :style="props.fillButtonStyle"
          >
            Kostenpfilchtig buchen
          </button>
        </div>
      </template>
    </form-wizard>

    <!-- Response -->
    <div>
      <div
        class="px-4 py-3 text-teal-900 bg-green-400 border-t-4 border-teal-500 rounded-b shadow-md "
        role="alert"
        v-if="response.status == 200"
      >
        <div class="flex">
          <div class="py-1">
            <svg
              class="w-6 h-6 mr-4 text-teal-500 fill-current"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 20 20"
            >
              <path
                d="M2.93 17.07A10 10 0 1 1 17.07 2.93 10 10 0 0 1 2.93 17.07zm12.73-1.41A8 8 0 1 0 4.34 4.34a8 8 0 0 0 11.32 11.32zM9 11V9h2v6H9v-4zm0-6h2v2H9V5z"
              />
            </svg>
          </div>
          <div class="flex items-center">
            <p class="text-sm">
              {{ response.message }}
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import CustomerCheckoutDatePick from "./CustomerCheckoutDatePick.vue";
import CustomerCheckoutPayment from "./CustomerCheckoutPayment.vue";
import VueCal from "vue-cal";
import "vue-cal/dist/vuecal.css";
import 'vue-cal/dist/i18n/de.js'

import moment from "moment";

export default {
  components: {
    CustomerCheckoutDatePick,
    CustomerCheckoutPayment,
    VueCal,
  },
  props: {
    business: {
      type: Object,
      required: true,
    },
    businessUser: {
      type: Object,
      required: true,
    },
    customer: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      termsConditions: false,
      showPaymentComponent: false,
      selectedDate: null,
      services: [],
      booking: {},
      hours: [],
      selectedDate: "",
      isOptionsExpanded: false,
      selectedOption: "1x",
      selectedEvent: {},
      response: {
        status: "",
        message: "",
      },
      errors: {
        termsConditions: false,
      },
    };
  },

  methods: {
    updateTerms() {
      this.termsConditions = !this.termsConditions;
    },
    updateBooking(booking) {
      this.booking = booking;
      this.showPaymentComponent = true;
    },
    submitPaymentForm() {
      this.$refs.CustomerCheckoutPayment.submitForm();
    },

    // Payment Handler
  },
};
</script>
<style scoped>
.vue-form-wizard .navbar .navbar-nav > li > a.wizard-btn,
.vue-form-wizard .wizard-btn {
  font-size: 16px !important;
}
</style>
