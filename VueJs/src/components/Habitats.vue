<template>
  <div v-if="estCharge">
  <ul>
    <li v-for="(habitat) in habitats">
      <router-link :to="{ name: 'habitat', params: { nom: habitat.nom} }">
        <figure>
          <img :src="'./public/images/' + habitat.image" :alt="habitat.nom">
          <figcaption>{{ habitat.nom }}</figcaption>
        </figure>
      </router-link>
    </li>
  </ul>
</div>
<h2 v-else>Veuillez patienter...</h2>
</template>

<script setup>
import { onMounted, ref, computed } from 'vue'
import { useDefaultStore } from '../stores/index'


const store = useDefaultStore();

onMounted(() => {
store.chargeHabitats();
});

const habitats = computed(() => store.habitats);
const estCharge = computed(() => habitats.value.length > 0);


</script>

<style></style>