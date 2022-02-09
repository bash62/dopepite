/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import Vue from 'vue'
import App from './App.vue'
import RessourceSearch from './Components/RessourceSearch.vue'

// any CSS you import will output into a single css file (app.css in this case)
import '../styles/app.css';

// start the Stimulus application
import '../bootstrap';

Vue.component('search-component',require('./Components/RessourceSearch.vue').default);
Vue.component('show-history',require('./Components/ShowHistory.vue').default);

const app = new Vue({
    el: '#app', // where <div id="app"> in your DOM contains the Vue template

});

