<template>
    <div>
        <div>
            <div class="flex items-center justify-center">
                <input autofocus :placeholder="searchPlaceholder" v-model="query" type="text" class="py-3 px-6 text-xl text-zinc-900 text-center rounded-xl my-4 w-1/3" id="search-bar">
            </div>

            <div class=" flex justify-center text-xl font-bold py-4">
              <div v-if="getFilteredPosts.length == 0 && getFoundedPosts == 0"> {{ getFilteredPosts.length }} ressources trouvés.
                <a v-bind:href="newPost" class="text-blue-600">La renseigner ?</a>
              </div>
              <div v-if="getFilteredPosts.length > 0" > {{ getFilteredPosts.length }} ressources non renseigné trouvé. </div>


              <div v-if="getFilteredPosts.length == 0 && getFoundedPosts.length > 0 "> {{ getFoundedPosts.length }} ressources déjà renseigné trouvés.</div>

            </div>
        </div>

        <div v-if="getFoundedPosts.length > 0 && getFilteredPosts.length <= 5" class="flex flex-col justify-center items-center w-full">
        
              <div  class="md:w-2/5 w-4/5 flex items-center  h-36" v-for="ressource in getFoundedPosts" v-bind:key="ressource.name">
                <a v-bind:href="updatePost + ressource.id" class="  w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800  flex">

                  <div class="bg-white rounded-lg w-16  flex justify-center items-center" >
                    <div class=" text-3xl text-purple-800 font-black">{{getFirstLetter(ressource.name)}}</div>
                  </div>
                  <div>
                    <p class="block text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>
                    <p class="block text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">Renseigné par {{ ressource.username }}</p>

                  </div>

                </a>
                <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="archiveUrl + ressource.id">
                  <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
                </a>

              </div>

            <div v-if="this.query.length < 2"></div>
            <div v-else class="md:w-2/5 w-4/5 flex items-center" v-for="ressource in getFilteredPosts" v-bind:key="ressource.name">
                <a v-bind:href="url + ressource.id" class="w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16 flex">
                    <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
                        <div class=" text-3xl text-purple-800 font-black">{{getFirstLetter(ressource.name)}}</div>
                    </div>
                    <p class="text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>

                </a>
                <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="archiveUrl + ressource.id">
                    <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
                </a>
            </div>
        </div>
    </div>

</template>


<script setup >

  import { ref, computed } from 'vue'
  import { useRoute, useRouter } from 'vue-router'
  import { useDefaultStore } from '../stores/index'

  
  export default {
    name: "ressourcesearch",
    data() {
      return {
        ressources: JSON.parse(this.res),
        ressources_found: JSON.parse(this.res_found),
        query: '',
        searchPlaceholder : "Rechercher une ressource",
        url:'/ressource/add/',
        newPost:'/ressource/new',
        archiveUrl: '/ressource/archive/',
        updatePost: '/ressource/update/'
      }
    },
    props: {
      res: {
        type: [],
        required: true,
      },
      res_found: {
        type: [],
        required: true,

      }
    },

    methods:{
      getFirstLetter(name){
        return(name[0])

      }
    },
    mounted() {
    },
    computed: {
      

    },
  };
</script>