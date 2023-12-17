<template>
  <div class="container">
    <div v-if="questions">
      <div v-if="fin">
        <p>Votre score est : {{ score }} / {{ questions.length }}</p>
      </div>
      <div class="card-header">
        <h2>{{ questions[index].question }}</h2>
      </div>
      <ul>
        <li v-for="(reponse, id) in questions[index].answers" :key="id" @click="action(id)" :class="variants[id]">
          {{ reponse }}
        </li>
      </ul>
      <button v-if="fin" @click="recommencer">Recommencer !</button>
      <button v-if="voirReponse && !fin" @click="continuer">Continuer !</button>
    </div>
    <div v-else>
      <h1>Aucune question dans cette catégorie</h1>
    </div>
  </div>
</template>

<script setup>
import { ref, computed } from 'vue'

const quiz = [
  {
    "question": "Quel animal est connu pour avoir la mémoire la plus longue ?",
    "answers": [
      "Éléphant",
      "Chimpanzé",
      "Dauphin",
      "Corbeau"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal peut changer de couleur pour se camoufler ?",
    "answers": [
      "Caméléon",
      "Grenouille",
      "Lion",
      "Panda"
    ],
    "ok": 0
  },
  {
    "question": "Quel est l'animal le plus bruyant du règne animal ?",
    "answers": [
      "Coq",
      "Lion",
      "Éléphant",
      "Baleine bleue"
    ],
    "ok": 3
  },
  {
    "question": "Quel est l'animal qui possède le plus grand nombre de cœurs ?",
    "answers": [
      "Pieuvre",
      "Crevette-mante",
      "Serpent",
      "Girafe"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal est capable de survivre à des conditions extrêmes, y compris le vide spatial ?",
    "answers": [
      "Tardigrade",
      "Cafard",
      "Serpent à sonnette",
      "Chameau"
    ],
    "ok": 0
  },
  {
    "question": "Quel est le seul mammifère capable de voler ?",
    "answers": [
      "Chauve-souris",
      "Colibri",
      "Aigle royal",
      "Libellule"
    ],
    "ok": 0
  },
  {
    "question": "Quel est le mammifère le plus lourd sur terre ?",
    "answers": [
      "Baleine bleue",
      "Éléphant d'Afrique",
      "Hippopotame",
      "Rhinocéros blanc"
    ],
    "ok": 1
  },
  {
    "question": "Quel animal a le plus de bras ?",
    "answers": [
      "Pieuvre",
      "Scorpion",
      "Araignée",
      "Etoile de mer"
    ],
    "ok": 2
  },
  {
    "question": "Quel oiseau est connu pour son habilité à imiter les sons qu'il entend, y compris les sonneries de téléphone et les alarmes de voiture ?",
    "answers": [
      "Perroquet gris du Gabon",
      "Canari",
      "Moineau",
      "Hibou"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal possède la plus longue langue par rapport à sa taille ?",
    "answers": [
      "Fourmilier",
      "Girafe",
      "Caméléon",
      "Colibri"
    ],
    "ok": 2
  },
  {
    "question": "Quel est le plus grand crustacé du monde ?",
    "answers": [
      "Crabe royal du Kamtchatka",
      "Crabe géant du Japon",
      "Langouste",
      "Homard"
    ],
    "ok": 1
  },
  {
    "question": "Quel est le plus grand insecte du monde en terme d'envergure ?",
    "answers": [
      "Papillon Atlas",
      "Goliathus goliatus",
      "Mante religieuse",
      "Criquet migrateur"
    ],
    "ok": 0
  },
  {
    "question": "Quel est l'animal le plus lourd volant aujourd'hui ?",
    "answers": [
      "Albatros hurleur",
      "Condor des Andes",
      "Cygne",
      "Cacatoès"
    ],
    "ok": 2
  },
  {
    "question": "Quel est le plus petit mammifère du monde ?",
    "answers": [
      "Microcebus myoxinus",
      "Soricidae Etruscan",
      "Chauve-souris de Kitti",
      "Musaraigne pygmée"
    ],
    "ok": 2
  },
  {
    "question": "Quel est l'animal le plus venimeux du monde ?",
    "answers": [
      "Méduse boîte",
      "Conus geographus",
      "Dendrocnide moroides",
      "Taipan de l'intérieur"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal est connu pour sa danse complexe pour attirer un partenaire ?",
    "answers": [
      "Paon",
      "Grue royale",
      "Manchot empereur",
      "Oiseau de paradis"
    ],
    "ok": 3
  },
  {
    "question": "Quel animal est capable de régénérer non seulement ses membres, mais aussi ses organes internes ?",
    "answers": [
      "Axolotl",
      "Lézard à queue détachable",
      "Crevette-mante",
      "Serpent à sonnette"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal est capable de dormir pendant plusieurs mois sans se nourrir ni boire ?",
    "answers": [
      "Marmotte",
      "Paresseux",
      "Koala",
      "Tortue"
    ],
    "ok": 0
  },
  {
    "question": "Quel animal est capable de marcher sur l'eau grâce à sa vitesse et à la tension superficielle de l'eau ?",
    "answers": [
      "Anolis aquaticus",
      "Araignée d'eau",
      "Basilic",
      "Colibri"
    ],
    "ok": 2
  },
  {
    "question": "Quel est le seul mammifère au monde connu pour être naturellement capable de biofluorescence ?",
    "answers": [
      "Opossum",
      "Paresseux",
      "Chauve-souris",
      "Platypus"
    ],
    "ok": 3
  }
]




const getRandomQuestions = (numQuestions) => {
  const quizMelange = quiz.sort(() => Math.random() - 0.5)
  return quizMelange.slice(0, numQuestions)
}

const questions = computed(() => getRandomQuestions(5));
const index = ref(0)
const reponseChoisie = ref(null)
const voirReponse = ref(false)
const score = ref(0)
const fin = ref(false);
const variants = ref([...Array(4)])

function action(id) {
  if (!voirReponse.value) {
    if (id === questions.value[index.value].ok) {
      score.value++
    } else {
      variants.value[id] = 'incorrect'
    }
    voirReponse.value = true
    variants.value[questions.value[index.value].ok] = 'correct'
    if (index.value === questions.value.length - 1) {
      fin.value = true;
    }
  }
}

function continuer() {
  reponseChoisie.value = null;
  voirReponse.value = false;
  index.value++;
  variants.value = [...Array(questions.length)];
}

function recommencer() {
  voirReponse.value = false;
  index.value = 0;
  score.value = 0;
  reponseChoisie.value = null;
  questions.value = getRandomQuestions(5);
  variants.value = [...Array(4)];
  fin.value = false;
}

</script>

<style>
/* Styles généraux */
.container {
  max-width: 800px;
  margin: 0 auto;
  padding: 40px;
  text-align: center;
}

h2 {
  font-size: 32px;
  font-weight: bold;
  margin-bottom: 30px;
}

ul {
  list-style-type: none;
  padding: 0;
  margin-bottom: 30px;
}

li {
  margin-bottom: 20px;
  font-size: 20px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

button {
  padding: 15px 30px;
  font-size: 18px;
  border-radius: 8px;
}

/* Animations */
@keyframes fadeIn {
  from {
    opacity: 0;
  }
  to {
    opacity: 1;
  }
}

@keyframes shake {
  0% {
    transform: translateX(0);
  }
  25% {
    transform: translateX(-10px);
  }
  50% {
    transform: translateX(10px);
  }
  75% {
    transform: translateX(-10px);
  }
  100% {
    transform: translateX(0);
  }
}

.card-header {
  animation: fadeIn 0.5s ease;
}

li.correct {
  background-color: #5cb85c;
  animation: fadeIn 0.3s ease;
}

li.incorrect {
  background-color: #d9534f;
  animation: shake 0.5s ease;
}

button {
  animation: fadeIn 0.5s ease;
}

.container{
  margin-top: 3%;
}
</style>
