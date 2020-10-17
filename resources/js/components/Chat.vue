<template>
    <div class="chat">
        <h2>{{ contact ? contact.name : 'Choose user'}}</h2>
        <h3>test</h3>
        <Messages :contact="contact" :messages="messages"/>
        <input-mes @send="sendMessage"/>
    </div>
</template>

<script>
    import Messages from './Messages';
    import InputMes from './InputMes';

    export default {
        name: "Chat",
        props: {
            user: {
                type: Object
            },
            contact: {
                type: Object,
                default: null
            },
            messages: {
                type: Array,
                default: []
            },
        },
        mounted (){

            window.Echo.private(`chat.${this.user.id}`)
                .listen('NewMessage', ({message}) => {
                    this.messages.push(message);
                })
        },
        methods: {
            sendMessage(text) {
                if(!this.contact){
                    return;
                }
                axios.post('/chat/send', {
                    contact_id: this.contact.id,
                    text: text,
                }).then((response) => {
                    this.$emit('new', response.data.message);
                });
            }
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
