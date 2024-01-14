<template>
<div class="drag">
  <div v-if="isLoading">
            <h2> Loading .... </h2>
        </div>
    <div v-else class="row">
        <div class="col-md-12" style="display:flex;flex-wrap:wrap;justify-content:center">

          <div class="card" style="width: 18rem;margin:6px" v-for="prod in foods" :key="prod.id">
  <img :src="prod.image" :alt=prod.description  width="200" height="200">
  <div class="card-body">
    <h5 class="card-title">{{ prod.description.substr(0,20) }}</h5>
   
    
  
  <div style="text-align:center">
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Prix : {{ prod.price }} TND</li>
                </ul>
                <button class="btn btn-outline-primary" @click="addToCart(prod)">Add to Cart</button>
              
            </div>
          </div>  
        </div>
    </div>
  </div>
</div>
  </template>

<script setup>

  import axios from "../config/api";
  import store from '../../store'
  
import { ref, onMounted } from 'vue';

const foods = ref([]);
const isLoading=ref(true)
onMounted(() => {
          getfoods();
                   
          }
);

const getfoods=(page=1)=>{
              
         axios.get('/api/foods/')
        
             .then(response => { 
              foods.value = response.data;
              isLoading.value=false
                               
              });  
              console.log(foods.value) 
          }
        
const    addToCart=(prod)=> {

store.commit("Foodstore/addCart", {product:prod,qty:1});

             }     

  
      
</script>
<style scoped>
.drag{
  margin-top: 70px;
}
</style>