<?php
require('../Database/Conexio.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);

$urlPublica = isset($_POST['hiddenInputUrlPaginaPublicar']) ? htmlspecialchars($_POST['hiddenInputUrlPaginaPublicar']) : "";

$urlDespublica = isset($_POST['hiddenInputUrlPaginaDespublicar']) ? htmlspecialchars($_POST['hiddenInputUrlPaginaDespublicar']) : "";

if(isset($_POST['presentacioADespublicar'])){
  $idPresentacioADespulicar = htmlspecialchars($_POST['presentacioADespublicar']);
  $presentacio->despublicaPresentacio($idPresentacioADespulicar);
  $url = parse_url($urlDespublica);
      if($url['path']=='/projecte-slides/Code/PHP/Views/homeVista.php'){
        header('Location: '. $urlDespublica);
        exit;
      }else{
        $arrayDiapositives = isset($_POST['despublicaArrayDiapositives']) ? json_decode($_POST['despublicaArrayDiapositives'], true) : [];
        $estil = isset($_POST['despublicaEstil']) ? htmlspecialchars($_POST['despublicaEstil']) : "";
        $titolPresentacio = isset($_POST['despublicaTitolPresentacio']) ? htmlspecialchars($_POST['despublicaTitolPresentacio']) : "";
        $descripcioPresentacio = isset($_POST['despublicaDecripcioPresentacio']) ? htmlspecialchars($_POST['despublicaDecripcioPresentacio']) : "";
        $pinPresentacio= isset($_POST['despublicaPin']) ? htmlspecialchars($_POST['despublicaPin']) : "";
        $idDiapositivaVisualitzacio= isset($_POST['presentacioADespublicar']) ? htmlspecialchars($_POST['presentacioADespublicar']) : "";
      }
}else{
  if(isset($_POST['presentacioAPublicar'])){
    $idPresentacio = htmlspecialchars($_POST['presentacioAPublicar']);
      $caracters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_.~';
      $urlGenerada = '';
  
      for ($i = 0; $i < 10; $i++) {
          $urlGenerada .= $caracters[random_int(0, strlen($caracters) - 1)];
      }
  
      $urlGenerada .= $idPresentacio;
      
      $presentacio->publicaPresentacio($idPresentacio, $urlGenerada);
      $url = parse_url($urlPublica);
      if($url['path']=='/projecte-slides/Code/PHP/Views/homeVista.php'){
        header('Location: '. $urlPublica);
        exit;
      }else{
        $arrayDiapositives = isset($_POST['hiddenArrayDiapositives']) ? json_decode($_POST['hiddenArrayDiapositives'], true) : [];
        $estil = isset($_POST['hiddenEstil']) ? htmlspecialchars($_POST['hiddenEstil']) : "";
        $titolPresentacio = isset($_POST['hiddenTitolPresentacio']) ? htmlspecialchars($_POST['hiddenTitolPresentacio']) : "";
        $descripcioPresentacio = isset($_POST['hiddenDecripcioPresentacio']) ? htmlspecialchars($_POST['hiddenDecripcioPresentacio']) : "";
        $pinPresentacio= isset($_POST['hiddenPin']) ? htmlspecialchars($_POST['hiddenPin']) : "";
        $idDiapositivaVisualitzacio= isset($_POST['presentacioAPublicar']) ? htmlspecialchars($_POST['presentacioAPublicar']) : "";
      }
  }else{
    echo "Error al publicar la presentació";
  }
}
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
  <script src="../../JavaScript/publicaPresentacio.js"></script>
</body>
</html>