"use strict";
//Mòdul de Validacions 
import { emailValidation, telefonValidation } from './validation.js';

let formHotel = document.querySelector('#formHotel');

formHotel.addEventListener("submit", function (e) {
    let nom = document.querySelector('#nom').value.trim();
    let direccio = document.querySelector('#direccio').value.trim();
    let ciutat = document.querySelector('#ciutat').value.trim();
    let pais = document.querySelector('#pais').value.trim();
    let telefon = document.querySelector('#telefon').value.trim();
    let email = document.querySelector('#email').value.trim();
    let identificadorHotel = document.querySelector('#identificadorHotel').value.trim();
    let contenedorError = document.querySelector('#error');

    e.preventDefault();
    contenedorError.innerHTML = '';
    let hasError = false;
    //Validació camps obligatoris
    if (!nom || !direccio || !ciutat || !pais || !telefon || !email || !identificadorHotel) {
        contenedorError.innerHTML = 'Tots els camps marcats amb * són obligatoris.';
        hasError = true;
    }
    //Validació email
    let ValidacióEmail = emailValidation(email);

    //Validació telèfon
    let ValidacióTelefon = telefonValidation(telefon);

    if (!hasError && !ValidacióEmail && !ValidacióTelefon) {
      formHotel.submit();
    }
});
