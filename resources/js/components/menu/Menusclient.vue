<template>
  <div class="list"> 
    <div v-for="menu in menus">
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img :src="menu.image" class="img" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ menu.name }}</h5>
        <p class="card-text">{{ menu.description }}</p>
       
        <RouterLink class="btn btn-outline-primary" :to="{ name: 'Foodsclient', params: { id: menu.id } }">Show Foods</RouterLink>

      </div>
    </div>
  </div>
</div></div></div>
</template>

<script setup>
 import { useRoute } from 'vue-router'

const route = useRoute()
const id_restaurant = ref(route.params.id)
import api from '../config/api.js';
import { ref,onMounted } from 'vue';
const menus=ref([])
const isLoading=ref(true)
const getmenus=async()=>{
await api.get("/api/menusbyrestaurant/"+id_restaurant.value)
.then(res=>{
 menus.value=res.data
 isLoading.value=false

})
.catch(error=>{
 console.log(error)
})
}

onMounted(() => {
 getmenus();
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