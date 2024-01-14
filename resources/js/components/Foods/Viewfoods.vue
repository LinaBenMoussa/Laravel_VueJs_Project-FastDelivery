<template>
       <Addfoodtable/>

    <div class="card">
        <DataTable :value="foods" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
            <Column header="Image">
              <template #body="{ data }" >
                 <img :src="data.image" :alt=data.name  class="shadow-4" width="65"/> 
              </template>
            </Column>
            <Column field="name" header="Nom" sortable></Column>
            <Column field="description" header="Description"  sortable ></Column>
            <Column field="price" header="Prix"  sortable ></Column>
            <Column field="id" header="Actions" style="min-width: 12rem">
        <template #body="val">
        
            <div class="d-flex">
        <Cardfood :food="val.data"/>
         
        <Editfoodtable  :food="val.data" />
        <button type="button" class="btn btn-warning rounded-circle " @click="deletefood(val.data.id)">
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
import Editfoodtable from './Editfood.vue';
import Addfoodtable from './Addfood.vue';
import Cardfood from './Cardfood.vue';
const foods=ref([])
const isLoading=ref(true)
const getfoods=async()=>{
await api.get("/api/foods")
.then(res=>{
    foods.value=res.data
    isLoading.value=false
    
})
.catch(error=>{
    console.log(error)
})
}

onMounted(() => {
    getfoods();
});


const deletefood=async(id)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
    try {
        await api.delete(`/api/foods/${id}`)
        getfoods()
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