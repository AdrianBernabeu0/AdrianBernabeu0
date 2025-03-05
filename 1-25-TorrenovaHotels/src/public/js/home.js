"use strict";

let contenedorBtnHotel = document.querySelectorAll(".contenedorBtnHotel");
let modalHotel = document.querySelector("#modalHotel");
let targetaUsuari = document.querySelectorAll(".targetaUsuari");
let mensajeSuccess = document.querySelector("#mensaje-success");
let btnCloseDialog = document.querySelector("#btnCloseDialog");
let formCrearUsuari = document.querySelector(".formCrearUsuari");
let idHotel = null;

btnCloseDialog.addEventListener("click", function () {
    modalHotel.close();
});

// Funció per crear el missatge de success quan s'associï correctament un usuari a un hotel.
function creacioMessageSuccess(result) {
    let contenedorSuccess = document.createElement("div");
    contenedorSuccess.classList.add("contenedorSuccess");
    contenedorSuccess.id = "contenedorSuccess";

    let successDiv = document.createElement("div");
    successDiv.classList.add("success");

    let p = document.createElement("p");
    p.textContent = result.success;

    let btnSuccess = document.createElement("button");
    btnSuccess.classList.add("btnCerrarAlert");
    btnSuccess.id = "btnSuccess";
    btnSuccess.textContent = "X";

    successDiv.appendChild(p);
    successDiv.appendChild(btnSuccess);

    contenedorSuccess.appendChild(successDiv);

    mensajeSuccess.appendChild(contenedorSuccess);
    mensajeSuccess.hidden = false;

    btnSuccess.addEventListener("click", () => {
        mensajeSuccess.hidden = true;
        mensajeSuccess.innerHTML = "";
    });
    setTimeout(() => {
        mensajeSuccess.hidden = true;
        mensajeSuccess.innerHTML = "";
    }, 4000);
}

contenedorBtnHotel.forEach(function (btn) {
    btn.addEventListener("click", function (e) {
        let botonHotel = btn.querySelector("button");
        idHotel = botonHotel.id;
        modalHotel.showModal();
    });
});

formCrearUsuari.addEventListener("submit", async function (e) {
    e.preventDefault();
    try {
        // Utilitzem el formData per fer la validacio en js
        const formData = new FormData(formCrearUsuari);

        let nomUsuari = formData.get("nomUsuari");
        let contrasenyaUsuari = formData.get("contrasenyaUsuari");
        let errorMessageDiv = document.querySelector("#errorMessage");
        let errorText = document.querySelector("#errorText");

        //Validació per verificar que els camps no estiguin buits
        if (!nomUsuari || !contrasenyaUsuari) {
            errorText.textContent = "";
            errorText.textContent ="Nom d'usuari/contrasenya són obligatoris";
            errorMessageDiv.style.display = "block";
            return;
        }
        // Validació per comprobar que els camps no tinguin mes de 255 caracters
        if (nomUsuari.length > 255 || contrasenyaUsuari.length > 255) {
            errorText.textContent = "";
            errorText.textContent = "Nom d'usuari/contrasenya no poden superar els 255 caràcters"; 
            errorMessageDiv.style.display = "block";
            return;
        }

        let response = await fetch(`/api/home/usuariHotel`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('input[name="_token"]')
                    .value,
            },
            body: JSON.stringify({ idHotel, nomUsuari, contrasenyaUsuari }), // Se envía el idHotel correctamente
        });

        if (response.ok) {
            let result = await response.json();
            modalHotel.close();
            creacioMessageSuccess(result);
        } else {
            const errorMessage = await response.json();

            errorText.textContent = errorMessage.error;
            errorMessageDiv.style.display = "block";
        }
    } catch (error) {
        console.error("Error inesperado:", error);
    }
});
