<template>
    

 <div class="card">
     <DataTable :value="reservations" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
         
         <Column field="date" header="Date" sortable></Column>
         <Column field="time" header="Time"  sortable ></Column>
         <Column field="restaurant_id" header="Restaurant"  sortable ></Column>
         <Column field="table_id" header="Num_table"  sortable ></Column>
         <Column field="phone" header="phone"  sortable ></Column>
         <Column field="numpersonnes" header="numpersonnes"  sortable ></Column>

         <Column field="id" header="Actions" style="min-width: 12rem">
     <template #body="val">
     
         <div class="d-flex">
      
     <button type="button" class="btn btn-warning rounded-circle " @click="deletereservation(val.data.id)">
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
const reservations=ref([])
const isLoading=ref(true)
const getreservations=async()=>{
await api.get("/api/reservationtable")
.then(res=>{
    reservations.value=res.data
 isLoading.value=false
 
})
.catch(error=>{
 console.log(error)
})
}

onMounted(() => {
 getreservations();
});


const deletereservation=async(id)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
 try {
     await api.delete(`/api/reservationtable/${id}`).then(
     location.reload())
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