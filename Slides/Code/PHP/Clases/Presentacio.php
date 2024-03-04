<?php

class Presentacio{
    private $conn;

    public function __construct(Conexio $conexio){
        $this->conn = $conexio->getConnection();
    }

    // Aquesta funció inserta la presentació a la taula de Presentacions ala bbdd 
    public function insertarPresentacion($titol,$descripcio, $pin){
        try {
          if(strlen($titol)>= 31){
            echo "Mida del titol de presentacio invalida";
            die();
          }else{
            $stmnt = $this->conn->prepare("INSERT INTO Presentacions (titol, descripcio, pin) VALUES (:titol, :descripcio, :pin)");
            $stmnt->bindParam(':titol', $titol);
            $stmnt->bindParam(':descripcio', $descripcio);
            if ($pin === null) {
              $stmnt->bindValue(':pin', null, PDO::PARAM_NULL);
            } else {
              $stmnt->bindParam(':pin', $pin);
            }
            $stmnt->execute();
          }
        } catch (PDOException $ex) {
            echo "Error de d'inserció";
        }
    }

    // Aquesta funció selecciona la id de l'última presentació insertada, que utilitzarem per fer els inserts de les diapositives
    public function seleccionarIdUltimaPresentacio(){
        try {
            $sth = $this->conn->prepare("SELECT LAST_INSERT_ID() as last_id FROM Presentacions" );
            $sth->execute();
            $result = $sth->fetch(PDO::FETCH_ASSOC);
            return $result['last_id'];
        } catch (PDOException $ex) {
            echo "Error al seleccionar l'último ID";
            return false;
        }
    }

    // Aquesta funció elimina la presentació de la bbdd que la seva ID coincideixi amb la ID que li passem per paràmetre
    public function eliminaPresentacioQueContinguiLaId($id){
        try{
            $sth = $this->conn->prepare("DELETE FROM Presentacions WHERE ID_Presentacio = :id");
            $sth->bindParam(':id', $id);
            $sth->execute();
            return true;
        } catch (PDOException $ex) {
            echo 'Error al eliminar la presentació amb la ID escollida';
        }
    }
    
    public function comparemSelects($id){
      try{
        $sth = $this->conn->prepare("Select titol,descripcio,pin,previsualizable,url FROM Presentacions WHERE ID_Presentacio = :id");
        $sth->bindParam(':id', $id);
        $sth->execute();
        return $sth->fetchAll(\PDO::FETCH_ASSOC);
    } catch (PDOException $ex) {
        echo 'Error al 8ollir el titol i descripcio de la id escollit';
    }
    }
    
    public function updatePresentacionTitol($id,$titol){
        try{
            $stmnt = $this->conn->prepare("UPDATE Presentacions SET titol=:titol WHERE ID_Presentacio = :id");
            $stmnt->bindParam(':id', $id);
            $stmnt->bindParam(':titol', $titol);
            $stmnt->execute();
        } catch (PDOException $ex) {
            echo 'Error al eliminar la presentació amb la ID escollida';
        }
    }
    public function updatePresentacionContingut($id,$descripcio){
      try{
          $stmnt = $this->conn->prepare("UPDATE Presentacions SET descripcio=:descripcio WHERE ID_Presentacio = :id");
          $stmnt->bindParam(':id', $id);
          $stmnt->bindParam(':descripcio', $descripcio);
          $stmnt->execute();
      } catch (PDOException $ex) {
          echo 'Error al eliminar la presentació amb la ID escollida';
      }
    }

    public function publicaPresentacio($idPresentacio, $urlGenerada){
      try{
          $stmnt = $this->conn->prepare("UPDATE Presentacions SET url = :urlGenerada WHERE ID_Presentacio = :idPresentacio");
          $stmnt->bindParam(':idPresentacio', $idPresentacio);
          $stmnt->bindParam(':urlGenerada', $urlGenerada);
          $stmnt->execute();
      } catch (PDOException $ex) {
          echo 'Error al publicar la presentació';
      }
  }

  public function despublicaPresentacio($idPresentacio){
    try{
        $stmnt = $this->conn->prepare("UPDATE Presentacions SET url = NULL WHERE ID_Presentacio = :idPresentacio");
        $stmnt->bindParam(':idPresentacio', $idPresentacio);
        $stmnt->execute();
    } catch (PDOException $ex) {
        echo 'Error al despublicar la presentació';
    }
}

public function matchPin($pin, $idPresentacio) {
  try {
    $stmnt = $this->conn->prepare("SELECT pin FROM Presentacions WHERE ID_Presentacio = :idPresentacio");
    $stmnt->bindParam(':idPresentacio', $idPresentacio);
    $stmnt->execute();
    $result = $stmnt->fetch(PDO::FETCH_ASSOC);
    
    if ($result['pin'] === $pin) {
      return true;
    } else {
      return false;
    } 
  } catch (PDOException $ex) {
    echo 'Error al obtenir el PIN de la presentació';
  }
}
public function updatePresentacionPin($id,$pinPresentacio){
  try{
      $stmnt = $this->conn->prepare("UPDATE Presentacions SET pin=:pin WHERE ID_Presentacio = :id");
      $stmnt->bindParam(':id', $id);
      $stmnt->bindParam(':pin', $pinPresentacio);
      $stmnt->execute();
  } catch (PDOException $ex) {
      echo 'Error al eliminar la presentació amb la ID escollida';
  }
}
public function updatePrevisualitzacio($id,$previsualitzacio){
  try{
      $stmnt = $this->conn->prepare("UPDATE Presentacions SET previsualizable=:previsualizable WHERE ID_Presentacio = :id");
      $stmnt->bindParam(':id', $id);
      $stmnt->bindParam(':previsualizable', $previsualitzacio);
      $stmnt->execute();
  } catch (PDOException $ex) {
      echo 'Error al actualizar les dades de previsualitzacio';
  }
}
}