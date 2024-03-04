<?php

$hiddenInputVisualitzaPresentacioAmbPin = isset($_POST['hiddenInputVisualitzaPresentacioAmbPin']) ? htmlspecialchars($_POST['hiddenInputVisualitzaPresentacioAmbPin']) : "";

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PIN</title>
  <link rel="stylesheet" href="../../CSS/global.css" />
</head>
<body>
    <div class="contenidorFormulariPIN">
      <img src="../../../Documentacion/imatges/icones/creu.png" alt="Tanca formulari" class="creuTancaFormulari">
      <form id="formulariPIN" action="../Controllers/controladorPantallaIntroduirPin.php" method="post">
        <label class="labelPin" for="pin">Introdueix el PIN de la presentació: </label>
        <input type="password" id="inputPin" name="inputPin" maxlength="4">
        <input type="hidden" id="inputPresentacioAVisualitzar" name="inputPresentacioAVisualitzar" value="<?php echo urldecode($_GET['k']);?>">
      </form>
    </div>
    <?php
      if(isset($_GET['pin'])){
        echo "<div class='contenidorWarningPin'>PIN Incorrecte</div>";
      }
    ?>
  <script src="../../JavaScript/pantallaIntroduirPIN.js"></script>
</body>
</html>