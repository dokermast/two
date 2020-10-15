<template>
    <div class="chat">
        <h2>{{ contact ? contact.name : 'Choose user'}}</h2>
        <Messages :contact="contact" :messages="messages"/>
        <input-mes @send="sendMessage"/>
    </div>
</template>

<script>
    import Messages from "./Messages";
    import InputMes from "./InputMes";

    export default {
        name: "ChatNew",
        props: {
            contact: {
                type: Object,
                default: null
            }
        },
        data(){
            return {
                messages: [],
                chat_id: ''
            }
        },
        mounted (){

            axios.get(`/chat/${this.contact.id}`)
                .then((response) => {
                    this.messages = response.data.messages;
                    this.chat_id = response.data.chat_id;
                });

            window.Echo.private('chat.' + this.chat_id)
                .listen('NewMessage', ({data}) => {

                    console.log('ECHO');

                    this.messages.push(data);
                });



            // this.channel.listen('NewMessage', ({data}) => {
            //         console.log('ECHO');
            //         this.messages.push(data);
            //     })

            // window.Echo.channel('chat')
            //     .listen('NewMessage', ({data}) => {
            //         this.messages.push(data);
            // })

            // window.Echo.private('chat.1')
            //     .listen('NewMessage', ({data}) => {
            //         this.messages.push(data);
            //     })


            // window.Echo.private('chat.' + this.chat_id)
            //     .listen('NewMessage', ({data}) => {
            //
            //         console.log('ECHO');
            //
            //         this.messages.push(data);
            //     })
        },
        methods: {
            sendMessage(text) {
                if(!this.contact){
                    return;
                }
                axios.post('/chat/send', {
                    contact_id: this.contact.id,
                    text: text,
                    chat_id: null
                }).then((response) => {
                    this.messages.push(response.data.message);
                    this.chat_id = response.data.chat_id;
                });
            },
        },
        components: {
            Messages,
            InputMes
        },
    }
</script>

<style scoped>
    .chat {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    h1 {
        flex: 5;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        font-size: 20px;
        padding: 10px;
        margin: 0;
        border-bottom: 1px dashed lightgray;
    }
</style>
