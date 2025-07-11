@extends('layouts.master')

@section('title', "Condicions d'ús")

@section('content')
<div class="condicions-container">
    <h1 class="condicions-titol">Condicions d'ús</h1>

    <section class="condicions-section" id="introduccio">
        <h2 class=" condicions-section-h2 condicions-introduccio">1. Introducció</h2>
        <p class="condicions-section-p condicions-introduccio-p">Aquest document estableix les condicions d'ús dels serveis proporcionats per la nostra empresa d'hotels. L'ús del nostre lloc web, serveis i instal·lacions implica l'acceptació de les presents condicions.</p>
    </section>

    <section class="condicions-section" id="reserves-i-cancelacions">
        <h2 class="condicions-section-h2 condicions-reserves">2. Reserves i cancel·lacions</h2>
        <p class="condicions-section-p condicions-reserves-p">Els clients poden fer reserves mitjançant el nostre lloc web. Les condicions específiques de cancel·lació poden variar segons la tarifa seleccionada. Consulteu els detalls al moment de fer la reserva.</p>
    </section>

    <section class="condicions-section" id="drets-i-responsabilitats">
        <h2 class="condicions-section-h2 condicions-drets-responsabilitats">3. Drets i responsabilitats dels usuaris</h2>
        <p class="condicions-section-p condicions-drets-responsabilitats-p">Els usuaris han de respectar les normes internes de l'establiment. L'empresa es reserva el dret d'expulsar qualsevol persona que incompleixi aquestes normes o causi danys a les instal·lacions.</p>
    </section>

    <section class="condicions-section" id="politica-de-privacitat">
        <h2 class="condicions-section-h2 condicions-politica-privacitat">4. Política de privacitat</h2>
        <p class="condicions-section-p condicions-politica-privacitat-p">Ens comprometem a protegir la privacitat dels nostres clients. Les dades personals recollides seran utilitzades exclusivament per gestionar les reserves i millorar els nostres serveis.</p>
    </section>

    <section class="condicions-section" id="limitacio-de-responsabilitat">
        <h2 class="condicions-section-h2 condicions-limitacio-responsabilitat">5. Limitació de responsabilitat</h2>
        <p class="condicions-section-p condicions-limitacio-responsabilitat-p">L'empresa no es fa responsable de pèrdues o danys derivats de l'ús dels nostres serveis, llevat que aquests siguin resultat de negligència greu per part nostra.</p>
    </section>

    <section class="condicions-section" id="modificacio-de-les-condicions">
        <h2 class="condicions-section-h2 condicions-modificacio-condicions">6. Modificació de les condicions</h2>
        <p class="condicions-section-p condicions-modificacio-condicions-p">L'empresa es reserva el dret de modificar aquestes condicions en qualsevol moment. Les modificacions seran publicades al nostre lloc web i entraran en vigor en el moment de la seva publicació.</p>
    </section>

    <section class="condicions-section" id="jurisdiccio-i-llei-aplicable">
        <h2 class="condicions-section-h2 condicions-jurisdiccio-llei">7. Jurisdicció i llei aplicable</h2>
        <p class="condicions-section-p condicions-jurisdiccio-llei-p">Aquestes condicions es regeixen per la legislació vigent al territori on es troba l'establiment. Qualsevol disputa serà sotmesa als tribunals competents d'aquest territori.</p>
    </section>
    <footer class="condicions-footer">
        <p class="condicions-footer-p condicions-drets">&copy; 2025 Torrenova Hotels. Tots els drets reservats.</p>
    </footer>
</div>
@endsection
