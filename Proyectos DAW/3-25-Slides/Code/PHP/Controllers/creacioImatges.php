<?php
$arrayDiapositives = isset($_POST['hiddenArrayDiapositives']) ? json_decode($_POST['hiddenArrayDiapositives'], true) : [];
$estil = isset($_POST['hiddenEstil']) ? htmlspecialchars($_POST['hiddenEstil']) : "";
$titolPresentacio = isset($_POST['hiddenTitolPresentacio']) ? htmlspecialchars($_POST['hiddenTitolPresentacio']) : "";
$descripcioPresentacio = isset($_POST['hiddenDecripcioPresentacio']) ? htmlspecialchars($_POST['hiddenDecripcioPresentacio']) : "";
$pinPresentacio= isset($_POST['hiddenPin']) ? htmlspecialchars($_POST['hiddenPin']) : "";
$idDiapositivaVisualitzacio = isset($_POST['hiddenId']) ? htmlspecialchars($_POST['hiddenId']) : "";
$idClicable = isset($_POST['idDiapositivaClicat']) ? htmlspecialchars($_POST['idDiapositivaClicat']) : "";
$titolDiapositivaContingut = isset($_POST['titolDiapositivaContingut']) ? htmlspecialchars($_POST['titolDiapositivaContingut']) : "";

$exist=false;
$numImatge=false;
if (isset($_FILES["imatgeDiapositiva"])) {
  
    if ($_FILES["imatgeDiapositiva"]["error"] == UPLOAD_ERR_OK) { 
        $folderLocation = "../Imatges/";
        $ImatgeExist=$folderLocation.$_FILES["imatgeDiapositiva"]["name"];
        $Imatge=$_FILES["imatgeDiapositiva"]["name"];
        if (!file_exists($folderLocation)) { 
            mkdir($folderLocation);
        }
        $ImatgeExist=$folderLocation.$_FILES["imatgeDiapositiva"]["name"];
        $Imatge=$_FILES["imatgeDiapositiva"]["name"];
        $ImatgeInicial=$_FILES["imatgeDiapositiva"]["name"];

        for ($i=1; $exist==false; $i++) { 
          if (file_exists($ImatgeExist)) {
            $imatgeSenseExtencio=pathinfo($ImatgeInicial,PATHINFO_FILENAME).$i;
            $Imatge=$imatgeSenseExtencio.".png";
            $ImatgeExist=$folderLocation.$Imatge;
          }else{
            move_uploaded_file($_FILES["imatgeDiapositiva"]["tmp_name"], "$folderLocation/" . basename($Imatge));
            $exist=true;
          }
      }

        move_uploaded_file($_FILES["imatgeDiapositiva"]["tmp_name"], "$folderLocation/" . basename($_FILES["imatgeDiapositiva"]["name"])); 
    }
}
$arrayDiapositives[$idClicable]['imatge']=$ImatgeExist;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
    
  <form id="tornaALaPaginaAnterior" action= "controladorEditarVista.php" method="post">
    <input type="hidden" id="hiddenInputVistaPreviaDiapositives" name="hiddenInputVistaPreviaDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives)); ?>">
    <input type="hidden" id="estilPresentacio" name="estilPresentacio" value="<?php echo $estil;?>">
    <input type="hidden" id="titolPresentacioVistaPrevia" name="titolPresentacioVistaPrevia" value="<?php echo $titolPresentacio;?>">
    <input type="hidden" id="descripcioPresentacioVistaPrevia" name="descripcioPresentacioVistaPrevia" value="<?php echo $descripcioPresentacio;?>">
    <input type='hidden' id='pinPresentacioVistaPrevia' name='pinPresentacioVistaPrevia' value='<?php echo $pinPresentacio;?>'>
    <input type="hidden" id="presentacioAPrevisualitzar" name="presentacioAPrevisualitzar" value="<?php echo $idDiapositivaVisualitzacio;?>">
  </form>
  <script src="../../JavaScript/creacioImatges.js"></script>
</body>
</html>