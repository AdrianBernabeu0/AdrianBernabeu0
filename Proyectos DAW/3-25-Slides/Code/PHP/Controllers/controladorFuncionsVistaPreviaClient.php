<?php
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);


function getDadesDiapositiva($idPresentacio, $diapositiva) {
  $arrayDadesDiapositiva = $diapositiva->recollirDiapositives($idPresentacio);
  return $arrayDadesDiapositiva;
}

function getDadesPreguntes($idPregunta, $diapositiva) {
  $arrayDadesPreguntes = $diapositiva->recollirDadesPregunta($idPregunta);
  return $arrayDadesPreguntes;
}

function getOpcions($idPregunta, $diapositiva) {
  $arrayOpcions = $diapositiva->recollirDadesOpcions($idPregunta);
  return $arrayOpcions;
}

function getEstilPresentacio($idPresentacio, $diapositiva){
  $estil = $diapositiva->getEstil($idPresentacio);
  return $estil;
}