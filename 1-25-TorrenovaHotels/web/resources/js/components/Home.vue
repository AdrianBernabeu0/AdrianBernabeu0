<template>
  <div class="contenedorHero">
    <div class="contenedorCerca">
        <Cerca />
    </div>
    <div class="hero">
      <!-- <h1>{{ message.hero.title }}</h1> -->
       <h1 class="home-titol">{{ message.title }}</h1>
       <p class="home-description">{{ message.description }}</p>
      <!-- <p>{{ message.hero.description }}</p> -->
    </div>
  </div>
  <div class="contenedorValors">
    <!-- <h2>{{ message.valors.title }}</h2> -->
     <h2 class="home-valors">Els nostres valors</h2>
    <div class="valors">
      <div class="targetaValor">
        <h3 class="home-sostenibilitat">Sostenibilitat</h3>
        <p class="home-sostenibilitat-p">Ens comprometem amb la cura del medi ambient.</p>
      </div>
      <div class="targetaValor">
        <h3 class="home-qualitat">Qualitat</h3>
        <p class="home-qualitat-p">Oferim experiències excepcionals als nostres clients.</p>
      </div>
      <div class="targetaValor">
        <h3 class="home-innovacio">Innovació</h3>
        <p class="home-innovacio-p">Sempre busquem millorar els nostres serveis.</p>
      </div>
    </div>
  </div>

  <section class="contenedorPromocions">
    <!-- <h2>{{ message.promocions.title }}</h2> -->
     <h2 class="home-promocions-p" >Promocions i Notícies</h2>
    <div class="slider-wrapper">
      <button class="prev"><</button>
      <div class="promocions">
        <div id="slide-1" class="targetaPromocio">
          <h3 class="home-descompte-h3">Descompte del 20%</h3>
          <p class="home-descompte-p">Gaudeix de les nostres ofertes d'estiu en totes les destinacions.</p>
        </div>
        <div id="slide-2" class="targetaPromocio">
          <h3 class="home-noticies-h3">Esdeveniments Exclusius</h3>
          <p class="home-noticies-p">Descobreix els esdeveniments exclusius a les nostres ubicacions.</p>
        </div>
      </div>
      <button class="next">></button>
      <div class="slider-nav">
        <a href="#slide-1"></a>
        <a href="#slide-2"></a>
      </div>
    </div>
  </section>

  <div class="contenedorCerca">
        <Footer />
    </div>
</template>

<script setup>
import { ref, onMounted, onBeforeMount } from "vue";
import Cerca from "./cerca.vue";
import Footer from "./footer.vue";

const message = ref("");
const error = ref(null);

// Llamada a una api para que traiga los mensajes de la pagina
onBeforeMount(async () => {
  try {
    const response = await fetch(`/api/message/ca`);
    if (!response.ok) throw new Error("Error al carregar les traduccions");

    const data = await response.json();
    if (data.message) {
      message.value = data.message;
    }
  } catch (err) {
    error.value = "Error al carregar les traduccions: " + err.message;
  }
});

onMounted(() => {
  // Api para saber si un elemento esta visible dependiendo donde estes en la pagina
  const observer = new IntersectionObserver(
    (entries, observer) => {
      entries.forEach((entry) => {
        // Condicion por si el elemento esta en la pagina visible
        if (entry.isIntersecting) {
          // Se le asigna una clase 
          entry.target.classList.add("visible");
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.1 }
  );

  const targetas = document.querySelectorAll(".targetaValor");
  targetas.forEach((targeta) => observer.observe(targeta));

  const slider = document.querySelector(".promocions");
  const slides = document.querySelectorAll(".targetaPromocio");
  const btnPrev = document.querySelector(".prev");
  const btnNext = document.querySelector(".next");
  const navLinks = document.querySelectorAll(".slider-nav a");
  let index = 0;

  // Funcion para cambiar de noticia y ponerle opacidad al link
  function actualitzarCarousel() {
    slider.scrollTo({ left: slides[index].offsetLeft, behavior: "smooth" });

    navLinks.forEach((link) => {
      link.style.opacity = "0.75";

      link.addEventListener("click", (e) =>{
        // Bucle para restaurar la opacidad de los links secundarios
        navLinks.forEach((linkSecundario) => (linkSecundario.style.opacity = "0.75"));

        link.style.opacity = "1";
      });
      // Condicion para saber al link que se clicka y ponerle la opacidad
      if (link.getAttribute("href") === `#${slides[index].id}`) {
        link.style.opacity = "1";
      } else {
        link.style.opacity = "0.75";
      }
    });
  }

  if (btnPrev && btnNext) {
    // Dependiendo donde este indice actual avança a la otra noticia o retrocede
    btnPrev.addEventListener("click", () => {
      index = index > 0 ? index - 1 : slides.length - 1;
      actualitzarCarousel();
    });

    btnNext.addEventListener("click", () => {
      index = index < slides.length - 1 ? index + 1 : 0;
      actualitzarCarousel();
    });
  }
});
</script>
