<template>
  <div class="pb-6 lg:pb-12">
    <div class="container px-4 mx-auto">
      <div class="font-sans">
        <p
          href="#"
          class="text-base font-bold no-underline lg:text-sm text-primary-400 hover:underline"
        >
          Mitgliedschaft
        </p>
        <h1 class="pt-6 pb-2 font-sans text-xl text-gray-900 break-normal"></h1>
      </div>
      <hr class="border-b border-secondary-400" />

      <!-- Alert when cancelled -->
      <div
        class="relative w-2/4 px-4 py-3 mx-auto mt-10 text-red-700 bg-red-100 border border-red-400 rounded "
        role="alert"
        v-if="subscription.status == 'cancelled'"
      >
        <strong class="font-bold">Subscription cancelled.</strong>
        <span class="block sm:inline"
          >Your services will end at the "Due Date" below.</span
        >
      </div>

      <div class="flex flex-col p-4 mx-auto my-10 border shadow-md md:w-1/2">
        <ul class="w-full">
          <li class="flex w-full py-2">
            <span class="w-1/3"> Paketname: </span>
            <span class="ml-auto font-bold">{{ subscription.plan_name }}</span>
          </li>
          <li class="flex w-full py-2">
            <span class="w-1/3"> Paketpreis: </span>
            <span class="ml-auto font-bold"
              >€ {{ subscription.plan_price }}</span
            >
          </li>
          <li class="flex w-full py-2">
            <span class="w-1/3"> Status: </span>
            <span v-if="subscription.status != 'trial'" class="ml-auto font-bold">{{ subscription.status }}</span>
            <span v-else class="ml-auto font-bold">Starter</span>
          </li>
          <li class="flex w-full py-2">
            <span class="w-1/3"> Startdatum: </span>
            <span class="ml-auto font-bold">{{ subscription.start_date }}</span>
          </li>
          <li class="flex w-full py-2">
            <span class="w-1/3"> Ablaufdatum: </span>
            <span class="ml-auto font-bold">{{ subscription.due_date }}</span>
          </li>
        </ul>
        <button
          v-if="subscription.status == 'cancelled'"
          @click="toggleSubscriptionStatus('reactivate')"
          class="w-1/2 px-10 py-3 mx-auto mt-5 font-bold text-white uppercase bg-green-400 rounded "
        >
          Reactivate Subscrpition
        </button>
        <button
          v-if="subscription.status == 'active'"
          @click="toggleSubscriptionStatus('cancel')"
          class="w-1/2 px-10 py-3 mx-auto mt-5 font-bold text-white uppercase bg-red-400 rounded "
        >
          Cancel Subscription
        </button>
        <div
          v-if="response.status == 200"
          class="w-full p-3 mt-5 text-center text-white bg-green-400"
        >
          {{ response.message }}
        </div>
        <div
          v-if="response.status == 422"
          class="w-full p-3 mt-5 text-center text-white bg-red-400"
        >
          {{ response.message }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    subscription: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      response: {
        message: "",
        status: "",
      },
    };
  },
  methods: {
    async toggleSubscriptionStatus(status) {
      let data = {
        subscription_id: this.subscription.subscription_id,
      };
      try {
        if (status == "cancel") {
          await this.axios.post("subscriptions/cancel", data);
        } else {
          await this.axios.post("subscriptions/reactivate", data);
        }
        window.location.reload();
      } catch (error) {
        console.log(error.response.data.message);
        this.response.message = error.response.data.message;
        this.response.status = error.response.status;
      }
    },
  },
};
</script>  


<style scoped>
#ccsingle {
  position: absolute;
  right: 15px;
  top: 20px;
}

#ccsingle svg {
  width: 100px;
  max-height: 60px;
}

.creditcard svg#cardfront,
.creditcard svg#cardback {
  width: 100%;
  -webkit-box-shadow: 1px 5px 6px 0px black;
  box-shadow: 1px 5px 6px 0px black;
  border-radius: 22px;
}

#generatecard {
  cursor: pointer;
  float: right;
  font-size: 12px;
  color: #fff;
  padding: 2px 4px;
  background-color: #909090;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

/* CHANGEABLE CARD ELEMENTS */
.creditcard .lightcolor,
.creditcard .darkcolor {
  -webkit-transition: fill 0.5s;
  transition: fill 0.5s;
}

.creditcard .lightblue {
  fill: #03a9f4;
}

.creditcard .lightbluedark {
  fill: #0288d1;
}

.creditcard .red {
  fill: #ef5350;
}

.creditcard .reddark {
  fill: #d32f2f;
}

.creditcard .purple {
  fill: #ab47bc;
}

.creditcard .purpledark {
  fill: #7b1fa2;
}

.creditcard .cyan {
  fill: #26c6da;
}

.creditcard .cyandark {
  fill: #0097a7;
}

.creditcard .green {
  fill: #66bb6a;
}

.creditcard .greendark {
  fill: #388e3c;
}

.creditcard .lime {
  fill: #d4e157;
}

.creditcard .limedark {
  fill: #afb42b;
}

.creditcard .yellow {
  fill: #ffeb3b;
}

.creditcard .yellowdark {
  fill: #f9a825;
}

.creditcard .orange {
  fill: #ff9800;
}

.creditcard .orangedark {
  fill: #ef6c00;
}

.creditcard .grey {
  fill: #bdbdbd;
}

.creditcard .primary {
  fill: #f6cd3e;
}

/* FRONT OF CARD */
#svgname {
  text-transform: uppercase;
}

#cardfront .st2 {
  fill: #000;
}

#cardfront .st3 {
  font-family: "Source Code Pro", monospace;
  font-weight: 600;
}

#cardfront .st4 {
  font-size: 54.7817px;
}

#cardfront .st5 {
  font-family: "Source Code Pro", monospace;
  font-weight: 400;
}

#cardfront .st6 {
  font-size: 33.1112px;
}

#cardfront .st7 {
  opacity: 0.6;
  fill: #000;
}

#cardfront .st8 {
  font-size: 24px;
}

#cardfront .st9 {
  font-size: 36.5498px;
}

#cardfront .st10 {
  font-family: "Source Code Pro", monospace;
  font-weight: 300;
}

#cardfront .st11 {
  font-size: 16.1716px;
}

#cardfront .st12 {
  fill: #4c4c4c;
}

/* BACK OF CARD */
#cardback .st0 {
  fill: none;
  stroke: #0f0f0f;
  stroke-miterlimit: 10;
}

#cardback .st2 {
  fill: #111111;
}

#cardback .st3 {
  fill: #f2f2f2;
}

#cardback .st4 {
  fill: #d8d2db;
}

#cardback .st5 {
  fill: #c4c4c4;
}

#cardback .st6 {
  font-family: "Source Code Pro", monospace;
  font-weight: 400;
}

#cardback .st7 {
  font-size: 27px;
}

#cardback .st8 {
  opacity: 0.6;
}

#cardback .st9 {
  fill: #ffffff;
}

#cardback .st10 {
  font-size: 24px;
}

#cardback .st11 {
  fill: #eaeaea;
}

#cardback .st12 {
  font-family: "Rock Salt", cursive;
}

#cardback .st13 {
  font-size: 37.769px;
}

/* FLIP ANIMATION */
.container {
  perspective: 1000px;
}

.creditcard {
  width: 100%;
  max-width: 400px;
  -webkit-transform-style: preserve-3d;
  transform-style: preserve-3d;
  transition: -webkit-transform 0.6s;
  -webkit-transition: -webkit-transform 0.6s;
  transition: transform 0.6s;
  transition: transform 0.6s, -webkit-transform 0.6s;
  cursor: pointer;
}

.creditcard .front,
.creditcard .back {
  position: relative;
  width: 100%;
  max-width: 400px;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  -webkit-font-smoothing: antialiased;
  color: #47525d;
}

.creditcard .back {
  -webkit-transform: rotateY(180deg);
  transform: rotateY(180deg);
}

.creditcard.flipped {
  -webkit-transform: rotateY(180deg);
  transform: rotateY(180deg);
}
</style>