/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

import Vue from 'vue';
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('form-errors', require('./components/form/Errors.vue').default);
Vue.component('tags-input', require('./components/form/Tags.vue').default);
Vue.component('tinymce', require('./components/form/Tinymce.vue').default);
Vue.component('admin-categories-list', require('./components/pages/admin/category/List.vue').default);
Vue.component('admin-article-list', require('./components/pages/admin/article/List.vue').default);
Vue.component('admin-tags-list', require('./components/pages/admin/tag/List.vue').default);
Vue.component('category-inline', require('./components/pages/admin/category/CategoryInline.vue').default);
Vue.component('category-form', require('./components/pages/admin/category/Form.vue').default);
Vue.component('article-form', require('./components/pages/admin/article/Form.vue').default);
Vue.component('tag-form', require('./components/pages/admin/tag/Form.vue').default);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);

// MODAL
import VModal from 'vue-js-modal';
Vue.use(VModal, {dynamicDefault:{draggable: true, resizable: true}});

// ALERTS
import VueSweetalert2 from 'vue-sweetalert2';
import 'sweetalert2/dist/sweetalert2.min.css';
const swalOptions = {
    confirmButtonColor: '#41b882',
    cancelButtonColor: '#ff7674',
    cancelButtonText: 'Відмінити',
};
Vue.use(VueSweetalert2, swalOptions);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
