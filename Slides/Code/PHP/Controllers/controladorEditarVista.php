<?php
session_start();
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);

if (isset($_POST['presentacioAEditar'])|| isset($_GET['id'])){
  if(isset($_GET['id'])){
    $idPresentacioAEditar= htmlspecialchars($_GET['id']);
  }else{
    $idPresentacioAEditar = htmlspecialchars($_POST['presentacioAEditar']);
  }
    try{
      //Aquí Recollim l'íd. on et trobes
        $id =$idPresentacioAEditar;
        $_SESSION["idPresentacion"]=$id;

        //En aquesta funció recollim el títol i el contingut de la presentació.
       
        $arrayPresentacio=$presentacio->comparemSelects($id);
        $titolPresentacio=$arrayPresentacio[0]['titol'];
        $descripcioPresentacion=$arrayPresentacio[0]['descripcio'];
        $pinPresentacio=$arrayPresentacio[0]['pin'];
        $presentacioPrevisualitzar=$arrayPresentacio[0]['previsualizable'];
        $url=$arrayPresentacio[0]['url'];
        
        //En aquesta funció recollim el títol, el contingut, l'estil, el tipus i la posició de les Diapositives.
        $vistaArrayPreguntesOpcions=[];
        $arrayRecojerDiapositiva=$diapositiva->recollirDiapositives($id);
        $nomClasseEstilSeleccionat = $arrayRecojerDiapositiva[0]['estil'];
        $arrayDiapositives = isset($_POST['hiddenInputVistaPreviaDiapositives']) ? json_decode($_POST['hiddenInputVistaPreviaDiapositives'], true) : [];
        
        require_once(__DIR__."/../Views/editarVista.php");
        die();
    }        
    catch (PDOException $ex) {
        echo "Error al recollir les dades de la presentacio";
    }
}

if (isset($_POST['presentacioAPrevisualitzar'])){
    $presentacioAPrevisualitzar = htmlspecialchars($_POST['presentacioAPrevisualitzar']);
    // $estilsPresentacio = htmlspecialchars($_POST['estilPresentacio']);
    try{
      //Aquí Recollim l'íd. on et trobes
        $id =$presentacioAPrevisualitzar;
        $_SESSION["idPresentacion"]=$id;
        $titolPresentacio = isset($_POST['titolPresentacioVistaPrevia']) ? htmlspecialchars($_POST['titolPresentacioVistaPrevia']): "";
        $descripcioPresentacion = isset($_POST['descripcioPresentacioVistaPrevia']) ? htmlspecialchars($_POST['descripcioPresentacioVistaPrevia']): "";
        $pinPresentacio=isset($_POST['pinPresentacioVistaPrevia']) ? htmlspecialchars($_POST['pinPresentacioVistaPrevia']): "";
        $arrayDiapositives = isset($_POST['hiddenInputVistaPreviaDiapositives']) ? json_decode($_POST['hiddenInputVistaPreviaDiapositives'], true) : [];

        $arrayPresentacio=$presentacio->comparemSelects($id);
        $url=$arrayPresentacio[0]['url'];
        $presentacioPrevisualitzar=$arrayPresentacio[0]['previsualizable'];

        $arrayRecojerDiapositiva=$diapositiva->recollirDiapositives($id);
        $nomClasseEstilSeleccionat = $arrayRecojerDiapositiva[0]['estil'];
        $estil = isset($_POST['estilPresentacio']) ? htmlspecialchars($_POST['estilPresentacio']) : "";
      if($estil!=null) {
        $nomClasseEstilSeleccionat=$estil;
      }
      $arrayRecojerDiapositiva=$arrayDiapositives;
        require_once(__DIR__."/../Views/editarVista.php");
        die();
    }        
    catch (PDOException $ex) {
        echo "Error al recollir les dades de la presentacio";
    }
}
else{
    echo "No s'ha pogut entrar al formulari Despres de Previsualitzar";
}

function botonsPrevisualitzacio($previsualitzarHidden){
  if($previsualitzarHidden=='S'){
    echo "<div id='esPotPrevisualitzar' class='contenidorBotonsPrevisualitzacio'>
  <button id='previsualitzarPresentacio' class='previsualitzar'>previsualitzar Presentacio</button>
  <button id='previsualitzarDiapositives' class='previsualitzar'>previsualitzar Diapositiva</button>
 </div>";
  }else{
  echo "<div id='previsualitzarHidden' class='contenidorBotonsPrevisualitzacio'>
  <button id='previsualitzarPresentacio' class='previsualitzar'>previsualitzar Presentacio</button>
  <button id='previsualitzarDiapositives' class='previsualitzar'>previsualitzar Diapositiva</button>
 </div>";
  }
  
};