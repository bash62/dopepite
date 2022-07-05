import { defineStore } from 'pinia'
import Axios from 'axios'

export const useDefaultStore = defineStore({
  id: 'default',
  state: () => ({
    hostIp: 'http://localhost:8000',
    apiResource: '/api/dofus_ressources?page=1',
    apiResourceParams: 'http://localhost:8000/api/dofus_ressources?name=',
    apiHistory: 'http://localhost:8000/api/ressource_entities?page=1',
    resources: [],
    resources_found: [],
    history: [],
    query: '',
    url:'/ressource/add/',
    newPost:'/ressource/new',
    archiveUrl: '/history/revert/',
    archiveRes: '/ressource/archive/',
    updatePost: '/history/update/'
  }),
  getters: {






  },
  actions: {


    getFoundedPosts(){

      if(this.resources.length === 0) return [];
        return this.resources_found.filter(post => {
        if(this.query == 'oe' ){
          this.query = "Œ";
        }
        return post.name.toLowerCase().startsWith(this.query.toLowerCase());
      })
    },
    getFilteredPosts(){

      if(this.resources.length === 0) return [];
      return this.resources.filter(post => {
        console.log(post)
        return post.name.toLowerCase().startsWith(this.query.toLowerCase());
      })
    },
    loadData() {
      Axios.get(this.hostIp + this.apiResource+'&available=1')
      .then(res => res.data)
      .then( data => {


        this.resources = [...this.resources,...data['hydra:member']]
        this.apiResource =  data['hydra:view']['hydra:next'];
     
      })
    },

    loadDataSearch() {
      Axios.get(this.apiResourceParams + this.query  )
      .then(res => res.data)
      .then( data => {
        this.resources = [...data['hydra:member']]
      })
    },

    loadHistory(){
      Axios.get(this.apiHistory+'&user_id='+localStorage.getItem('user_id'))
      .then(res => res.data)
      .then( data => {
    

        const items = []
        data['hydra:member'].forEach(e => {
 
          items.push({ressource: e['ressource_id'],date:e.date,id:e.id})
          
        });

        console.log(items)
        this.history = [items,...this.history]
      });
    },



  }
})
