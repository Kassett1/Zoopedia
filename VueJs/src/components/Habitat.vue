<template>
  <div v-if="estCharge">
  <div v-if="infoshabitat">
    <h1>{{ nomhabitat }}</h1>
    <h2>{{ infoshabitat }}</h2>
  </div>
  <h1 v-else>Cet habitat n'existe pas</h1>
</div>
<h2 v-else>Veuillez patienter...</h2>
</template>

<script setup>

import { onMounted, ref, computed, watch } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import { toRef } from 'vue'
import { useDefaultStore } from '../stores/index'


const store = useDefaultStore();

onMounted(() => {
store.chargeHabitats();
});

const habitats = computed(() => store.habitats);
const estCharge = computed(() => habitats.value.length > 0);


const route = ref(useRoute());
const routeParams = toRef(route.value, 'params');
const nomhabitat = ref(routeParams.value.nom);

watch(routeParams, () => {
  nomhabitat.value = routeParams.value.nom;
});

const infoshabitat = computed(() => {
  if (habitats.value) {
    for (let i = 0; i < habitats.value.length; i++) {
      const habitat = habitats.value[i];
      if (habitat.nom === nomhabitat.value) {
        return habitat;
      }
    }
  }
  return null;
});



</script>

<style></style>