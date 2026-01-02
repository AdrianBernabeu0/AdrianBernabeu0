"use strict";
let fechaInici;
let fechaFinal;
const iniciCalendari = 1;
const finalCalendari = 31;
const mitjDia = 12;
const multiplicadorDoble = 2;
const roomManagment = document.querySelector("#dialog-roomManagment");
const divDialogEstatHabitacio = document.querySelector(".div-dialog-estat-habitacio");
const divDialogNumHabitacio = document.querySelector(".div-dialog-num-habitacio");
const divDialogServeisHabitacio = document.querySelector(".div-dialog-serveis-habitacio");
const divDialogTipusHabitacio = document.querySelector(".div-dialog-tipus-habitacio");
const divDialogReservaHabitacio = document.querySelector(".div-dialog-reserva-habitacio");

const formCheckIn = document.querySelector("#formCheckIn");
const buttonsCheckIn = document.querySelector(".checkIn");
const formCheckOut = document.querySelector("#formCheckOut");
const buttonsCheckOut = document.querySelector(".checkOut");
const btnCloseDialogRoomManagement = document.querySelector(
    ".btn-close-dialog-roomManagement"
);
const divCheckBtn = document.querySelector("#divCheckBtn");

let recollirHabitacionid = document.querySelectorAll(".habitacion");
const formRoomBlock = document.querySelector("#formRoomBlock");
const buttonsRoomBlock = document.querySelector(".roomBlock");

const dialogDetallReserva = document.querySelector("#dialog-detall-reserva");
const btnDialogDetallReserva = document.querySelector("#btn-close-dialog-detall-reserva");

const divDetallReservaDataEntrada = document.querySelector(".div-detall-reserva-data-entrada");
const divDetallReservaDataSortida = document.querySelector(".div-detall-reserva-data-sortida");
const divDetallReservaNom = document.querySelector(".div-detall-reserva-nom");
const divDetallReservaEmail = document.querySelector(".div-detall-reserva-email");
const divDetallReservaPreu = document.querySelector(".div-detall-reserva-preu");

const fechaAvui = (data) => {
    const diaData = new Date(data);
    const hoy = new Date();

    // Normalizar ambas fechas eliminando la hora
    diaData.setHours(0, 0, 0, 0);
    hoy.setHours(0, 0, 0, 0);

    return diaData.getTime() === hoy.getTime();
};

const omplirDadesColumnaFilaGrid = () => {
    let contadorColumna = 1;
    let contadorFila = 1;
    let contadorfecha = 1;
    const divDays = document.querySelectorAll(".days");
    const divTotesReserves = document.querySelector(".totesReserves");
    recollirHabitacionid = document.querySelectorAll(".habitacion");
    const habitacions = document.querySelector(".habitacions");
    const divTotesReservesLength = recollirHabitacionid.length;
    divTotesReserves.style.gridTemplateRows = `repeat(${divTotesReservesLength},1fr)`;
    recollirHabitacionid.forEach((recollirId) => {
        recollirId.setAttribute("data-fila", contadorFila++);
    });

    habitacions.style.gridTemplateRows = `repeat(${recollirHabitacionid.length},1fr)`;
    divDays.forEach((divDay) => {
        if (contadorfecha === iniciCalendari) {
            fechaInici = divDay.getAttribute("data-date");
        } else if (contadorfecha === finalCalendari) {
            fechaFinal = divDay.getAttribute("data-date");
        }
        if (fechaAvui(divDay.getAttribute("data-date"))) {
            divDay.className="days dayAvui";
        }
        contadorfecha++;
        divDay.setAttribute("data-columna", contadorColumna++);
    });
};
omplirDadesColumnaFilaGrid();

const revisionDateIniciFinal = (
    dataInicialReservaEntrada,
    dataFinalReservaSortida,
    dataCalendariInici,
    dataCalendariFinal
) => {
    // Convertir ambas fechas a objetos Date
    dataInicialReservaEntrada = new Date(dataInicialReservaEntrada);
    dataFinalReservaSortida = new Date(dataFinalReservaSortida);
    dataCalendariInici = new Date(dataCalendariInici);
    dataCalendariFinal = new Date(dataCalendariFinal);

    // Normalizar ambas fechas eliminando la hora
    dataInicialReservaEntrada.setHours(0, 0, 0, 0);
    dataFinalReservaSortida.setHours(0, 0, 0, 0);
    dataCalendariInici.setHours(0, 0, 0, 0);
    dataCalendariFinal.setHours(0, 0, 0, 0);
    // Compara la fecha por donde comienza el calendario y por donde acaba, con las fechas de la reserva, te devuelve si la fecha
    //del calendario esta dentro de las fechas de la reserva
    return (
        dataCalendariFinal > dataInicialReservaEntrada &&
        dataCalendariFinal < dataFinalReservaSortida &&
        dataCalendariInici > dataInicialReservaEntrada &&
        dataCalendariInici < dataFinalReservaSortida
    );
};
const revisionDateForIfFinalOrInici= (
    dataReserva,
    dataCalendari,
) => {
    // Convertir ambas fechas a objetos Date
    dataReserva = new Date(dataReserva);
    dataCalendari = new Date(dataCalendari);

    // Normalizar ambas fechas eliminando la hora
    dataReserva.setHours(0, 0, 0, 0);
    dataCalendari.setHours(0, 0, 0, 0);
    // Comparar las fechas
    if(dataCalendari > dataReserva){
        return "avanç";
    }else{
        return "despres";
    }
};
const omplirDialogDetallReserva = (reserva) => {

    divDetallReservaDataEntrada.textContent = reserva.data_Entrada;
    divDetallReservaDataSortida.textContent = reserva.data_Sortida;
    divDetallReservaNom.textContent = reserva.NomUsuari;
    divDetallReservaEmail.textContent = reserva.emailUsuari;
    divDetallReservaPreu.textContent = reserva.preu;
};

btnDialogDetallReserva.addEventListener("click", ()=> {
    divDetallReservaDataEntrada.innerHTML = "";
    divDetallReservaDataSortida.innerHTML = "";
    divDetallReservaNom.innerHTML = "";
    divDetallReservaEmail.innerHTML = "";
    divDetallReservaPreu.innerHTML = "";
    dialogDetallReserva.close();
});
const classNameReserva = (dataReserva, dataSortida) => {
    dataReserva = new Date(dataReserva);
    dataSortida = new Date(dataSortida);
    const dataAvui = new Date();
    if (
        dataReserva.getTime() === dataAvui.getTime() ||
        (dataSortida > dataAvui && dataReserva < dataAvui)
    ) {
        return "reserves-curso";
    } else if (dataSortida < dataAvui) {
        return "reserves-pasada";
    } else {
        return "reserves-futuro";
    }
};
const recollirInformacionReserva=()=>{
    const clickReserva=document.querySelectorAll('.clickReserva');
    clickReserva.forEach(reserva => {
        reserva.addEventListener('click', async (event)=> {
            try {
                event.preventDefault();
                const response = await fetch(
                    `/api/rooms/detail/reserva/${reserva.id}`,
                    {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                        },
                    }
                );

                //Si la resposta es correcta cridara la funcio per crear els contenidors
                if (response.ok) {
                    const result = await response.json();
                    dialogDetallReserva.showModal();
                    omplirDialogDetallReserva(result);
                } else {
                    const errorMessage = await response.text();
                    console.error("Error", errorMessage);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });
    });
}
function omplirReserves(reserves) {
    const divTotesReserves = document.querySelector(".totesReserves");
    reserves.forEach((reserva) => {
        const [dataEntrada, tempsEntrada] = reserva.data_Entrada.split(" ");
        const [horaEntrada] = tempsEntrada.split(":").map(Number);
        const [dataSortida, tempsSortida] = reserva.data_Sortida.split(" ");
        const [horaSortida] = tempsSortida.split(":").map(Number);
        if (
            document.querySelector(`.days[data-date="${dataEntrada}"]`) ||
            revisionDateIniciFinal(dataEntrada,dataSortida,fechaInici,fechaFinal
            )
        ) {
            let dataColumna = document.querySelector(`.days[data-date="${dataEntrada}"]`) ? 
            document.querySelector(`.days[data-date="${dataEntrada}"]`).getAttribute("data-columna"): 1;

            const habitacionPosition = document.querySelector(`.habitacion[id="${reserva.habitacion_id}"]`)
            .getAttribute("data-fila");
            let dataColumnaFinal = document.querySelector(`.days[data-date="${dataSortida}"]`)?
             document.querySelector(`.days[data-date="${dataSortida}"]`).getAttribute("data-columna"): finalCalendari;
            const div = document.createElement("div");
            if (horaEntrada > mitjDia) {
                dataColumna = dataColumna * multiplicadorDoble;
            } else {
                dataColumna = dataColumna * multiplicadorDoble - 1;
            }
            if (horaSortida > mitjDia) {
                dataColumnaFinal = dataColumnaFinal * multiplicadorDoble + 1;
            } else {
                dataColumnaFinal = dataColumnaFinal * multiplicadorDoble;
            }
                if (revisionDateForIfFinalOrInici(dataEntrada,fechaInici)==="avanç") {
                    dataColumna=iniciCalendari;
                }
                if (revisionDateForIfFinalOrInici(dataSortida,fechaFinal)==="despres") {
                    dataColumnaFinal=finalCalendari * multiplicadorDoble + 1;
                }
            div.style.gridArea = `${habitacionPosition}/${dataColumna}/${habitacionPosition}/${dataColumnaFinal}`;
            div.className = `${classNameReserva(dataEntrada, dataSortida)} clickReserva reserves`;
            div.id=reserva.id;
            div.textContent = reserva.usuari;
            divTotesReserves.appendChild(div);
        }
    });
    recollirInformacionReserva();
}

async function recollirReserves() {
    const habitacionsIDArray = [];
    recollirHabitacionid.forEach((recollirId) => {
        habitacionsIDArray.push(recollirId.id);
    });
    try {
        const response = await fetch(`/api/rooms/detail/reserves`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                // "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(habitacionsIDArray),
        });

        //Si la resposta es correcta cridara la funcio per crear els contenidors
        if (response.ok) {
            const result = await response.json();
            omplirReserves(result);
        } else {
            const errorMessage = await response.text();
            console.error("Error", errorMessage);
        }
    } catch (error) {
        console.error("Error:", error);
    }
}
recollirReserves();

function omplirDialog(objectResult, idHabitacion) {
    
    let mensaje;
    const btnCreateReserva = document.querySelector(".btnCreateReserva");
    const formCreateReserva = document.querySelector("#formCreateReserva");
    const btnCreateReservatipusHabitacio = document.querySelector(".btnCreateReservatipusHabitacio");
    btnCreateReserva.value = idHabitacion;
    if (objectResult.mensaje) {
        mensaje = objectResult.mensaje;
        objectResult = objectResult.habitacion;
    }
    if (objectResult.Estat_habitacion === "bloquejat") {
        formCreateReserva.style.display = 'none';
        buttonsRoomBlock.innerHTML = "Desbloquejar habitacio";
        buttonsRoomBlock.style.backgroundColor = "#41F053";
    }else{formCreateReserva.style.display = 'block';}
    divDialogEstatHabitacio.textContent = objectResult.Estat_habitacion;
    divDialogEstatHabitacio.id = "estatHabitacion";
    divDialogNumHabitacio.textContent = objectResult.Nombre_llits;
    divDialogServeisHabitacio.textContent = objectResult.Nom_servei;
    divDialogTipusHabitacio.textContent = objectResult.Nom_tipus_habitacio;
    if (mensaje) {
        divDialogReservaHabitacio.textContent=objectResult.mensaje;
        divCheckBtn.style.display = "none";
        buttonsRoomBlock.id = objectResult.Habitacio_id;
        btnCreateReservatipusHabitacio.value = objectResult.Nom_tipus_habitacio;
    } else {
        divCheckBtn.style.display = "flex";
        const NomClientH4 = document.createElement("h4");
        NomClientH4.textContent = "Nom client";
        divDialogReservaHabitacio.appendChild(NomClientH4)

        const identificadorClient = document.createElement("p");
        identificadorClient.textContent = objectResult.Identificador_client;
        divDialogReservaHabitacio.appendChild(identificadorClient);

        const h4IdentificadorReserva = document.createElement("h4");
        h4IdentificadorReserva.textContent = "identificador reserva";
        divDialogReservaHabitacio.appendChild(h4IdentificadorReserva);

        const identificadorReserva = document.createElement("p");
        identificadorReserva.textContent = objectResult.Identificador_reserva;
        divDialogReservaHabitacio.appendChild(identificadorReserva);

        buttonsCheckIn.id = objectResult.Identificador_reserva;
        buttonsCheckOut.id = objectResult.Identificador_reserva;
        buttonsRoomBlock.id = objectResult.Habitacio_id;
        btnCreateReservatipusHabitacio.value = objectResult.Nom_tipus_habitacio;
    }
}
function functionClickRoom() {
    const divHabitacions = document.querySelectorAll(".habitacion");
    divHabitacions.forEach((habitacion) => {
        habitacion.addEventListener("click", async (event)=> {
            try {
                event.preventDefault();
                const response = await fetch(
                    `/api/rooms/detail/${habitacion.id}`,
                    {
                        method: "GET",
                        headers: {
                            "Content-Type": "application/json",
                            // "X-CSRF-TOKEN": token,
                        },
                    }
                );

                //Si la resposta es correcta cridara la funcio per crear els contenidors
                if (response.ok) {
                    const result = await response.json();
                    roomManagment.showModal();
                    omplirDialog(result, habitacion.id);
                } else {
                    const errorMessage = await response.text();
                    console.error("Error", errorMessage);
                }
            } catch (error) {
                console.error("Error:", error);
            }
        });
    });
}
functionClickRoom();

btnCloseDialogRoomManagement.addEventListener("click",()=> {
    divDialogEstatHabitacio.innerHTML = "";
    divDialogNumHabitacio.innerHTML = "";
    divDialogServeisHabitacio.innerHTML = "";
    divDialogTipusHabitacio.innerHTML ="";
    divDialogReservaHabitacio.innerHTML="";
    roomManagment.close();
});

formCheckIn.addEventListener("submit", async (event)=> {
    try {
        event.preventDefault();
        const token = document.querySelector('input[name="_token"]').value;
        const response = await fetch(`/api/rooms/detail/checkIn`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(buttonsCheckIn.id),
        });

        //Si la resposta es correcta cridara la funcio per crear els contenidors
        if (response.ok) {
            const estatHabitacion = document.querySelector("#estatHabitacion");
            estatHabitacion.innerHTML = "ocupat";
        } else {
            const errorMessage = await response.text();
            console.error("Error", errorMessage);
        }
    } catch (error) {
        console.error("Error:", error);
    }
});

formCheckOut.addEventListener("submit", async (event)=> {
    try {
        event.preventDefault();
        const token = document.querySelector('input[name="_token"]').value;
        const response = await fetch(`/api/rooms/detail/checkOut`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(buttonsCheckIn.id),
        });

        //Si la resposta es correcta cridara la funcio per crear els contenidors
        if (response.ok) {
            const estatHabitacion = document.querySelector("#estatHabitacion");
            estatHabitacion.innerHTML = "lliure";
        } else {
            const errorMessage = await response.text();
            console.error("Error", errorMessage);
        }
    } catch (error) {
        console.error("Error:", error);
    }
});

document.addEventListener("DOMContentLoaded", () => {
    const prevButton = document.getElementById("prev-button");
    const nextButton = document.getElementById("next-button");
    const calendarContainer = document.querySelector("#calendar-container");
    const currentStartDate = new Date(); // Fecha inicial
    const diesAvanç=5;
    const diaSet=7;
    currentStartDate.setDate(currentStartDate.getDate() - diesAvanç); // Inicia 5 días antes de hoy
    // Función para actualizar el calendario
    const updateCalendar = async (startDate) => {
        try {
            const response = await fetch(`/room-management?start_date=${startDate.toISOString().split("T")[0]}`);
            const html = await response.text();
            // Extraer el contenido de #calendar-container del HTML recibido
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, "text/html");
            const newCalendar = doc.querySelector("#calendar-container");
            // Reemplazar solo el contenido del calendario
            calendarContainer.innerHTML = newCalendar.innerHTML;
            omplirDadesColumnaFilaGrid();
            recollirReserves();
            functionClickRoom();
            const prevButton = document.getElementById("prev-button");
            const nextButton = document.getElementById("next-button");
            nextButton.addEventListener("click", () => {
                currentStartDate.setDate(currentStartDate.getDate() + diaSet);
                updateCalendar(currentStartDate);
            });
            prevButton.addEventListener("click", () => {
                currentStartDate.setDate(currentStartDate.getDate() - diaSet);
                updateCalendar(currentStartDate);
            });
        } catch (error) {
            console.error("Error al actualitzar el calendari:", error);
        }
    };

    // Avanzar 7 días
    nextButton.addEventListener("click", () => {
        currentStartDate.setDate(currentStartDate.getDate() + diaSet); // Avanza 7 días
        updateCalendar(currentStartDate); // Actualiza el calendario
    });

    // Retroceder 7 días
    prevButton.addEventListener("click", () => {
        currentStartDate.setDate(currentStartDate.getDate() - diaSet); // Retrocede 7 días
        updateCalendar(currentStartDate); // Actualiza el calendario
    });
});

// Event Listener per bloqujar/desbloquejar l'habitació
formRoomBlock.addEventListener("submit", async (event)=>{
    try {
        const formCreateReserva = document.querySelector("#formCreateReserva");
        const btnCrearReserva = document.querySelector("#btnCrearReserva");
        event.preventDefault();
        const token = document.querySelector('input[name="_token"]').value;
        const response = await fetch(`/api/rooms/detail/roomBlock`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token,
            },
            body: JSON.stringify(buttonsRoomBlock.id),
        });

        if (response.ok) {
            const data = await response.json();

            const estatHabitacion = document.querySelector("#estatHabitacion");

            // Condició per mostrar el botó per bloquejar/desbloquejar
            if (data.estat === "bloquejat") {
                estatHabitacion.innerHTML = "bloquejat";
                buttonsRoomBlock.innerHTML = "Desbloquejar habitació";
                buttonsRoomBlock.style.backgroundColor = "#41F053";
                btnCrearReserva.style.display = "none";
            } else {
                estatHabitacion.innerHTML = "lliure";
                buttonsRoomBlock.innerHTML = "Bloquejar habitació";
                buttonsRoomBlock.style.backgroundColor = "";
                formCreateReserva.style.display = "block";
                btnCrearReserva.style.display = "block";
            }
        } else {
            const errorMessage = await response.text();
            console.error("Error", errorMessage);
        }
    } catch (error) {
        console.error("Error:", error);
    }
});

