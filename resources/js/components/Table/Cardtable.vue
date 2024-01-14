<template>
    <button type="button" class="btn btn-warning rounded-circle "  @click="visible = true">
      <span style="color: rgba(102, 133, 110, 0.623)">
       <i class="fa-solid fa-eye"></i>
     
      </span>

  </button>   
  
   <div class="card flex align-items-center justify-content-center">
       <Dialog
        v-model:visible="visible"   
    >
       <Card style="width: 25em">
           <template #header>
               <img alt="user header" src="https://res.cloudinary.com/dqhwmpfm6/image/upload/v1704993535/image/xwgnxbfd2rif2ovutbvn.jpg"  width="250" height="250"/>
           </template>
           <template #title>Numéro de table : {{ table.table_number }} <br> Nombre de places : {{ table.seating_capacity }} </template>
           
       </Card>
   </Dialog>
   </div>

</template>

<script setup>
import Card from 'primevue/card';
import { ref,onMounted } from "vue"
import Dialog from 'primevue/dialog';
const props=defineProps(['table'])
const visible = ref(false);
const table=ref({})
  
onMounted(() => {
 table.value=props.table
          }
);
</script>

<style lang="scss" scoped>

</style>