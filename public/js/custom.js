// let submitButton = document.querySelector("#submit-message");

// submitButton.addEventListener("click", function () {
//     let message = document.querySelector("#input-message").value;
//     let input = document.querySelector('#input-message');
//     let messagesContainer = document.querySelector('#messages-container');
//     let conversationId = document.querySelector("#conversation-id").value;
//     var CSRF_TOKEN = $('meta[name="csrf-token"]').attr("content");
//     $.ajax({
//         //this part
//         url: `/chat/${conversationId}`,
//         type: "POST",
//         data: { _token: CSRF_TOKEN, message },
//         success: function (response) {
//             let div = document.createElement("div");
//             div.classList.add("bg-gray-300", "w-2/4", "ml-auto", "mr-2", "my-2", "pb-2", "pt-0", "rounded-lg");
//             div.innerHTML = `
//                             <div class="bg-gray-600 text-right text-white font-bold rounded-t-lg p-1 pr-2 mt-0">
//                                 You
//                             </div>
//                             <div class="p-2 text-right">
//                                 ${message}
//                             </div>
//             `;
//             messagesContainer.appendChild(div);
//             messagesContainer.scrollTop = messagesContainer.scrollHeight;
//             input.value = "";
//         },
//         error: function () {
//             console.log("error");
//         }
//     });
// });


// Echo.private('test')
//     .listen('ConversationMessageSent', (e) => {
//         alert('WORKS');
//     });
