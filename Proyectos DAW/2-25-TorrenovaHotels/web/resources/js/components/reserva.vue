<template>
  <div class="container">
    <section class="reservation-summary">
      <header class="summary-header">
        <h1 class="summary-header-h1">Resum de la Reserva</h1>
      </header>
      <div class="summary-details">
        <div class="detail-item">
          <h2 class="detail-item-hotel">Hotel Escollit:</h2>
          <p>{{ reserva.NomHotel }}</p>
        </div>
        <div class="detail-item">
          <h2 class="detail-item-habitacio">Tipus d’Habitació Escollida:</h2>
          <p>{{ reserva.NomTipusHabitacio }}</p>
        </div>
        <div class="detail-item">
          <h2 class="detail-item-dades">Dates de la Reserva:</h2>
          <p>{{ reserva.DataEntrada }}</p>
          <p>{{ reserva.DataSortida }}</p>
        </div>
        <div class="detail-item">
          <h2 class="detail-item-preu">Preu Total de la Reserva:</h2>
          <p>{{ reserva.PreuTipusHabitacio }} €</p>
        </div>
      </div>
      <!-- Botó per iniciar el procés de "Reserva Ràpida" -->
      <div class="action-button">
        <button class="detail-item-button" @click="mostrarModal = true">Reserva Ràpida</button>
      </div>
    </section>

    <!-- Modal que apareix quan 'mostrarModal' és cert -->
    <transition name="modal">
      <dialog v-if="mostrarModal" class="modal-overlay" @click.self="mostrarModal = false">
        <div class="modal-content">
          <button class="close-button" @click="mostrarModal = false" aria-label="Tanca">×</button>
          <h2>Reserva Ràpida</h2>
          <!-- Formulari per introduir el correu electrònic de l'usuari -->
          <form>
            <label for="email">Correu Electrònic:</label>
            <input type="email" id="email" v-model="email" required placeholder="Correu electrònic requerit" />
            <button type="submit" @click="enviarValidacio">Enviar</button>
          </form>
          <!-- Missatge de confirmació o error després d'enviar el formulari -->
          <p v-if="missatge">{{ missatge }}</p>
        </div>
      </dialog>
    </transition>
  </div>
</template>

<script>
export default {
  data() {
    return {
      mostrarModal: false,
      email: '',
      missatge: '',
      reserva: {
        NomHotel: '',
        DataEntrada: '',
        DataSortida: '',
        NomTipusHabitacio: '',
        PreuTipusHabitacio: '',
      },
      cerca: {
        DataEntrada: '',
        DataSortida: '',
      }
    };
  },
  methods: {
    obtenerReserva() {
      const reservaData = sessionStorage.getItem("room");
      const diesCerca = sessionStorage.getItem("cerca");


      if (reservaData) {
        this.reserva = JSON.parse(reservaData);
        this.cerca = JSON.parse(diesCerca);

        this.reserva.DataEntrada = this.cerca.dataInici;
        this.reserva.DataSortida = this.cerca.dataFinal;

        let fechaInicio = new Date(this.reserva.DataEntrada);
        let fechaFin = new Date(this.reserva.DataSortida);

        let diferenciaTiempo = fechaFin - fechaInicio;
        let diferenciaDias = diferenciaTiempo / (1000 * 60 * 60 * 24);

        this.reserva.PreuTipusHabitacio = this.reserva.PreuTipusHabitacio * diferenciaDias;

        const datosReserva = {
          hotel: this.reserva.NomHotel,
          habitacio: this.reserva.NomTipusHabitacio,
          dataEntrada: this.reserva.DataEntrada,
          dataSortida: this.reserva.DataSortida,
          preu: this.reserva.PreuTipusHabitacio,
          idHabitacio: this.reserva.IdTipusHabitacio,
          ocupants: this.reserva.PersonesReserva


        }

        localStorage.setItem("reserva", JSON.stringify(datosReserva));

      }
    },
    async enviarValidacio() {
      try {
        await this.enviarCorreoUnic();
      } catch (error) {
        this.missatge = 'Error durant la validació d\'email: ' + error.message;
      }
    },
    async enviarCorreoUnic() {
      try {
        const mail = { email: this.email };
        const response = await fetch('/api/correo-mail', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(mail),
        });

        if (!response.ok) {
          const errorMessage = `Error: ${response.status} ${response.statusText}`;
          console.error(errorMessage);
          throw new Error(errorMessage);
        }

        this.missatge = 'Email enviat satisfactòriament!';
        window.location.href = "/";
      } catch (error) {
        this.missatge = 'Error enviant el correu: ' + error.message;
        throw error;
      }
    },
  },
  mounted() {
    this.obtenerReserva();
  }
};
</script>
