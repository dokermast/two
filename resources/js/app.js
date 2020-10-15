/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('messenger', require('./components/Messenger.vue').default);
Vue.component('contacts', require('./components/Contacts.vue').default);
Vue.component('messages', require('./components/Messages.vue').default);
Vue.component('input-mes', require('./components/InputMes.vue').default);
Vue.component('chat', require('./components/Chat.vue').default);

Vue.component('mess-new', require('./components/MessNew.vue').default);
Vue.component('list-cont', require('./components/ListContactsNew.vue').default);
Vue.component('chat-new', require('./components/ChatNew.vue').default);



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
