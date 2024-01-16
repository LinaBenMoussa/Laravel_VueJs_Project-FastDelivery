<template>
    <form @submit.prevent="handleSubmit">
    <div class="card" style="width: 50rem;">
     <div class="card-body">
      <h5 class="card-title">Montant à payer : {{amount}} TL</h5>
      <br/>
      <div class="card-text">
        <div class="form-group">
          <input v-model="email" type="email" class="form-control" placeholder="email" />
       </div>
       <br/>
      </div>
      <div id="card-element"></div>
      <br/>
      <button type="submit" class="btn btn-success">Procéder au payement</button>
    </div>
   </div>
   </form>
  </template>
  
  <script setup>
  import { onMounted, ref } from 'vue';
  import { loadStripe } from '@stripe/stripe-js';
  import store from '../../store'
  
  import api from "../config/api.js";
  
  import { useRouter } from 'vue-router';
  import { v4 as uuidv4 } from 'uuid';
  
  const router = useRouter();
  const panierNumber = uuidv4();
  const stripePromise = loadStripe('pk_test_51ORyu3IlM2uMduSNOf47gF3KNdEYl9u5QBqQTh1iDH4BUXo4WLgUbKTKK0TQDFaEcKdxWngj1A8MpuqTQq5mgjkw00umx6PHz7');
  const stripe = ref(null);
  let cardElement; // Déclarer cardElement comme variable globale
  let amount=ref(0);
  
  const email = ref(localStorage.getItem("email") || '');;
  
  onMounted(async () => {
  
    amount.value=store.state.Foodstore.cartTotal;
  
    stripe.value = await stripePromise;
    const elements = stripe.value.elements();
  
    cardElement = elements.create('card'); // Affecter cardElement
    cardElement.mount('#card-element');
  });
  
  const handleSubmit = async () => {
    const { token, error } = await stripe.value.createToken(cardElement);
  
    if (error) {
      console.error(error);
    } else {
     
      // Envoie le token au serveur pour traiter le paiement
      const response = await api.post('/api/createpayment', {
        token: token.id,
        amount: amount.value * 100// Convertir le montant en cents 
        
      });
  
      if (response.data.message) {
        addcommandes()
        console.log(response.data.message);
        // Le paiement est réussi
        alert(response.data.message);
        //Vider le cart
        
        store.commit('Foodstore/clearCart')
        //Redirection
        router.push('/shopping')
      } else {
        console.error(response.data.error);
      }
    }
  
  };
  const addcommandes=async()=>{
    console.log("avant for")
    for(let c of store.state.Foodstore.cart){

      
      let productid=c.product.id
      let qty=c.qty
      console.log("dans for",c.qty)
      console.log("apres for :",{
        food_id:productid,
        qty:qty,
        email:localStorage.getItem('email'),
        phone:localStorage.getItem('phone'),
        address:localStorage.getItem('address'),
        panier: panierNumber,
      })
      await api.post('/api/commandes', {
        food_id:productid,
        qty:qty,
        email:localStorage.getItem('email'),
        phone:localStorage.getItem('phone'),
        address:localStorage.getItem('address'),
        panier: panierNumber,
      });
          }
  }
  </script>
  
  