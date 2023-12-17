<template>
  <div class="soundbox">
    <h1 class="animal-name">{{ animal.nom }}</h1>
    <button class="boutonSoundbox jouer" @click="jouerBruit">Jouer le bruit</button>
    <div>
      <button class="boutonSoundbox changer" @click="rafraichirPage">Changer</button>
    </div>
    <h1 class="introduction">Amusez-vous avec les cris des animaux !</h1>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const animaux = [
  { nom: 'Lion', bruit: 'lion.mp3' },
  { nom: 'Tigre', bruit: 'tigre.mp3' },
  { nom: 'Éléphant', bruit: 'elephant.wav' },
  { nom: 'Grenouille', bruit: 'grenouille.wav' },
  { nom: 'Oiseau', bruit: 'oiseau.wav' },
  { nom: 'Chien', bruit: 'chien.wav' },
  { nom: 'Chat', bruit: 'chat.wav' },
  { nom: 'Vache', bruit: 'vache.wav' },
  { nom: 'Cheval', bruit: 'cheval.wav' }
];

function jouerBruitAnimal(bruit) {
  const audio = new Audio(`./public/cris/${bruit}`);
  audio.play();
}

function genererAnimalAleatoire() {
  const animalAleatoire = animaux[Math.floor(Math.random() * animaux.length)];
  return animalAleatoire;
}

const animal = ref(genererAnimalAleatoire());

function jouerBruit() {
  jouerBruitAnimal(animal.value.bruit);
}

function rafraichirPage() {
  location.reload();
}
</script>

<style>
.soundbox {
  max-width: 400px;
  margin: 0 auto;
  padding: 40px;
  text-align: center;
}

.animal-name {
  font-size: 48px;
  margin-bottom: 40px;
  color: #333;
}

button {
  padding: 20px 40px;
  font-size: 24px;
  font-weight: bold;
  background-color: #4CAF50;
  color: #fff;
  border: none;
  border-radius: 10px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button:hover {
  background-color: #45a049;
}

button.jouer {
  margin-top: 50px;
}

button.changer {
  margin-top: 20px;
  background-color: #ccc;
  color: #333;
}

button.changer:hover {
  background-color: #aaa;
}

.introduction {
  font-size: 28px;
  margin-top: 50px;
  color: #555;
}
</style>
