{
    const moment = require("moment");

    // user activity
    let currentUser;

    axios.get('/users/currentUser').then(res => {
        return currentUser = res.data;
    })


    window.addEventListener('change', e => {
        Echo.private('messages')
            .whisper('typing', {
                data: currentUser
            })
    })

    window.addEventListener('keyup', e => {
        Echo.private('messages')
            .whisper('typing', {
                data: currentUser
            })
    })

    Echo.private("messages")
        .listenForWhisper("typing", e => {
        const formStatus = document.getElementById('form-status');
        formStatus.innerText = `${e.data.name} is writing now..`
        setTimeout(() => {
            formStatus.innerText = ''
        }, 5000)
    });


    // user status
    Echo.join('messages')

        .here(users => {
            users.forEach(user => {
                document
                    .querySelectorAll(".user-list-item")
                    .forEach(item => {
                        if (parseInt(item.dataset.id) === user.id) {
                            item.classList.add('active')
                        }
                    });
            })
        })

        .joining(user => {
            document.querySelectorAll(".user-list-item").forEach(item => {
                if (parseInt(item.dataset.id) === user.id) {
                    item.classList.add("active");
                }
            });
        })

        .leaving(user => {
            document.querySelectorAll(".user-list-item").forEach(item => {
                if (parseInt(item.dataset.id) === user.id) {
                    item.classList.remove('active')
                }
            });
        })


    // insert new message
    Echo.private('messages')

        .listen('MessageCreated', e => {
            const messageList = document.getElementById('message-list');

            if (e.message.text && e.message.image) {
                const element = `
                    <li class="list-group-item">
                        <div>
                            <p class="font-weight-bold mb-0">
                                ${e.user.name}
                                <span class="ml-1 font-weight-light">( ${moment(
                                    e.message.created_at
                                ).fromNow()} )</span>
                            </p>
                        </div>
                        <p class="mb-0" style="font-size:1.5rem;">${
                            e.message.text
                        }</p>
                        <p class="mb-0 mt-1">
                            <a href="${e.message.image}" target="_blank">
                                <img class="chat-image" src="${
                                    e.message.image
                                }">
                            </a>
                        </p>
                    </li>
                `;
                messageList.insertAdjacentHTML("afterbegin", element);


            } else if (e.message.image) {
                const element = `
                    <li class="list-group-item">
                        <div>
                            <p class="font-weight-bold mb-0">
                                ${e.user.name}
                                <span class="ml-1 font-weight-light">( ${moment(
                                    e.message.created_at
                                ).fromNow()} )</span>
                            </p>
                        </div>
                        <p class="mb-0 mt-1">
                            <a href="${e.message.image}" target="_blank">
                                <img class="chat-image" src="${
                                    e.message.image
                                }">
                            </a>
                        </p>
                    </li>
                `;
                messageList.insertAdjacentHTML("afterbegin", element);

            } else {
                const element = `
                    <li class="list-group-item">
                        <div>
                            <p class="font-weight-bold mb-0">
                                ${e.user.name}
                                <span class="ml-1 font-weight-light">( ${moment(e.message.created_at).fromNow()} )</span>
                            </p>
                        </div>
                        <p class="mb-0" style="font-size:1.5rem;">${e.message.text}</p>
                    </li>
                `
                messageList.insertAdjacentHTML("afterbegin", element);

            }
        })


        
}