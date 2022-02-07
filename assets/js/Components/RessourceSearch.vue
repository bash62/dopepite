


<template>

    <div>

      <div class=" border ">
        <h1 class="flex  items-center justify-center text-2xl block mt-2">Cherche une ressource </h1>
        <div class="flex items-center justify-center">
          <input
              autofocus
              :placeholder="searchPlaceholder"
              v-model="query" type="text" class="  my-4 w-2/6" id="search-bar">
        </div>

      </div>

      <div class=" flex justify-center text-xl font-bold py-3">
        <div v-if=" getFilteredPosts.length > 0">
          {{ getFilteredPosts.length }} ressources jamais renseigné trouvés.

        </div>

        <div v-else >
          {{ getFilteredPosts.length }} ressources trouvé .
          <a v-bind:href="newPost" class="text-blue-600"> La renseigner ? </a>

        </div>
      </div>

      <div class="flex justify-center">
        <div class="w-1/3">

          <div class=" justify-center items-center bg-gray-800 bg-opacity-75 p-4 m-1.5 rounded-sm cursor-pointer hover:scale-125 hover:my-2"  v-on:click="onClickRedirect" v-for="ressource in getFilteredPosts" v-bind:key="ressource.name" v-bind:href="ressource.id" >
            <div class="relative flex text-align">
              <a v-bind:href="url + ressource.id" class=" w-full h-full absolute "></a>
              <div class=" left-5 " >
                <div class=" bg-white rounded-full w-12 h-12 flex justify-center items-center mr-5">
                  <div class=" text-3xl text-purple-800 font-black ">{{getFirstLetter(ressource.name)}}</div>
                </div>

              </div>
              <div class="text-4xl font-medium text-white ">{{ ressource.name }}</div>
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
        searchPlaceholder : "Nom d'une ressource",
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