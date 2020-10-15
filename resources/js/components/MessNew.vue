<template>
    <div id="mess">
        <div class="text-center"><h3>PARENT</h3></div>

        <list-cont @showModal="showModal" ></list-cont>

        <!--   Modal Chat     -->
        <div v-if="modalVisible">
            <transition name="model">
                <div class="modal-mask">
                    <div class="modal-wrapper">
                        <div class="modal-dialog">
                            <div class="modal-content bg-white">
                                <chat-new :contact="contact"></chat-new>
                                <button @click="modalVisible = false">close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
        </div>

    </div>
</template>

<script>
    import ChatNew from "./ChatNew";
    export default {
        name: "MessNew",
        data () {
            return {
                modalVisible: false,
                contact: {
                    type: Object
                }
            }
        },
        methods: {
            showModal(modalVisible, contact) {
                this.modalVisible = modalVisible;
                this.contact = contact;
            }
        },
        components: {
            ChatNew
        },
    }
</script>

<style lang="scss" scoped>

    .modal-mask {
        position: fixed;
        z-index: 9998;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, .5);
        display: table;
        transition: opacity .3s ease;
    }

    .modal-wrapper {
        display: table-cell;
        vertical-align: middle;
    }


</style>

