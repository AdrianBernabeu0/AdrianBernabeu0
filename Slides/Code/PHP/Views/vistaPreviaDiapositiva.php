<?php 

$arrayDiapositives = isset($_POST['hiddenInputPrevisualitzarDiapositives']) ? json_decode($_POST['hiddenInputPrevisualitzarDiapositives'], true) : [];
$url = isset($_POST['hiddenInputPrevisualitzarURL']) ? htmlspecialchars($_POST['hiddenInputPrevisualitzarURL']) : "";
$estil = isset($_POST['estilPrevisualitzarDiapositiva']) ? htmlspecialchars($_POST['estilPrevisualitzarDiapositiva']) : "";
$titolPresentacio = isset($_POST['titolPrevisualitzarDiapositiva']) ? htmlspecialchars($_POST['titolPrevisualitzarDiapositiva']) : "";
$descripcioPresentacio = isset($_POST['descripcioPrevisualitzarDiapositiva']) ? htmlspecialchars($_POST['descripcioPrevisualitzarDiapositiva']) : "";
$idDiapositivaVisualitzacio = isset($_POST['presentacioAEditar']) ? htmlspecialchars($_POST['presentacioAEditar']) : "";
$idClicable = isset($_POST['idDiapositivaClicable']) ? htmlspecialchars($_POST['idDiapositivaClicable']) : "";
$pinPresentacio= isset($_POST['pinPrevisualitzarDiapositiva']) ? htmlspecialchars($_POST['pinPrevisualitzarDiapositiva']) : "";
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
  <form id="tornaALaPaginaAnterior" action= "<?php echo $url;?>" method="post">
    <input type="hidden" id="hiddenInputVistaPreviaDiapositives" name="hiddenInputVistaPreviaDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives)); ?>">
    <input type="hidden" id="estilPresentacio" name="estilPresentacio" value="<?php echo $estil;?>">
    <input type="hidden" id="titolPresentacioVistaPrevia" name="titolPresentacioVistaPrevia" value="<?php echo $titolPresentacio;?>">
    <input type="hidden" id="descripcioPresentacioVistaPrevia" name="descripcioPresentacioVistaPrevia" value="<?php echo $descripcioPresentacio;?>">
    <input type='hidden' id='pinPresentacioVistaPrevia' name='pinPresentacioVistaPrevia' value='<?php echo $pinPresentacio;?>'>
    <input type="hidden" id="presentacioAPrevisualitzar" name="presentacioAPrevisualitzar" value="<?php echo $idDiapositivaVisualitzacio;?>">
    <input type="hidden" id="idDiapositivaClicable" name="idDiapositivaClicable" value="<?php echo $idClicable?>">
    
  </form>
    <button class="acabaDeVisualitzar <?php echo $estil;?>Button">Acaba la visualització</button>
    <div class="vistaPreviaPresentacioDiapositives <?php echo $estil;?>">
    </div>
    <script src="../../JavaScript/previsualitzacioDiapositiva.js"></script>

</body>
</html>