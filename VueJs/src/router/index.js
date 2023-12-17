import { createRouter, createWebHashHistory } from 'vue-router'
import Accueil from '../components/Accueil.vue'
import Animal from '../components/Animal.vue'
import Habitats from '../components/Habitats.vue'
import Quiz from '../components/Quiz.vue'
import Animaux from '../components/Animaux.vue'
import Habitat from '../components/Habitat.vue'
import Cri from '../components/Cri.vue'


const routes = [
    
    {
      path: '/',
      name : 'homepage',
      component : Accueil
    },
    {
      path: '/animal/:nom',
      name : 'animal',
      component: Animal
    },
    {
      path: '/habitats',
      name : 'habitats',
      component: Habitats
    },
    {
      path: '/quiz',
      name : 'quiz',
      component: Quiz
    },
    {
      path: '/animaux',
      name : 'animaux',
      component: Animaux
    },
    {
      path: '/habitats/:nom',
      name : 'habitat',
      component: Habitat
    },
    {
      path: '/soundbox',
      name : 'soundbox',
      component: Cri
    }
]

const router = createRouter({
    history: createWebHashHistory(),
    routes,
  })

export default router