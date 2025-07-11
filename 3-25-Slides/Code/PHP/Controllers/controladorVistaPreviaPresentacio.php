<?php

if(isset($_POST['hiddenInputVistaPreviaDiapositives']) && isset($_POST['estilPresentacio']) && isset($_POST['urlPaginaAnterior'])){
  $url = parse_url($_POST['urlPaginaAnterior']);
  header('Location: '. $url['path']);
}else{
  echo "Error al recollir les dades de la presentació";
}