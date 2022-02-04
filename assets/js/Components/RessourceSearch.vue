


<template>

    <div >
      {{ressources}}
      <div class="flex justify-center">
        <label  class="mr-2 font-medium" for="search-bar">Rechercher une ressource</label>
        <input v-model="query" type="text" class="w-2/6" id="search-bar">
      </div>
      <div v-if="query && getFilteredPosts.length == 0">
        {{ getFilteredPosts.length }} ressources trouvés.


      </div>
      <div class="flex justify-center" v-for="ressource in getFilteredPosts" v-bind:key="ressource.name">
        <div class="border-2">
          {{ ressource.name }}
        </div>
        <div class="border-2">
          {{ ressource.type }}
        </div>

      </div>
    </div>


</template>


<script>
import RESSOURCE from '../json/ressource.json'

console.log(RESSOURCE, 'here in index')




  export default {
    name: "ressourcesearch",
    data() {
      return {
        ressources: RESSOURCE,
        query: '',
      }
    },
    props: ['res'],
    methods:{

    },
    computed: {
      getFilteredPosts(){
        return this.ressources.filter(post => {
          return post.name.toLowerCase().startsWith(this.query.toLowerCase());
        })
      }
    },
  };

</script>