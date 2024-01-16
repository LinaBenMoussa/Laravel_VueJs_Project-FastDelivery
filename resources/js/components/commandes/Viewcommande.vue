<template>
    <Addcommandetable/>

 <div class="card">
     <DataTable :value="commandesFiltrees" stripedRows  paginator :rows="5" :rowsPerPageOptions="[5, 10, 20, 50]"  showGridlines  dataKey="id" :loading="isLoading">
         
         <Column field="id" header="" sortable></Column>
         <Column field="email" header="email"  sortable ></Column>
         <Column field="phone" header="phone"  sortable ></Column>
         <Column field="address" header="Adresse"  sortable ></Column>

         <Column field="id" header="Actions" style="min-width: 12rem">
     <template #body="val">
     
         <div class="d-flex">
     <Cardcommande :foods="val.data"/>
      
     <Editcommandetable  :commande="val.data" />
     <button type="button" class="btn btn-warning rounded-circle " @click="deletecommande(val.data.panier)">
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
import Editcommandetable from './Editcommande.vue';
import Addcommandetable from './Addcommande.vue';
import Cardcommande from './Cardcommande.vue';
const commandes=ref([])
const commandesFiltrees=ref([])

const isLoading=ref(true)
const getcommandes=async()=>{
await api.get("/api/commandes")
.then(res=>{
    commandes.value=res.data
 isLoading.value=false
 
})
.catch(error=>{
 console.log(error)
})
getcommandesfiltrer();
}

const getcommandesfiltrer = () => {
    const paniersExistants = new Set();
    commandes.value.forEach(c => {
        console.log("commande", c);
        if (!paniersExistants.has(c.panier)) {
            paniersExistants.add(c.panier);
           return commandesFiltrees.value.push(c);
        }
    });
    isLoading.value=false
    console.log("here",commandesFiltrees.value);

    console.log(commandesFiltrees.value);
    // Vous pouvez retourner commandesFiltrees si nécessaire
};


onMounted(() => {
 getcommandes();
});


const deletecommande=async(cmd)=>{
if (window.confirm("Etes-vous sûr de vouloir supprimer ?")) {
 try {
     await api.delete(`/api/commandes/${cmd}`)
     getcommandes();

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