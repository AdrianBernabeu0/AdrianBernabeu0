import { createApp } from 'vue';
import home from './components/Home.vue';
import resumReserva from './components/resumReserva.vue';
import roomAvailable from './components/RoomAvailable.vue'
import reserva from './components/reserva.vue';

createApp(home).mount('#home');
createApp(resumReserva).mount('#resumReserva');
createApp(roomAvailable).mount('#roomAvailable');
createApp(reserva).mount('#reserva');

const lenguaje=document.querySelector(".lang-show");
const banderaCA="cat.png",banderaEN="reinoUnido.png",banderaES="spain.png";
const idiomes=["CAT","ENG","ESP"]
const nomenclaturaCastella="es";
const nomenclaturaCatala="ca";
const nomenclaturaAngles="en";

//Funció que fa el canvi de l'idioma en el div. quan es carrega 
const canviDivLenguage=(idioma)=>{
    const img=document.createElement("img")
    const textoIdioma=document.createElement("p");
    
    if (idioma === nomenclaturaCastella) {
        img.setAttribute("src",`/img/spain.png`);
        textoIdioma.textContent="ESP";
    }
    else if (idioma === nomenclaturaCatala){
        img.setAttribute("src",`/img/cat.png`);
        textoIdioma.textContent="CAT";
    }
    else if (idioma === nomenclaturaAngles) {
        img.setAttribute("src",`/img/reinoUnido.png`);
        textoIdioma.textContent="ENG";
    }
    lenguaje.innerHTML=""
    lenguaje.id=textoIdioma.textContent;
    lenguaje.append(img,textoIdioma);
}

//Funció que canvia l'idioma en la pàgina d'home
const actualitzaTextosHome = (messages) => {
    document.querySelector(".home-label-destinacio").textContent = messages.labelDestinacio;
    document.querySelector(".home-label-data-inici").textContent = messages.labelDataInici;
    document.querySelector(".home-label-data-final").textContent = messages.labelDataFinal;
    document.querySelector(".home-label-persones-reserva").textContent = messages.labelPersonesPerReserva;
    document.querySelector(".home-boton-cerca").textContent = messages.botonCerca;

    document.querySelector(".home-titol").textContent = messages.title;
    document.querySelector(".home-description").textContent = messages.description;
    document.querySelector(".home-valors").textContent = messages.titolValor;
    document.querySelector(".home-sostenibilitat").textContent = messages.h3Sostenibilitat;
    document.querySelector(".home-sostenibilitat-p").textContent = messages.pSostenibilitat;
    document.querySelector(".home-qualitat").textContent = messages.h3Qualitat;
    document.querySelector(".home-qualitat-p").textContent = messages.pQualitat;
    document.querySelector(".home-innovacio").textContent = messages.h3Innovacio;
    document.querySelector(".home-innovacio-p").textContent = messages.pInnovacio;
    document.querySelector(".home-promocions-p").textContent = messages.h2PromocionNoticies;
    document.querySelector(".home-descompte-h3").textContent = messages.h2Descompte;
    document.querySelector(".home-descompte-p").textContent = messages.pDescompte;
    document.querySelector(".home-noticies-h3").textContent = messages.h2Noticies;
    document.querySelector(".home-noticies-p").textContent = messages.pNoticies;
    
    document.querySelector(".home-politica").textContent = messages.politicaPrivacitat;
    document.querySelector(".home-condicion").textContent = messages.condicionUs;
    document.querySelector(".home-nosaltres").textContent = messages.sobreNosaltres;
    document.querySelector(".home-contacte").textContent = messages.contact;
    document.querySelector(".home-drets").textContent = messages.drestsReservats;
};

//Funció que canvia l'idioma en la pàgina de politica i Privacitat
const actualitzaTextosPoliticaPrivacitat = (messages) => {
    document.querySelector(".politica-titol").textContent = messages.titolPolitica;
    document.querySelector(".politica-introduccio").textContent = messages.h2introduccio;
    document.querySelector(".politica-introduccio-p").textContent = messages.pintroduccio;
    document.querySelector(".politica-recollida").textContent = messages.h2Recollida;
    document.querySelector(".politica-recollida-p").textContent = messages.pRecollida;

    document.querySelector(".politica-utilitzacio-dades").textContent = messages.h2Utilitzacio;
    document.querySelector(".politica-utilitzacio-dades-p").textContent = messages.pUtilitzacio;
    document.querySelector(".politica-comparticio-dades").textContent = messages.h2Comparticio;
    document.querySelector(".politica-comparticio-dades-p").textContent = messages.pComparticio;
    document.querySelector(".politica-drets-usuaris").textContent = messages.h2Drets;
    document.querySelector(".politica-drets-usuaris-p").textContent = messages.pDrets;
    document.querySelector(".politica-seguretat-dades").textContent = messages.h2Seguretat;
    document.querySelector(".politica-seguretat-dades-p").textContent = messages.pSeguretat;
    document.querySelector(".politica-modificacions-politica").textContent = messages.h2Modificacions;
    document.querySelector(".politica-modificacions-politica-p").textContent = messages.pModificacions;
    document.querySelector(".politica-contacte").textContent = messages.h2Contacte;
    document.querySelector(".politica-contacte-p").innerHTML = messages.pContacte;
    document.querySelector(".politica-drets").textContent = messages.footerDrets;
};

//Funció que canvia l'idioma en la pàgina de condicion d'us
const actualitzaTextosCondicionsUs = (messages) => {
    document.querySelector(".condicions-titol").textContent = messages.titolCondicion;
    document.querySelector(".condicions-introduccio").textContent = messages.h2introduccioUs;
    document.querySelector(".condicions-introduccio-p").textContent = messages.pintroduccioUs;
    document.querySelector(".condicions-reserves").textContent = messages.h2Reserves;
    document.querySelector(".condicions-reserves-p").textContent = messages.pReserves;
    document.querySelector(".condicions-drets-responsabilitats").textContent = messages.h2DretsResponsabilitat;
    document.querySelector(".condicions-drets-responsabilitats-p").textContent = messages.pDretsResponsabilitat;
    document.querySelector(".condicions-politica-privacitat").textContent = messages.h2Politica;
    document.querySelector(".condicions-politica-privacitat-p").textContent = messages.pPolitica;
    document.querySelector(".condicions-limitacio-responsabilitat").textContent = messages.h2Limitacio;
    document.querySelector(".condicions-limitacio-responsabilitat-p").textContent = messages.pLimitacio;
    document.querySelector(".condicions-modificacio-condicions").textContent = messages.h2Modificacio;
    document.querySelector(".condicions-modificacio-condicions-p").textContent = messages.pModificacio;
    document.querySelector(".condicions-jurisdiccio-llei").textContent = messages.h2Jurisdicció;
    document.querySelector(".condicions-jurisdiccio-llei-p").textContent = messages.pJurisdicció;
    document.querySelector(".condicions-drets").textContent = messages.footerDrets;
};

//Funció que canvia l'idioma en la pàgina de sobre nosaltres
const actualitzaTextosNosaltres = (messages) => {
    document.querySelector(".nosaltres-titol").textContent = messages.titolNosaltres;
    document.querySelector(".nosaltres-qui-som").textContent = messages.h2QuiSom;
    document.querySelector(".nosaltres-qui-som-p").textContent = messages.pQuiSom;
    document.querySelector(".nosaltres-historia").textContent = messages.h2Historia;
    document.querySelector(".nosaltres-historia-p").textContent = messages.pHistoria;

    document.querySelector(".nosaltres-missio-valors").textContent = messages.h2MissioValors;
    document.querySelector(".nosaltres-missio-valors-li-compromis").textContent = messages.liCompromisMissioValors;
    document.querySelector(".nosaltres-missio-valors-li-experiencies").textContent = messages.liExperienciaMissioValors;
    document.querySelector(".nosaltres-missio-valors-li-fomentar").textContent = messages.liFomentarMissioValors;
    document.querySelector(".nosaltres-ubicacio-contacte").textContent = messages.h2Ubicacio;
    document.querySelector(".nosaltres-ubicacio-contacte-p").innerHTML = messages.pUbicacio;
    document.querySelector(".nosaltres-drets").textContent = messages.footerDrets;
};
const actualitzaTextosReserva = (messages) => {
  document.querySelector(".summary-header-h1").textContent = messages.summaryHeaderH1;
  document.querySelector(".detail-item-hotel").textContent = messages.detailItemHotel;
  document.querySelector(".detail-item-habitacio").textContent = messages.detailItemHabitacio;
  document.querySelector(".detail-item-dades").textContent = messages.detailItemDades;
  document.querySelector(".detail-item-preu").textContent = messages.detailItemPreu;
  document.querySelector(".detail-item-button").textContent = messages.detailItemButton;
}
const actualitzaTextosResumReserva = (messages) => {
  document.querySelector(".titolH3-resumReserva").textContent = messages.titolResumReserva;
  document.querySelector(".hotelEscollitH4-resumReserva").textContent = messages.hotelResumReserva;
  document.querySelector(".habitacio-resumReserva").textContent = messages.habitacioResumReserva;
  document.querySelector(".dades-resumReserva").textContent = messages.dadesResumReserva;
  document.querySelector(".preu-resumReserva").textContent = messages.preuResumReserva;
  document.querySelector(".btnResumReserva").textContent = messages.btnResumReserva;

}
//Funció que truca a les funcions de canvis d'idioma
const actualitzaTextos = (messages) => {
    if (document.querySelector(".home-label-destinacio")) {
        actualitzaTextosHome(messages);
    }
    if (document.querySelector(".politica-titol")) {
        actualitzaTextosPoliticaPrivacitat(messages); 
    }
    if (document.querySelector(".condicions-titol")) {
        actualitzaTextosCondicionsUs(messages);
    }
    if (document.querySelector(".nosaltres-titol")) {
        actualitzaTextosNosaltres(messages);
    } 
    if (document.querySelector(".reservation-summary")) {
      actualitzaTextosReserva(messages);
    }
    if (document.querySelector(".contenedorResum")) {
      actualitzaTextosResumReserva(messages);
    }
};

//Funció que truca a l'api que ens dona els textos traduïts
const canviIdioma = async (idioma)=>{
    const castella="ESP",catalan="CAT",angles="ENG";
    if (idioma === castella) idioma = "es";
    else if (idioma === catalan) idioma = "ca";
    else if (idioma === angles) idioma = "en";
        try {
            const response = await fetch(
                `/api/message/${idioma}`,
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
                localStorage.setItem("lang", idioma);
                actualitzaTextos(result.message);   
            } else {
                const errorMessage = await response.text();
                console.error("Error", errorMessage);
            }
        } catch (error) {
          console.error("Error:", error);
        }
      }

      
      document.addEventListener("DOMContentLoaded", async () => {
        const idiomaGuardat = localStorage.getItem("lang") || "ca"; 
        canviDivLenguage(idiomaGuardat);
        await canviIdioma(idiomaGuardat);
    });

//Funció que fa que quan li donis al contenidor d'idioma et surti el canvi d'idiomes i si li dones una segona vegada desaparegui el contenidor
lenguaje.addEventListener('click',()=>{
const divLang=document.querySelector("#divIdiomes");
if(divLang.className!=="lang-div-show"){
divLang.innerHTML="";
divLang.className="lang-div-show";
const castella="ESP",catalan="CAT",angles="ENG";
idiomes.forEach(idioma => {
    if(idioma!==lenguaje.id){
        const div=document.createElement("div")
        div.className="lang-div-idiomes";
        divLang.append(div);
        const img=document.createElement("img")
        const texto=document.createElement("p")
        texto.textContent=idioma;
        if(idioma===castella){
            img.setAttribute("src",`/img/${banderaES}`);
        }else if(idioma===catalan){
            img.setAttribute("src",`/img/${banderaCA}`);
        }else if(idioma===angles){
            img.setAttribute("src",`/img/${banderaEN}`);
        }
        div.append(img);
        div.append(texto);
        div.addEventListener('click',()=>{
            lenguaje.innerHTML=""
            lenguaje.id=texto.textContent;
            lenguaje.append(img,texto);
            divLang.innerHTML="";
            divLang.className="lang-div";
            canviIdioma(texto.textContent)
        });
    }
});
}else{
        divLang.innerHTML="";
            divLang.className="lang-div";
}
});

    // Funció que quan li cliques fora del contenidor el contenidor d'idioma es va
    document.addEventListener("click", function(event) {
        const divLang=document.querySelector("#divIdiomes");
        if (!divLang.contains(event.target) && !lenguaje.contains(event.target)) {
            divLang.innerHTML="";
            divLang.className="lang-div";
        }
    });
