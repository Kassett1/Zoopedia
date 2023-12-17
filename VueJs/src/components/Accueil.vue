<template>
  <div v-if="estCharge && images" class="contenu">
    <section class="section-presentation">
      <h1 class="titre-page">Accueil</h1>
      <ul class="liste-animaux">
        <li v-for="animal in animauxAleatoires" :key="animal.id" class="animal">
          <router-link :to="{ name: 'animal', params: { nom: animal.nom } }" class="lien-animal">
            <figure class="figure-animal">
              <img :src="getAnimalImage(animal.image)" :alt="animal.nom" class="image-animal">
              <figcaption class="nom-animal">{{ animal.nom }}</figcaption>
            </figure>
          </router-link>
        </li>
      </ul>
      <div class="container">
        <h2 class="titre-section">Bienvenue sur mon site !</h2>
        <p class="description">Bienvenue sur mon site de présentation des animaux. Ce projet a été réalisé dans le cadre de ma deuxième année de licence informatique. 
          Mon objectif est de vous faire découvrir et en apprendre davantage sur la diversité des animaux qui peuplent notre planète.</p>
      </div>
    </section>
  </div>
  <h2 v-else class="message-attente">Veuillez patienter...</h2>
</template>

<script setup>
import { onMounted, computed, ref } from 'vue'
import { useDefaultStore } from '../stores/index'
import axios from 'axios';

const store = useDefaultStore();

onMounted(() => {
  store.chargeAnimaux();
  fetchImages()
});

const animauxAleatoires = computed(() => {
  if (store.animals.length > 0) {
    const animauxCopie = [...store.animals];
    return animauxCopie.sort(() => Math.random() - 0.5).slice(0, 5);
  } else {
    return [];
  }
});

const estCharge = computed(() => animauxAleatoires.value.length > 0);

const images = ref(null);

function fetchImages() {
  return axios.get('http://127.0.0.1:8000/api/images')
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
.titre-page {
  font-size: 2.5rem;
  color: #F9A825;
  text-align: center;
  margin-bottom: 30px;
}

.contenu {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
  padding: 0;
  margin: 0;
}

.liste-animaux {
  list-style-type: none;
}

.animal {
  margin: 10px;
  text-align: center;
}

.lien-animal {
  display: block;
  text-decoration: none;
}

.figure-animal {
  width: 200px;
  height: 200px;
  margin: 0;
  overflow: hidden;
  border-radius: 10px;
}

.image-animal {
  width: 100%;
  height: 100%;
  object-fit: cover;
  transition: transform 0.3s;
}

.nom-animal {
  display: none;
  font-size: 1rem;
  color: #333;
  text-align: center;
  margin-top: 10px;
}

.animal:hover .nom-animal {
  display: block;
}

.animal:hover .image-animal {
  transform: scale(1.1);
}

.message-attente {
  font-size: 1.8rem;
  color: #333;
  text-align: center;
  margin: 20px 0;
}

.section-presentation {
  padding: 50px 0;
}

.container {
  max-width: 800px;
  margin: 0 auto;
  text-align: center;
}

.titre-section {
  font-size: 2rem;
  color: #333;
  margin-bottom: 20px;
}

.description {
  font-size: 1.2rem;
  color: #666;
  margin-bottom: 30px;
}
</style>
