<?php
class Diapositiva {
  private $conn;
    
  public function __construct(Conexio $conexio) {
    $this->conn = $conexio->getConnection();
  }
    
  // Aquesta funció inserta les diapositives a la taula de Diapositives a la bbdd 
  public function insertarDiapositiva($titol, $contingut, $id_presentacio, $estil,$tipusDiapositiva,$posicioDiapositiva, $idPregunta) {
    if(strlen($titol) >= 256) {
      echo "Mida invalida del titol de la diapositiva";
      die();
    }else{
    try {
      $sql = "INSERT INTO Diapositives (titol, contingut, Presentacio_ID, estil, tipus,posicio, pregunta_id) VALUES (:titol, :contingut, :id_presentacio, :estil, :tipusDiapositiva,:posicioDiapositiva, :idPregunta)";
      $stmnt = $this->conn->prepare($sql);
      $stmnt->bindParam(':titol', $titol);
      if ($contingut === null) {
        $stmnt->bindValue(':contingut', null, PDO::PARAM_NULL);
      } else {
        $stmnt->bindParam(':contingut', $contingut);
      }
      $stmnt->bindParam(':id_presentacio', $id_presentacio);
      $stmnt->bindParam(':estil', $estil);
      $stmnt->bindParam(':tipusDiapositiva', $tipusDiapositiva);
      $stmnt->bindParam(':posicioDiapositiva', $posicioDiapositiva);
      if ($idPregunta === null) {
        $stmnt->bindValue(':idPregunta', null, PDO::PARAM_NULL);
      } else {
        $stmnt->bindParam(':idPregunta', $idPregunta);
      }
        $stmnt->execute();
      } catch (PDOException $ex) {
        echo "Error al insertar en la taula Diapositives";
      }
    }
  }

  // Aquesta funció elimina totes les diapositives de la bbdd que la seva Presentacio_ID coincideixi amb la id que li passem per paràmetre
  public function eliminaTotesDiapositivesQueContinguinLaId($id){
    try{
      $sth = $this->conn->prepare("DELETE FROM Diapositives WHERE Presentacio_ID = :id");
      $sth->bindParam(':id', $id);
      $sth->execute();
      return true;
    } catch (PDOException $ex) {
      return false;
      echo 'Error al eliminar totes les diapositives amb id escollit';
    }
  }

  public function eliminaTotesDiapositivesAmbID($id){
    try{
      $sth = $this->conn->prepare("DELETE FROM Diapositives WHERE ID_Diapositiva = :id");
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al eliminar totes les diapositives amb id escollit';
    }
  }

  public function recollirDadesOpcions($id){
    try{
      $sth = $this->conn->prepare("SELECT pregunta_id, opcio FROM Opcions WHERE pregunta_id = :id");
      $sth->bindParam(":id", $id);
      $sth->execute();
      return $sth->fetchAll(\PDO::FETCH_ASSOC);
    }catch (PDOException $ex) {
      echo 'Error al mostrar les opcions';
    }
  }

  public function recollirDadesPregunta($id) {
    try {
        $sth = $this->conn->prepare("SELECT ID_Pregunta AS id, pregunta, p.resposta_correcte, p.associada FROM Preguntes p WHERE p.ID_Pregunta = :idPregunta");
        $sth->bindParam(":idPregunta", $id);
        $sth->execute();
        $result = $sth->fetchAll(\PDO::FETCH_ASSOC); 
        return $result; 
    } catch (PDOException $ex) {
        echo 'Error al mostrar les dades de les preguntes';
    }
}


  public function recollirDiapositives($id){
    try{
      $sth = $this->conn->prepare("Select ID_Diapositiva,titol,contingut,tipus,estil,posicio,pregunta_id FROM Diapositives WHERE Presentacio_ID = :id");
      $sth->bindParam(':id', $id);
      $sth->execute();
      return $sth->fetchAll(\PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo 'Error al recollir totes les diapositives amb id escollit';
    }
  }

  public function actualitzarDiapositiva($titol, $contingut, $id_presentacio, $estil,$tipusDiapositiva,$posicioDiapositiva) {
    try {
      $sql = "INSERT INTO Diapositives (titol, contingut, Presentacio_ID, estil, tipus,posicio) VALUES (:titol, :contingut, :id_presentacio, :estil, :tipusDiapositiva,:posicioDiapositiva)";
      $stmnt = $this->conn->prepare($sql);
      $stmnt->bindParam(':titol', $titol);
      if ($contingut === null) {
        $stmnt->bindValue(':contingut', null, PDO::PARAM_NULL);
      } else {
        $stmnt->bindParam(':contingut', $contingut);
      }
      $stmnt->bindParam(':id_presentacio', $id_presentacio);
      $stmnt->bindParam(':estil', $estil);
      $stmnt->bindParam(':tipusDiapositiva', $tipusDiapositiva);
      $stmnt->bindParam(':posicioDiapositiva', $posicioDiapositiva);
      $stmnt->execute();
    } catch (PDOException $ex) {
      echo "Error al insertar en la taula Diapositives";
    }
  }

  public function actualitzarTitol($id,$titol){
    try{
      $sth = $this->conn->prepare("UPDATE Diapositives SET titol=:titol WHERE ID_Diapositiva = :id");
      $sth->bindParam(':titol', $titol);
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al Actualtizar les dades de actualitzarTitol';
      var_dump($ex);
    }
  }

  public function actualitzarContingut($id,$contingut){
    try{
      $sth = $this->conn->prepare("UPDATE Diapositives SET contingut=:contingut WHERE ID_Diapositiva = :id");
      $sth->bindParam(':contingut', $contingut);
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al Actualtizar les dades de actualitzarContingut';  
    }
  }

  public function actualitzarEstil($id,$estil){
    try{
      $sth = $this->conn->prepare("UPDATE Diapositives SET estil=:estil WHERE ID_Diapositiva = :id");
      $sth->bindParam(':estil', $estil);
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al Actualtizar les dades de actualitzarEstil';
    }
  }

  public function actualitzarTipus($id,$tipus){
    try{
      $sth = $this->conn->prepare("UPDATE Diapositives SET tipus=:tipus WHERE ID_Diapositiva = :id");
      $sth->bindParam(':tipus', $tipus);
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al Actualtizar les dades de actualitzarTipus';
    }
  }

  public function actualitzarPosicio($id,$posicio){
    try{
      $sth = $this->conn->prepare("UPDATE Diapositives SET posicio=:posicio WHERE ID_Diapositiva = :id");
      $sth->bindParam(':posicio', $posicio);
      $sth->bindParam(':id', $id);
      $sth->execute();
    } catch (PDOException $ex) {
      echo 'Error al Actualtizar les dades de actualitzarPosicio';
    }
  }

  public function getEstil($idPresentacio) {
    try {
      $stmnt = $this->conn->prepare("SELECT DISTINCT estil FROM Diapositives WHERE Presentacio_ID = :idPresentacio");
      $stmnt->bindParam(':idPresentacio', $idPresentacio);
      $stmnt->execute();
      $result = $stmnt->fetch(PDO::FETCH_ASSOC);
      return $result['estil'];
    } catch (PDOException $ex) {
      echo "Error al obtenir l'estil de la presentació";
    }
  }

  public function getLastPregunta(){
    try {
      $sth = $this->conn->prepare("SELECT LAST_INSERT_ID() as last_id FROM Preguntes" );
      $sth->execute();
      $result = $sth->fetch(PDO::FETCH_ASSOC);
      return $result['last_id'];
    } catch (PDOException $ex) {
      echo "Error al seleccionar l'últim ID";
      return false;
    }
  }
  
  public function setPregunta($pregunta, $resposta, $associada){
    try {
      $sth = $this->conn->prepare("INSERT INTO Preguntes (pregunta, resposta_correcte, associada) VALUES (:pregunta, :resposta, :associada)");
      $sth->bindParam(':pregunta', $pregunta);
      $sth->bindParam(':resposta', $resposta);
      $sth->bindParam(':associada', $associada);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al insertar la pregunta";
    }
  }

  public function setOpcionsPregunta($opcio, $idPregunta){
    try {
      $sth = $this->conn->prepare("INSERT INTO Opcions (opcio, pregunta_id) VALUES (:opcio, :idPregunta)");
      $sth->bindParam(':opcio', $opcio);
      $sth->bindParam(':idPregunta', $idPregunta);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al insertar les opcions de la pregunta";
    }
  }

  public function getIdPregunta($idDiapositiva){
    try {
      $sth = $this->conn->prepare("SELECT pregunta_id FROM Diapositives WHERE pregunta_id = :idDiapositiva" );
      $sth->bindParam(':idDiapositiva', $idDiapositiva);
      $sth->execute();
      return $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo "Error al seleccionar la ID de la pregunta";
    }
  }

  public function getPregunta(){
    try {
      $sth = $this->conn->prepare("SELECT ID_Pregunta, pregunta FROM Preguntes");
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo "Error al seleccionar l'enunciat de la pregunta";
    }
  } 

  public function getOpcions(){
    try {
      $sth = $this->conn->prepare("SELECT ID_Opcio, opcio FROM Opcions");
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo "Error al seleccionar les opcions de la preguntes";
    }
  } 

  public function getResposta(){
    try {
      $sth = $this->conn->prepare("SELECT resposta_correcte FROM Preguntes" );
      $sth->execute();
      return $sth->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo "Error al seleccionar la resposta de la pregunta";
    }
  } 

  public function updatePregunta($novaPregunta, $idPregunta){
    try {
      $sth = $this->conn->prepare("UPDATE Preguntes SET pregunta=:novaPregunta WHERE ID_Pregunta = :idPregunta" );
      $sth->bindParam(':novaPregunta', $novaPregunta);
      $sth->bindParam(':idPregunta', $idPregunta);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al actualitzar l'enunciat de la pregunta";
    }
  }

  public function updateOpcio($novaOpcio, $idOpcio){
    try {
      $sth = $this->conn->prepare("UPDATE Opcions SET opcio=:novaOpcio WHERE ID_Opcio = :idOpcio" );
      $sth->bindParam(':novaOpcio', $novaOpcio);
      $sth->bindParam(':idOpcio', $idOpcio);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al actualitzar les opcions de la pregunta";
    }
  }

  public function updateResposta($novaResposta, $idPregunta){
    try {
      $sth = $this->conn->prepare("UPDATE Preguntes SET resposta_correcte=:novaResposta WHERE ID_Pregunta = :idPregunta" );
      $sth->bindParam(':novaResposta', $novaResposta);
      $sth->bindParam(':idPregunta', $idPregunta);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al actualitzar la resposta de la pregunta";
    }
  }

  public function getPreguntaIDFromDiapositiva($idDiapositiva){
      try {
        $sth = $this->conn->prepare("SELECT pregunta_id FROM Diapositives WHERE ID_Diapositiva = :idDiapositiva");
        $sth->bindParam(':idDiapositiva', $idDiapositiva);
        $sth->execute();
        return $sth->fetch(PDO::FETCH_ASSOC);
      } catch (PDOException $ex) {
        echo "Error al seleccionar ID_Pregunta";
      }
  }

  public function deleteTotAmbIDPregunta($idPregunta){
    try {
      $sth = $this->conn->prepare("DELETE FROM Preguntes WHERE ID_Pregunta = :idPregunta" );
      $sth->bindParam(':idPregunta', $idPregunta);
      $sth->execute();
      $sth = $this->conn->prepare("DELETE FROM Opcions WHERE ID_Pregunta = :idPregunta" );
      $sth->bindParam(':idPregunta', $idPregunta);
      $sth->execute();
    } catch (PDOException $ex) {
      echo "Error al eliminar els registres que continguin ID_Pregunta";
    }
  }

  public function getTipus($idDiapositiva){
    try {
      $sth = $this->conn->prepare("SELECT tipus FROM Diapositiva WHERE ID_Diapositiva = :idDiapositiva" );
      $sth->bindParam(':idDiapositiva', $idDiapositiva);
      $sth->execute();
      return $result = $sth->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
      echo "Error al eliminar els registres que continguin ID_Pregunta";
    }
  }
}