<?php

require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);

$missatge = "";

if (isset($_POST['presentacioAEliminar'])){
    $idPresentacioAEliminar = htmlspecialchars($_POST['presentacioAEliminar']);
    try{
        /* Com la ID de la presentació és (exemple: 'presentacio8'), i a nosaltres només ens interessa el número, 
        agafem el caràcter que es troba a l'última posició de l'string amb substr($idPresentacioAEliminar, -1)*/
        $id =$idPresentacioAEliminar;
        if ($diapositiva->eliminaTotesDiapositivesQueContinguinLaId($id)) {
          if($presentacio->eliminaPresentacioQueContinguiLaId($id)){
            $missatge = "La presentació s'ha eliminat amb èxit";
          }
        }
        else{
          $missatge = "Error al eliminar la presentació";
        }
    }        
    catch (PDOException $ex) {
        echo "Error al eliminar les dades que continguin la id seleccionada";
    }
}
else{
    echo "No s'ha pogut entrar al formulari";
}

session_start();
$_SESSION['missatge'] = $missatge;

header('Location: ../Views/homeVista.php');
exit;