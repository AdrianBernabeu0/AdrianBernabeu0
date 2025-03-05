<template>
  <div class="container">
    <form @submit.prevent="enviarFormulario" method="post" id="formCerca" class="cercaRapida">
      <div class="cerca-div">
        <label for="destinacio" class="cerca-label">Destinació</label>
        <input 
          type="text" 
          v-model="destinacio" 
          class="cerca-input"
          required
          placeholder="Introdueix destinació"
        >
      </div>

      <div class="cerca-div">
        <label for="dataInici" class="cerca-label">Data d'inici</label>
        <input 
          type="date" 
          v-model="dataInici" 
          class="cerca-input-data"
          required
        >
      </div>

      <div class="cerca-div">
        <label for="dataFinal" class="cerca-label">Data final</label>
        <input 
          type="date" 
          v-model="dataFinal" 
          class="cerca-input-data"
          required
        >
      </div>

      <div class="cerca-div">
        <label for="quantitatReserva" class="cerca-label">Persones</label>
        <input 
          type="number" 
          v-model="quantitatReserva" 
          class="cerca-input-reserva"
          min="1"
          required
          placeholder="Núm. persones"
        >
      </div>

      <div class="cerca-div-button">
        <button type="submit" class="cerca-button">
          Cerca
          <span aria-hidden="true">→</span>
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Cerca",
  data() {
    return {
      destinacio: "",
      dataInici: "",
      dataFinal: "",
      quantitatReserva: ""
    };
  },
  methods: {
    async enviarFormulario() {
      const cerca = {
        destinacio: this.destinacio,
        dataInici: this.dataInici,
        dataFinal: this.dataFinal,
        quantitatReserva: this.quantitatReserva,
      };
      sessionStorage.setItem("cerca", JSON.stringify(cerca));
      window.location.href = "/roomAvailable";
    },
  },
};
</script>