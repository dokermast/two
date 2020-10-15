<template>
    <div class="contacts">
        <ul>
            <li v-for="(contact, index) in contacts" @click="modalShow(contact)" :key="contact.id" :class="{'selected' : index == selected }">
                <div class="contact">
                    <p class="name">{{ contact.name }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "ListContacts",
        data () {
            return {
                contacts: {
                    type: Array,
                    default: []
                },
                selected: 0,
                modalVisible: false,
            }
        },
        mounted() {

            axios.get('/contacts')
                .then((response) => {
                    this.contacts = response.data;
                });
        },
        methods: {
            modalShow (contact) {
                this.modalVisible = true;
                this.$emit('showModal', this.modalVisible, contact);
            },
        }
    }
</script>

<style lang="scss" scoped>
    .contacts {
        flex: 2;
        max-height: 100%;
        height: 600px;
        /*overflow: scroll;*/

        ul {
            list-style-type: none;
            padding-left: 5px;
            background-color: #ddedf5;

            li {
                display: flex;
                padding: 2px 2px 2px 15px;
                height: 80px;
                position: relative;
                cursor: pointer;

                &.selected {
                    background: #dfdfdf;
                }

                span.unread {
                    background: #82e0a8;
                    color: #fff;
                    position: absolute;
                    right: 11px;
                    top: 20px;
                    display: flex;
                    font-weight: 700;
                    min-width: 20px;
                    justify-content: center;
                    align-items: center;
                    line-height: 20px;
                    font-size: 12px;
                    padding: 0 4px;
                    border-radius: 3px;
                }

                .contact {
                    flex: 3;
                    font-size: 12px;
                    overflow: hidden;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;

                    p {
                        margin: 0;

                        &.name {
                            font-weight: bold;
                        }
                    }
                }
            }
        }
    }
</style>

