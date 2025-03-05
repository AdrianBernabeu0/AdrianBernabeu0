let comptador = 0;

const tornaALaPaginaAnterior = document.getElementById('tornaALaPaginaAnterior');
const acabaDeVisualitzar = document.querySelector('.acabaDeVisualitzar');
const hiddenInputVistaPreviaDiapositives = document.getElementById('hiddenInputVistaPreviaDiapositives');
const  hiddenInputVistaPreviaDiapositivesTrim = hiddenInputVistaPreviaDiapositives.value.trim();
const arrayDiapositives = JSON.parse(hiddenInputVistaPreviaDiapositivesTrim);
const vistaPreviaPresentacioDiapositives = document.querySelector('.vistaPreviaPresentacioDiapositives');

const hiddenIdClickable = document.getElementById("idDiapositivaClicable"); 

function afegeixAContenidorDiapositives(diapositiva) {
  vistaPreviaPresentacioDiapositives.innerHTML = '';
  vistaPreviaPresentacioDiapositives.appendChild(diapositiva);
}
// Funcio que afegeix la diapositiva 
function afegeixADiapositiva(titol, contingut) {
  const diapositiva = document.createElement('div');
  diapositiva.setAttribute('class', 'diapositivaVistaPrevia');

  const titolDiapositiva = document.createElement('p');
  titolDiapositiva.setAttribute('class', 'titolVistaPrevia');
  titolDiapositiva.textContent = titol;

  const contingutDiapositiva = document.createElement('p');
  contingutDiapositiva.setAttribute('class', 'contingutVistaPrevia');
  contingutDiapositiva.textContent = contingut;
  
  if(contingutDiapositiva.textContent === ""){
    titolDiapositiva.setAttribute('class', 'titolVistaPreviaSol');
    diapositiva.appendChild(titolDiapositiva);
    vistaPreviaPresentacioDiapositives.style.justifyContent = 'center'; 
  }else{
    diapositiva.appendChild(titolDiapositiva);
    diapositiva.appendChild(contingutDiapositiva);
    vistaPreviaPresentacioDiapositives.style.justifyContent = 'flex-start';
  }

  afegeixAContenidorDiapositives(diapositiva);
}
// Funcio que actualitza la diapositiva que surt en la vista previa
function actualizarDiapositiva() {
  const diapositivaActual = arrayDiapositives[hiddenIdClickable.value];
  afegeixADiapositiva(diapositivaActual.titol, diapositivaActual.contingut);
}

actualizarDiapositiva();
// Boto per torna a la pagina on s'ha activat la vista previa 
acabaDeVisualitzar.addEventListener('click', (e) => {
  tornaALaPaginaAnterior.submit();
});

