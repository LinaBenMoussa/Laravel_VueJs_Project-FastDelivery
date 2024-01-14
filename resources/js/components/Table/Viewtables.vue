<template>
    <Addtabletable/>

 <div class="card">
     <DataTable :value="tables" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
         
         <Column field="table_number" header="Numéro de la Table" sortable></Column>
         <Column field="seating_capacity" header="Nombre de place"  sortable ></Column>
       

         <Column field="id" header="Actions" style="min-width: 12rem">

     <template #body="val">
     
         <div class="d-flex">
     <Cardtable :table="val.data"/>
      
     <Edittabletable  :table="val.data" />
     <button type="button" class="btn btn-warning rounded-circle " @click="deletetable(val.data.id)">
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
import Edittabletable from './Edittable.vue';
import Addtabletable from './Addtable.vue';
import Cardtable from './Cardtable.vue';
const tables=ref([])
const isLoading=ref(true)
const gettables=async()=>{
await api.get("/api/tables")
.then(res=>{
    tables.value=res.data
 isLoading.value=false
 
})
.catch(error=>{
 console.log(error)
})
}

onMounted(() => {
 gettables();
});


const deletetable=async(id)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
 try {
     await api.delete(`/api/tables/${id}`)
     gettables()
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