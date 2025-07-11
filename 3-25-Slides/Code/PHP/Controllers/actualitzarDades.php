<?php
session_start();
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);

if (isset($_POST['titolPresentacio']) && isset($_POST['descripcioPresentacio'])) {
  $titolPresentacio = htmlspecialchars($_POST['titolPresentacio']);
  $descripcioPresentacio = htmlspecialchars($_POST['descripcioPresentacio']);
  $pinPresentacio = htmlspecialchars($_POST['pinPresentacio']);

  try {
    //Recollim l'íd. i el comparem amb el select que tenia aquesta íd. 
    //i si es té la mateixa que l'anterior no fa res, 
    //però si no són les mateixes dades fa un update la dada que es va fer sigui en titol o descripció de la presentació.
    $id=$_SESSION["idPresentacion"];
    $comparar=$presentacio->comparemSelects($id);
    if($titolPresentacio!=$comparar[0]['titol']){
      $presentacio->updatePresentacionTitol($id,$titolPresentacio);
    }
    if($descripcioPresentacio!=$comparar[0]['descripcio']){ 
      $presentacio->updatePresentacionContingut($id,$descripcioPresentacio);   
    }
    if($pinPresentacio!=$comparar[0]['pin']){ 
      $presentacio->updatePresentacionPin($id,$pinPresentacio);   
    }

      if (isset($_POST['titolDiapositives']) && isset($_POST['contingutDiapositives']) && isset($_POST['estilPresentacio'])&& isset($_POST['tipusDiapositiva'])&& isset($_POST['posicioDiapositiva'])) {
          /* Els valors d'aquests inputs son strings separades per la següent combinació: '!#$%&!'. 
          Amb explode, separo l'string cada cop que hi ha aquella combinació i assigno els valors a l'array */
          $titolArray = explode('!#$%&!', $_POST['titolDiapositives']);
          $contingutArray = explode('!#$%&!', $_POST['contingutDiapositives']);
          $estilPresentacio = htmlspecialchars($_POST['estilPresentacio']);
          $tipusDiapositivaArray = explode('!#$%&!', $_POST['tipusDiapositiva']);
          $posicioDiapositivaArray = explode('!#$%&!', $_POST['posicioDiapositiva']);
          $eliminaDiapositivaArray = explode('!#$%&!', $_POST['eliminaDiapositiva']);
          $idDiapositivesArray = explode('!#$%&!', $_POST['idDiapositives']);
          
          for ($i=0; $i < count($eliminaDiapositivaArray); $i++) { 
            $idDiapositiva = htmlspecialchars($eliminaDiapositivaArray[$i]);
            $diapositiva->eliminaTotesDiapositivesAmbID($idDiapositiva);
          }
          $diapositivaAntiga= $diapositiva->recollirDiapositives($id);
          for ($i=0; $i < count($idDiapositivesArray); $i++) {
            $arreglemPosicions=null;
            for ($f=0; $f < count($diapositivaAntiga); $f++) { 
              if ($idDiapositivesArray[$i]==$diapositivaAntiga[$f]) {
                $arreglemPosicions=$diapositivaAntiga[$i];
                $diapositivaAntiga[$i]=$diapositivaAntiga[$f];
                $diapositivaAntiga[$f]=$arreglemPosicions;
              }
              
            }
          }
          // Aquest if revisa que hi hagi els mateixos títols que continguts (alguns son null)
          if (count($titolArray) == count($contingutArray)) {
              $length = count($titolArray);

              /* Bucle for que recorre els dos arrays i va cridant a la funció insertarDiapositiva passant-li per paràmetre 
              el valor del títol i el contingut de la diapositiva */
              for ($i = 0; $i < $length; $i++) {

                if(isset($diapositivaAntiga[$i]['titol'])){
                  if(trim($titolArray[$i])!=$diapositivaAntiga[$i]['titol']){
                    $titol = htmlspecialchars($titolArray[$i]);
                    $diapositiva->actualitzarTitol($diapositivaAntiga[$i]['ID_Diapositiva'],$titol);
                  }
                }

                if(isset($diapositivaAntiga[$i]['contingut'])){
                  if(trim($contingutArray[$i])!=$diapositivaAntiga[$i]['contingut']){
                    $contingut = htmlspecialchars($contingutArray[$i]);
                    $diapositiva->actualitzarContingut($diapositivaAntiga[$i]['ID_Diapositiva'],$contingut);
                  }
                }
                if(isset($diapositivaAntiga[$i]['estil'])){
                  if(trim($estilPresentacio)!=$diapositivaAntiga[$i]['estil']){
                    $diapositiva->actualitzarEstil($diapositivaAntiga[$i]['ID_Diapositiva'],trim($estilPresentacio));
                  }
                }
                if(isset($diapositivaAntiga[$i]['tipus'])){
                  if(trim($tipusDiapositivaArray[$i])!=$diapositivaAntiga[$i]['tipus']){
                    $tipusDiapositiva = htmlspecialchars($tipusDiapositivaArray[$i]);
                    $diapositiva->actualitzarTipus($diapositivaAntiga[$i]['ID_Diapositiva'],$tipusDiapositiva);
                  }
                }
                
                if(isset($diapositivaAntiga[$i]['posicio'])){
                  if(trim($posicioDiapositivaArray[$i])!=$diapositivaAntiga[$i]['posicio']){
                    $posicioDiapositiva = htmlspecialchars($posicioDiapositivaArray[$i]);
                    $diapositiva->actualitzarPosicio($diapositivaAntiga[$i]['ID_Diapositiva'],$posicioDiapositiva);
                  }
                }
                if(isset($diapositivaAntiga[$i])){
                  if ($titolArray[$i]!=$diapositivaAntiga[$i]['titol']&&$contingutArray[$i]!=$diapositivaAntiga[$i]['contingut']&&$tipusDiapositivaArray[$i]!=$diapositivaAntiga[$i]['tipus']
                &&$estilPresentacio!=$diapositivaAntiga[$i]['estil']&&$posicioDiapositivaArray[$i]!=$diapositivaAntiga[$i]['posicio']) {
                  $titol = htmlspecialchars($titolArray[$i]);
                  $contingut = htmlspecialchars($contingutArray[$i]);
                  $tipusDiapositiva = htmlspecialchars($tipusDiapositivaArray[$i]);
                  $posicioDiapositiva = htmlspecialchars($posicioDiapositivaArray[$i]);
                  $diapositiva->  insertarDiapositiva($titol, $contingut, $id, $estilPresentacio, $tipusDiapositiva,$posicioDiapositiva,$idPregunta);
                }
                }else{
                  $titol = htmlspecialchars($titolArray[$i]);
                  $contingut = htmlspecialchars($contingutArray[$i]);
                  $tipusDiapositiva = htmlspecialchars($tipusDiapositivaArray[$i]);
                  $posicioDiapositiva = htmlspecialchars($posicioDiapositivaArray[$i]);
                  $diapositiva->  insertarDiapositiva($titol, $contingut, $id, $estilPresentacio, $tipusDiapositiva,$posicioDiapositiva,$idPregunta);
                }
              }
          }
      }
  } catch (PDOException $ex) {
      echo "Error al guardar la presentació";
  }
} else {
  echo "No puc entrar a la presentació";
}
header('Location: ../Views/homeVista.php');
exit;