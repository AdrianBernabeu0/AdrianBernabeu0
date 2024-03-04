let arrayDiapositiva = [];
let arrayPrevisualitzacio = [];
let titols = [];
let contingut = [];
let tipus = [];
let posicio=[];
let tipusDiapositiva = false;
let idClicat=null;
let eliminarDiapositiva=[];
let idDiapositives=[];

const diapositiva=document.querySelector('.diapositiva');
let divClicable= document.querySelectorAll(".divClicable");
const buttonAfegirTitol = document.getElementById('afegirTitol');
const buttonAfegirTitolContingut = document.getElementById('afegirTitolContingut');
const contenidorDiapositives = document.getElementById('PadrecontenedorDiapositivas');
const iconesAfegirDiapositives = document.querySelector('#afegirDiapositives');
const hiddenInputTitols = document.getElementById('titolDiapositives');
const hiddenInputContingut = document.getElementById('contingutDiapositives');
const buttonEnviarDadesPresentacio = document.querySelector('.botoGuardarPresentacio');
const form = document.getElementById('enviaDadesPresentacio');
const hiddenInputTipus = document.getElementById('tipusDiapositiva');
const hiddenInputPosicion = document.getElementById('posicioDiapositiva');
const iconaEliminarDiapositives = document.querySelector("#elimina");
const divsDiapositives = document.querySelector('.afegirDiapositives');
const hiddenInputElimina = document.getElementById('eliminaDiapositiva');
const hiddenInputIDDiapositives = document.getElementById('idDiapositives');
const botonCanviarPosicions = document.querySelector(".canviaPosicions");
const iconaAdalt=document.querySelector("#adaltPosicio");
const iconaAbaix=document.querySelector("#abaixPosicio");

const claseOpcionsPresentacio = document.querySelector(".opcionsPresentacio");
const claseBotons = document.querySelector(".divBotoGuardarPresentacio");
const nav = document.querySelector("nav");
const cajaDiapositiva = document.querySelector(".boxDiapositives");

const estilPresentacioHiden = document.getElementById('estilPresentacio');


const formVistaPrevia = document.getElementById('formVistaPrevia');
const hiddenInputVistaPreviaDiapositives = document.getElementById('hiddenInputVistaPreviaDiapositives');
const hiddenInputVistaPreviaURL = document.getElementById('hiddenInputVistaPreviaURL');
const titolPresentacioVistaPrevia = document.getElementById('titolPresentacioVistaPrevia');
const descripcioPresentacioVistaPrevia = document.getElementById('descripcioPresentacioVistaPrevia');
const estilPresentacioVistaPrevia = document.getElementById("estilPresentacioVistaPrevia");
const pinPresentaciovistaPrevia = document.getElementById("hiddenInputVistaPreviaPin");

const dark = document.querySelector('#dark');
const blue = document.querySelector('#blue');

const formVistaPreviaDiapositives = document.getElementById('formVistaPreviaDiapositives');
const hiddenInputPrevisualitzarDiapositives = document.getElementById('hiddenInputPrevisualitzarDiapositives');
const hiddenInputPrevisualitzarURL = document.getElementById('hiddenInputPrevisualitzarURL');
const titolPrevisualitzarDiapositiva = document.getElementById('titolPrevisualitzarDiapositiva');
const descripcioPrevisualitzarDiapositiva = document.getElementById('descripcioPrevisualitzarDiapositiva');
const estilPrevisualitzarDiapositiva = document.getElementById("estilPrevisualitzarDiapositiva");
const pinPrevisualitzarDiapositiva = document.getElementById("pinPrevisualitzarDiapositiva");

let estils=estilPresentacioHiden.value.trim();

const contenidorMissatgeEstatDelete = document.querySelector('.contenidorWarning');

const hiddenIdClickable = document.getElementById("idDiapositivaClicable");
const divButtonsPrevisualitzacio = document.querySelector(".contenidorBotonsPrevisualitzacio");
const botoPrevisualitzarPresentacio = document.getElementById("previsualitzarPresentacio");
const botoPrevisualitzarDiapositiva = document.getElementById("previsualitzarDiapositives");

const presentacioAPublicar = document.getElementById('presentacioAPublicar');
const formPublicaPresentacions = document.getElementById('formPublicaPresentacions');
const hiddenInputUrlPaginaPublicar = document.getElementById('hiddenInputUrlPaginaPublicar');
const hiddenInputUrlPaginaDespublicar = document.getElementById('hiddenInputUrlPaginaDespublicar');
const formDespublicaPresentacions = document.getElementById('formDespublicaPresentacions');
const contenidorUrlPublicacio = document.querySelector('.contenidorUrlPublicacio');
const pContenidorUrlPublicacio = document.querySelector('.pContenidorUrlPublicacio');

const hiddenArrayDiapositives = document.getElementById('hiddenArrayDiapositives');
const hiddenEstil = document.getElementById('hiddenEstil');
const hiddenTitolPresentacio = document.getElementById('hiddenTitolPresentacio');
const hiddenDecripcioPresentacio = document.getElementById('hiddenDecripcioPresentacio');
const hiddenPin = document.getElementById('hiddenPin');

const despublicaArrayDiapositives = document.getElementById('despublicaArrayDiapositives');
const despublicaEstil = document.getElementById('despublicaEstil');
const despublicaTitolPresentacio = document.getElementById('formDespublicaPresentacions');
const despublicaDecripcioPresentacio = document.getElementById('despublicaDecripcioPresentacio');
const despublicaPin = document.getElementById('despublicaPin');



// Aquesta funció, amb una variable de tipus booleà, determina quin tipus de diapositiva afegeix al contenidor de la diapositiva
if(divButtonsPrevisualitzacio.id==='previsualitzarHidden'){
  divButtonsPrevisualitzacio.style.visibility ='hidden';
}

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


// Aquesta funció et mostra l'un tipus d'input o l'altre dependent del qual va ser el que has donat clic i mes a mes afegeix a l'array les dades que es va agafar de la base de dades.
const afegirContingutsDiapositives = () => {
  const nouDivClicable=document.querySelectorAll(".divClicable");
  nouDivClicable.forEach(liniaDiapositiva => {
    let contador=liniaDiapositiva.id.match(/(\d+)/g);
    liniaDiapositiva.addEventListener("click", function() {
        if (liniaDiapositiva.classList.item(2)=='titolContingut') {
          diapositiva.innerHTML='';
           let titolDiapositiva=document.createElement('input');
           titolDiapositiva.id="titolDiapositivaContingut";
           titolDiapositiva.setAttribute('class',`inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva${estils}`);
           titolDiapositiva.setAttribute('placeholder','TITOL');
           titolDiapositiva.setAttribute('maxlength','255');
           titolDiapositiva.setAttribute('value',arrayDiapositiva[contador-1]["titol"]);

           let contingutDiapositiva=document.createElement('textarea');
           contingutDiapositiva.id="ContingutDiapositiva";
           contingutDiapositiva.setAttribute('class',`inputOpcionsPesentacio inputContingutOpcionsPresentacio diapositiva${estils}`);
           contingutDiapositiva.setAttribute('placeholder','CONTINGUT');
           contingutDiapositiva.textContent=arrayDiapositiva[contador-1]["contingut"];
          diapositiva.append(titolDiapositiva,contingutDiapositiva);
          idClicat=contador-1;
          tipusDiapositiva = true;
        }else{
          diapositiva.innerHTML='';
          let titolDiapositiva=document.createElement('input');
          titolDiapositiva.id="titolDiapositiva";
          titolDiapositiva.setAttribute('class',`inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva${estils}`);
          titolDiapositiva.setAttribute('placeholder','TITOL');
          titolDiapositiva.setAttribute('maxlength','255');
          titolDiapositiva.setAttribute('value',arrayDiapositiva[contador-1]["titol"]);
          diapositiva.append(titolDiapositiva);
          idClicat=contador-1;
          tipusDiapositiva = false;
        }
        
    });
  });
  divClicable=nouDivClicable;
};

const actualitzarContenidorPosicion =()=>{
  contenidorDiapositives.innerHTML='';
  arrayDiapositiva.sort((a, b) => a.posicio - b.posicio);
  arrayDiapositiva.forEach((diapositiva, index) => {
        if(diapositiva["tipus"]==='titolContingut'){
          let titolDiapositiva = document.createElement('p');
          titolDiapositiva.textContent = diapositiva["titol"];
          let contingutDiapositiva = document.createElement('p');
          contingutDiapositiva.textContent = diapositiva["contingut"];
          // if (contingut.textContent.length > 100) {
          //   contingut.style.fontSize = '0.5rem';
          // }
          // if (contingut.textContent.length > 200) {
          //   contingut.style.fontSize = '0.3rem';
          // }
          // if (contingut.textContent.length > 600) {
          //   contingut.style.fontSize = '0.2rem';
          // }

          const diapositivaNova = document.createElement('div');
          diapositivaNova.setAttribute('id', `contenedorDiapositiva${index+1}`);
          diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleable divClicable titolContingut ${estils} ${idDiapositives[index]}`);
          diapositivaNova.appendChild(titolDiapositiva);
          diapositivaNova.appendChild(contingutDiapositiva);
          afegeixDiapositivaAContenidor(diapositivaNova);
        }else{
        let titolDiapositiva = document.createElement('p');
        titolDiapositiva.textContent = diapositiva["titol"];
        const diapositivaNova = document.createElement('div');
        diapositivaNova.setAttribute('id', `contenedorDiapositiva${index+1}`);
        diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleableNomesTitol divClicable nomestitol ${estils} ${idDiapositives[index]}`);
        diapositivaNova.appendChild(titolDiapositiva);
        afegeixDiapositivaAContenidor(diapositivaNova);
        }
});
afegirContingutsDiapositives();
}

const actualitzarContenidorPerArray =()=>{
  contenidorDiapositives.innerHTML='';
  arrayDiapositiva.sort((a, b) => a.posicio - b.posicio);
  arrayDiapositiva.forEach((diapositiva, index) => {
        if(diapositiva["tipus"]==='titolContingut'){
          let titolDiapositiva = document.createElement('p');
          titolDiapositiva.textContent = diapositiva["titol"];
          let contingutDiapositiva = document.createElement('p');
          contingutDiapositiva.textContent = diapositiva["contingut"];
          const diapositivaNova = document.createElement('div');
          diapositivaNova.setAttribute('id', `contenedorDiapositiva${index+1}`);
          diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleable divClicable titolContingut ${estils} ${idDiapositives[index]}`);
          diapositivaNova.appendChild(titolDiapositiva);
          diapositivaNova.appendChild(contingutDiapositiva);
          afegeixDiapositivaAContenidor(diapositivaNova);
        }else{
        let titolDiapositiva = document.createElement('p');
        titolDiapositiva.textContent = diapositiva["titol"];
        const diapositivaNova = document.createElement('div');
        diapositivaNova.setAttribute('id', `contenedorDiapositiva${index+1}`);
        diapositivaNova.setAttribute('class', `diapositivesAlContenidorScrolleableNomesTitol divClicable nomestitol ${estils} ${idDiapositives[index]}`);
        diapositivaNova.appendChild(titolDiapositiva);
        afegeixDiapositivaAContenidor(diapositivaNova);
        }
});
let noudiv= document.querySelectorAll(".divClicable");
divClicable=noudiv;
  divClicable.forEach(liniaDiapositiva => {
    liniaDiapositiva.addEventListener('click', (e) => {
      console.log(parseInt(liniaDiapositiva.id.match(/(\d+)/g)-1,10));
      eliminarDiapositiva.push(liniaDiapositiva.classList.item(3))
      hiddenInputElimina.value =eliminarDiapositiva.join('!#$%&!');
      arrayDiapositiva.splice(parseInt(liniaDiapositiva.id.match(/(\d+)/g)-1,10), 1);
      liniaDiapositiva.remove();
      actualitzarContenidorPerArray();
  });
});
}

divClicable.forEach(liniaDiapositiva => {

  let contador=liniaDiapositiva.id.match(/(\d+)/g);
  let diapositivaActual=[];
  idDiapositives.push(liniaDiapositiva.classList.item(3));

  if (liniaDiapositiva.classList.contains('titolContingut')) {
    let contingutTitol=liniaDiapositiva.textContent.split('               ');
    diapositivaActual = {
      titol:contingutTitol[1].replace(/\n/g, '').trim(),
      contingut:contingutTitol[2].replace(/\n/g, '').trim(),
      tipus: 'titolContingut',
      posicio:parseInt(contador [0], 10),
      idDiapositives:parseInt(liniaDiapositiva.classList.item(3),10),
  };
  }else{
    diapositivaActual = {
      titol: liniaDiapositiva.textContent.replace(/\n/g, '').trim(),
      contingut: null,
      tipus: 'nomesTitol',
      posicio:parseInt(contador [0], 10),
      idDiapositives:parseInt(liniaDiapositiva.classList.item(3),10),
  };
  }
  arrayDiapositiva.push(diapositivaActual); 
  actualitzarContenidorPosicion();
});

// Aquesta funció afegeix al arrayDiapositiva les dades de la diapositiva, mirant el seu ID i determinant si es d'un tipus o l'altre 
function afegeixALlistaDiapositives() {

    let diapositivaActual = {
        titol: null,
        contingut: null,
        tipus: null,
        posicio:null
    };
    const diapositives = diapositiva.querySelectorAll('.inputOpcionsPesentacio');
    diapositives.forEach((diapositiva, index) => {
      if (diapositiva.id === 'ContingutDiapositiva' && diapositiva.value) {
        diapositivaActual.contingut = diapositiva.value;
      }
      
      if(tipusDiapositiva){
        if (diapositiva.id === 'titolDiapositivaContingut' && diapositiva.value) {
          diapositivaActual.titol = diapositiva.value;
          diapositivaActual.tipus='titolContingut';
        }
      }else{
        if (diapositiva.id === 'titolDiapositiva' && diapositiva.value) {
          diapositivaActual.titol = diapositiva.value;
          diapositivaActual.tipus='nomesTitol';
        }
      }
    });
    console.table(diapositivaActual);
    if(idClicat!=null){
      arrayDiapositiva[idClicat]['titol']=diapositivaActual['titol'];
      arrayDiapositiva[idClicat]['contingut']=diapositivaActual['contingut'];
      arrayDiapositiva[idClicat]['tipus']=diapositivaActual['tipus'];
    }else{
      for (let index = 0; index <= arrayDiapositiva.length; index++) {
        diapositivaActual.posicio=index+1;
      }
      if (diapositivaActual.titol || diapositivaActual.contingut) {
        arrayDiapositiva.push(diapositivaActual);
        idClicat=diapositivaActual.posicio-1; 
        
     }
     
    }
    actualitzarContenidorPosicion();
}



/* 
Aquest event s'activa quan es prem el botó de 'Guardar presentació'. 
Recorre l'arrayDiapositiva i va afegint tots els titols a l'array titols i tots els continguts a l'array contingut.
Després, afegeix al hidden input corresponent les dades d'aquests arrays separats per '!#$%&!' amb .join('!#$%&!') 
*/
buttonEnviarDadesPresentacio.addEventListener('click', (e) => {
    e.preventDefault();
    arrayDiapositiva.forEach(diapositiva => {
        titols.push(diapositiva.titol);
        contingut.push(diapositiva.contingut);
        tipus.push(diapositiva.tipus);
        posicio.push(diapositiva.posicio);
    });
    hiddenInputTitols.value = titols.join('!#$%&!');
    hiddenInputContingut.value = contingut.join('!#$%&!');
    hiddenInputTipus.value =tipus.join('!#$%&!');
    hiddenInputPosicion.value =posicio.join('!#$%&!');
    hiddenInputIDDiapositives.value= idDiapositives.join('!#$%&!');
    if(estils!=null){
      estilPresentacioHiden.value=estils;
    }
    
    form.submit();
});


// Aquest s'activa cada cop que es prem el botó 'Afegir titol'. Copia el template de diapositiva de tipus titol, i crida la funció creaDiapositiva
buttonAfegirTitol.addEventListener("click", (e) => {
    tipusDiapositiva = false;
    const template = document.querySelector(".TitolTemplate");
    const clone = document.importNode(template.content, true);
    idClicat=null;
    creaDiapositiva(tipusDiapositiva, clone);
    
});

// Aquest s'activa cada cop que es prem el botó 'Afegir titol i contingut'. Copia el template de diapositiva de tipus titol i contingut, i crida la funció creaDiapositiva
buttonAfegirTitolContingut.addEventListener("click", (e) => {
    tipusDiapositiva = true;
    const template = document.querySelector(".TitolContingutTemplate");
    const clone = document.importNode(template.content, true);
    idClicat=null;
    creaDiapositiva(tipusDiapositiva, clone);
});

// Aquest event s'activa quan es prem el botó d'Afegir diapositiva, i crida a la funció afegeixALlistaDiapositives
iconesAfegirDiapositives.addEventListener('click', (e) => {
    e.preventDefault();
    afegeixALlistaDiapositives();
});

iconaEliminarDiapositives.addEventListener('click', (e) => {
  e.preventDefault();
  if (iconaEliminarDiapositives.id==='elimina') {
    iconaEliminarDiapositives.textContent="Parar d'eliminar"
    iconaEliminarDiapositives.id='stopElimina';
  const divClicableActual= document.querySelectorAll(".divClicable");
  divClicable=divClicableActual;
  divsDiapositives.setAttribute('id','eliminarConColor');
  
  divClicable.forEach(liniaDiapositiva => {

    liniaDiapositiva.addEventListener('click', (e) => {
      console.log(parseInt(liniaDiapositiva.id.match(/(\d+)/g)-1,10));
      eliminarDiapositiva.push(liniaDiapositiva.classList.item(3))
      hiddenInputElimina.value =eliminarDiapositiva.join('!#$%&!');

      arrayDiapositiva.splice(parseInt(liniaDiapositiva.id.match(/(\d+)/g)-1,10), 1);
      liniaDiapositiva.remove();
      actualitzarContenidorPerArray();
  });
  });
  }else {
    divsDiapositives.setAttribute('id','eliminarSinColor');
    iconaEliminarDiapositives.textContent='Eliminar Diapositives'
    actualitzarContenidorPosicion();
    iconaEliminarDiapositives.id='elimina';
  }
  });

  function actualizarPosiciones() {
    divClicable.forEach((elemento, index) => {
        elemento.innerHTML = arrayDiapositiva[index]['titol']+arrayDiapositiva[index]['contingut'];
        elemento.id = "contenedorDiapositiva"+(index+1);
        
    });
}

function desactivaDisplayContenidor() {
  contenidorMissatgeEstatDelete.style.display = 'none';
}

setTimeout(desactivaDisplayContenidor, 3000);

    iconaAdalt.addEventListener('click', (e) => {
      if(idClicat!=null){
      contenidorMissatgeEstatDelete.style.display = 'block';
      if (arrayDiapositiva[idClicat-1]!=null) {
        arrayDiapositiva[idClicat]['posicio']-=1;
        arrayDiapositiva[idClicat-1]['posicio']+=1;
        idClicat=idClicat-1;
      }
      }else{
        contenidorMissatgeEstatDelete.style.display = 'block';
        setTimeout(desactivaDisplayContenidor, 3000);
      }
      
      actualitzarContenidorPosicion();
    });

    iconaAbaix.addEventListener('click', (e) => { 
      if(idClicat!=null){
        if (arrayDiapositiva[idClicat+1]!=null) {
          arrayDiapositiva[idClicat]['posicio']+=1;
          arrayDiapositiva[idClicat+1]['posicio']-=1;
          idClicat=idClicat+1;
        }
    }else{
      contenidorMissatgeEstatDelete.style.display = 'block';
      setTimeout(desactivaDisplayContenidor, 3000);
    }
      actualitzarContenidorPosicion();
    });

    dark.addEventListener('click', (e) => { 
      estils="dark";
      actualitzarContenidorPosicion();
      diapositiva.setAttribute('class',`diapositiva ${estils}`)
    });
    blue.addEventListener('click', (e) => { 
      estils="blue";
      actualitzarContenidorPosicion();
      diapositiva.setAttribute('class',`diapositiva ${estils}`)
    });

//Aquest event s'activa quan es prem l'icona de l'ull i posa la vista previa de la presentacio
botoPrevisualitzarDiapositiva.addEventListener('click',(e) =>{
const titolPresentacio = document.getElementById('titolPresentacio');
const descripcioPresentacio = document.getElementById('descripcioPresentacio');
const pinPresentacio = document.getElementById('pinPresentacio');
  hiddenIdClickable.value=idClicat;
  if (hiddenIdClickable.value=="") {
    contenidorMissatgeEstatDelete.style.display = 'block';
        setTimeout(desactivaDisplayContenidor, 3000);
  }else{
    
  hiddenInputPrevisualitzarDiapositives.value = JSON.stringify(arrayDiapositiva);
  hiddenInputPrevisualitzarURL.value = window.location.href;
  titolPrevisualitzarDiapositiva.value=titolPresentacio.value;
  descripcioPrevisualitzarDiapositiva.value = descripcioPresentacio.value;
  estilPrevisualitzarDiapositiva.value=estils;
  pinPrevisualitzarDiapositiva.value = pinPresentacio.value;
  formVistaPreviaDiapositives.submit();
  }
});

  if (hiddenInputPrevisualitzarDiapositives.value) {
    arrayPrevisualitzacio = JSON.parse(hiddenInputPrevisualitzarDiapositives.value);
    for (let index = 0; index < arrayPrevisualitzacio.length; index++) {
      arrayDiapositiva[index]=arrayPrevisualitzacio[index];
      
    }
    actualitzarContenidorPosicion();
  }


botoPrevisualitzarPresentacio.addEventListener('click',(e)=>{
  const titolPresentacio = document.getElementById('titolPresentacio');
  const descripcioPresentacio = document.getElementById('descripcioPresentacio');
  const pinPresentacio = document.getElementById('pinPresentacio');
  hiddenInputVistaPreviaDiapositives.value = JSON.stringify(arrayDiapositiva);
  hiddenInputVistaPreviaURL.value = window.location.href;
  titolPresentacioVistaPrevia.value=titolPresentacio.value;
  descripcioPresentacioVistaPrevia.value = descripcioPresentacio.value;
  pinPresentaciovistaPrevia.value = pinPresentacio.value;
  estilPresentacioVistaPrevia.value=estils;
  formVistaPrevia.submit();
});
if (hiddenInputVistaPreviaDiapositives.value) {
  arrayPrevisualitzacio = JSON.parse(hiddenInputVistaPreviaDiapositives.value);
  for (let index = 0; index < arrayPrevisualitzacio.length; index++) {
    arrayDiapositiva[index]=arrayPrevisualitzacio[index];
    
  }
  actualitzarContenidorPosicion();
}

function ompleContenidorUrlPublicacio(url) {
  pContenidorUrlPublicacio.textContent = `URL de publicació: ${url}`;
  contenidorUrlPublicacio.style.display = 'block';
}

const buttonPublicaPresentacio = document.querySelectorAll('.buttonPublicaPresentacio');
  const urlGenerada = document.querySelector('.urlGenerada');
  const titolPresentacio = document.getElementById('titolPresentacio');
  const descripcioPresentacio = document.getElementById('descripcioPresentacio');
  const pinPresentacio = document.getElementById('pinPresentacio');
  buttonPublicaPresentacio.forEach(boto => {
    if (boto.textContent === "Publica") {
      boto.addEventListener('click', (e) => {
        hiddenInputUrlPaginaPublicar.value = window.location.href;
        hiddenArrayDiapositives.value=JSON.stringify(arrayDiapositiva);
        hiddenEstil.value=estils;
        hiddenTitolPresentacio.value=titolPresentacio.value;
        hiddenDecripcioPresentacio.value=descripcioPresentacio.value;
        hiddenPin.value=pinPresentacio.value;
        formPublicaPresentacions.submit();
      });
    }
    if (boto.textContent === "Despublica") {
      boto.addEventListener('click', (e) => {
        hiddenInputUrlPaginaDespublicar.value = window.location.href;
        despublicaArrayDiapositives.value=JSON.stringify(arrayDiapositiva);
        despublicaEstil.value=estils;
        despublicaTitolPresentacio.value=titolPresentacio.value;
        despublicaDecripcioPresentacio.value=descripcioPresentacio.value;
        despublicaPin.value=pinPresentacio.value;
        formDespublicaPresentacions.submit();
      });
    }
    if (boto.textContent === "Mostra URL") {
      boto.addEventListener('click', (e) => {
        ompleContenidorUrlPublicacio(urlGenerada.textContent);
      });
    }
  });
  
  if (hiddenArrayDiapositives.value) {
    arrayPrevisualitzacio = JSON.parse(hiddenArrayDiapositives.value);
    for (let index = 0; index < arrayPrevisualitzacio.length; index++) {
      arrayDiapositiva[index]=arrayPrevisualitzacio[index];
      
    }
    actualitzarContenidorPosicion();
  }
  if (despublicaArrayDiapositives.value) {
    arrayPrevisualitzacio = JSON.parse(despublicaArrayDiapositives.value);
    for (let index = 0; index < arrayPrevisualitzacio.length; index++) {
      arrayDiapositiva[index]=arrayPrevisualitzacio[index];
      
    }
    actualitzarContenidorPosicion();
  }