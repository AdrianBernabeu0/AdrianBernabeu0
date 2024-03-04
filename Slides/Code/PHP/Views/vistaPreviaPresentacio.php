<?php 
require('../Controllers/controladorFuncionsVistaPreviaClient.php');
$url = isset($_POST['hiddenInputVistaPreviaURL']) ? htmlspecialchars($_POST['hiddenInputVistaPreviaURL']) : "homeVista.php";

if(isset($_GET['k'])){
  if (isset($_GET['pwd'])) {
    $redirectURL = 'pantallaIntroduirPIN.php?k=' . urlencode($_GET['k']);
    header('Location: ' . $redirectURL);
    exit;
  }
  $diapositiva = new Diapositiva($pdo);
  $arrayDadesDiapositiva = getDadesDiapositiva(preg_replace('/[^0-9]/', '', $_GET['k']), $diapositiva);

  $arrayDadesPregunta = [];
  $arrayIdPreguntes = [];
  $arrayOpcionsPreguntes = [];

  foreach ($arrayDadesDiapositiva as $diapositivaActual) {
      if (array_key_exists('pregunta_id', $diapositivaActual)) {
          $arrayIdPreguntes[] = $diapositivaActual['pregunta_id'];
      }
  }

  foreach ($arrayIdPreguntes as $idPregunta) {
    $dadesIdPregunta = getDadesPreguntes($idPregunta, $diapositiva);
    $opcionsIdPregunta = getOpcions($idPregunta, $diapositiva);
    $arrayDadesPregunta = array_merge($arrayDadesPregunta, $dadesIdPregunta);
    $arrayOpcionsPreguntes = array_merge($arrayOpcionsPreguntes, $opcionsIdPregunta);
}
  $estilPresentacio = getEstilPresentacio(preg_replace('/[^0-9]/', '', $_GET['k']), $diapositiva);
}

$arrayDiapositives = isset($_POST['hiddenInputVistaPreviaDiapositives']) ? json_decode($_POST['hiddenInputVistaPreviaDiapositives'], true) : [];
// var_dump($arrayDiapositives);
$estil = isset($_POST['estilPresentacioVistaPrevia']) ? htmlspecialchars($_POST['estilPresentacioVistaPrevia']) : "";
$titolPresentacio = isset($_POST['titolPresentacioVistaPrevia']) ? htmlspecialchars($_POST['titolPresentacioVistaPrevia']) : "";
$descripcioPresentacio = isset($_POST['descripcioPresentacioVistaPrevia']) ? htmlspecialchars($_POST['descripcioPresentacioVistaPrevia']) : "";
$idPresentacioVisualitzat = isset($_POST['idPresentacio']) ? htmlspecialchars($_POST['idPresentacio']) : "";
$pinPresentacio= isset($_POST['hiddenInputVistaPreviaPin']) ? htmlspecialchars($_POST['hiddenInputVistaPreviaPin']) : "";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $titolPresentacio?></title>
    <link rel="stylesheet" href="../../CSS/global.css" />

    <!-- TIPOGRAFIA EXTERNA -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet" />
</head>

<body>
  <?php
  echo "<div class='contenidorMiniatures'>";
      foreach ($arrayDadesDiapositiva as $diapositiva) {
        if ($diapositiva['contingut'] === null) {
          echo "<div class='diapositivaDinsCarrusel diapositivesAlContenidorScrolleableNomesTitol diapositiva" . $diapositiva['posicio'] ." " . $estilPresentacio . "'>";
          echo "<p class='titolDiapositivesScroll'>" . $diapositiva['titol'] . "</p>";
          echo "</div>";
        } else {
          echo "<div class='diapositivaDinsCarrusel diapositivesAlContenidorScrolleable diapositiva" . $diapositiva['posicio'] . " " . $estilPresentacio . "'>";
          echo "<p class='titolDiapositivesScroll'>" . $diapositiva['titol'] . "</p>";
          echo "<p class='contingutDiapositivesScroll'>" . $diapositiva['contingut'] . "</p>";
          echo "</div>";
        }
      }
    echo "</div>";
    if (isset($_GET['k'])) {
      echo "<form id='formulariRedireccio' action='" . $url . "' method='post'>";
      echo "<input type='hidden' id='hiddenInputVistaPreviaDiapositives' name='hiddenInputVistaPreviaDiapositives' value='" . htmlspecialchars(json_encode($arrayDadesDiapositiva)) . "'>";
      echo "<input type='hidden' id='hiddenInputVistaPreviaDiapositivesAmbPregunta' name='hiddenInputVistaPreviaDiapositivesAmbPregunta' value='" . htmlspecialchars(json_encode($arrayDadesPregunta)) . "'>";
      echo "<input type='hidden' id='hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions' name='hiddenInputVistaPreviaDiapositivesAmbPreguntaOpcions' value='" . htmlspecialchars(json_encode($arrayOpcionsPreguntes)) . "'>";
      echo "<input type='hidden' id='estilPresentacio' name='estilPresentacio' value='" . $estilPresentacio . "'>";
      echo "<input type='hidden' id='titolPresentacioVistaPrevia' name='titolPresentacioVistaPrevia' value='" . $titolPresentacio . "'>";
      echo "</form>";
      echo "<button class='acabaDeVisualitzar " . $estilPresentacio . "Button'>Acaba la visualització</button>";
      echo "<div class='vistaPreviaPresentacioDiapositives " . $estilPresentacio . "'></div>";
      echo "<div class='fletxesCanviDiapositiva'>";
      if ($estilPresentacio === 'blue') {
        echo "<img src='../../../Documentacion/imatges/icones/fletxaEsquerraBlack.png' alt='Diapositiva anterior' class='diapositivaEnrere' draggable='false'>";
        echo "<button class='mostraMiniatures mostraMiniaturesBlue'>Mostra miniatures</button>";
        echo "<img src='../../../Documentacion/imatges/icones/fletxaDretaBlack.png' alt='Següent diapositiva' class='diapositivaEndavant' draggable='false'>";
      } else {
        echo "<img src='../../../Documentacion/imatges/icones/fletxaEsquerraWhite.png' alt='Diapositiva anterior' class='diapositivaEnrere' draggable='false'>";
        echo "<button class='mostraMiniatures mostraMiniaturesDark'>Mostra miniatures</button>";
        echo "<img src='../../../Documentacion/imatges/icones/fletxaDretaWhite.png' alt='Següent diapositiva' class='diapositivaEndavant' draggable='false'>";
      }
      echo "</div>";
    } else {
      echo "<form id='tornaALaPaginaAnterior' action= '" . $url . "' method='post'>";
      echo "<input type='hidden' id='hiddenInputVistaPreviaDiapositives' name='hiddenInputVistaPreviaDiapositives' value='" . htmlspecialchars(json_encode($arrayDiapositives)) . "'>";
      echo "<input type='hidden' id='estilPresentacio' name='estilPresentacio' value='" . $estil . "'>";
      echo "<input type='hidden' id='titolPresentacioVistaPrevia' name='titolPresentacioVistaPrevia' value='" . $titolPresentacio . "'>";
      echo "<input type='hidden' id='descripcioPresentacioVistaPrevia' name='descripcioPresentacioVistaPrevia' value='" . $descripcioPresentacio . "'>";
      echo "<input type='hidden' id='presentacioAPrevisualitzar' name='presentacioAPrevisualitzar' value='" . $idPresentacioVisualitzat . "'>";
      echo "<input type='hidden' id='pinPresentacioVistaPrevia' name='pinPresentacioVistaPrevia' value='" . $pinPresentacio . "'>";
      echo "</form>";
      echo "<button class='acabaDeVisualitzar " . $estil . "Button'>Acaba la visualització</button>";
      echo "<div class='vistaPreviaPresentacioDiapositives " . $estil . "'></div>";
      echo "<div class='fletxesCanviDiapositiva'>";
      if ($estil === 'blue') {
        echo "<img src='../../../Documentacion/imatges/icones/fletxaEsquerraBlack.png' alt='Diapositiva anterior' class='diapositivaEnrere' draggable='false'>";
        echo "<img src='../../../Documentacion/imatges/icones/fletxaDretaBlack.png' alt='Següent diapositiva' class='diapositivaEndavant' draggable='false'>";
      } else {
        echo "<img src='../../../Documentacion/imatges/icones/fletxaEsquerraWhite.png' alt='Diapositiva anterior' class='diapositivaEnrere' draggable='false'>";
        echo "<img src='../../../Documentacion/imatges/icones/fletxaDretaWhite.png' alt='Següent diapositiva' class='diapositivaEndavant' draggable='false'>";
      }
      echo "</div>";
    }
  ?>

    </div>
    <script src="../../JavaScript/vistaPreviaPresentacio.js"></script>

</body>
</html>