<template>
  <div>

    <div class="flex flex-col justify-center items-center w-full">

      <div  class="md:w-2/5 w-4/5 flex items-center" v-for="ressource in setData" v-bind:key="ressource.name" >

        <a v-bind:href="url + ressource.id" class="w-full text-align bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16 flex">
          <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
            <div class=" text-3xl text-purple-800 font-black">{{getFirstLetter(ressource.name)}}</div>

          </div>
          <p class="text-3xl font-medium text-white h-full flex justify-center items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>
          <p class="text-base font-medium text-white h-full flex justify-center items-center  px-4">{{ getParsedTime(ressource.date) }}</p>
        </a>
        <a class="text-yellow-500 justify-center h-full flex items-center px-4" v-bind:href="archiveUrl + ressource.id">
          <i class="fas fa-archive text-yellow-500 hover:text-red-500 cursor-pointer text-xl"></i>
        </a>
      </div>
    </div>
  </div>
</template>


<script>
//TODO: Set time Ago in french

  import TimeAgo from 'javascript-time-ago'
  import fr from 'javascript-time-ago/locale/fr.json'
  TimeAgo.addDefaultLocale(fr)

  const timeAgo = new TimeAgo('fr-FR');
  export default {
  name: "showhistory",
  data() {
    return {
      ressources: [],
      query: '',
      searchPlaceholder : "Rechercher une ressource",
      url:'/history/update/',
      archiveUrl: '/history/revert/'
    }
  },
  props: ['res'],
  methods:{
    getFirstLetter(name){
      return(name[0])
    },
    getParsedTime(datetime){
      return timeAgo.format(new Date(datetime));
    }
  },
  mounted() {
  console.log(this.res)
  },
  computed: {
    setData(){
      return this.ressources = JSON.parse(this.res);
    }

  },
};
</script>