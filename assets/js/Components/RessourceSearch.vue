


<template>

    <div>

      <div class="flex justify-center">
        <label  class="mr-2 font-medium" for="search-bar">Rechercher une ressource</label>
        <input v-model="query" type="text" class="w-2/6" id="search-bar">
      </div>

      <div class=" flex justify-center text-3xl font-bold py-3">
        <div v-if="query && getFilteredPosts.length > 0">
          {{ getFilteredPosts.length }} ressources jamais renseigné trouvés.

        </div>

        <div v-else >
          {{ getFilteredPosts.length }} ressources jamais renseigné trouvés.
        </div>

      </div>
      <div class="flex justify-center">
        <div class="w-1/3 ">

          <div class="relative flex justify-center items-center bg-gray-500 p-4 m-1.5 rounded-xl cursor-pointer hover:scale-125 hover:my-2"  v-on:click="onClickRedirect" v-for="ressource in getFilteredPosts" v-bind:key="ressource.name" v-bind:href="ressource.id" >
            <a v-bind:href="url + ressource.id" class=" w-full h-full absolute "></a>
            <div class="absolute left-5 " >
              <div class="z-0 absolute  -top-6 bg-white rounded-full w-12 h-12 flex justify-center items-center">
                <div class=" text-xl font-black ">F</div>
              </div>

            </div>
            <div>{{ ressource.name }}</div>

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
        url:'/ressource/add/',
      }
    },
    props: ['res'],
    methods:{
       onClickRedirect(e) {
          console.log(e.target.id);


      },

    },
    mounted() {

    },
    computed: {
      getFilteredPosts(){
        return this.ressources.filter(post => {
          return post.name.toLowerCase().startsWith(this.query.toLowerCase());
        })
      },

    },
  };

</script>