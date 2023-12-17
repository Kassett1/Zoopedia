
<template>
  <header>
      <h1>Zoopedia</h1>
      <nav>
        <li><router-link :to="{ name: 'homepage' }">Accueil</router-link></li>
        <li><router-link :to="{ name: 'animaux' }">Animaux</router-link></li>
        <li><router-link :to="{ name: 'quiz' }">Quiz</router-link></li>
        <li><router-link :to="{ name: 'soundbox' }">Soundbox</router-link></li>
        <li><a href="http://127.0.0.1:8000/ajouter/animal">Ajouter</a></li>
      </nav>
  </header>
</template>

<script setup>



</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

body {
  margin: 0;
}

header {
  display: flex;
  justify-content: space-around;
  align-items: center;
  padding: 0 8%;
  background-color: #1b79e6; /* Couleur de fond de l'en-tête */
  font-size: 1.2rem; /* Légère augmentation de la taille du header */
}

header h1 {
  margin-right: 15%;
  font-family: 'Poppins', sans-serif; /* Police de caractères */
  font-size: 2.5rem; /* Taille du texte du titre augmentée */
  color: #F9A825; /* Couleur du texte du titre */
}

nav {
  display: flex;
  justify-content: space-around;
  align-items: center;
  flex-grow: 1;
  margin-right: 5%;
}

nav li {
  list-style-type: none; /* Supprime le style de puce */
}

nav a {
  color: #ffffff; /* Couleur des liens */
  font-family: 'Poppins', sans-serif; /* Police de caractères */
  font-size: 1.3rem; /* Taille du texte des liens augmentée */
  text-decoration: none;
  transition: color 0.3s;
}

nav a:hover {
  color: #F9A825; /* Couleur au survol des liens */
  animation: bounce 0.8s ease-in-out; /* Animation au survol des liens */
}

@keyframes bounce {
  0%, 100% {
    transform: translateY(0);
  }
  50% {
    transform: translateY(-5px); /* Animation de rebond */
  }
}


</style>