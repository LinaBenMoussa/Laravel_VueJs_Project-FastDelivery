<template>
     
    <button type="button" class="btn btn-warning rounded-circle "  @click="visible = true">
       <span style="color: rgb(233, 240, 241)">
        <i class="fa-solid fa-pen-to-square"></i>
      
       </span>
  
   </button>    
  <form >
   <div class="card flex justify-content-center">
      <Dialog
         v-model:visible="visible"   
     >
   <div class="row">
   <div class="col-md-6">
       <label for="name" class="form-label">Nom</label>
   <input type="text" class="form-control" id="name" v-model="menu.name">
  
   </div>
   <div class="col-md-6 ms-auto">
       <label for="description" class="form-label">Description</label>
   <input type="texte" class="form-control" id="description" v-model="menu.description">
  
   </div>
  </div>
               
  
  <div class="row">
   
   <div class="col-md-6 ms-auto">
       <label for="restaurant" class="form-label">restaurant</label>
       <select class="form-control" v-model="menu.restaurant_id">
         <option v-for="sc in restaurant" :key="sc.id" :value=sc.id>{{sc.name}}</option>
      </select>  
  
  
   </div>
  </div>
  <div class="row">
   <file-pond
  name="test"
  ref="pond"
  class-name="my-pond"
  label-idle="Drop files here..."
  allow-multiple="false"
  accepted-file-types="image/jpeg, image/png"
  v-bind:files="myFiles"
  v-on:init="handleFilePondInit"
  :server="serverOptions()"
  />
  </div>
  <br/>
  <button type="submit" className="btn btn-outline-primary" @click="modifierproduit">
   <i class="fa-solid fa-floppy-disk"></i>Enregister
           </button>
           <button type="button" className="btn btn-outline-primary" @click="cancel">
   <i class="fa-solid fa-floppy-disk"></i>cancel
           </button>
  </Dialog>
   </div>
  </form>        
  </template>
  
  <script setup>
  import api from '../config/api.js';
  import { ref,onMounted } from "vue"
  import vueFilePond from 'vue-filepond';
  import 'filepond/dist/filepond.min.css';
  import Dialog from 'primevue/dialog';
  import FilePondPluginImagePreview from 'filepond-plugin-image-preview';
  import 'filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css';
  // Create FilePond component
  const FilePond = vueFilePond(FilePondPluginImagePreview);
  const myFiles = ref([]);
  import axios from 'axios';
  const props=defineProps(['menu'])
  const visible = ref(false);
  const menu=ref({})
  
  const restaurant = ref([]);
  const getrestaurant=async()=>{     
         await api.get('/api/restaurants').then(res => {
             restaurant.value = res.data;
                 }).catch(error => {
                     console.log(error)
                 });
     
              }
  const handleFilePondInit = async() => {
     if (menu.value.image) {
     
       myFiles.value = [
     {
       source: menu.value.image,
       options: { type: 'local' }
     }
     ]
    }
     }
   
  const loadmenu=()=>{
   
    menu.value=props.menu
  }
  onMounted(() => {
   getrestaurant();
   loadmenu()
   
           }
  );
  
  const  modifierproduit=()=>{
     api.put(`/api/menus/${menu.value.id}`,menu.value)
          .then(() => {
            visible.value=false
          })  
          .catch(error => {
             console.error("There was an error!", error);})
  }
  
  const cancel=()=>{
   visible.value=false
           
  }
  const serverOptions = () => { console.log('server pond');
  return {
    load: (source, load, error, progress, abort, headers) => {
                    var myRequest = new Request(source);
                    fetch(myRequest).then(function(response) {
                      response.blob().then(function(myBlob) {
                        load(myBlob);
                      });
                    });
                  },
  process: (fieldName, file, metadata, load, error, progress, abort) => {
  const data = new FormData();
  data.append('file', file);
  data.append('upload_preset', 'Fast_Delivery');
  data.append('cloud_name', 'dqhwmpfm6');
  data.append('public_id', file.name);
  axios.post('https://api.cloudinary.com/v1_1/dqhwmpfm6/upload',data)
  .then((response) => response.data)
  .then((data) => {
  console.log(data);
  
  menu.value.image = data.url;
  load(data);
  })
  .catch((error) => {
  console.error('Error uploading file:', error);
  error('Upload failed');
  abort();
  });
  },
  };
  };
  
  
  </script>
  <style scoped>
  
  </style>