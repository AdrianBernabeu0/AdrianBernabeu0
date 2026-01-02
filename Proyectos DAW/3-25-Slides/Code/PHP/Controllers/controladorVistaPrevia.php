<?php
session_start();
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);

if (isset($_POST['idPrevisualitzacio']) && isset($_POST['presentacioAVisualitzar'])){
    $idPresentacioAEditar = htmlspecialchars($_POST['idPrevisualitzacio']);
    $ojo = htmlspecialchars($_POST['presentacioAVisualitzar']);
    try{
      //Aquí Recollim l'íd. on et trobes
        $id =$idPresentacioAEditar;
        echo $ojo;
        //En aquesta funció recollim el títol i el contingut de la presentació.
       
        $presentacio->updatePrevisualitzacio($id, $ojo);
    }        
    catch (PDOException $ex) {
        echo "Error al permetre o denegar vista previa";
    }
}
else{
    echo "No s'ha pogut enviar les dades de previsualitzacio";
}
header('Location: ../Views/homeVista.php');

