<template>
    <Addrestauranttable/>

 <div class="card">
     <DataTable :value="restaurants" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
         <Column header="Image">
           <template #body="{ data }" >
              <img :src="data.logo" :alt=data.name  class="shadow-4" width="65"/> 
           </template>
         </Column>
         <Column field="name" header="Nom" sortable></Column>
         <Column field="description" header="Description"  sortable ></Column>
         <Column field="phone" header="phone"  sortable ></Column>
         <Column field="email" header="Email"  sortable ></Column>
         <Column field="address" header="Adresse"  sortable ></Column>
         <Column field="city" header="Ville"  sortable ></Column>

         <Column field="id" header="Actions" style="min-width: 12rem">
     <template #body="val">
     
         <div class="d-flex">
     <Cardrestaurant :restaurant="val.data"/>
      
     <Editrestauranttable  :restaurant="val.data" />
     <button type="button" class="btn btn-warning rounded-circle " @click="deleterestaurant(val.data.id)">
         <span style="color: rgb(245, 5, 5)">
             <i class="fa-solid fa-trash"></i>
   
    </span>
    
     </button> 
    </div>
         </template>
         </Column>
 </DataTable>
 </div>

</template>

<script setup>
import api from '../config/api.js';
import DataTable from 'primevue/datatable';
import Column from 'primevue/column';
import { ref,onMounted } from 'vue';
import Editrestauranttable from './Editrestaurant.vue';
import Addrestauranttable from './Addrestaurant.vue';
import Cardrestaurant from './Cardrestaurant.vue';
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


const deleterestaurant=async(id)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
 try {
     await api.delete(`/api/restaurants/${id}`)
     getrestaurants()
} catch (error) {
 console.log(error)
     
 }
}

}
</script>
<style scoped>
.drag{
margin-top: 100px;
}
</style>