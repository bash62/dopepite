
<template>
    <div id="app">


      <h1 class="">fefe</h1>
      <RessourceSearch/>
      <ShowHistory/>
      <LandingStats/>
    </div>

</template>





<script>
import RessourceSearch from './Components/RessourceSearch.vue'
import ShowHistory from './Components/RessourceSearch.vue'
import LandingStats from './Components/LandingStats.vue'

export default {
  name: "app",
  components:{
    RessourceSearch,
    ShowHistory,
    LandingStats
  }
}


</script>

