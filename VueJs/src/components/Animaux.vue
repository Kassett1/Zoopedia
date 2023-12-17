<template>
  <div v-if="estCharge && images">
    <button @click="etatFiltres()" class="bouton-filtres">Filtres</button>
    <div :class="classeFiltres" class="conteneur-filtres">
      <ul>
        <li class="filtre-categorie">Catégorie</li>
        <button v-for="(categorie) in categories" :key="categorie.id" class="bouton-filtres"
          @click="changeFiltre(categorie.nom)">
          {{ categorie.nom }}</button>
        <li class="filtre-habitat">Habitat</li>
        <button v-for="(habitat) in habitats" :key="habitat.id" class="bouton-filtres"
          @click="changeFiltre(habitat.nom)">{{
            habitat.nom }}</button>
        <li></li>
        <button class="filtre-categorie" @click="changeFiltre(null)">Réinitialiser</button>
      </ul>
    </div>
    <div class="conteneur-recherche">
      <input type="text" v-model="recherche" @keydown="handleKeyPress" placeholder="Rechercher..."
        class="input-recherche">
    </div>
    <div v-if="filtreChoisi == null">
      <ul class="liste-animaux">
        <li v-for="(animal) in animals" :key="animal.id" class="animal">
          <router-link :to="{ name: 'animal', params: { nom: animal.nom } }" class="lien-animal">
            <figure class="figure-animal">
              <img :src="getAnimalImage(animal.image)" :alt="animal.nom" class="image-animal">
              <figcaption class="nom-animal">{{ animal.nom }}</figcaption>
            </figure>
          </router-link>
        </li>
      </ul>
    </div>
    <div v-else>
      <ul class="liste-animaux">
        <li v-for="(animal) in animauxFiltres" :key="animal.id" class="animal">
          <div v-if="compareCategorie(animal.categorie, filtreChoisi) || compareHabitat(animal.habitat, filtreChoisi)"
            class="filtre-animal">
            <router-link :to="{ name: 'animal', params: { nom: animal.nom } }" class="lien-animal">
              <figure class="figure-animal">
                <img :src="getAnimalImage(animal.image)" :alt="animal.nom" class="image-animal">
                <figcaption class="nom-animal">{{ animal.nom }}</figcaption>
              </figure>
            </router-link>
          </div>
        </li>
      </ul>
    </div>
  </div>
  <h2 v-else class="message-attente">Veuillez patienter...</h2>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import { useDefaultStore } from '../stores/index'
import { useRouter } from 'vue-router';
import axios from 'axios';

const router = useRouter();
const store = useDefaultStore();

onMounted(() => {
  store.chargeAnimaux();
  store.chargeCategories();
  store.chargeHabitats();
  fetchImages()
});

const animals = computed(() => store.animals);
const estCharge = computed(() => animals.value.length > 0);
const categories = computed(() => store.categories);
const habitats = computed(() => store.habitats);

const classeFiltres = ref("filtresInvisibles");

function etatFiltres() {
  if (classeFiltres.value == "filtresInvisibles") {
    classeFiltres.value = "filtresVisibles";
  } else {
    classeFiltres.value = "filtresInvisibles";
  }
}

const filtreChoisi = ref(null);

const animauxFiltres = ref([])

function changeFiltre(filtre) {
  filtreChoisi.value = filtre;
  if (filtreChoisi.value != null) {
    animauxFiltres.value = [];
    animals.value.forEach((animal) => {
      if (compareCategorie(animal.categorie, filtre) || compareHabitat(animal.habitat, filtre)) {
        animauxFiltres.value.push(animal);
      }
    });
  }
}

const recherche = ref('');

function effectuerRecherche() {
  const animalRecherche = recherche.value;
  const animalRechercheMajuscule = animalRecherche.charAt(0).toUpperCase() + animalRecherche.slice(1);
  router.push({ name: 'animal', params: { nom: animalRechercheMajuscule } });
}

function handleKeyPress(event) {
  if (event.keyCode === 13) {
    effectuerRecherche();
  }
}

function compareCategorie(categorie, filtre) {
  const categorieId = parseInt(getCategorieId(categorie)) - 1;
  if (categorieId >= 0 && categorieId < categories.value.length) {
    return categories.value[categorieId].nom == filtre;
  }
}

function compareHabitat(habitat, filtre) {
  const habitatId = parseInt(getHabitatId(habitat)) - 1;
  if (habitatId >= 0 && habitatId < habitats.value.length) {
    return habitats.value[habitatId].nom == filtre;
  }
}

function getCategorieId(categorie) {
  const matches = categorie.match(/\/api\/categories\/(\d+)/);
  if (matches && matches.length === 2) {
    return matches[1];
  }
  return null;
}

function getHabitatId(habitat) {
  const matches = habitat.match(/\/api\/habitats\/(\d+)/);
  if (matches && matches.length === 2) {
    return matches[1];
  }
  return null;
}

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
.bouton-filtres {
  font-size: 1rem;
  background-color: #F9A825;
  color: #FFF;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
  margin-top: 1%;
  margin-left: 1%;
}

.bouton-filtres:hover {
  background-color: #E65100;
}

.conteneur-filtres {
  margin-bottom: 20px;
  transition: max-height 0.3s;
  overflow: hidden;
  display: flex;
  justify-content: center;
}

.filtresInvisibles {
  max-height: 0;
}

.filtresVisibles {
  max-height: 500px;
}

.filtre-categorie {
  font-size: 1rem;
  font-weight: bold;
  cursor: pointer;
  transition: color 0.3s;
}

.filtre-categorie:hover {
  color: #E65100;
}

.categorie {
  font-size: 1rem;
  cursor: pointer;
  transition: color 0.3s;
}

.categorie:hover {
  color: #E65100;
}

.filtre-habitat {
  font-size: 1rem;
  font-weight: bold;
  margin-top: 10px;
  cursor: pointer;
  transition: color 0.3s;
}

.filtre-habitat:hover {
  color: #E65100;
}

.habitat {
  font-size: 1rem;
  cursor: pointer;
  transition: color 0.3s;
}

.habitat:hover {
  color: #E65100;
}

.conteneur-recherche {
  margin-bottom: 20px;
}

.input-recherche {
  font-size: 1rem;
  padding: 10px;
  border: 1px solid #DDD;
  border-radius: 5px;
  width: 100%;
  box-sizing: border-box;
  transition: border-color 0.3s;
}

.input-recherche:focus {
  outline: none;
  border-color: #F9A825;
}

.liste-animaux {
  list-style-type: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  align-items: flex-start;
}

.animal {
  margin: 10px;
  text-align: center;
  transition: transform 0.3s;
}

.animal:hover {
  transform: scale(1.05);
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
  transition: transform 0.3s;
}

.image-animal {
  width: 100%;
  height: 100%;
  object-fit: cover;
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

.message-attente {
  font-size: 1.8rem;
  color: #333;
  text-align: center;
  margin: 20px 0;
}


</style>
