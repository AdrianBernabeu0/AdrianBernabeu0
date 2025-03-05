<?php
require('../Database/Conexio.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);

if(isset($_POST['inputPin'])){
  $pin = htmlspecialchars($_POST['inputPin']);
  echo $pin;
  if(isset($_POST['inputPresentacioAVisualitzar'])){
    $url = urlencode($_POST['inputPresentacioAVisualitzar']);
    echo $url;
    $idPresentacio = preg_replace('/[^0-9]/', '', $_POST['inputPresentacioAVisualitzar']);
    echo $idPresentacio;
  }
  if($presentacio->matchPin($pin, $idPresentacio)){
    header('Location: ../Views/vistaPreviaPresentacio.php?k=' . $url);
    exit;
  }
  else{
    header('Location: ../Views/pantallaIntroduirPIN.php?k=' . $url . '&pin=error');
    exit;
  }
}