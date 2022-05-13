/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */
import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from './router'
import App from './App.vue'

import css from './styles/app.css'
// start the Stimulus application
import './bootstrap';

const app = createApp(App)

app.use(router)
app.use(createPinia())

app.mount('#app')

