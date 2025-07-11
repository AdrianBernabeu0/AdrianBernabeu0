"use strict";
const contenenedorSuccess = document.querySelector("#contenedorSuccess");
const btnSuccess = document.querySelector("#btnSuccess");
const contenedorLogin = document.querySelector(".contenedorLogin");
const divLogOut = document.querySelector(".divLogout");
//Missatge de success en home per quan fas click a la x i timeout de 4 segons per borrar automàticament el missatge
if (contenenedorSuccess) {
  btnSuccess.addEventListener('click', () => {
    contenenedorSuccess.innerHTML = '';
  });
  setTimeout(() => {
    contenenedorSuccess.innerHTML = '';
  }, 4000);
}
contenedorLogin.addEventListener("click", () => {
  divLogOut.style.display = "flex";
});

window.addEventListener('click', (event) => {
  if (!contenedorLogin.contains(event.target) && !divLogOut.contains(event.target)) {
    divLogOut.style.display = "none";
  }
});

window.addEventListener('scroll', () => {
  divLogOut.style.display = "none";
});