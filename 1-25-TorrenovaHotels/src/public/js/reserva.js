"use strict";
let tipusHabitacio = document.querySelector("#tipusHabitacio");
let dataEntrada = document.querySelector("#dataEntrada");
let dataSortida = document.querySelector("#dataSortida");
let mensajeError = document.querySelector("#mensajeError"); // Contenedor para el mensaje de error
let formulario = document.querySelector("#formReserva"); // Seleccionar el formulario
let inputPreu = document.querySelector("#preu");
let tipusHabitacioPreu = document.querySelector("#tipusHabitacioPreu");
let tipusHabitacioNom = document.querySelector("#tipusHabitacioNom");

let habitacioSelect = document.querySelector("#habitacioSelect");

if (tipusHabitacioPreu != null) {
  inputPreu.value = tipusHabitacioPreu.value;

}

let preuBase = inputPreu.value;

function actualitzarPreciofiltrat(preu){
  inputPreu.value = preu;
}

function actualizarPrecio() {
  let fechaEntrada = document.querySelector("#dataEntrada").value;
  let fechaSortida = document.querySelector("#dataSortida").value;
  let mensajeErrorServer = document.querySelector("#mensajeErrorServer");

  if (mensajeErrorServer) {
    mensajeErrorServer.innerHTML = "";

  }
  // Obtener la fecha actual (solo año, mes y día)
  let fechaActual = new Date();
  fechaActual.setHours(0, 0, 0, 0); // Establecer horas a 0 para comparar solo fecha

  // Si el elemento existe y tiene un valor, actualizamos preuBase
  if (tipusHabitacioPreu) {
    preuBase = parseFloat(tipusHabitacioPreu.value) || 0; // Asegurarse de que el valor sea numérico
  }

  if (fechaEntrada && fechaSortida) {
    // Convertir las fechas a objetos Date
    let fechaEntradaDate = new Date(fechaEntrada);
    let fechaSortidaDate = new Date(fechaSortida);
    
    // Poner las horas a 0 para que no de problemas al actualizar el precio
    fechaEntradaDate.setHours(0, 0, 0, 0);
    fechaSortidaDate.setHours(0, 0, 0, 0);

    // Verificar si la fecha de entrada es anterior al día actual
    if (fechaEntradaDate < fechaActual) {
      mensajeError.textContent = "La fecha de entrada no puede ser anterior al día de hoy.";
      mensajeError.style.color = "red"; // Mostrar el mensaje de error en color rojo

      // Limpiar el campo de precio
      inputPreu.value = "";

      return; // Salir de la función si la fecha de entrada es incorrecta
    }

    // Calcular la diferencia en milisegundos entre la fecha de entrada y salida
    let diferenciaMilisegundos = fechaSortidaDate - fechaEntradaDate;

    // Convertir la diferencia a días
    let diferenciaDias = diferenciaMilisegundos / (1000 * 3600 * 24);

    // Asegurarse de que la diferencia de días sea mayor que 0
    if (diferenciaDias > 0) {
      // Calcular el nuevo precio basado en la cantidad de días
      let nuevoPrecio = preuBase * diferenciaDias;

      // Actualizar el campo de precio
      inputPreu.value = nuevoPrecio.toFixed(2); // Mostrar el precio con 2 decimales

      if (mensajeError) {
        // Limpiar el mensaje de error si las fechas son correctas
        mensajeError.textContent = "";
      }

    } else {
      // Si las fechas son incorrectas (ej. fecha de salida es antes de la de entrada)
      mensajeError.textContent = "La fecha de salida debe ser posterior a la de entrada.";
      mensajeError.style.color = "red"; // Mostrar el mensaje de error en color rojo

      // Limpiar el campo de precio
      inputPreu.value = "";
    }
  }
}

dataEntrada.addEventListener("change", actualizarPrecio);
dataSortida.addEventListener("change", actualizarPrecio);

if (habitacioSelect) {
  habitacioSelect.addEventListener("change", async () => {
    let fechaEntrada = document.querySelector("#dataEntrada").value;
    let fechaSortida = document.querySelector("#dataSortida").value;

    let habitacioId = habitacioSelect.value;
    if (habitacioId) {
        try {
            let response = await fetch(`/api/reserva/getTipusHabitacio`, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({ habitacio_id: habitacioId }),
            });
  
            if (response.ok) {
              let data = await response.json();
              tipusHabitacioNom.value = data.NomTipusHabitacio;
              tipusHabitacioPreu.value = data.PreuTipusHabitacio;
              tipusHabitacio.value = data.NomTipusHabitacio + ' -- ' + data.PreuTipusHabitacio+ ' €';
              if (fechaEntrada === '' && fechaSortida === '') {
                actualitzarPreciofiltrat(data.PreuTipusHabitacio);
              }else{
                actualizarPrecio();
              }
            } else {
              console.error("Error al obtener tipo de habitación");
              tipusHabitacioNom.value = "";
              tipusHabitacioPreu.value = "";
            }
        } catch (error) {
            console.error("Error en la solicitud:", error);
          }
    } else {
        tipusHabitacioInput.value = "";
    }
  });
}

// Validar al intentar enviar el formulario
formulario.addEventListener("submit", function(event) {
  // Si hay un mensaje de error, prevenir el envío del formulario
  if (mensajeError.textContent !== "") {
    event.preventDefault(); // Detiene el envío del formulario
  }
});