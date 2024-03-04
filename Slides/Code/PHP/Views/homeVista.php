<?php 
require('../Controllers/controladorHomeVista.php');
session_start();
$missatge = isset($_SESSION['missatge']) ? $_SESSION['missatge'] : "";
unset($_SESSION['missatge']); 
?>


<!DOCTYPE html>
<html lang="ca">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../../CSS/global.css" />

    <!-- TIPOGRAFIA EXTERNA -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap"
      rel="stylesheet"
    />
    <title>Home</title>
  </head>

  <body>
    <header>
      <div>
        <nav>
          <div>
            <a href="homeVista.php">
              <img class="iconoHome" src="../../../Documentacion/imatges/icones/hogar.png"/>
            </a>
          </div>
          <div class="nom">
            <h1>SLIDES|| HOME</h1>
          </div>
        </nav>
      </div>
    </header>
    <div class="contenidorWarning">
        <p class="missatgeEstatDelete">
          <?php
          echo $missatge;
          ?>
        </p>
      </div>
    <div class="contenidorUrlPublicacio"><p class="pContenidorUrlPublicacio"></p></div>
    <div id="divBoto">
      <a href="seleccioEstils.html"
        ><button class="botoCrearPresentacio">+ Crear presentació</button></a
      >
    </div>
    <div class="divBodyHome">
      <div id="presentacions">
      <?php
    $titolsIdsPinUrl = getTitolsIdsPinUrl();
    crearDivPresentacio($titolsIdsPinUrl);
    ?>
      </div>
      <div id="missatge">NO HI HA CAP PRESENTACIÓ</div>
    </div>
    <form id="formPublicaPresentacions" action="../Controllers/publicaPresentacio.php" method="post">
      <input type="hidden" id="presentacioAPublicar" name="presentacioAPublicar">
      <input type="hidden" id="hiddenInputUrlPaginaPublicar" name="hiddenInputUrlPaginaPublicar">
    </form>
    <form id="formDespublicaPresentacions" action="../Controllers/publicaPresentacio.php" method="post">
      <input type="hidden" id="presentacioADespublicar" name="presentacioADespublicar">
      <input type="hidden" id="hiddenInputUrlPaginaDespublicar" name="hiddenInputUrlPaginaDespublicar">
    </form>
    <form id="eliminaPresentacio" action="../Controllers/eliminaPresentacio.php" method="post">
      <input type="hidden" id="presentacioAEliminar" name="presentacioAEliminar">
    </form>
    <form id="editaPresentacio" action="../Controllers/controladorEditarVista.php" method="post">
      <input type="hidden" id="presentacioAEditar" name="presentacioAEditar">
    </form>
    <form id="permetPrevisualitza" action="../Controllers/controladorVistaPrevia.php" method="post">
      <input type="hidden" id="idPrevisualitzacio" name="idPrevisualitzacio">
      <input type="hidden" id="presentacioAVisualitzar" name="presentacioAVisualitzar">
    </form>
    <template id="confirmacioEliminaPresentacio">
      <div id="confirmaOCancela">
        <p class="preguntaEliminacio">Estàs segur que vols eliminar aquesta presentació?</p>
        <div class="buttonsEleccioEliminar">
          <button form="eliminaPresentacio" class="buttonEliminacio confirma">SI</button>
          <button class="buttonEliminacio cancela">NO</button>
        </div>
      </div>
    </template>
    <script src="../../JavaScript/home.js"></script>
  </body>
</html>