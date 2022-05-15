import { createRouter, createWebHistory } from 'vue-router'
import RessourceSearch from '../components/RessourceSearchBar.vue'
import History from '../components/History.vue'

const routes = [
    // À compléter
    {
      path: '/show',
      name : 'app-show',
      component : RessourceSearch
    },
    {
      path: '/history/action',
      name: 'app-history',
      component: History
    }
]

const router = createRouter({
    history: createWebHistory(),
    routes,
  })

export default router
