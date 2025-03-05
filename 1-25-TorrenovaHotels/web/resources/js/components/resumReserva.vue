<template>
  <!-- Modal de carga -->
  <div v-if="cargando" class="modal-loading">
    <div class="loading-content">
      <p class="loading-content-resumReserva">Enviat correu, si us plau esperi...</p>
    </div>
  </div>

  <!-- Modal de éxito -->
  <div v-if="mensajeExito" class="modal-success">
    <div class="success-content">
      <p class="success-content-resumReserva">Correu enviat amb èxit!</p>
      <button class="success-contentCerrar-ResumReserva" @click="cerrarMensaje">Tancar</button>
    </div>
  </div>

  <!-- Modal de Error -->
  <div v-if="mensajeError" class="modal-error">
    <div class="error-content">
      <p class="error-content-resumReserva">Hi ha hagut un error al pagar la reserva</p>
      <button class="error-contentCerrar-resumReserva" @click="cerrarMensajeError">Tancar</button>
    </div>
  </div>

  <div class="contenedorResum">
    <div class="detallResum">
      <div class="contenedorTituloResum">
        <h3 class="titolH3-resumReserva">Resum Reserva</h3>
      </div>
      <div class="contendorDetallResum">
        <h4 class="hotelEscollitH4-resumReserva">Hotel Escollit: </h4>
        <p id="hotel">{{ reserva.hotel }}</p>

        <h4 class="habitacio-resumReserva">Habitació escollida: </h4>
        <p id="habitacio">{{ reserva.habitacio }}</p>

        <h4 class="dades-resumReserva">Dates Reserva: </h4>
        <p id="data">{{ reserva.DataEntrada }} - {{ reserva.DataSortida }}</p>
      </div>

      <div class="contenedorBtnPreuResum">
        <div class="contenedorPreu">
          <h4 class="preu-resumReserva">Preu total: </h4>
          <p id="preu">{{ reserva.preu }}€</p>
        </div>
        <button class="btnResumReserva" @click="pagarReserva" type="submit">Pagar Reserva</button>
      </div>

    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      cargando: false,
      mensajeExito: false,
      mensajeError: false,
      reserva: {
        NomHotel: '',
        NomTipusHabitacio: '',
        DataEntrada: '',
        DataSortida: '',
        PreuTipusHabitacio: '',
        idHabitacio: '',
        ocupants: '',

      }
    };
  },
  methods: {
    async actualizarReserva(datos) {
      try {
        const response = await fetch(`https://67.202.46.67:8000/api/actualitzarReservas`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(datos),
        });

        if (!response.ok) throw new Error("Error a l'actualizar la reserva a la base de dades");

      } catch (error) {
        console.error("Error a l'actualizar la reserva:", error);
        this.mensajeError = true;
      }
    },
    async enviarCorreo() {
      try {
        this.cargando = true;

        let hotel = document.querySelector("#hotel").textContent;
        let habitacio = document.querySelector("#habitacio").textContent;
        let data = document.querySelector("#data").textContent;
        let preu = document.querySelector("#preu").textContent.replace("€", "").trim();

        let habitacioId = this.reserva.idHabitacio;
        let ocupants = this.reserva.ocupants;

        let [dataInici, dataFinal] = data.split(" - ");


        const datos = { hotel, habitacio, dataInici, dataFinal, preu, habitacioId, ocupants};
        const response = await fetch(`/api/correo-enviar`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(datos),
        });

        if (!response.ok) throw new Error("Error a l'enviar el correu");

        await this.actualizarReserva(datos);

        this.mensajeExito = true;

      } catch (err) {
        this.mensajeError = true;
      } finally {
        this.cargando = false;
      }
    },
    pagarReserva() {
      const pagar = import.meta.env.VITE_PAGAMENT_SIMULAT;
      if (pagar === "true") {
        this.enviarCorreo();
      } else {
        this.mensajeError = true;
      }
    },
    cerrarMensaje() {
      this.mensajeExito = false;
      window.location.href = "/";
      localStorage.removeItem("reserva");

    },
    cerrarMensajeError() {
      this.mensajeError = false;
    },
  },
  mounted() {
    const reserva = JSON.parse(localStorage.getItem("reserva"));
    if (reserva) {
      this.reserva.hotel = reserva.hotel;
      this.reserva.habitacio = reserva.habitacio;
      this.reserva.DataEntrada = reserva.dataEntrada;
      this.reserva.DataSortida = reserva.dataSortida;
      this.reserva.preu = reserva.preu;
      this.reserva.idHabitacio = reserva.idHabitacio;
      this.reserva.ocupants = reserva.ocupants;
    }else {
      window.location.href = "/";
    }
  }
};
</script>