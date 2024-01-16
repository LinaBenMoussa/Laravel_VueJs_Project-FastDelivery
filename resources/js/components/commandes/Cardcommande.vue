<template>
  <button type="button" class="btn btn-warning rounded-circle" @click="visible = true">
    <span style="color: rgba(102, 133, 110, 0.623)">
      <i class="fa-solid fa-eye"></i>
    </span>
  </button>

  <div class="card flex align-items-center justify-content-center">
    <Dialog v-model:visible="visible">
      <OrderList v-model="foods" listStyle="height:auto" dataKey="id">
        <template #header> List of Products </template>
        <template #item="slotProps">
          <div class="flex flex-wrap p-2 align-items-center gap-3">
            <img class="w-4rem shadow-2 flex-shrink-0 border-round" :src="slotProps.item.product.image" :alt="slotProps.item.name" />
            <div class="flex-1 flex flex-column gap-2">
              <span class="font-bold">Food Name : </span>{{ slotProps.item.product.name }}<br>
              <span class="font-bold">Restaurant :</span> {{ slotProps.item.rest }}
              <div class="flex align-items-center gap-2">
                <i class="pi pi-tag text-sm"></i>
                <span class="font-bold text-900">Quantity : </span>{{ slotProps.item.qty }}
              </div>
            </div>
            <span>$ {{ slotProps.item.product.price }}</span>
          </div>
        </template><br><br>
      </OrderList>
    </Dialog>
  </div>
</template>

<script setup>
import OrderList from 'primevue/orderlist';
import Dialog from 'primevue/dialog';
import { ref, onMounted, defineProps } from 'vue';
import api from '../config/api.js';

const props = defineProps(['foods']);
const visible = ref(false);
const foods = ref([]);
const commandes = ref([]);
const isLoading = ref(true);

const getcommandes = async () => {
  try {
    const response = await api.get("/api/commandes");
    commandes.value = response.data;
    isLoading.value = false;
    getfoods(); // Appel à getfoods après avoir récupéré les commandes
  } catch (error) {
    console.error(error);
  }
};

const getfoods = async () => {
  // Réinitialiser la liste foods à chaque appel de getfoods
  foods.value = [];

  // Utiliser Promise.all pour attendre la résolution de toutes les promesses
  await Promise.all(
    commandes.value.map(async (c) => {
      if (c.panier === props.foods.panier) {
        try {
          const res = await api.get("/api/foods/" + c.food_id);
          foods.value.push({ product: res.data, qty: c.qty });
        } catch (error) {
          console.error(error);
        }
      }
    })
  );

  console.log("foods", foods.value);
};

onMounted(() => {
  getcommandes();
});
</script>

<style lang="scss" scoped>
.font-bold {
  color: orangered;
}
</style>
