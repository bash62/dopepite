
<template>
  <router-view/>
</template>


<script setup>
import { onMounted } from "@vue/runtime-core";
import { useDefaultStore } from './stores/index'

const store = useDefaultStore()


onMounted(()=> {
  store.loadHistory();
  store.loadData();

})
</script>


<style>

</style>


