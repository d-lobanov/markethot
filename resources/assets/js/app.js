
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.component('product-item', require('./components/ProductItemComponent.vue'));
Vue.component('products-list', require('./components/ProductsListComponent.vue'));
Vue.component('homepage', require('./components/HomePageComponent.vue'));
Vue.component('search-tab', require('./components/SearchTab.vue'));
Vue.component('categories-links', require('./components/CategoriesLinksComponent.vue'));

const app = new Vue({
    el: '#app'
});
