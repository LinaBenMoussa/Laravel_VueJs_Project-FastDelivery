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
               <img alt="user header" :src="restaurant.logo"  width="250" height="250"/>
           </template>
           <template #title> {{ restaurant.description }} </template>
           <template #subtitle> Phone : {{restaurant.phone}} </template>
           
           
       </Card>
   </Dialog>
   </div>

</template>

<script setup>
import Card from 'primevue/card';
import { ref,onMounted } from "vue"
import Dialog from 'primevue/dialog';
const props=defineProps(['restaurant'])
const visible = ref(false);
const restaurant=ref({})
  
onMounted(() => {
 restaurant.value=props.restaurant
          }
);
</script>

<style lang="scss" scoped>

</style>