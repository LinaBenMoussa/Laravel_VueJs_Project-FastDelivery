<template>
    <Addmenutable/>

 <div class="card">
     <DataTable :value="menus" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
         <Column header="Image">
           <template #body="{ data }" >
              <img :src="data.image" :alt=data.name  class="shadow-4" width="65"/> 
           </template>
         </Column>
         <Column field="name" header="Nom" sortable></Column>
         <Column field="description" header="Description"  sortable ></Column>
         <Column field="id" header="Actions" style="min-width: 12rem">
     <template #body="val">
     
         <div class="d-flex">
     <Cardmenu :menu="val.data"/>
      
     <Editmenutable  :menu="val.data" />
     <button type="button" class="btn btn-warning rounded-circle " @click="deletemenu(val.data.id)">
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
import Editmenutable from './Editmenu.vue';
import Addmenutable from './Addmenu.vue';
import Cardmenu from './Cardmenu.vue';
const menus=ref([])
const isLoading=ref(true)
const getmenus=async()=>{
await api.get("/api/menus")
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


const deletemenu=async(id)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
 try {
     await api.delete(`/api/menus/${id}`)
     getmenus()
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