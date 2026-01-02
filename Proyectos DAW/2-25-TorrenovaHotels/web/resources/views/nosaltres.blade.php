@extends('layouts.master')

@section('title', "Nosaltres - Informació sobre l'empresa")

@section('content')
<div class="nosaltres-container">
    <h1 class="nosaltres-titol">Sobre nosaltres</h1>

<main class="main-content">
    <section class="info-section nosaltres-section">
        <h2 class="nosaltres-qui-som nosaltres-section-h2">Qui som?</h2>
        <p class="nosaltres-qui-som-p nosaltres-section-p">Som una empresa dedicada a oferir experiències úniques a través de la nostra cadena d’hotels de luxe. Amb anys d’experiència en el sector, el nostre compromís és garantir la màxima qualitat i satisfacció per als nostres clients.</p>

        <h2 class="nosaltres-historia nosaltres-section-h2">Història</h2>
        <p class="nosaltres-historia-p nosaltres-section-p">Fundada al 2019, la nostra empresa ha crescut ràpidament, ampliant-se a diverses destinacions a tot el món. La nostra filosofia es basa en la qualitat, la innovació i l’excel·lència en el servei.</p>

        <h2 class="nosaltres-missio-valors nosaltres-section-h2">Missió i valors</h2>
        <ul class="nosaltres-section-ul">
            <li class="nosaltres-missio-valors-li-compromis nosaltres-section-ul-li">Compromís amb la sostenibilitat i el medi ambient.</li>
            <li class="nosaltres-missio-valors-li-experiencies nosaltres-section-ul-li">Proporcionar experiències úniques i memorables als nostres hostes.</li>
            <li class="nosaltres-missio-valors-li-fomentar nosaltres-section-ul-li">Fomentar el desenvolupament personal i professional dels nostres empleats.</li>
        </ul>

        <h2 class="nosaltres-ubicacio-contacte nosaltres-section-h2">Ubicació i contacte</h2>
        <p class="nosaltres-ubicacio-contacte-p nosaltres-section-p">La seu central es troba a Barcelona, amb oficines regionals a diverses ciutats clau. Ens podeu contactar a través del nostre correu electrònic: 
        <a href="mailto:torrenovaHotels@torrenovahotels.com" class="nosaltres-section-a">torrenovahotels@torrenovahotels.com </a> o al telèfon +34 123 456 789.</p>
    </section>
</main>

<footer class="nosaltres-footer">
    <p class="nosaltres-drets nosaltres-footer-p">&copy; 2025 Torrenova Hotels. Tots els drets reservats.</p>
</footer>
</div>
@endsection