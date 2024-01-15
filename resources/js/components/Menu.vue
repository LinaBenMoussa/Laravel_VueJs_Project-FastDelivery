<template>
    <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
   <div class="container-fluid">
    <router-link class="navbar-brand"  to="/">FastDelivery </router-link>
     <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
       <span class="navbar-toggler-icon"></span>
     </button>
     <div class="collapse navbar-collapse" id="navbarColor01">
       <ul class="navbar-nav me-auto">
         <li class="nav-item">
             <router-link v-if="isAdmin()" class="nav-link active"  to="/restaurants">Restaurants
            
         </router-link>
           </li>
           <li class="nav-item">
             <router-link v-if="isAdmin()" class="nav-link active"  to="/tables">tables
            
         </router-link>
           </li>
         <li class="nav-item">
           <router-link v-if="isAdmin()" class="nav-link active"  to="/menus">Menus
             </router-link>
         </li>
         
         <li class="nav-item">
           <router-link v-if="isAdmin()" class="nav-link active"  to="/foods">Foods
             </router-link>
         </li>
         <li class="nav-item">
           <router-link v-if="isUser()" to="/shopping" class="nav-item nav-link"> Shopping Cart </router-link>  
         </li>
         
        
         <li class="nav-item">
           <router-link v-if="isUser() || isVisitor()" class="nav-link active"  to="/restaurantsclient">Restaurants
             </router-link>
         </li>
         <li class="nav-item">
           <router-link v-if="isUser()" class="nav-link active"  to="/secretcode">Secret Code
             </router-link>
         </li>
         <li class="nav-item">
  <router-link v-if="isVisitor()" class="nav-link active" to="/login">Login
  </router-link>
  </li>
  <li class="nav-item">
  <router-link v-if="isVisitor()" class="nav-link active" to="/register">Register
  </router-link>
  </li>
  <li v-if="isUser() || isAdmin()" class="nav-item">
  <button  @click="logout">Logout</button>
  </li>
         
       </ul>
       <form class="d-flex">
         <input class="form-control me-sm-2" type="search" placeholder="Search">
         <button class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
       </form>
       <ul v-if="isUser() || isVisitor()" class="navbar-nav ms-auto mb-2 mb-lg-0">
                     <li class="nav-item me-3">
                     <router-link class="nav-link position-relative" :class="$route.name == 'Cart'? 'active':''" aria-current="page" :to="{ name: 'Cart' }">
                       <i class="fa-solid fa-cart-shopping fa-lg" style="color: #ffffff;"></i>
                         
                         <span v-if="$store.state.Foodstore.cart.length > 0" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                         {{ $store.state.Foodstore.cart.length }}
                         </span>
                     </router-link>
     </li>
     <li class="nav-item">
  <span class="nav-link active">Bonjour, {{ getUsername() }}</span>
</li>
 </ul>
 
     </div>
   </div>
 </nav>
 </template>
 
 <script setup>
  import store from '../store'

 import axios from 'axios';
 import { useRouter } from 'vue-router';
 const router = useRouter();
 const logout=async()=> {
 let token=""
  token=localStorage.getItem('token')
  console.log(token)
  axios.post('http://localhost:8000/api/logout', null, {
  headers: {
  'Authorization': `Bearer ${token}`
  }
 })
  .then((response) => {
  console.log(response)
  localStorage.removeItem('token')
  localStorage.removeItem('user')
  localStorage.removeItem('role')
  clearCart()
  router.push("/login")
  })
  .catch(err => {console.log(err);alert(err) })
  }
 
  const getUsername = () => {
  const username = localStorage.getItem('user');
  return username ? username : '';
};
const isAdmin = () => {
    const role = localStorage.getItem('role');
    return role === 'admin';}
const isUser= () => {
    const role = localStorage.getItem('role');
    console.log(role)
    return role === 'user';}
    const isVisitor= () => {
    const user = localStorage.getItem('user');
    console.log("new",user)
    return user === null;}
    const   clearCart=()=> { 
        store.commit("Foodstore/clearCart");
       }
 </script>
 
 