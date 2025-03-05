<?php
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');
require('../Clases/Presentacio.php');

$pdo = new Conexio();
$presentacio = new Presentacio($pdo);
$diapositiva = new Diapositiva($pdo);


$pin = isset($_POST['pinPresentacio']) ? htmlspecialchars($_POST['pinPresentacio']) : "";

if (isset($_POST['titolPresentacio']) && isset($_POST['descripcioPresentacio'])) {
    $titolPresentacio = htmlspecialchars($_POST['titolPresentacio']);
    $descripcioPresentacio = htmlspecialchars($_POST['descripcioPresentacio']);

    try {
        $presentacio->insertarPresentacion($titolPresentacio, $descripcioPresentacio, $pin);
        // Aquest valor l'utilitzem per saber quina ID de presentació hem d'assignar a la taula de diapositives
        $lastId = $presentacio->seleccionarIdUltimaPresentacio();

        if (isset($_POST['hiddenInputArrayDiapositives']) && isset($_POST['estilPresentacio'])){
          $arrayDiapositives = json_decode($_POST['hiddenInputArrayDiapositives'], true);
          $estilPresentacio = htmlspecialchars($_POST['estilPresentacio']);
          for ($i=0; $i < count($arrayDiapositives); $i++) { 
            $titol = $arrayDiapositives[$i]['titol'];
            $contingut = $arrayDiapositives[$i]['contingut'];
            $tipusDiapositiva = $arrayDiapositives[$i]['tipus'];
            $posicioDiapositiva = $arrayDiapositives[$i]['posicion'];
            if ($tipusDiapositiva === 'preguntesSimples') {
              $opcions = $arrayDiapositives[$i]['opcions'];
              $pregunta = $arrayDiapositives[$i]['pregunta'];
              $respostaCorrecte = $arrayDiapositives[$i]['respostaCorrecte'];
              $associada = $arrayDiapositives[$i]['associada']; 
              $diapositiva->setPregunta($pregunta,$respostaCorrecte, $associada);
              $idLastPregunta = $diapositiva->getLastPregunta();
              foreach ($opcions as $opcio) {
                $diapositiva->setOpcionsPregunta($opcio, $idLastPregunta);
              }
              $diapositiva->insertarDiapositiva($titol, $contingut, $lastId, $estilPresentacio, $tipusDiapositiva,$posicioDiapositiva, $idLastPregunta);
            }
            else{
              $diapositiva->insertarDiapositiva($titol, $contingut, $lastId, $estilPresentacio, $tipusDiapositiva,$posicioDiapositiva, null);
            }
          }
        }
        else{
          echo "No hi ha cap diapositiva";
        } 
    } catch (PDOException $ex) {
        echo "Error al guardar la presentació";
        var_dump($ex);
    }
} else {
    echo "No puc entrar a la presentació";
}
header('Location: ../Views/homeVista.php');
exit;
