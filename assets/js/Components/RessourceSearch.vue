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

        <div class="flex flex-col justify-center items-center w-full">

              <div v-if="getFoundedPosts.length > 0 && getFilteredPosts.length == 0" class="md:w-2/5 w-4/5 flex items-center" v-for="ressource in getFoundedPosts" v-bind:key="ressource.name">
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


<script>
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
        archiveUrl: '/ressource/archive/'
      }
    },
    props: ['res','res_found'],
    methods:{
      getFirstLetter(name){
        return(name[0])

      }
    },
    mounted() {
      console.log(this.res)
      console.log(this.res_found)
    },
    computed: {
      getFilteredPosts(){
        return this.ressources.filter(post => {
          if(this.query == 'oe' ){
            this.query = "Œ";
          }
          return post.name.toLowerCase().startsWith(this.query.toLowerCase());
        })
      },
      getFoundedPosts(){
        return this.ressources_found.filter(post => {
          if(this.query == 'oe' ){
            this.query = "Œ";
          }
          return post.name.toLowerCase().startsWith(this.query.toLowerCase());
        })
      },

    },
  };
</script>