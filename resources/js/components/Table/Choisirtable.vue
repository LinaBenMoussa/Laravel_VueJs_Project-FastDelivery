<template>
  <button type="button" class="btn btn-warning rounded-circle " @click="visible = true">
    <span style="color: rgb(233, 240, 241)">
      Réserver Table
    </span>
  </button>

  <form>
    <Dialog v-model:visible="visible" modal header="Réservation de Table" :style="{ width: '50rem' }" :breakpoints="{ '1199px': '75vw', '575px': '90vw' }">
  <div class="card flex justify-content-center">
    <div class="row">
      <!-- Colonne pour le calendrier -->
      <div class="col-md-6">
        <Calendar v-model="reservation.date" inline showWeek @date-select="date => handleDateClick(date)" />
      </div>

      <!-- Colonne pour les champs -->
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-12">
            <label for="reservation_time" class="form-label">Heure de Réservation</label>
      <!-- Utilisez une liste déroulante pour afficher les heures disponibles -->
      <select class="form-control" id="reservation_time" v-model="reservation.time" >
        <!-- Boucle à travers les heures disponibles -->
        <option v-for="hour in availableHoursNew" :key="hour" :value="hour">{{ hour }} </option>
      </select>
    </div>
        </div>
<br><br>
        <div class="row">
          <div class="col-md-12">
            <label for="table" class="form-label">Nombre de personnes</label>
            <input type="number" class="form-control" disabled="true" id="num_personnes" @input="getIdTable()" >

          </div>
        </div><br>
        <div class="row"><br>
          <div class="col-md-12">
            <button type="submit" class="btn btn-outline-primary" @click="reserveTable()">
       Réserver
    </button>
    
          </div>
        </div><br>
        <div class="row"><br><br><br>
          <div class="col-md-12">
            <button type="button" class="btn btn-outline-primary" @click="cancel">
      Annuler
    </button>
    
          </div>
        </div>
      </div>
    </div>

    <br/>

    
  </div>
</Dialog>

  </form>
</template>

<script setup>
import Calendar from 'primevue/calendar';

import { ref, onMounted } from "vue";
import api from '../config/api.js';
import Dialog from 'primevue/dialog';


const visible = ref(false);
const props = defineProps(['restaurantid']);
const reservation = ref({
  date: null,
  time: null,
  table_id: null,
  numpersonnes: null,
  restaurant_id: props.restaurantid,
  email: localStorage.getItem('user'),
  secretCode:null,
});
const availableHoursNew = ref([]);
const availableHours = [
'08:00:00', '08:30:00', '09:00:00', '09:30:00', '10:00:00', '10:30:00', '11:00:00', '11:30:00',
      '12:00:00', '12:30:00', '13:00:00', '13:30:00', '14:00:00', '14:30:00', '15:00:00', '15:30:00',
      '16:00:00', '16:30:00', '17:00:00', '17:30:00', '18:00:00', '18:30:00', '19:00:00', '19:30:00', '20:00:00'
    ];
const restaurantReservations = ref([]);
const tables = ref([]);
const gettables=async()=>{
  await api.get(`/api/tablesbyrestaurant/${props.restaurantid}`)
.then(res=>{
    tables.value=res.data
 
})
.catch(error=>{
 console.log(error)
})
}
const idtables = ref([]);
const times=ref([{
  heures:[],
  idTable:null,
}])
const getIdTable = () => {
  
  availableHoursNew.value = []
  times.value = [{
  heures: [],
  idTable: null,
}];
  // enregistrer num_personnes
  const numPersonnesInput = document.getElementById("num_personnes");
  // if (numPersonnesInput) {
    const numPersonnesValue = numPersonnesInput.value;
    console.log("Nombre de personnes:", numPersonnesValue);
    reservation.value.numpersonnes = parseInt(numPersonnesValue);
  // }
console.log("nmbre personne ca marche")
// **** remplir idTables
idtables.value = tables.value
    .filter(table => table.seating_capacity >= numPersonnesValue)
    .map(table => table.id); 
// *********
 
if (idtables.value.length > 0) {
  for (const id of idtables.value) { 
    // Pour chaque id de table, vérifiez les heures non disponibles dans la liste des réservations
    const reservedHoursForTable = [];

    for (const res of restaurantReservations.value) {
      console.log("tableei id",res.table_id)
      console.log("res.date",res.date)
      console.log(reservation.value.date)
      

      if (res.table_id === id && res.date === reservation.value.date) {
        reservedHoursForTable.push(res.time);
      }
    }console.log("les dates reserves pour les tables",reservedHoursForTable)

    // Filtrer les heures disponibles en retirant celles qui sont réservées
    const availableHoursForTable = availableHours.filter(hour => !reservedHoursForTable.includes(hour));
    // Enregistrez les heures disponibles avec l'id de la table correspondante
    times.value.push({
      idTable: id,
      heures: availableHoursForTable
    
    });
    

  }console.log("times value",times.value);
}
getavailablehours()
  console.log(reservation.num_personnes)
};
const getReservationsByRestaurantId = async () => {
      try {
        const response = await api.get(`/api/reseravationsbyrestaurant/${props.restaurantid}`);
        restaurantReservations.value = response.data;
      } catch (error) {
        console.error("Erreur lors de la récupération des réservations par restaurant_id", error);
      }
    };
const handleDateClick = (event) => {
  availableHoursNew.value = []
  times.value = [{
  heures: [],
  idTable: null,
}];
      document.getElementById("num_personnes").disabled = false;

      console.log("ca marche ****")
      const formattedDate = `${event.getFullYear()}-${(event.getMonth() + 1 < 10 ? '0' : '') + (event.getMonth() + 1)}-${(event.getDate() < 10 ? '0' : '') + event.getDate()}`;

  reservation.value.date = formattedDate;
  console.log("formatted",reservation.date);
  
};
const getavailablehours = () => {
  times.value.forEach(t => { 
    t.heures.forEach(h=>{
    console.log("h",h);
       if (!availableHoursNew.value.includes(h)) {
        availableHoursNew.value.push(h.split(':').slice(0, 2).join(':'));}})
    
  });
  console.log("formatted",reservation.date);

  reservation.restaurant_id=props.restaurantid;

}
const reserveTable=async()=>{
  const reservation_timeInput = document.getElementById("reservation_time");
  if (reservation_timeInput) {
    const reservation_timeValue = reservation_timeInput.value;
    console.log("Nombre de personnes:", reservation_timeValue);
    reservation.value.time = reservation_timeValue;
  }
  
  reservation.value.secretCode = generateSecretCode();
  console.log(reservation.value.secretCode);
  times.value.forEach(t=>{t.heures.forEach(h=>{if((h.split(':').slice(0, 2).join(':'))===reservation.value.time){
    console.log("la condition est fausse")
    reservation.value.table_id=t.idTable}})})
  console.log("reservation",reservation.value)
  await api.post('/api/reservationtable', reservation.value).then(() => {
    window.alert('Réservation confirmée avec succès! Vous pouvez retrouver votre secret code dans la section "Codes Secrets" de la page.');
      visible.value = false;
    })
    .catch(error => {
      console.error('Erreur lors de la réservation :', error);
    });

}
const cancel = () => {
  visible.value = false;
};

onMounted(() => {
  getReservationsByRestaurantId()
  gettables();
  
});
const generateSecretCode = () => {
  const characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
  let secretCode = '';

  for (let i = 0; i < 8; i++) {
    const randomIndex = Math.floor(Math.random() * characters.length);
    secretCode += characters.charAt(randomIndex);
  }

  return secretCode;
};
</script>

