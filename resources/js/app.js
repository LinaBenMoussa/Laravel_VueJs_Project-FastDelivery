import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from "vue-router";
import { routes } from "./routes";
import 'bootswatch/dist/United/bootstrap.min.css';
import "@fortawesome/fontawesome-free/css/all.css";
import store from "./store"
import App from './App.vue'
import PrimeVue from 'primevue/config';
import 'primevue/resources/themes/lara-light-green/theme.css'
let app = createApp(App)
const router = createRouter({
history: createWebHashHistory(),
routes: routes,
})
app.use(store)
app.use(router).use(PrimeVue);
app.use(router);
app.mount("#app")