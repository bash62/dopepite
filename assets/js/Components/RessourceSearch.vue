<template>
    <div>
      <div class="">
        <div class="flex items-center justify-center">
          <input
              autofocus
              :placeholder="searchPlaceholder"
              v-model="query" type="text" class="py-3 px-6 text-xl text-zinc-900 text-center rounded-xl my-4 w-1/3" id="search-bar">
        </div>
      </div>

      <div class=" flex justify-center text-xl font-bold py-4">
        <div v-if=" getFilteredPosts.length > 0">
          {{ getFilteredPosts.length }} ressources jamais renseigné trouvés.
        </div>

        <div v-else >
          {{ getFilteredPosts.length }} ressources trouvé.
          <a v-bind:href="newPost" class="text-blue-600">La renseigner ?</a>
        </div>
      </div>

      <div class="flex justify-center">
        <div class="md:w-2/5 w-4/5">
          <div v-if="this.query.length < 0"></div>

          <div v-else class="justify-center items-center bg-zinc-700 bg-opacity-75 m-3 rounded-lg cursor-pointer hover:bg-zinc-800 h-16" v-on:click="onClickRedirect" v-for="ressource in getFilteredPosts" v-bind:key="ressource.name" v-bind:href="ressource.id" >
            <div class="relative flex text-align h-full">
              <a v-bind:href="url + ressource.id" class="w-full h-full absolute"></a>
              <div class="bg-white rounded-lg w-16 h-full flex justify-center items-center" >
                <div class=" text-3xl text-purple-800 font-black">{{getFirstLetter(ressource.name)}}</div>
              </div>

              <p class="text-3xl font-medium text-white align-right h-full flex justify-center truncate items-center w-full px-4">{{ ressource.name.length > 40? ressource.name.substring(0, 40)+ "..." : ressource.name }}</p>
            </div>
          </div>
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
        query: '',
        searchPlaceholder : "Rechercher une ressource",
        url:'/ressource/add/',
        newPost:'/ressource/new'
      }
    },
    props: ['res'],
    methods:{
       onClickRedirect(e) {
          console.log(e.target.id);
      },
      getFirstLetter(name){
        return(name[0])

      }
    },
    mounted() {

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

    },
  };
</script>