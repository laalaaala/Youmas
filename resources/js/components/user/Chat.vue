<template>
  <div class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
    <div class="w-full m-auto mt-10 border-gray-900 border-2">
      <div class="card p-1 bg-gray-900">
        <div class="card-title">
          <h1 class="text-white font-bold text-center">
            {{ conversation.title }}
          </h1>
        </div>
      </div>
    </div>
    <div class="w-1/2 m-auto mt-10 border-gray-900 border-2">
      <div class="w-full bg-gray-900 h-16 pt-2 text-white flex justify-between shadow-md">
        <!-- back button -->
        <a to="/chat">
          <svg
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 24 24"
            class="w-12 h-12 my-1 text-green-100 ml-2"
          >
            <path
              class="text-gray-100 fill-current"
              d="M9.41 11H17a1 1 0 0 1 0 2H9.41l2.3 2.3a1 1 0 1 1-1.42 1.4l-4-4a1 1 0 0 1 0-1.4l4-4a1 1 0 0 1 1.42 1.4L9.4 11z"
            />
          </svg>
        </a>
        <div class="my-3 text-gray-100 font-bold text-lg tracking-wide">
          {{ receiver.email }} - {{ friend.status }}
        </div>
        <!-- 3 dots -->
        <svg
          xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 24 24"
          class="icon-dots-vertical w-8 h-8 mt-2 mr-2"
        >
          <path
            class="text-gray-100 fill-current"
            fill-rule="evenodd"
            d="M12 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm0 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"
          />
        </svg>
      </div>

      <div
        id="messages-container"
        class="h-auto p-1"
        style="height: 300px; overflow-y: scroll"
      >
        <div v-for="message in chat.localMessages" :key="message.id">
          <div
            class="bg-gray-300 w-2/4 ml-auto mr-2 my-2 pb-2 pt-0 rounded-lg"
            v-if="message.user_id == user.id"
          >
            <div
              class="bg-gray-600 text-right text-white font-bold rounded-t-lg p-1 pr-2 mt-0"
            >
              You
            </div>
            <div class="p-2 text-right">
              {{ message.message }}
            </div>
          </div>
          <div class="bg-gray-400 w-2/4 mr-auto ml-2 my-2 pb-2 rounded-lg" v-else>
            <div
              class="bg-gray-600 text-left text-white font-bold rounded-t-lg p-1 pl-2 mt-0"
            >
              {{ receiver.email }}
            </div>
            <div class="p-2">
              {{ message.message }}
            </div>
          </div>
        </div>
      </div>
      <div class="w-full flex justify-between bg-gray-900" style="bottom: 0px">
        <input
          id="input-message"
          class="flex-grow m-2 py-2 px-4 mr-1 rounded-full border border-gray-300 bg-gray-200 resize-none"
          rows="1"
          placeholder="Message..."
          style="outline: none"
          v-model="chat.message"
        />
        <button
          id="submit-message"
          class="m-2"
          style="outline: none"
          @click="submitMessage()"
        >
          <input id="conversation-id" hidden :value="conversation.id" />
          <svg
            class="svg-inline--fa text-gray-400 fa-paper-plane fa-w-16 w-12 h-12 py-2 mr-2"
            aria-hidden="true"
            focusable="false"
            data-prefix="fas"
            data-icon="paper-plane"
            role="img"
            xmlns="http://www.w3.org/2000/svg"
            viewBox="0 0 512 512"
          >
            <path
              fill="currentColor"
              d="M476 3.2L12.5 270.6c-18.1 10.4-15.8 35.6 2.2 43.2L121 358.4l287.3-253.2c5.5-4.9 13.3 2.6 8.6 8.3L176 407v80.5c0 23.6 28.5 32.9 42.5 15.8L282 426l124.6 52.2c14.2 6 30.4-2.9 33-18.2l72-432C515 7.8 493.3-6.8 476 3.2z"
            />
          </svg>
        </button>
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
    messages: {
      type: Array,
      required: true,
    },
    conversation: {
      type: Object,
      required: true,
    },
    receiver: {
      type: Object,
      required: true,
    },
  },
  data() {
    return {
      friend: { ...this.receiver },
      chat: {
        localMessages: [...this.messages],
        message: "",
      },
    };
  },
  methods: {
    async submitMessage() {
      try {
        let data = {
          message: this.chat.message,
        };

        let response = await this.axios.post(`/chat/${this.conversation.id}`, data);

        this.chat.message = "";

        document.querySelector("#messages-container").scrollTop = document.querySelector(
          "#messages-container"
        ).scrollHeight;
      } catch (error) {
        alert(error);
      }
    },

    listen() {
      Echo.join("chat")
        .joining((user) => {
          axios.put("/user/" + user.id + "/online", {});
        })
        .leaving((user) => {
          axios.put("/user/" + user.id + "/offline", {});
        })
        .listen("UserOnline", (e) => {
          if (e.user.id == this.friend.id) {
            this.friend = e.user;
          }
        })
        .listen("UserOffline", (e) => {
          if (e.user.id == this.friend.id) {
            this.friend = e.user;
          }
        });
    },
  },
  mounted() {
    // Online/Offline status
    this.listen();

    Echo.channel(this.conversation.reference).listen(
      "ConversationMessageSent",
      (data) => {
        const message = data.message;

        this.chat.localMessages.push(message);
      }
    );
  },
};
</script>
