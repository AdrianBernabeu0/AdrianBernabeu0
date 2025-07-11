<?php
require('../Database/Conexio.php');
require('../Clases/Diapositives.php');

// Aquesta funció selecciona a la bbdd tots els titols i les id de presentacions, que assigna al array que retorna
function getTitolsIdsPinUrl() {
  $conexio = new Conexio();
  $dtb = $conexio->getConnection();

  $sth = $dtb->query("SELECT ID_Presentacio, titol, pin,previsualizable, url FROM Presentacions");
  $sth->execute();

  return $sth->fetchAll(\PDO::FETCH_ASSOC);
}

/* 
  Aquesta funció rep com a paràmetre un array d'objectes amb tots els títols e ID de presentacions que i ha a la bbdd.
  Recorre amb un bucle forEach aquest array i assigna el valor que tenen ID_Presentacio i titol a les variables a $id i $titol respectivament. 
  Després, crea el codi HTML de les resentacions, utilitzant el valor d'aquestes variables per assignar la ID de la presentació i el títol, 
  que és el que es veurà a la pàgina Home 
*/
function crearDivPresentacio($arrayTitolsIdsPinUrl) {
  foreach ($arrayTitolsIdsPinUrl as $linea) {
      $id = $linea['ID_Presentacio'];
      $titol = $linea['titol'];
      $pin = $linea['pin'];
      $url = $linea['url'];
      $previsualizable=$linea['previsualizable'];

      if ($url != null) {
        if($pin != null){
          echo "<div id='presentacio" . $id . "' class='presentacions contePin publicada'>";
        }else{
          echo "<div id='presentacio" . $id . "' class='presentacions sensePin publicada'>";
        }
      }
      else{
        if($pin != null){
          echo "<div id='presentacio" . $id . "' class='presentacions contePin noPublicada'>";
        }else{
          echo "<div id='presentacio" . $id . "' class='presentacions sensePin noPublicada'>";
        }
      }
      if($previsualizable =='S'){
        echo "<div class='divOptionsIcona'>
            <img src='../../../Documentacion/imatges/icones/copiar.png' alt='Icona copia' class='icones copia' />
            <img src='../../../Documentacion/imatges/icones/ojo.png' alt='Icona visualització' class='icones visualitza' id='imatgeUll'>
            <img src='../../../Documentacion/imatges/icones/editar.png' alt='Icona edita' class='icones edita'/>
            <img src='../../../Documentacion/imatges/icones/papelera.png' alt='Icona elimina' class='icones elimina' />
            </div>";
      }else{
        echo "<div class='divOptionsIcona'>
            <img src='../../../Documentacion/imatges/icones/copiar.png' alt='Icona copia' class='icones copia' />
            <img src='../../../Documentacion/imatges/icones/ojo-tachado.png' alt='Icona visualització' class='icones visualitza' id='imagenOjoTachado'>
            <img src='../../../Documentacion/imatges/icones/editar.png' alt='Icona edita' class='icones edita'/>
            <img src='../../../Documentacion/imatges/icones/papelera.png' alt='Icona elimina' class='icones elimina' />
            </div>";
      }
      
      echo "<div class='divMissatge'><span class='textDivPresentacio'>" . $titol . "</span></div>";
      if ($url != null) {
        if($pin != null){
          echo "
            <div class='contenidorBotonsPublicar'>
             <button class='buttonPublicaPresentacio'>Despublica</button>
             <button class='buttonPublicaPresentacio'>Mostra URL</button>
            </div>";
            echo "<span class='urlGenerada'>192.168.50.164/projecte-slides/Code/PHP/Views/vistaPreviaPresentacio.php?k=$url&pwd=y</span>";
        }else{
          echo "
            <div class='contenidorBotonsPublicar'>
             <button class='buttonPublicaPresentacio'>Despublica</button>
             <button class='buttonPublicaPresentacio'>Mostra URL</button>
            </div>";
            echo "<span class='urlGenerada'>192.168.50.164/projecte-slides/Code/PHP/Views/vistaPreviaPresentacio.php?k=$url</span>";
        }
      }else{
        echo "<button class='buttonPublicaPresentacio'>Publica</button>";
      }
      echo "</div>";

  }
}
