<template>
          <div class="container-fluid">
            <button type="button" class="btn btn-warning  rounded-circle m-2"  @click="visible = true">
              <span style="color: rgb(43, 27, 27)">
              <i class="fa-solid fa-square-plus"> </i> 
            </span>
            New
              </button>
             
  
           
          </div>
  
     
  
  <form >
    <Dialog
            v-model:visible="visible"
            modal header="Header" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }"
           
        >
      <div class="card flex justify-content-center">
        
        
  
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
    
    <br/>
           
  
             
    <button type="submit" className="btn btn-outline-primary" @click="addtable">
      <i class="fa-solid fa-floppy-disk"></i>Enregister
              </button>
              <button type="button" className="btn btn-outline-primary" @click="cancel">
      <i class="fa-solid fa-floppy-disk"></i>cancel
              </button>
              
              
         
      </div>
  
    </Dialog>
            </form>
            
             
  </template>
  
  <script setup>
  import { ref,onMounted } from "vue"
  import api from '../config/api.js';
  import Dialog from 'primevue/dialog';
  const visible = ref(false);
  const table=ref({
    table_number:"",
    seating_capacity:"",
      restaurant_id:""
  })
  const restaurant = ref([]);
  const getrestaurant=()=>{
            
            api.get('/api/restaurants').then(res => {
                restaurant.value = res.data;
                    }).catch(error => {
                        console.log(error)
                    });
        
                 }
        
  const addtable=async()=>{
    try {
      await api.post("/api/tables/",table.value)
     {
       visible.value=false
      window.location.reload()
     }
    } catch (error) {
      
    }
  }
  onMounted(() => {
      getrestaurant();
              }
  );
 
  
  const cancel=()=>{
      visible.value=false
              
  }
  
  
  
  </script>
  <style scoped>
  
  </style>