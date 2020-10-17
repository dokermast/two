<template>
    <div class="messenger">
        <Contacts :contacts="contacts" @selected="startChatWith"/>
        <Chat :user="user" :contact="selectedContact" :messages="messages"   @new="addNewMessage"/>
    </div>
</template>

<script>
    import Contacts from './Contacts';
    import Chat from './Chat';

    export default {
        name: "Messenger",
        props: {
            user: {
                type: Object,
                required: true
            }
        },
        data() {
            return {
                selectedContact: null,
                messages: [],
                contacts: [],
            };
        },
        mounted() {

            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },

        methods: {
            startChatWith(contact){
                axios.get(`/chat/${contact.id}`)
                    .then((response) => {
                        this.messages = response.data.messages;
                        this.selectedContact = contact;
                    })
            },
            addNewMessage(message) {
                this.messages.push(message);
            },
        },
        components: { Contacts, Chat }
    }
</script>

<style scoped>
    .messenger {
        display: flex;
    }
</style>




















<!--<template>-->
<!--    <div class="messenger">-->
<!--        <Contacts :contacts="contacts" @selected="startChatWith"/>-->
<!--        <Chat :contact="selectedContact" :messages="messages" @new="saveNewMessage"/>-->
<!--    </div>-->
<!--</template>-->

<!--<script>-->
<!--    import Chat from './Chat';-->
<!--    import Contacts from './Contacts';-->
<!--    export default {-->
<!--        name: "Messenger",-->
<!--        props: {-->
<!--            user: {-->
<!--                type: Object,-->
<!--                required: true-->
<!--            }-->
<!--        },-->
<!--        data() {-->
<!--            return {-->
<!--                selectedContact: null,-->
<!--                messages: [],-->
<!--                contacts: []-->
<!--            };-->
<!--        },-->
<!--        mounted() {-->

<!--            Echo.private(`chat.${this.user.id}`)-->
<!--                .listen('NewMessage', (e) => {-->
<!--                    this.hanleIncoming(e.message);-->
<!--                });-->

<!--            axios.get('/contacts')-->
<!--                .then((response) => {-->
<!--                    this.contacts = response.data;-->
<!--                });-->
<!--            this.fetchChat();-->
<!--        },-->
<!--        methods: {-->
<!--            startChatWith(contact){-->
<!--                axios.get(`/chat/${contact.id}`)-->
<!--                    .then((response) => {-->
<!--                        this.messages = response.data;-->
<!--                        this.selectedContact = contact;-->
<!--                    })-->
<!--            },-->
<!--            saveNewMessage(message) {-->
<!--                this.messages.push(message);-->
<!--            },-->
<!--            hanleIncoming(message) {-->
<!--                if (this.selectedContact && message.from == this.selectedContact.id) {-->
<!--                    this.saveNewMessage(message);-->
<!--                    return;-->
<!--                }-->
<!--            },-->
<!--            fetchChat(){-->
<!--                setInterval( () => {-->
<!--                    if (this.selectedContact) {-->
<!--                        this.startChatWith(this.selectedContact);-->
<!--                    }-->
<!--                },5000);-->
<!--            },-->
<!--        },-->
<!--        components: { Chat, Contacts }-->
<!--    }-->
<!--</script>-->

<!--<style scoped>-->
<!--    .messenger {-->
<!--        display: flex;-->
<!--    }-->
<!--</style>-->
