import Accueil from './components/accueil.vue';
import Viewfoods from "./components/Foods/Viewfoods.vue";
import Viewtables from "./components/Table/Viewtables.vue";

import Viewrestaurants from "./components/restaurants/Viewrestaurants.vue";
import Viewmenus from "./components/menu/Viewmenus.vue";
import Foodsclient from "./components/Foods/Foodsclient.vue";
import Menusclient from "./components/menu/Menusclient.vue";
import Restaurantsclient from "./components/restaurants/Restaurantsclient.vue";
import Login from './components/authentification/Login.vue'
import Register from './components/authentification/Register.vue'
import HomeCart from './components/cart/HomeCart.vue';
import Cart from './components/cart/Cart.vue';
import Payment from './components/cart/Payment.vue';
import Success from './components/cart/Success.vue';
import Dashboard from './components/admin/dashboard.vue';
import Errorpage from './components/cart/Errorpage.vue'
export const routes = [
    {
        name:"Dashboard",
        path:"/dashboard",
        component:Dashboard
    },
{
    name:"Viewfoods",
    path:"/foods",
    component:Viewfoods
},
{
    name:"Viewtables",
    path:"/tables",
    component:Viewtables
},
{
    name:"Foodsclient",
    path:"/foodsclient/:id",
    component:Foodsclient
},
{
    name:"Menusclient",
    path:"/menusclient/:id",
    component:Menusclient
},
{
    name:"Restaurantsclient",
    path:"/restaurantsclient",
    component:Restaurantsclient
},
{
    name:"Viewrestaurants",
    path:"/restaurants",
    component:Viewrestaurants
},
{
    name:"Viewmenus",
    path:"/menus",
    component:Viewmenus
},
{
    path:'/shopping',
    name:'HomeCart',
    component:HomeCart
},
{
    path:'/cart',
    name:'Cart',
    component:Cart
},
{
    path:'/payment',
    name:'Payment',
    component:Payment
},
{
    path:'/success',
    name:'success',
    component:Success
},
{
    path:'/error',
    name:'Error',
    component:Errorpage
},
{
    name: "login",
    path: "/login",
    component: Login,
   
    },
    {
    name: "register",
    path: "/register",
    component: Register,
   
    },
    {
        name:"Accueil",
        path:"/accueil",
        component:Accueil
    },
];