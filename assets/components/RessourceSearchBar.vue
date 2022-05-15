<template>

        <div>
            <div class="flex items-center justify-center">
                <input autofocus :placeholder="store.searchPlaceholder" v-model="store.query" @input="store.loadDataSearch()" type="text" class="py-3 px-6 text-xl text-zinc-900 text-center rounded-xl my-4 w-1/3" id="search-bar">
            </div>

            <div class=" flex justify-center text-xl font-bold py-4">

              <div v-if="store.resources.length == 0 && store.resources.length == 0"> Aucune resource trouvé.
                <a v-bind:href="store.newPost" class="text-blue-600">La renseigner ?</a>
              </div>

              <div v-else > {{ store.resources.length }} ressources trouvé ! </div>

            </div>
            


            <div v-if="store.resources.length > 0 && store.query.length <= 0" class="flex flex-col justify-center items-center w-full">

            <div  class="md:w-2/5 w-4/5 flex items-center" v-for="(ressource,index) in store.resources" :key="index" :item="ressource">
                <a v-bind:href="store.url + ressource.id" class="w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16 flex">
                    <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
                        <div class=" text-3xl text-purple-800 font-black">{{ressource.name.length == 0? '?' : ressource.name[0]}}</div>
                    </div>
                    <p class="text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>

                </a>
                <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="store.archiveUrl + ressource.id">
                    <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
                </a>
            </div>
            </div>

            <div v-else class="flex flex-col justify-center items-center w-full">

            <div  class="md:w-2/5 w-4/5 flex items-center" v-for="(ressource,index) in store.resources" :key="index" :item="ressource">
                <a v-bind:href="store.url + ressource.id" class="w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16 flex">
                    <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
                        <div class=" text-3xl text-purple-800 font-black">{{ressource.name.length == 0? '?' : ressource.name[0]}}</div>
                    </div>
                    <p class="text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>

                </a>
                <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="store.archiveUrl + ressource.id">
                    <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
                </a>
            </div>

            </div>

        <div class=" flex justify-center text-xl font-bold py-4" @click="store.loadData"> Load more </div>


            

    </div>
        


</template>


<script setup>

  import { ref } from 'vue'
  import { useDefaultStore } from '../stores/index'

  const store = useDefaultStore()


 
</script>