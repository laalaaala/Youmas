<template>
  <div class="md:flex">
    <div class="py-5 lg:px-5 md:w-full md:py-0">
      <div class="p-5 pl-0 text-2xl font-bold text-center lg:text-left">Warenkorb</div>
      <hr />
      <div class="p-5 py-1 text-center lg:text-left">
        <span class="mr-3 font-bold">Mitarbeiter: </span
        >{{ booking.employee_name }}
      </div>
      <div class="p-5 py-1 text-center lg:text-left">
        <span class="mr-3 font-bold">Datum & Uhrzeit:</span>
        {{ booking.time | moment("DD/MM/YYYY LT") }}
      </div>
      <div class="p-5 py-1 text-center lg:text-left">
        <span class="mr-3 font-bold">Dauer:</span>
        {{ this.booking.total_duration }} Minuten
      </div>
      <hr />
      <div class="flex flex-col w-full p-5 py-1 mx-auto mt-10 text-right lg:w-1/2">
        <span
          v-for="service in booking.services"
          :key="service.id"
          class="flex p-3 mb-1 bg-primary-200"
        >
          <span class="mr-auto"> {{ service.name }} x 1 </span>
          <span class="ml-auto"> {{ service.price }}€ </span>
        </span>
        <span class="flex p-3 border-t-2 border-black">
          <span class="mr-auto">
            <strong>Zwischensumme:</strong>
          </span>
          <span class="ml-auto font-semibold">
            €{{ booking.total_price }}
          </span>
        </span>
        <span class="flex p-3 border-t-2 border-black">
          <span class="mr-auto">
            <strong>Gesamtsumme:</strong>
          </span>
          <span class="ml-auto font-semibold">
            €{{ booking.total_price }} <br />
            <span class="text-xs">
              Enthält {{ taxCalculation(booking.total_price) }} MwSt. (19%)
            </span>
          </span>
        </span>
        <div
          v-if="businessUser.subscription.plan_name == 'Golden'"
          class="mr-auto"
        >
          <div class="flex flex-col w-full my-5">
            <div class="flex flex-row items-center">
              <input v-model="paymentMethod" value="card" type="radio" />
              <i class="ml-5 fas fa-credit-card"></i>
              <label class="ml-1 font-semibold" for="card">Card</label>
            </div>
            <div class="flex flex-row items-center">
              <input v-model="paymentMethod" value="cash" type="radio" />
              <i class="ml-5 fas fa-money-bill-wave"></i>
              <label class="ml-1 font-semibold" for="cash">Cash</label>
            </div>
          </div>
        </div>
        <div
          v-show="paymentMethod == 'cash'"
          class="w-full py-2 font-bold text-center rounded bg-primary-400 text-secondary-400"
        >
          <p>Dieses Unternehmen akzeptiert nur Barzahlungen</p>
        </div>
      </div>
      <form
        id="payment-form"
        class="p-3 bg-gray-200"
        v-show="paymentMethod == 'card'"
      >
        <div class="p-3 shadow" id="card-element">
          <!-- Elements will create input elements here -->
        </div>

        <!-- We'll put the error messages in this element -->
        <div id="card-errors" role="alert"></div>
        <div id="payment-request-button">
          <!-- A Stripe Element will be inserted here. -->
        </div>

        <button
          id="submit"
          style="display: none"
          class="p-1 px-10 mt-2 text-white rounded btn bg-primary-400"
        >
          Pay
        </button>
      </form>
    <div class="flex flex-row items-center w-full mx-auto mt-5 mb-10 lg:w-1/2">
      <input type="checkbox" class="w-16" @click="updateTerms()" />
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
    </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    booking: {
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
      stripe: null,
      cardElement: null,
      paymentMethod: "cash",
      localBooking: this.booking,
    };
  },
  watch: {
    booking: {
      handler(val) {
        alert("change", val);
      },
    },
  },
  methods: {
    updateTerms() {
      this.$emit('updateTerms');
    },
    submitForm(e) {
      // If business accepts card
      if (this.paymentMethod == "card") {
        this.handleStripePayment(this.stripe, this.cardElement);

        // var payButton = document.querySelector("#payment-form #submit");
        // payButton.click();
      } else {
        this.book(2, false);
      }
    },
    handleStripePayment(stripe, cardElement) {
      stripe
        .createPaymentMethod({
          type: "card",
          card: cardElement,
          billing_details: {
            name:
              this.customer.customer.first_name +
              " " +
              this.customer.customer.last_name,
          },
        })
        .then(this.stripePaymentMethodHandler(stripe, cardElement));
    },
    async stripePaymentMethodHandler(stripe, cardElement) {
      let purchaseData = {
        total_price: this.booking.total_price,
        stripe_account: this.businessUser.stripe_account.account_id,
      };
      let purchaseResponse = await this.axios.post(
        `/checkout/purchases`,
        purchaseData
      );

      //   this.response.message = purchaseResponse.data.message;
      //   this.response.status = purchaseResponse.status;
      console.log("purchaseResponse", purchaseResponse.data);

      // Create Transaction records
      let transactionData = {
        business_id: this.businessUser.id,
        customer_id: this.customer.id,
        transaction_id: purchaseResponse.data.client_secret,
        order_id: purchaseResponse.data.order_id,
        amount: this.booking.total_price,
        services: window.localStorage.services,
      };

      console.log("business", transactionData);

      let transactionResponse = await this.axios.post(
        `/checkout/transactions`,
        transactionData
      );

      let transactionId = transactionResponse.data.data.id;

      try {
        stripe
          .confirmCardPayment(purchaseResponse.data.client_secret, {
            payment_method: {
              card: cardElement,
              billing_details: {
                name:
                  this.customer.customer.first_name +
                  " " +
                  this.customer.customer.last_name,
              },
            },
          })
          .then(function (result) {
            if (result.error) {
              console.log(result.error.message);
            } else {
              if (result.paymentIntent.status === "succeeded") {
              }
            }
          });
        this.book(transactionId, false);
      } catch (error) {
        console.log("there has been error", error);
      }
    },
    async book(transactionId, card) {
      try {
        if (this.paymentMethod == "card") {
          let data = {
            booking: this.booking,
            transactionId: transactionId,
          };

          let response = await this.axios.post(
            `/dashboard/employees/${this.booking.employee}/available-hours`,
            data
          );
        } else {
          let data = {
            booking: this.booking,
          };
          let response = await this.axios.post(
            `/dashboard/employees/${this.booking.employee}/available-hours`,
            data
          );
        }

        // Send to dashboard
        window.location.replace("/dashboard/bookings");
      } catch (error) {
        console.log("error", error);
      }
    },
    taxCalculation(totalPrice) {
      return totalPrice * 0.19;
    },
  },
  mounted() {
    /**
     * Set-Up Stripe
     */
    console.log("BOOKINGS", this.localBooking);
    let vm = this;
    console.log(vm.booking);
    let stripeScript = document.createElement("script");
    stripeScript.setAttribute("src", "https://js.stripe.com/v3");
    document.head.appendChild(stripeScript);
    this.stripe = Stripe(
      "pk_live_51IyYZaGsaDc0phAj0GzjSOoB9829IY6jA1oWviL72oPGvqYbj21WkvWyen3Tvh2MVKUO28YIUXfecuSfrFkC6JDP00q7wEL5t6"
    );
    // this.stripe = Stripe(
    //   "pk_test_51IyYZaGsaDc0phAjXOEDNLTfrFh5Sm7HB8IRp1K2GhYtzlRz5qczSOZglG3bv1EFunHI1FyZSmW1uAbsfOO5hLlL00jzdbgagt"
    // );

    var elements = this.stripe.elements();
    var style = {
      base: {
        color: "#32325d",
      },
    };
    this.cardElement = elements.create("card", { style: style });
    this.cardElement.mount("#card-element");
    console.log("this.booking", this.booking);
    let price = this.booking.totalPrice;
    let paymentData = {
      country: "DE",
      currency: "eur",
      total: {
        label: "",
        amount: this.booking.total_price * 100,
      },
      requestPayerName: true,
      requestPayerEmail: true,
    };
    var paymentRequest = this.stripe.paymentRequest(paymentData);

    var elements = this.stripe.elements();
    var prButton = elements.create("paymentRequestButton", {
      paymentRequest: paymentRequest,
    });

    paymentRequest.canMakePayment().then(function (result) {
      if (result) {
        prButton.mount("#payment-request-button");
      } else {
        console.log(result);
        document.getElementById("payment-request-button").style.display =
          "none";
      }
    });
  },
};
</script>