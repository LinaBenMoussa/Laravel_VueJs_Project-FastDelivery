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
                <img alt="user header" :src="food.image"  width="250" height="250"/>
            </template>
            <template #title> {{ food.description }} </template>
            <template #subtitle> Prix : {{food.price}} DL</template>
            
            
        </Card>
    </Dialog>
    </div>

</template>

<script setup>
import Card from 'primevue/card';
import { ref,onMounted } from "vue"
import Dialog from 'primevue/dialog';
const props=defineProps(['food'])
const visible = ref(false);
const food=ref({})
   
onMounted(() => {
  food.value=props.food
           }
);
</script>

<style lang="scss" scoped>

</style>