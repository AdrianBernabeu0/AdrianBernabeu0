"use strict";

const formFiltrarData = document.querySelector("#formFiltrarData");

//Funció per la creació del template amb les dades de cada reserva
function creationTemplate(result){
  const habitacionsDiv = document.createElement("div");
  habitacionsDiv.classList.add("contenedorHabitacions");

  result.forEach((habitacio) => {
      const template = document.querySelector("#templateHabitacio");
      let contenedorHabitacions = document.querySelector("#contenedorHabitacions");
      const habitacioDiv = template.content.cloneNode(true);

      habitacioDiv.querySelector(".IdentificadorReserva").innerHTML = "<strong>Identificador Reserva :</strong> " + habitacio.IdentificadorReserva;
      habitacioDiv.querySelector(".NomUsuari").innerHTML = "<strong>Nom Usuari : </strong> " + habitacio.NomUsuari;
      habitacioDiv.querySelector(".data_EntradaReservas").innerHTML = "<strong>Data Entrada : </strong> " + habitacio.data_EntradaReservas;
      habitacioDiv.querySelector(".data_SortidaReservas").innerHTML = "<strong>Data Sortida : </strong> " + habitacio.data_SortidaReservas;
      habitacioDiv.querySelector(".NomTipusHabitacions").innerHTML = "<strong>Tipus Habitacio : </strong> " + habitacio.NomTipusHabitacions;
      habitacioDiv.querySelector(".OcupantsHabitacions").innerHTML =  "<strong>Ocupants Habitació : </strong> " + habitacio.OcupantsHabitacions;
      habitacioDiv.querySelector(".PersonasReservas").innerHTML = "<strong>Persones Reserva :</strong> " + habitacio.PersonesReserva;
      habitacioDiv.querySelector(".NomHabitacions").innerHTML = "<strong>Habitació Assignada : </strong> " + habitacio.NomHabitacions;
      habitacioDiv.querySelector(".EstatReservas").innerHTML = "<strong>Estat Reserva : </strong>" + habitacio.EstatReservas;
      habitacioDiv.querySelector(".PreuReservas").innerHTML = "<strong>Preu : </strong> " + habitacio.PreuReservas + "€";
      habitacioDiv.querySelector(".NotasClient").innerHTML = "<strong>Notes Client :</strong> " + habitacio.ObservacionHabitacions;

      habitacionsDiv.appendChild(habitacioDiv);
  });

  contenedorHabitacions.appendChild(habitacionsDiv);
}

//Funció per la creació dels contenidors de les reserves
function creationReservas(result) {
  let contenedorHabitacions = document.querySelector("#contenedorHabitacions");

  if (result.length > 0) {
    creationTemplate(result);
  } else {
      contenedorHabitacions.innerHTML = "<div class='noReserves'>No hi han reserves</div>";
  }
}
//Event Listener per quan fas submit del formulari
formFiltrarData.addEventListener("submit", async function (e) {
    try {
        e.preventDefault();
        const dataInici = document.querySelector("#dataInici").value;
        const dataFinal = document.querySelector("#dataFinal").value;
        const nomClient = document.querySelector("#nomClient").value;
        const numReserva = document.querySelector("#numReserva").value;
        const token = document.querySelector('input[name="_token"]').value;

        const response = await fetch(`/api/rooms/checkinList/search`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify({ dataInici, dataFinal,nomClient,numReserva }),
        });

        //Si la resposta es correcta cridarà la funció per crear els contenidors
        if (response.ok) {
            const result = await response.json();
            const contenedorHabitacions = document.querySelector("#contenedorHabitacions");
            contenedorHabitacions.innerHTML = "";
            creationReservas(result);
        } else {
            const errorMessage = await response.text();
            console.error("Error", errorMessage);
        }
    } catch (error) {
        console.error("Error:", error);
    }
});
