import { createRouter, createWebHistory } from 'vue-router'
import RessourceSearch from '../components/RessourceSearchBar.vue'


const routes = [
    // À compléter
    {
      path: '/show',
      name : 'app-show',
      component : RessourceSearch
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
  })

export default router
