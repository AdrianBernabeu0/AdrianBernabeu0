let comp = 0;
let ojo;
let urlPublicacio = "";
const divPresentacions = document.getElementById('presentacions');
const divMissatge = document.getElementById('missatge');
const presentacions = document.querySelectorAll('.presentacions');
const formElimina = document.getElementById('eliminaPresentacio');
const hiddenInputEliminaPresentacio = document.getElementById('presentacioAEliminar');
const formEdita = document.getElementById('editaPresentacio');
const hiddenInputEditaPresentacio = document.getElementById('presentacioAEditar');
const hiddenInputVisualitzaPresentacio = document.getElementById('presentacioAVisualitzar');
const missatgeEstatDelete = document.querySelector('.missatgeEstatDelete');
const contenidorMissatgeEstatDelete = document.querySelector('.contenidorWarning');
const acceptarMissatgeEstatDelete = document.querySelector('.acceptarMissatgeEstatDelete');
const presentacioAPublicar = document.getElementById('presentacioAPublicar');
const formPublicaPresentacions = document.getElementById('formPublicaPresentacions');
const hiddenInputUrlPaginaPublicar = document.getElementById('hiddenInputUrlPaginaPublicar');
const hiddenInputUrlPaginaDespublicar = document.getElementById('hiddenInputUrlPaginaDespublicar');
const presentacioADespublicar = document.getElementById('presentacioADespublicar');
const formDespublicaPresentacions = document.getElementById('formDespublicaPresentacions');
const contenidorUrlPublicacio = document.querySelector('.contenidorUrlPublicacio');
const pContenidorUrlPublicacio = document.querySelector('.pContenidorUrlPublicacio');

const formPrevisualitza = document.getElementById("permetPrevisualitza");
const idPresentacio = document.getElementById("idPrevisualitzacio");


// Aquesta funció desactiva el display dels elements children de la presentació que se li passa com a paràmetre
function desactivaDisplayChildNodesPresentacio(presentacio) {
  console.log(presentacio);
    for (let i = 0; i < presentacio.children.length; i++) {
        presentacio.children[i].style.display = 'none';
    }
}

// Aqusta funció assigna el valor al hidden input (la ID de la presentació que se li passa per paràmetre) i envia el formulari
function eliminaPresentacio(presentacio) {
  console.log(presentacio);
    hiddenInputEliminaPresentacio.value = presentacio.id.match(/(\d+)/g);
    formElimina.submit();
}

/* 
Aquesta funció reestableix el display dels elements children de la presentació que se li passa per paràmetre, 
a excepció dels elements amb ID 'confirmaOCancela' (el div que conté tot els elements del template), que els elimina amb .remove<()
*/
function reestableixDisplay(presentacio, clone) {
  console.log(presentacio);
    for (let i = 0; i < presentacio.children.length; i++) {
        if (presentacio.children[i].id != 'confirmaOCancela'){
            presentacio.children[i].style.display = '';
        }
        else{
            presentacio.children[i].remove();
        }
    }
    
}

// Aquesta funció activa el template i l'afegeix a la presentació que se li passa per paràmetre
function activaTemplate(presentacio) {
  console.log(presentacio);
    const template = document.getElementById("confirmacioEliminaPresentacio");
    const clone = document.importNode(template.content, true);
    const buttonElimina = clone.querySelector('.confirma');
    const buttonCancelEliminacio = clone.querySelector('.cancela');



    // Aquest event s'activa quan es prem el botó de 'SI' (botó que contesta a la pregunta 'Estàs segur que vols eliminar aquesta presentació?'), i crida a la funció eliminaPresentacio
    buttonElimina.addEventListener('click', (e) => {
        eliminaPresentacio(presentacio);
    })
    
    // Aquest botó s'activa qua es prem el botó de 'NO'(botó que contesta a la pregunta 'Estàs segur que vols eliminar aquesta presentació?'), i crida a la funció reestableixDisplay
    buttonCancelEliminacio.addEventListener('click', (e) => {
        reestableixDisplay(presentacio, clone);
    })

    presentacio.appendChild(clone);
}

// Bucle forEach que recorre el contenidor on es troben totes les presentacions. També crea bucles forEach per cada tipus d'icona per assignar-lis un event  
function ompleContenidorUrlPublicacio(url) {
  urlPublicacio = url;
  pContenidorUrlPublicacio.textContent = `URL de publicació: ${url}`;
  contenidorUrlPublicacio.style.display = 'flex';
}

presentacions.forEach((presentacio, index) => {
  const iconaElimina = presentacio.querySelectorAll('.elimina');
  const iconaEdita = presentacio.querySelectorAll('.edita');
  const iconaVisualitza = presentacio.querySelectorAll('.visualitza');
  const buttonPublicaPresentacio = presentacio.querySelectorAll('.buttonPublicaPresentacio');
  const urlGenerada = presentacio.querySelector('.urlGenerada');

  buttonPublicaPresentacio.forEach(boto => {
    if (boto.textContent === "Publica") {
      boto.addEventListener('click', (e) => {
        presentacioAPublicar.value = presentacio.id.match(/(\d+)/g);
        hiddenInputUrlPaginaPublicar.value = window.location.href;
        formPublicaPresentacions.submit();
      });
    }
    if (boto.textContent === "Despublica") {
      boto.addEventListener('click', (e) => {
        presentacioADespublicar.value = presentacio.id.match(/(\d+)/g);
        hiddenInputUrlPaginaDespublicar.value = window.location.href;
        formDespublicaPresentacions.submit();
      });
    }
    if (boto.textContent === "Mostra URL") {
      boto.addEventListener('click', (e) => {
        ompleContenidorUrlPublicacio(urlGenerada.textContent);
      });
    }
  });



    iconaElimina.forEach(icona => {
        // Aquest event s'activa cada cop que es prem l'icona de la paperera, i crida a les funcions desactivaDisplayChildNodesPresentacio i activaTemplate
        icona.addEventListener('click', (e) => {
            desactivaDisplayChildNodesPresentacio(presentacio);
            activaTemplate(presentacio);
        })
    })

    iconaEdita.forEach(icona => {
        /* Aquest event s'activa cada cop que es prem l'icona del llapis, i assigna el valor al hidden input que 
        s'utilitza per determinar quina presenació has d'editar. Finalment envia el formulari */
        icona.addEventListener('click', (e) => {
            hiddenInputEditaPresentacio.value=presentacio.id.match(/(\d+)/g);
            formEdita.submit();
            hiddenInputVisualitzaPresentacio.value=ojo;
            formEdita.submit();
          }
        )
    })

    iconaVisualitza.forEach(icona => {
      /* Aquest event s'activa quan es prem l'icona del ull i fa que es canvii el valor del ull per pasarlo a la base de dades */
      icona.addEventListener('click', (e) => {
          if(icona.id==="imagenOjoTachado"){
          idPresentacio.value=presentacio.id.match(/(\d+)/g);
          hiddenInputVisualitzaPresentacio.value="S";
         
        }else{
          idPresentacio.value=presentacio.id.match(/(\d+)/g);
          hiddenInputVisualitzaPresentacio.value="N";     
          }
          
          formPrevisualitza.submit();
          
      })
  })
    
    
})
function desactivaDisplayContenidor() {
  contenidorMissatgeEstatDelete.style.display = 'none';
}

setTimeout(desactivaDisplayContenidor, 3000);


if (missatgeEstatDelete.textContent != "") {
  if (missatgeEstatDelete.textContent.trim() === "La presentació s'ha eliminat amb èxit") {
    contenidorMissatgeEstatDelete.style.display = 'block';
    contenidorMissatgeEstatDelete.setAttribute('id', 'exitos');
  }
  if(missatgeEstatDelete.textContent.trim() === "Error al eliminar la presentació"){
    contenidorMissatgeEstatDelete.style.display = 'block';
    contenidorMissatgeEstatDelete.setAttribute('id', 'error');
  }
}





// Aquest if desactiva el display del missatge 'NO HI HA CAP PRESENTACIÓ' si detecta que no hi ha cap children al contenidor de presentacons
if (divPresentacions.childElementCount !== 0) {
    divMissatge.style.display = "none";
}