<?php
if (isset($_POST['estilPresentacio'])){
  $nomClasseEstilSeleccionat = htmlspecialchars($_POST['estilPresentacio']);
}

$arrayDiapositives = isset($_POST['hiddenInputVistaPreviaDiapositives']) ? json_decode($_POST['hiddenInputVistaPreviaDiapositives'], true) : [];

$titolPresentacio = isset($_POST['titolPresentacioVistaPrevia']) ? htmlspecialchars($_POST['titolPresentacioVistaPrevia']) : "";
$descripcioPresentacio = isset($_POST['descripcioPresentacioVistaPrevia']) ? htmlspecialchars($_POST['descripcioPresentacioVistaPrevia']) : "";


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/global.css">

    <!-- TIPOGRAFIA EXTERNA -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div>
            <nav>
                <div>
                    <a href="homeVista.php">
                        <img class="iconoHome" src="../../../Documentacion/imatges/icones/hogar.png" alt="Icono Home">
                    </a>
                </div>
                <div class="nom">
                    <h1>SLIDES|| HOME</h1>
                </div>
            </nav>
        </div>
    </header>
    <div class="divBodyPresentacions">
        <div class="opcionsPresentacio">
            <div class="titolDescripcio">
              <form id="formVistaPrevia" action="vistaPreviaPresentacio.php" method="post">
              <input type="hidden" id="hiddenInputVistaPreviaDiapositives" name="hiddenInputVistaPreviaDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives));?>">
                <input type="hidden" id="hiddenInputVistaPreviaURL" name="hiddenInputVistaPreviaURL">
                <input type="hidden" id="estilPresentacioVistaPrevia" name="estilPresentacioVistaPrevia" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                <input type="hidden" id="titolPresentacioVistaPrevia" name="titolPresentacioVistaPrevia">
                <input type="hidden" id="descripcioPresentacioVistaPrevia" name="descripcioPresentacioVistaPrevia">
              </form>
                <form id="enviaDadesPresentacio" action="../Controllers/controladorPresentacions.php" method="post">
                    <input type="text" id="titolPresentacio" name="titolPresentacio" class="inputOpcionsPesentacio" placeholder="Titol Presentacio" maxlength="30" required value="<?php echo $titolPresentacio;?>">
                    <input type="text" id="descripcioPresentacio" name="descripcioPresentacio" class="inputOpcionsPesentacio" placeholder="Descripcio" value="<?php echo $descripcioPresentacio;?>">
                    <input type="text" id="pinPresentacio" name="pinPresentacio" maxlength="4" class="inputOpcionsPesentacio" placeholder="PIN opcional">
                    <input type="hidden" id="hiddenInputArrayDiapositives" name="hiddenInputArrayDiapositives">

                    <input type="hidden" id="estilPresentacio" name="estilPresentacio" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                </form>
            </div>
            
            <div class="afegirDiapositives">
              <div class="botonDespegable">
                  <button id="afegirTitol" class="afegirDiapositiva">Afegir Titol</button>
                  <button id="afegirTitolContingut" class="afegirDiapositiva">Afegir Titol i Contingut</button>
                  <button id="Test" class="afegirDiapositiva">Test</button>
              </div>
              <div id="PadrecontenedorDiapositivas"></div>
              <template class="TitolTemplate">
                  <input type="text" id="titolDiapositiva" class="inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat; ?>" placeholder="TITOL" maxlength="255">
                  <input type="hidden" id="tipusTitol" name="tipusTitol">
                </template>
              <template class="TitolContingutTemplate">
                  <input type="text" id="titolDiapositivaContingut" class="inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat; ?>" placeholder="TITOL" maxlength="30" required>
                  <textarea type="text" id="ContingutDiapositiva" class="inputOpcionsPesentacio inputContingutOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat; ?>" placeholder="CONTINGUT" maxlength="715"></textarea>
                  <input type="hidden" id="tipusContingut" name="tipusContingut">
                </template>
                <dialog id="dialeg">
                  <div class="preguntaAssociada">
                    <h2>Vols afegir una diapositiva associada?</h2>
                  </div>
                  <div class="buttonsAssociada">
                    <button id="yesButton">Si</button>
                    <button id="noButton">No</button>
                  </div>
                </dialog>
                <template class="preguntesSimplesTemplate">
                  <input type="text" id="titolPreguntaDiapositiva" class="inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat; ?>" placeholder="TITOL" maxlength="255">
                  <div id="contenidorPregunta" class="inputOpcionsPesentacio contenidorPregunta diapositiva<?php echo $nomClasseEstilSeleccionat; ?>"></div>
                  <label class="labelTest">Pregunta:</label>
                    <input type="text" class="preguntes" name="preguntes">
                  <label class="labelTest">1.-
                    <input type="text" class="opcionsPregunta" name="opcio1" placeholder="Opció 1">
                  </label>
                  <label class="labelTest">2.-
                    <input type="text" class="opcionsPregunta" name="opcio2" placeholder="Opció 2">
                  </label>
                  <label class="labelTest">3.-
                    <input type="text" class="opcionsPregunta" name="opcio3" placeholder="Opció 3">
                  </label>
                  <label class="labelTest">4.-
                    <input type="text" class="opcionsPregunta" name="opcio4" placeholder="Opció 4">
                  </label>
                  <label class="labelTest">Resposta corecte
                    <input type="text" class="opcioCorrecte" name="respostaCorrecte" placeholder="1, 2, 3, 4">
                  </label>
                  <input type="hidden" id="tipusContingut" name="tipusContingut">
                </template>
          </div>
        </div>
        <div class="opcionsDiapositiva">
            <div class="divBotoGuardarPresentacio">
                <img src='../../../Documentacion/imatges/icones/afegir.png' id="afegirDiapositives" alt='Icona afegir' class='icones afegir' />
                <button id="PrevisualitzarPresentacio" class="botoPrevisualitzar">Previsualitzar Presentacio</button>
                <button form="enviaDadesPresentacio" class="botoGuardarPresentacio">Guardar presentacio</button>
            </div>
            
            <div class="boxDiapositives">
                <div class="diapositiva <?php echo $nomClasseEstilSeleccionat; ?>"></div>
            </div>
        </div>
    </div>
    <script src="../../JavaScript/presentacio.js"></script>
</body>
</html>