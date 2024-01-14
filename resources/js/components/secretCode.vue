<template>
    <div >
    <div v-if="isLoading">
    <h2> Loading .... </h2>
    </div>
    <div v-else class="py-6">
    <table class="table table-striped shadow">
    <thead>
    <tr>
    <th scope="col">Date</th>
    <th scope="col">Heure</th>
    <th scope="col">Nombre de personnes</th>
    <th scope="col">Restaurant</th>
    <th scope="col">SecretCode</th>
   
    </tr>
    </thead>
    <tbody>
    <tr v-for="res in reservations" :key="res.id">
    
    
    <td>{{ res.date }}</td>
    <td>{{ res.time }}</td>
    <td>{{ res.numpersonnes }}</td>
    <td>{{ getRestaurantName(res.restaurant_id) }}</td>
    <td>{{ res.secretCode }}</td>
    
    

    </tr>
    </tbody>
    </table>
    
    </div>
    </div>
    </template>
    <script setup>
    import { ref,onMounted } from 'vue';
    import axios from 'axios';
    const reservations=ref([])
    const isLoading=ref(true)
    const getreservations=async()=>{
    await axios.get("http://localhost:8000/api/reseravationsbyusername/"+localStorage.getItem('user'))
    .then(res=>{
    reservations.value=res.data
    isLoading.value=false
    
    })
    .catch(error=>{
    console.log(error)
    })
    }
    const restaurants=ref([])
const getrestaurants=async()=>{
await axios.get("http://localhost:8000/api/restaurants")
.then(res=>{
    restaurants.value=res.data
 isLoading.value=false
 
})
.catch(error=>{
 console.log(error)
})
}
const getRestaurantName = (restaurantId) => {
  const restaurant = restaurants.value.find((r) => r.id === restaurantId);
  return restaurant ? restaurant.name : 'N/A';
};
    onMounted(() => {
        getreservations();
        getrestaurants();
    });
   
    </script>
    <style lang="scss" scoped>
    </style>