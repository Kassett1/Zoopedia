<template>
  <div class="animal-page" v-if="estCharge && images">
    <div v-if="infosAnimal">
      <h1 class="animal-name">{{ nomAnimal }}</h1>
      <figure class="imageAnimal">
        <img :src="getAnimalImage(infosAnimal.image)" :alt="infosAnimal.nom" class="image-animal">
        <figcaption class="nom-animal">{{ infosAnimal.nom }}</figcaption>
      </figure>
      <div class="infos">
        <h2 class="animal-info">{{ infosAnimal.description }}</h2>
        <h2 class="animal-info">Habitat: {{ habitat.nom }}</h2>
        <h2 class="animal-info">Régime alimentaire: {{ regime.nom }}</h2>
        <h2 class="animal-info">Catégorie: {{ categorie.nom }}</h2>
      </div>
    </div>
    <h1 v-else class="error-message">Cet animal n'existe pas</h1>
  </div>
  <h2 v-else class="loading-message">Veuillez patienter...</h2>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import { useRoute } from 'vue-router'
import { useDefaultStore } from '../stores/index'
import Axios from 'axios';
import { watch } from 'vue';

const store = useDefaultStore();

onMounted(() => {
  store.chargeAnimaux();
  fetchImages()
});

const animals = computed(() => store.animals);
const estCharge = computed(() => animals.value.length > 0);

const route = useRoute();
const nomAnimal = ref(route.params.nom);

const infosAnimal = computed(() => {
  if (animals.value) {
    return animals.value.find(animal => animal.nom === nomAnimal.value) || null;
  }
  return null;
});

// Variables pour stocker les noms réels des informations de l'animal
const habitat = ref(0);
const regime = ref(0);
const categorie = ref(0);




watch(infosAnimal, (newInfosAnimal) => {
  if (newInfosAnimal !== null) {
    Axios.get("http://localhost:8000" + newInfosAnimal.habitat)
      .then(response => {
        habitat.value = response.data;
      })
      .catch(error => {
        console.log(error);
      });


    Axios.get("http://localhost:8000" + newInfosAnimal.categorie)
      .then(response => {
        categorie.value = response.data;
      })
      .catch(error => {
        console.log(error);
      });

      Axios.get("http://localhost:8000" + newInfosAnimal.regime)
      .then(response => {
        regime.value = response.data;
      })
      .catch(error => {
        console.log(error);
      });



  }
});


function getHabitatId(habitat) {
  if (typeof habitat === 'string') {
    const segments = habitat.split("/");
    if (segments.length >= 4) {
      return `/${segments[2]}/${segments[3]}`;
    }
  }
  return null;
}

function getRegimeId(regime) {
  if (typeof regime === 'string') {
    const segments = regime.split("/");
    if (segments.length >= 4) {
      const regimeId = segments[3];
      return `/regime/${regimeId}`;
    }
  }
  return null;
}


function getCategorieId(categorie) {
  if (typeof categorie === 'string') {
    const segments = categorie.split("/");
    if (segments.length >= 4) {
      return `/${segments[2]}/${segments[3]}`;
    }
  }
  return null;
}


const images = ref(null);

function fetchImages() {
  return Axios.get('http://127.0.0.1:8000/api/images')
    .then(response => {
      images.value = response.data; 
    })
    .catch(error => {
      console.log(error);
      images.value = []; 
    });
}



function getAnimalImage(animalName) {
  if (images.value && images.value.images && images.value.images.length > 0) {
    for (const image of images.value.images) {
      if (image.name === animalName) {
        const imageDataUrl = "data:image/png;base64," + image.data;
        return imageDataUrl;
      }
    }
  }
  return null;
}

</script>


<style>
.animal-page {
  max-width: 600px;
  margin: 0 auto;
  padding: 40px;
  text-align: center;
}

.animal-name {
  font-size: 48px;
  margin-bottom: 10px;
  color: #333;
}

.animal-info {
  font-size: 24px;
  color: #555;
}

.error-message {
  font-size: 36px;
  color: #ff0000;
}

.loading-message {
  font-size: 24px;
  color: #555;
  margin-top: 10px;
}

.infosAnimal {
  display: flex;
}

.figure-animal {
  width: 200px;
  height: 200px;
  margin: 0;
  overflow: hidden;
  border-radius: 10px;
  transition: transform 0.3s;
}
</style>
