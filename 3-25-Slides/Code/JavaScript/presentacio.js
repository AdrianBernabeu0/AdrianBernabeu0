let arrayDiapositiva = [];
let titols = [];
let contingut = [];
let tipus = [];
let posicion=[];
let tipusDiapositiva = false;
let contadorPosicion=1;
let arrayPreguntes = [];
let tipusDiapositivaTest = false;

const diapositiva = document.querySelector('.diapositiva');
const buttonAfegirTitol = document.getElementById('afegirTitol');
const buttonAfegirTitolContingut = document.getElementById('afegirTitolContingut');
const contenidorDiapositives = document.getElementById('PadrecontenedorDiapositivas');
const iconaAfegir = document.querySelector('#afegirDiapositives');
const hiddenInputTitols = document.getElementById('titolDiapositives');
const hiddenInputContingut = document.getElementById('contingutDiapositives');
const buttonEnviarDadesPresentacio = document.querySelector('.botoGuardarPresentacio');
const form = document.getElementById('enviaDadesPresentacio');
const hiddenInputTipus = document.getElementById('tipusDiapositiva');
const hiddenInputPosicion = document.getElementById('posicioDiapositiva');
const hiddenInputArrayDiapositives = document.getElementById('hiddenInputArrayDiapositives');

const botoPrevisualitzar = document.getElementById("PrevisualitzarPresentacio");
const claseOpcionsPresentacio = document.querySelector(".opcionsPresentacio");
const claseBotons = document.querySelector(".divBotoGuardarPresentacio");
const nav = document.querySelector("nav");
const cajaDiapositiva = document.querySelector(".boxDiapositives");
const hiddenInputVistaPreviaDiapositives = document.getElementById('hiddenInputVistaPreviaDiapositives');
const hiddenInputVistaPreviaURL = document.getElementById('hiddenInputVistaPreviaURL');
const formVistaPrevia = document.getElementById('formVistaPrevia');
const titolPresentacio = document.getElementById('titolPresentacio');
const descripcioPresentacio = document.getElementById('descripcioPresentacio');
const descripcioPresentacioVistaPrevia = document.getElementById('descripcioPresentacioVistaPrevia');
const titolPresentacioVistaPrevia = document.getElementById('titolPresentacioVistaPrevia');
const estilPresentacioVistaPrevia = document.getElementById('estilPresentacioVistaPrevia');
const diapositivaPreguntes = document.getElementById('Test');
const hiddenInputPreguntesAmbOpcions = document.getElementById('hiddenInputPreguntesAmbOpcions');
const dialeg = document.getElementById('dialeg');
const yesButton = document.getElementById('yesButton');
const noButton = document.getElementById('noButton');

// Aquesta funció, amb una variable de tipus booleà, determina quin tipus de diapositiva afegeix al contenidor de la diapositiva
function creaDiapositiva(tipusDiapositiva, clone) {
    diapositiva.innerHTML = '';
    if (tipusDiapositiva) {
        diapositiva.appendChild(clone);
    } else {
        diapositiva.appendChild(clone);
    }
}

// Afegeix la diapositiva al contenidor scrolleable
function afegeixDiapositivaAContenidor(diapositivaNova) {
    contenidorDiapositives.appendChild(diapositivaNova);
}

// Aquesta funció crea el contingut que anirà dins de la diapositiva al contenidor de diapositives, assigna les ID de les diapositives i crida a la funció afegeixDiapositivaAContenidor
function creaDiapositivaAContenidor(diapositiva, index) {
    const titol = document.createElement('p');
    const contingut = document.createElement('p');
    const opcions = document.createElement('p');
    const pregunta = document.createElement('p');
    const respostaCorrecte = document.createElement('p');
    titol.textContent = diapositiva.titol;
    contingut.textContent = diapositiva.contingut;
    if (contingut.textContent.length > 100) {
      contingut.style.fontSize = '0.5rem';
    }
    if (contingut.textContent.length > 200) {
      contingut.style.fontSize = '0.3rem';
    }
    if (contingut.textContent.length > 600) {
      contingut.style.fontSize = '0.2rem';
    }
    
    opcions.textContent = diapositiva.opcions;
    pregunta.textContent=diapositiva.pregunta;
    respostaCorrecte.textContent=diapositiva.respostaCorrecte;
    const diapositivaNova = document.createElement('div');
    titol.setAttribute('class','titolDiapositivesScroll');
    contingut.setAttribute('class','contingutDiapositivesScroll');
    opcions.setAttribute('class','tipusDiapositivesScroll');
    pregunta.setAttribute('class','tipusDiapositivesScroll');
    respostaCorrecte.setAttribute('class','tipusDiapositivesScroll');
    diapositivaNova.setAttribute('id', `Diapositiva${index + 1}`);
    if(diapositiva.contingut === null){
        if (diapositiva.pregunta != null) {
          diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleableTest ${estilPresentacioVistaPrevia.value}`);
          diapositivaNova.append(titol, pregunta,opcions);
        }
        else{
          diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleableNomesTitol ${estilPresentacioVistaPrevia.value}`);
          diapositivaNova.appendChild(titol);
        }
      } 
      
      else{
      diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleable ${estilPresentacioVistaPrevia.value}`);
      diapositivaNova.appendChild(titol);
      diapositivaNova.appendChild(contingut);
    }

    afegeixDiapositivaAContenidor(diapositivaNova);
}

// Aquesta funció buida el contenidor de diapositives i el torna a emplenar recorrent l'arrayDiapositiva
const actualitzaContenidorDiapositives = () => {
    contenidorDiapositives.innerHTML = '';
    arrayDiapositiva.forEach((diapositiva, index) => {
        creaDiapositivaAContenidor(diapositiva, index);
    });
}


// Aquesta funció afegeix al arrayDiapositiva les dades de la diapositiva, mirant el seu ID i determinant si es d'un tipus o l'altre 
function afegeixALlistaDiapositives(diapositivaAssociada) {
  let diapositivaActual = {
    titol: null,
    contingut: null,
    tipus: null,
    posicion: null,
    pregunta: null,
    opcions: [],
    respostaCorrecte: null,
    associada: diapositivaAssociada
  };


  const diapositives = document.querySelectorAll('.inputOpcionsPesentacio');

  diapositives.forEach((diapositiva) => {
    
    if (diapositiva.id === 'ContingutDiapositiva' && diapositiva.value) {
      diapositivaActual.contingut = diapositiva.value;
    }

    if (diapositiva.id === 'titolDiapositivaContingut' && diapositiva.value) {
      diapositivaActual.titol = diapositiva.value;
      diapositivaActual.tipus = 'titolContingut';
      diapositivaActual.posicion = contadorPosicion;
    }

    if (diapositiva.id === 'titolDiapositiva' && diapositiva.value) {
      diapositivaActual.titol = diapositiva.value;
      diapositivaActual.tipus = 'nomesTitol';
      diapositivaActual.posicion = contadorPosicion;
    }
    if(diapositiva.id === 'titolPreguntaDiapositiva' && diapositiva.value){
      diapositivaActual.titol = diapositiva.value;
      diapositivaActual.posicion = contadorPosicion;
      diapositivaActual.tipus = 'preguntesSimples';
    }
    if (diapositiva.id === 'contenidorPregunta') {
      const pregunta = diapositiva.querySelector('.preguntes');
      const opcions = diapositiva.querySelectorAll('.opcionsPregunta');
      const opcioCorrecte = diapositiva.querySelector('.opcioCorrecte');
   
      if (pregunta) {
         diapositivaActual.pregunta = pregunta.value;
      }
   
      if (opcions) {
        opcions.forEach((opcio) => {
          diapositivaActual.opcions.push(opcio.value);
        })
      }
   
      if (opcioCorrecte) {
         diapositivaActual.respostaCorrecte = opcioCorrecte.value;
      }
   }
  });

  if (diapositivaActual.titol || diapositivaActual.contingut) {
    arrayDiapositiva.push(diapositivaActual);
    contadorPosicion++;
  }

  actualitzaContenidorDiapositives();
}
    

/* 
Aquest event s'activa quan es prem el botó de 'Guardar presentació'. 
Recorre l'arrayDiapositiva i va afegint tots els titols a l'array titols i tots els continguts a l'array contingut.
Després, afegeix al hidden input corresponent les dades d'aquests arrays separats per '!#$%&!' amb .join('!#$%&!') 
*/
buttonEnviarDadesPresentacio.addEventListener('click', (e) => {
  e.preventDefault();
  hiddenInputArrayDiapositives.value = JSON.stringify(arrayDiapositiva);
  // hiddenInputPreguntesAmbOpcions.value = JSON.stringify(arrayPreguntes);
  form.submit();
});
      
    
    


// Aquest s'activa cada cop que es prem el botó 'Afegir titol'. Copia el template de diapositiva de tipus titol, i crida la funció creaDiapositiva
buttonAfegirTitol.addEventListener("click", (e) => {
    tipusDiapositiva = false;
    const template = document.querySelector(".TitolTemplate");
    const clone = document.importNode(template.content, true);
    creaDiapositiva(tipusDiapositiva, clone);
});

// Aquest s'activa cada cop que es prem el botó 'Afegir titol i contingut'. Copia el template de diapositiva de tipus titol i contingut, i crida la funció creaDiapositiva
buttonAfegirTitolContingut.addEventListener("click", (e) => {
    tipusDiapositiva = true;
    const template = document.querySelector(".TitolContingutTemplate");
    const clone = document.importNode(template.content, true);
    creaDiapositiva(tipusDiapositiva, clone);
});


diapositivaPreguntes.addEventListener("click", (e) => {
  tipusDiapositivaTest = true;
  const template = document.querySelector(".preguntesSimplesTemplate");
  const clone = document.importNode(template.content, true);
  creaDiapositiva(tipusDiapositiva, clone);
});

yesButton.addEventListener('click', (e) => {
  afegeixALlistaDiapositives('S');
  tipusDiapositivaTest = false;
  dialeg.close();
})

noButton.addEventListener('click', (e) => {
  afegeixALlistaDiapositives('N');
  tipusDiapositivaTest = false;
  dialeg.close();
})

// Aquest event s'activa quan es prem el botó d'Afegir diapositiva, i crida a la funció afegeixALlistaDiapositives
iconaAfegir.addEventListener('click', (e) => {
    e.preventDefault();
    if (tipusDiapositivaTest) {
      dialeg.showModal();
    }else {
      afegeixALlistaDiapositives('N');
    }
});


//Aquest event s'activa quan es prem l'icona de l'ull i posa la vista previa de la presentacio
botoPrevisualitzar.addEventListener('click',(e) =>{
  hiddenInputVistaPreviaDiapositives.value = JSON.stringify(arrayDiapositiva);
  hiddenInputVistaPreviaURL.value = window.location.href;
  titolPresentacioVistaPrevia.value=titolPresentacio.value;
  descripcioPresentacioVistaPrevia.value = descripcioPresentacio.value;
  formVistaPrevia.submit();
})


if (hiddenInputVistaPreviaDiapositives.value) {
  arrayDiapositiva = JSON.parse(hiddenInputVistaPreviaDiapositives.value);
  actualitzaContenidorDiapositives();
}