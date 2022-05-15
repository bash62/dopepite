

<template>
  <div>
    

    <div class="">
      <div class="flex flex-col justify-center items-center w-full" v-for="(ressource,index) in store.history" :key="index" :item="ressource">
        <div  class="md:w-2/5 w-3/5 flex items-center" v-for="(item,index) in ressource" :key="index" :item="item">


          <a v-bind:href="store.url + item.ressource.id" class="w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16 flex">
          <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
            <div class=" text-3xl text-purple-800 font-black">{{item.ressource.name[0]}}</div>
          </div>
          <div class="w-full">
          <p class="text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ item.ressource.name.length > 40? item.ressource.name.substring(0, 40)+ "..." : item.ressource.name }}</p>
          <p class="text-base font-medium text-white h-full flex justify-center items-center  px-4"> </p>
          </div>

        </a>


        <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="store.archiveUrl + item.ressource.id">
          <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
        </a>
          
        </div>

      </div>

    </div>
  </div>
</template>


<script setup>


  import { computed, ref } from 'vue'
  import { useDefaultStore } from '../stores/index'

  const store = useDefaultStore()



</script>