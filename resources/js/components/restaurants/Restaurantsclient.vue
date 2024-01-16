<template>
  <div class="list">
    <div  v-for="restaurant in restaurants">
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img :src="restaurant.logo" class="img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ restaurant.name }}</h5>
        <p class="card-text">{{ restaurant.description }}</p>
      
        <RouterLink class="btn btn-outline-primary" :to="{ name: 'Menusclient', params: { id: restaurant.id } }">Show menus</RouterLink>
        <Choisirtable :restaurantid="restaurant.id" />
      </div>
    </div>
  </div>
</div></div></div>
</template>

<script setup>
import Choisirtable from '../Table/Choisirtable.vue';
import api from '../config/api.js';
import { ref,onMounted } from 'vue';
const restaurants=ref([])
const isLoading=ref(true)
const getrestaurants=async()=>{
await api.get("/api/restaurants")
.then(res=>{
 restaurants.value=res.data
 isLoading.value=false

})
.catch(error=>{
 console.log(error)
})
}
onMounted(() => {
 getrestaurants();
});
</script>
<style scoped>
.img{
  height: 182px;
  width:175px
}
.list{
  margin-left: 350px;
  margin-top: 30px;
}
</style>