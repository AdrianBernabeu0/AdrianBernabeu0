"use strict";
let contenedorError = document.querySelector('#error');
let hasError = false;

//Funció per validar el correu electrònic
export function emailValidation(email){
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(email)) {
    contenedorError.innerHTML = 'Si us plau, introdueix una adreça de correu electrònic vàlida.';
    hasError = true;
    return hasError;
}
}
//Funció per validar el telèfon
export function telefonValidation(telefon){
  const telefonRegex = /^\d{9}$/;
  if (!telefonRegex.test(telefon)) {
    contenedorError.innerHTML = 'El telèfon ha de contenir 9 dígits numèrics.';
    hasError = true
    return hasError;
}
}