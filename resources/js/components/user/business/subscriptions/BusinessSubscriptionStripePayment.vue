<template>
  <div class="w-1/2 p-10 mx-auto mt-5">
    <form class="p-3 bg-gray-200" id="payment-form">
      <div class="p-3 shadow" id="card-element">
        <!-- Elements will create input elements here -->
      </div>

      <!-- We'll put the error messages in this element -->
      <div id="card-element-errors" role="alert"></div>
      <div id="payment-request-button">
        <!-- A Stripe Element will be inserted here. -->
      </div>

      <button
        class="p-1 px-10 mt-2 text-white rounded btn bg-primary-400"
        @click="paySubscription"
        type="submit"
        :disabled="loading"
      >
        <span v-if="!loading">Subscribe</span>
        <MoonLoader :loading="loading" :color="'white'" :size="'25px'" />
      </button>
    </form>
  </div>
</template>
<script>
import MoonLoader from "vue-spinner/src/MoonLoader.vue";

export default {
  components: {
    MoonLoader,
  },
  props: {
    user: {
      type: Object,
      required: true,
    },
    plan: {
      type: String,
      required: true,
    },
    period: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      loading: false,
      stripe: "",
      card: "",
      elements: "",
      btn: "",
      clientSecret: null,
      subscriptionId: null,
      // silverPlan: { // !TEST
      //   yearly: {
      //     id: "price_1JKpbjGsaDc0phAj3eSp731w",
      //   },
      //   semester: {
      //     id: "price_1JKpbEGsaDc0phAjoTx6sasj",
      //   },
      //   oneTime: {
      //     id: "price_1JKpaLGsaDc0phAjwEXetkB4",
      //   },
      // },
      // goldenPlan: {
      //   yearly: {
      //     id: "price_1JKpdwGsaDc0phAjRUr9Iz18",
      //   },
      //   semester: {
      //     id: "price_1JKpdOGsaDc0phAjrDEhXEED",
      //   },
      //   oneTime: {
      //     id: "price_1JDtbyGsaDc0phAjTFozRE9x",
      //   },
      // }, // !/TEST
      silverPlan: {
        yearly: {
          id: "price_1KT7Z8GsaDc0phAjl19YncJ5",
        },
        semester: {
          // id: "price_1KT7Z0GsaDc0phAjrvQbNjYy", // !1€
          id: "price_1KTQauGsaDc0phAjwZR3xM5F", // !209.94€
        },
        oneTime: {
          id: "price_1KT7YtGsaDc0phAjTeUtxCxo",
        },
      },
      goldenPlan: {
        yearly: {
          id: "price_1KT7ZDGsaDc0phAjzagYROrR",
        },
        semester: {
          id: "price_1KT7ZBGsaDc0phAjxSxnBnCN",
        },
        oneTime: {
          id: "price_1KT7ZAGsaDc0phAjJUGUQHmP", // !1€
          // id: "price_1KTR7ZGsaDc0phAjoqZ7aGkz", // !39.99€
        },
      },
    };
  },
  methods: {
    async paySubscription(e) {
      e.preventDefault();
      this.loading = true;
      // Create customer & subscription depending on plan type and period
      if (this.plan == "silver") {
        await this.createSilverCustomer();
      } else {
        await this.createGoldenCustomer();
      }

      this.stripe
        .confirmCardPayment(this.clientSecret, {
          payment_method: {
            card: this.card,
          },
        })
        .then(async (result) => {
          if (result.error) {
            alert(result.error.message);
          } else {
            // Start loading

            // Successful subscription payment
            let data = {
              status: "active",
            };

            await this.axios.put(
              `/businesses/subscriptions/${this.subscriptionId}/update`,
              data
            );

            window.location.replace("/businesses/subscriptions");
          }
        });
    },
    async createSilverCustomer() {
      let data = {
        user_email: this.user.email,
      };

      let createCustomerResponse = await this.axios.post(
        "/businesses/subscriptions/create-stripe-customer",
        data
      );
      console.log(
        "createCustomerResponse",
        createCustomerResponse.data.customer
      );

      let priceId = "";

      if (parseInt(this.period) == 1) {
        priceId = this.silverPlan.oneTime.id;
      } else if (parseInt(this.period) == 2) {
        priceId = this.silverPlan.semester.id;
      } else {
        priceId = this.silverPlan.yearly.id;
      }

      let subscriptionData = {
        priceId: priceId,
        customerId: createCustomerResponse.data.customer.id,
        planName: "Silver",
      };

      await this.createCustomerSubscription(subscriptionData);
    },
    async createGoldenCustomer() {
      let data = {
        user_email: this.user.email,
      };

      let createCustomerResponse = await this.axios.post(
        "/businesses/subscriptions/create-stripe-customer",
        data
      );

      let priceId = "";

      if (this.period == 1) {
        priceId = this.goldenPlan.oneTime.id;
      } else if (this.period == 2) {
        priceId = this.goldenPlan.semester.id;
      } else {
        priceId = this.goldenPlan.yearly.id;
      }

      let subscriptionData = {
        priceId: priceId,
        customerId: createCustomerResponse.data.customer.id,
        planName: "Golden",
      };

      await this.createCustomerSubscription(subscriptionData);

      // location.reload();

      // this.card.addEventListener("change", function (event) {
      //   displayError(event);
      // });
      // function displayError(event) {
      //   let displayError = document.getElementById("card-element-errors");
      //   if (event.error) {
      //     displayError.textContent = event.error.message;
      //   } else {
      //     displayError.textContent = "";
      //   }
      // }
      // console.log("btn", this.btn);
    },
    async createCustomerSubscription(data) {
      let response = await this.axios.post(
        "/businesses/subscriptions/create-stripe-subscription",
        data
      );

      this.subscriptionId = response.data.data.local_subscription_id;
      this.clientSecret = response.data.data.client_secret;
    },
    cardEventGenerate() {
      // this.card.addEventListener("change", function (event) {
      // console.log("card.change", event);
      // displayError(event);
      // });
      // function displayError(event) {
      //   let displayError = document.getElementById("card-element-errors");
      //   if (event.error) {
      //     displayError.textContent = event.error.message;
      //   } else {
      //     displayError.textContent = "";
      //   }
      // }
    },
  },
  mounted() {
    let stripeScript = document.createElement("script");
    stripeScript.setAttribute("src", "https://js.stripe.com/v3");
    document.head.appendChild(stripeScript);

    this.stripe = Stripe(
      "pk_live_51IyYZaGsaDc0phAj0GzjSOoB9829IY6jA1oWviL72oPGvqYbj21WkvWyen3Tvh2MVKUO28YIUXfecuSfrFkC6JDP00q7wEL5t6"
    );
    // this.stripe = Stripe(
    //   "pk_test_51IyYZaGsaDc0phAjXOEDNLTfrFh5Sm7HB8IRp1K2GhYtzlRz5qczSOZglG3bv1EFunHI1FyZSmW1uAbsfOO5hLlL00jzdbgagt"
    // );

    this.elements = this.stripe.elements();
    var style = {
      base: {
        color: "#32325d",
      },
    };
    this.card = this.elements.create("card", { style: style });
    this.card.mount("#card-element");

    var paymentRequest = this.stripe.paymentRequest({
      country: "US",
      currency: "usd",
      total: {
        label: "Demo total",
        amount: 50000,
      },
      requestPayerName: true,
      requestPayerEmail: true,
    });
    console.log("paymentRequest", paymentRequest);
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