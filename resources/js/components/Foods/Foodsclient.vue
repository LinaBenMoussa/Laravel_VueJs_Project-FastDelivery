<template>
    <div v-for="food in foods">
  <div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-4">
      <img :src="food.image" class="img-fluid rounded-start" alt="...">
    </div>
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title">{{ food.name }}</h5>
        <p class="card-text">{{ food.description }}</p>
        <p class="card-text"><small class="text-body-secondary">{{ food.price }} TL</small></p>
        <div class="cart-product-quantity">
                    <button @click="minus(food)" >
                      -	
                    </button>
                    <div class="count"><strong> {{ quantities[food.id] }} </strong></div>
                    <button @click="add(food)">+</button>
        </div>
        <button class="btn btn-outline-primary" @click="addToCart(food)">Add to Cart</button>

      </div>
    </div>
  </div>
</div></div>
</template>

<script setup>
  import store from '../../store'
  import { useRoute } from 'vue-router'

const route = useRoute()
const id = ref(route.params.id)
import api from '../config/api.js';
import { ref,onMounted } from 'vue';
const foods=ref([])
const isLoading=ref(true)
const getfoods=async()=>{
await api.get("/api/foodsbymenu/"+id.value)
.then(res=>{
 foods.value=res.data
 isLoading.value=false
 initializeQuantities();

})
.catch(error=>{
 console.log(error)
})
}

onMounted(() => {
 getfoods();
});

const addToCart=(prod)=> {
store.commit("Foodstore/addCart", {product:prod,qty:quantities.value[prod.id]})}
const quantities = ref({});
const initializeQuantities = () => {
    foods.value.forEach(food => {
        quantities.value[food.id] = 1;  // Initialiser la quantité à 1 pour chaque food
    });
}


const add = (food) => {
    quantities.value[food.id]++;
}

const minus = (food) => {
    if (quantities.value[food.id] > 1) {
        quantities.value[food.id]--;
    }
}
</script>
<style scoped>

</style>