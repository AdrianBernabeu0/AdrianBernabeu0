let comptador = 0;
let associada = '';
let arrayOpcions = []; 
let arrayPreguntes = [];
const tornaALaPaginaAnterior = document.getElementById('tornaALaPaginaAnterior');
const acabaDeVisualitzar = document.querySelector('.acabaDeVisualitzar');
const hiddenInputVistaPreviaDiapositives = document.getElementById('hiddenInputVistaPreviaDiapositives');
const hiddenInputVistaPreviaDiapositivesTrim = hiddenInputVistaPreviaDiapositives.value.trim();
const arrayDiapositives = JSON.parse(hiddenInputVistaPreviaDiapositivesTrim);
const vistaPreviaPresentacioDiapositives = document.querySelector('.vistaPreviaPresentacioDiapositives');
const hiddenInputVistaPreviaDiapositivesAmbPregunta = document.getElementById('hiddenInputVistaPreviaDiapositivesAmbPregunta');
const contingutDiapositivesScroll = document.querySelector('.contingutDiapositivesScroll');
if (hiddenInputVistaPreviaDiapositivesAmbPregunta !== null) {
  const hiddenInputVistaPreviaDiapositivesAmbPreguntaTrim = hiddenInputVistaPreviaDiapositivesAmbPregunta.value.trim();
  arrayPreguntes = JSON.parse(hiddenInputVistaPreviaDiapositivesAmbPreguntaTrim);
}
const diapositivaEndavant = document.querySelectorAll('.diapositivaEndavant');
const diapositivaEnrere = document.querySelectorAll('.diapositivaEnrere');
const formulariRedireccio = document.getElementById('formulariRedireccio');
let mostraMiniatures = document.querySelector('.mostraMiniatures');
const contenidorMiniatures = document.querySelector('.contenidorMiniatures');
const hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions = document.getElementById('hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions');
if (hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions !== null) {
  const hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcionsTrim = hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions.value.trim();
  arrayOpcions = JSON.parse(hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcionsTrim);
}




function afegeixAContenidorDiapositives(diapositiva) {
  vistaPreviaPresentacioDiapositives.innerHTML = '';
  vistaPreviaPresentacioDiapositives.appendChild(diapositiva);
}

// Funcio que afegeix la diapositiva 
function afegeixADiapositiva(titol, contingut, tipus) {
  const diapositiva = document.createElement('div');
  diapositiva.setAttribute('class', 'diapositivaVistaPrevia');

  const titolDiapositiva = document.createElement('p');
  titolDiapositiva.setAttribute('class', 'titolVistaPrevia');
  titolDiapositiva.textContent = titol;

  const contingutDiapositiva = document.createElement('p');
  contingutDiapositiva.setAttribute('class', 'contingutVistaPrevia');
  contingutDiapositiva.textContent = contingut;

  if (contingutDiapositiva.textContent === "") {
    titolDiapositiva.setAttribute('class', 'titolVistaPreviaSol');
    diapositiva.appendChild(titolDiapositiva);
    vistaPreviaPresentacioDiapositives.style.justifyContent = 'center';

  } else {
    if (contingutDiapositiva.textContent.length > 100) {
      contingutDiapositiva.style.fontSize = '2rem';
    }
    if (contingutDiapositiva.textContent.length > 300) {
      contingutDiapositiva.style.fontSize = '1.5rem';
    }
    if (contingutDiapositiva.textContent.length > 600) {
      contingutDiapositiva.style.fontSize = '1rem';
    }
    diapositiva.appendChild(titolDiapositiva);
    diapositiva.appendChild(contingutDiapositiva);
    vistaPreviaPresentacioDiapositives.style.justifyContent = 'flex-start';
  }

  afegeixAContenidorDiapositives(diapositiva);
}

function afegeixADiapositivaTest(pregunta, opcions, titol) {
  const diapositiva = document.createElement('div');
  diapositiva.setAttribute('class', 'diapositivaVistaPrevia');

  const titolDiapositiva = document.createElement('p');
  titolDiapositiva.setAttribute('class', 'titolVistaPrevia');
  titolDiapositiva.textContent = titol;

  const contenidorTests = document.createElement('div');
  contenidorTests.setAttribute('class', 'contenidorTests');

  const tests = document.createElement('p');
  tests.setAttribute('class', 'testVistaPrevia');
  tests.textContent = pregunta;

  const opcionsPregunta = document.createElement('div');
  opcionsPregunta.setAttribute('class', 'testVistaPrevia');


  opcions.forEach((opcio, index) => {
    const radio = document.createElement('input');
    radio.setAttribute('type', 'radio');
    radio.setAttribute('name', 'resposta');
    radio.setAttribute('value', opcio.trim());
    radio.setAttribute('id', `opcio${index}`);
    radio.setAttribute('disabled', 'true');
    radio.setAttribute('class', 'radioVistaPrevia');

    const label = document.createElement('label');
    label.setAttribute('for', `opcio${index}`);
    label.setAttribute('class', 'labelTest');
    label.textContent = opcio.trim();

    opcionsPregunta.appendChild(radio);
    opcionsPregunta.appendChild(label);
  });

  diapositiva.appendChild(titolDiapositiva);
  diapositiva.appendChild(contenidorTests);
  contenidorTests.appendChild(tests);
  contenidorTests.appendChild(opcionsPregunta);

  afegeixAContenidorDiapositives(diapositiva);
}

function afegeixALlistaAssociades(pregunta, opcions, respostaCorrecte) {
  const diapositiva = document.createElement('div');
  diapositiva.setAttribute('class', 'diapositivaVistaPrevia');

  const contenidorTests = document.createElement('div');
  contenidorTests.setAttribute('class', 'contenidorTests');

  const tests = document.createElement('p');
  tests.setAttribute('class', 'testVistaPrevia');
  tests.textContent = pregunta;

  const opcionsPregunta = document.createElement('div');
  opcionsPregunta.setAttribute('class', 'testVistaPrevia');

  const resposta = document.createElement('p');
  resposta.setAttribute('class', 'testVistaPrevia');
  
  

  opcions.forEach((opcio, index) => {
    const radio = document.createElement('input');
    radio.setAttribute('type', 'radio');
    radio.setAttribute('name', 'resposta');
    radio.setAttribute('value', opcio.trim());
    radio.setAttribute('id', `opcio${index}`);
    radio.setAttribute('disabled', 'true');
    radio.setAttribute('class', 'radioVistaPrevia');
    if (sessionStorage.getItem(`${radio.value}`) === radio.value) {
      radio.checked = true;
    }
    if (index === parseInt(respostaCorrecte - 1)) {
      resposta.textContent = radio.value;
    }
    
    const label = document.createElement('label');
    label.setAttribute('for', `opcio${index}`);
    label.setAttribute('class', 'labelTest');
    label.textContent = opcio.trim();

    opcionsPregunta.appendChild(radio);
    opcionsPregunta.appendChild(label);
  });

  

  diapositiva.appendChild(contenidorTests);
  contenidorTests.appendChild(tests);
  contenidorTests.appendChild(opcionsPregunta);
  contenidorTests.appendChild(resposta);

  afegeixAContenidorDiapositives(diapositiva);
}


function afegeixADiapositivaTestClient(titol, pregunta, respostaCorrecte, opcions, associada, id) {
  const diapositiva = document.createElement('div');
  diapositiva.setAttribute('class', 'diapositivaVistaPrevia');

  const titolDiapositiva = document.createElement('p');
  titolDiapositiva.setAttribute('class', 'titolVistaPrevia');
  titolDiapositiva.textContent = titol;

  const contenidorTests = document.createElement('div');
  contenidorTests.setAttribute('class', 'contenidorTests');

  const tests = document.createElement('p');
  tests.setAttribute('class', 'testPreguntaVistaPrevia');
  tests.textContent = pregunta;

  const opcionsPregunta = document.createElement('div');
  opcionsPregunta.setAttribute('class', 'testOpcionsVistaPrevia');

  const submitButton = document.createElement('button');
  if (sessionStorage.getItem(`${pregunta}${id}`) === tests.textContent && associada === 'S') {
    submitButton.textContent = 'Veure resposta';
    opcionsPregunta.appendChild(submitButton);
  }
  else{
    if (sessionStorage.getItem(`${pregunta}${id}`) === tests.textContent && associada === 'N') {
      submitButton.style.display = 'none';
    }
    else{
      submitButton.textContent = 'Guardar resposta';
      opcionsPregunta.appendChild(submitButton);
    }
  }
  

  let radioValue = '';

  opcions.forEach((opcio, index) => {
    const radio = document.createElement('input');
    if (sessionStorage.getItem(`${pregunta}${id}`) === tests.textContent ) {
      radio.setAttribute('type', 'radio');
      radio.setAttribute('name', 'resposta');
      radio.setAttribute('value', opcio.trim());
      radio.setAttribute('id', `opcio${index}`);
      radio.setAttribute('disabled', 'true');
      radio.setAttribute('class', 'radioVistaPrevia');
    } else {
      radio.setAttribute('type', 'radio');
      radio.setAttribute('name', 'resposta');
      radio.setAttribute('value', opcio.trim());
      radio.setAttribute('id', `opcio${index}`);
      radio.setAttribute('class', 'radioVistaPrevia');
    }
    if (sessionStorage.getItem(`${radio.value}`) === radio.value) {
      radio.checked = true;
    }

    const label = document.createElement('label');
    label.setAttribute('for', `opcio${index}`);
    label.setAttribute('class', 'labelTest');
    label.textContent = opcio.trim();

    radio.addEventListener('click', () => {
      radioValue = radio.value;
    });

    opcionsPregunta.appendChild(radio);
    opcionsPregunta.appendChild(label);
  });

  submitButton.addEventListener('click', (e) => {
    sessionStorage.setItem(`${pregunta}${id}`, tests.textContent);
    sessionStorage.setItem(`${radioValue}`, radioValue);
    if (associada === 'S' && sessionStorage.getItem(`${pregunta}${id}`) === tests.textContent) {
      afegeixALlistaAssociades(pregunta, opcions, respostaCorrecte);
    }
  })

  diapositiva.appendChild(titolDiapositiva);
  diapositiva.appendChild(contenidorTests);
  contenidorTests.appendChild(tests);
  contenidorTests.appendChild(opcionsPregunta);

  afegeixAContenidorDiapositives(diapositiva);
}

// Funcio que actualitza la diapositiva que surt en la vista previa
let opcions = []; 

function actualizarDiapositiva() {
  const diapositivaActual = arrayDiapositives[comptador];
  console.table(diapositivaActual);

  if (arrayPreguntes.length > 0) {
    if (arrayOpcions !== null) {
      if (diapositivaActual.tipus === 'preguntesSimples') {
        opcions = []; 
        for (let i = 0; i < arrayOpcions.length; i++) {
          if (diapositivaActual.pregunta_id === arrayOpcions[i]['pregunta_id']) {
            opcions.push(arrayOpcions[i].opcio);
          }
        } for (let i = 0; i < arrayPreguntes.length; i++) {
          if (diapositivaActual.pregunta_id === arrayPreguntes[i]['id']) {
            associada = arrayPreguntes[i]['associada'];
            respostaCorrecte = arrayPreguntes[i]['resposta_correcte'];
            pregunta = arrayPreguntes[i]['pregunta'];
            id = arrayPreguntes[i]['id'];
          }
        }
        console.table(opcions);
        console.log(associada);
        afegeixADiapositivaTestClient(diapositivaActual.titol, pregunta, respostaCorrecte, opcions, associada, id);
      }
      else {
        afegeixADiapositiva(diapositivaActual.titol, diapositivaActual.contingut, diapositivaActual.tipus);
      }
    }
  } else if (diapositivaActual.tipus === 'preguntesSimples') {
    opcions = []; 
    for (let i = 0; i < diapositivaActual.opcions.length; i++) {
      opcions.push(diapositivaActual.opcions[i]);
    }
    console.log('Opcions:', opcions);
    console.log('pregnta:', diapositivaActual.pregunta);
    afegeixADiapositivaTest(diapositivaActual.pregunta, diapositivaActual.opcions, diapositivaActual.titol);
  }
  else {
    afegeixADiapositiva(diapositivaActual.titol, diapositivaActual.contingut, diapositivaActual.tipus);
  }
}





actualizarDiapositiva();
//Permet anar endavant de les diapositives
diapositivaEndavant.forEach(fletxa => {
  fletxa.addEventListener('click', (e) => {
    // desactivaDisplayContenidorMiniatures();
    comptador++;
    if (comptador >= 0 && comptador < arrayDiapositives.length) {
      actualizarDiapositiva();
    } else {
      comptador = arrayDiapositives.length - 1;
    }
  });
});
//Permet anar enrere de les diapositives
diapositivaEnrere.forEach(fletxa => {
  fletxa.addEventListener('click', (e) => {
    // desactivaDisplayContenidorMiniatures();
    comptador--;
    if (comptador >= 0) {
      actualizarDiapositiva();
    } else {
      comptador = 0;
    }
  });
});

//Boto de acabar la visualitzacio que permet anar a la pagina on s'ha activat 
acabaDeVisualitzar.addEventListener('click', (e) => {
  if (formulariRedireccio != null) {
    formulariRedireccio.submit();
  } else {
    tornaALaPaginaAnterior.submit();
  }
});


function desactivaDisplayContenidorMiniatures() {
  contenidorMiniatures.style.display = 'none';
  contenidorMiniatures.childNodes.forEach(child => {
    child.style.display = 'none';
  })
}

if (mostraMiniatures === null) {
  mostraMiniatures = '';
} else {
  mostraMiniatures.addEventListener('click', (e) => {
    contenidorMiniatures.style.display = 'flex';
    contenidorMiniatures.childNodes.forEach((child, index) => {
      child.style.display = 'flex';
      if (comptador === index) {
        child.style.border = '4px solid #FF51FF';
      }
      else {
        if (child.classList.contains('dark')) {
          child.style.border = '2px solid white';
        }
        else {
          child.style.border = '2px solid black';
        }
      }
      child.addEventListener('click', (e) => {
        comptador = index;
        actualizarDiapositiva();
        desactivaDisplayContenidorMiniatures();
      })
    });
  })
}