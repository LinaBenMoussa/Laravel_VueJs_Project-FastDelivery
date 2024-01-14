<template>
     
    <button type="button" class="btn btn-warning rounded-circle "  @click="visible = true">
       <span style="color: rgb(233, 240, 241)">
        <i class="fa-solid fa-pen-to-square"></i>
      
       </span>
  
   </button>    
  <form >
   <div class="card flex justify-content-center">
      <Dialog
         v-model:visible="visible"   
     >
   <div class="row">
   <div class="col-md-6">
       <label for="table_number" class="form-label">Numéro de la Table</label>
   <input type="text" class="form-control" id="table_number" v-model="table.table_number">
  
   </div>
   <div class="col-md-6 ms-auto">
       <label for="seating_capacity" class="form-label">Nombre de place</label>
   <input type="texte" class="form-control" id="seating_capacity" v-model="table.seating_capacity">
  
   </div>
  </div>
               
  
  <div class="row">
   
   <div class="col-md-6 ms-auto">
       <label for="restaurant" class="form-label">restaurant</label>
       <select class="form-control" v-model="table.restaurant_id">
         <option v-for="sc in restaurant" :key="sc.id" :value=sc.id>{{sc.name}}</option>
      </select>  
  
  
   </div>
  </div>
  <div class="row">
   
  </div>
  <br/>
  <button type="submit" className="btn btn-outline-primary" @click="modifierproduit">
   <i class="fa-solid fa-floppy-disk"></i>Enregister
           </button>
           <button type="button" className="btn btn-outline-primary" @click="cancel">
   <i class="fa-solid fa-floppy-disk"></i>cancel
           </button>
  </Dialog>
   </div>
  </form>        
  </template>
  
  <script setup>
  import api from '../config/api.js';
  import { ref,onMounted } from "vue"
  import Dialog from 'primevue/dialog';
  const props=defineProps(['table'])
  const visible = ref(false);
  const table=ref({})
  
  const restaurant = ref([]);
  const getrestaurant=async()=>{     
         await api.get('/api/restaurants').then(res => {
             restaurant.value = res.data;
                 }).catch(error => {
                     console.log(error)
                 });
     
              }
  
   
  const loadtable=()=>{
   
    table.value=props.table
  }
  onMounted(() => {
   getrestaurant();
   loadtable()
   
           }
  );
  
  const  modifierproduit=()=>{
     api.put(`/api/tables/${table.value.id}`,table.value)
          .then(() => {
            visible.value=false
          })  
          .catch(error => {
             console.error("There was an error!", error);})
  }
  
  const cancel=()=>{
   visible.value=false
           
  }
  
  
  </script>
  <style scoped>
  
  </style>