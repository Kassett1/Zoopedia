import { defineStore } from 'pinia';
import Axios from 'axios';

export const useDefaultStore = defineStore({
  id: 'default',
  state: () => ({
    animals: [],
    habitats: [],
    categories: []
  }),
  getters: {

  },
  actions: {
    chargeAnimaux() {
      Axios.get("http://localhost:8000/api/animals")
        .then(response => {
          this.animals = response.data["hydra:member"];
          // Traitement à effectuer avec les données (par exemple, affichage, manipulation, etc.)
        })
        .catch(e => {
          const erreurs = e;
          console.log(e);
        });
    },
    chargeHabitats() {
      Axios.get("http://localhost:8000/api/habitats")
        .then(response => {
          this.habitats = response.data["hydra:member"];
          // Traitement à effectuer avec les données (par exemple, affichage, manipulation, etc.)
        })
        .catch(e => {
          const erreurs = e;
          console.log(e);
        });
    },
    chargeCategories() {
      Axios.get("http://localhost:8000/api/categories")
        .then(response => {
          this.categories = response.data["hydra:member"];
          // Traitement à effectuer avec les données (par exemple, affichage, manipulation, etc.)
        })
        .catch(e => {
          const erreurs = e;
          console.log(e);
        });
    }
  }
});
