<template>
      <div class="contenedorCerca">
        <Cerca />
    </div>
  <div class="containerRoom">
    <h2 class="title">Habitacions disponibles</h2>
    <div v-if="rooms.length === 0" class="no-rooms">Carregant....</div>
    <div v-else class="rooms-grid">
      <div v-for="room in rooms" :key="room.NomHabitacio" class="room-card" @click="selectRoom(room)">
        <h3 class="room-title">{{ room.NomHabitacio }}</h3>
        <p><strong>Tipus:</strong> {{ room.NomTipusHabitacio }}</p>
        <p><strong>Descripció:</strong> {{ room.Descripcio }}</p>
        <p><strong>Preu base:</strong> {{ room.PreuTipusHabitacio }}€</p>
        <p><strong>Capacitat:</strong> {{ room.OcupantsHabitacio }} persones</p>
        
        <!-- Mostrar todas las imágenes -->
        <div class="images">
          <img v-for="(image, index) in room.Imatge" :key="index" :src="image" class="room-image" />
        </div>
      </div>
    </div>
  </div>
  <div class="contenedorCerca">
        <Footer />
    </div>
</template>

  
<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import axios from "axios";
import Footer from "./footer.vue";
import Cerca from "./cerca.vue";

const rooms = ref([]);
const loading = ref(true);
const router = useRouter();

onMounted(async () => {
  try {
    const reserva = JSON.parse(sessionStorage.getItem("cerca"));

    if (!reserva) {
      return;
    }

    const response = await axios.get("https://67.202.46.67:8000/api/habitaciones", {
      params: {
        idReserva: reserva.IdReserva,
        destinacio: reserva.destinacio,
        dataInici: reserva.dataInici,
        dataFinal: reserva.dataFinal,
        quantitatReserva: reserva.quantitatReserva,
      },
    });

    if (response.data) {
      
      rooms.value = response.data.map((room) => ({
        ...room,
        Imatge: JSON.parse(room.Imatge), // Convierte la cadena JSON a array
        PersonesReserva: reserva.quantitatReserva,
      }));
    }
  } finally {
    loading.value = false;
  }
});

const selectRoom = (room) => {
  sessionStorage.setItem("room",JSON.stringify(room));
  window.location.href = "/reserva";
};
</script>