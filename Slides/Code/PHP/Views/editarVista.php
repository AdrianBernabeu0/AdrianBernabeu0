
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <link rel="stylesheet" href="../../CSS/global.css" />

    <!-- TIPOGRAFIA EXTERNA -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap" rel="stylesheet" />
</head>

<body>

    <header>
        <div>
            <nav>
                <div>
                    <a href="../Views/homeVista.php">
                        <img class="iconoHome" src="../../../Documentacion/imatges/icones/hogar.png" alt="icono home" />
                        <!-- ..\\..\\Documentacion\\imatges\\icones\\hogar.png" -->
                    </a>
                </div>

                <div class="nom">
                    <h1 >SLIDES|| EDITAR PRESENTACION</h1>
                </div>
            </nav>
        </div>
    </header>
    <div class="contenidorWarning">
                Escull una diapositiva
    </div>
    <div class="contenidorUrlPublicacio"><p class="pContenidorUrlPublicacio"></p></div>
    <div class="divBodyPresentacions">
        <div class="opcionsPresentacio">
            <div class="titolDescripcio">
            <?php botonsPrevisualitzacio($presentacioPrevisualitzar)?>
                <form id="enviaDadesPresentacio" action="actualitzarDades.php" method="post">
                    <input type="text" id="titolPresentacio" name="titolPresentacio" class="inputOpcionsPesentacio"
                        placeholder="Titol Presentacio" value="<?php echo $titolPresentacio;?>"/>
                    <input type="text" id="descripcioPresentacio" name="descripcioPresentacio"
                        class="inputOpcionsPesentacio" placeholder="Descripcio" value="<?php echo $descripcioPresentacion;?>"/>
                    <input type="text" id="pinPresentacio" name="pinPresentacio" maxlength="4" class="inputOpcionsPesentacio" placeholder="PIN opcional"
                          value="<?php echo $pinPresentacio;?>">
                    <input type="hidden" id="titolDiapositives" name="titolDiapositives">
                    <input type="hidden" id="contingutDiapositives" name="contingutDiapositives">
                    <input type="hidden" id="estilPresentacio" name="estilPresentacio" value="
                    <?php echo $nomClasseEstilSeleccionat;?>">
                    <input type="hidden" id="tipusDiapositiva" name="tipusDiapositiva">
                    <input type="hidden" id="posicioDiapositiva" name="posicioDiapositiva">
                    <input type="hidden" id="eliminaDiapositiva" name="eliminaDiapositiva">
                    <input type="hidden" id="idDiapositives" name="idDiapositives">
                </form>
                <form id="formPublicaPresentacions" action="../Controllers/publicaPresentacio.php" method="post">
                  <input type="hidden" id="presentacioAPublicar" name="presentacioAPublicar" value="<?php echo $id?>">
                  <input type="hidden" id="hiddenInputUrlPaginaPublicar" name="hiddenInputUrlPaginaPublicar">
                  <input type="hidden" id="hiddenArrayDiapositives" name="hiddenArrayDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives));?>">
                  <input type="hidden" id="hiddenEstil" name="hiddenEstil" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                  <input type="hidden" id="hiddenTitolPresentacio" name="hiddenTitolPresentacio">
                  <input type="hidden" id="hiddenDecripcioPresentacio" name="hiddenDecripcioPresentacio">
                  <input type="hidden" id="hiddenPin" name="hiddenPin" maxlength="4" class="inputOpcionsPesentacio" value="<?php echo $pinPresentacio;?>">
                </form>
                <form id="formDespublicaPresentacions" action="../Controllers/publicaPresentacio.php" method="post">
                  <input type="hidden" id="presentacioADespublicar" name="presentacioADespublicar" value="<?php echo $id?>">
                  <input type="hidden" id="hiddenInputUrlPaginaDespublicar" name="hiddenInputUrlPaginaDespublicar">
                  <input type="hidden" id="despublicaArrayDiapositives" name="despublicaArrayDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives));?>">
                  <input type="hidden" id="despublicaEstil" name="despublicaEstil" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                  <input type="hidden" id="despublicaTitolPresentacio" name="despublicaTitolPresentacio">
                  <input type="hidden" id="despublicaDecripcioPresentacio" name="despublicaDecripcioPresentacio">
                  <input type="hidden" id="despublicaPin" name="despublicaPin" maxlength="4" class="inputOpcionsPesentacio" value="<?php echo $pinPresentacio;?>">
                </form>
                <?php 
                if ($url != null) {
                  if($pinPresentacio != null){
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
                ?>
                <form id="formVistaPreviaDiapositives" action="../Views/vistaPreviaDiapositiva.php" method="post">
                  <input type="hidden" id="hiddenInputPrevisualitzarDiapositives" name="hiddenInputPrevisualitzarDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives));?>">
                  <input type="hidden" id="hiddenInputPrevisualitzarURL" name="hiddenInputPrevisualitzarURL">
                  <input type="hidden" id="estilPrevisualitzarDiapositiva" name="estilPrevisualitzarDiapositiva" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                  <input type="hidden" id="titolPrevisualitzarDiapositiva" name="titolPrevisualitzarDiapositiva">
                  <input type="hidden" id="descripcioPrevisualitzarDiapositiva" name="descripcioPrevisualitzarDiapositiva">
                  <input type="hidden" id="pinPrevisualitzarDiapositiva" name="pinPrevisualitzarDiapositiva" class="inputOpcionsPesentacio"
                          value="<?php echo $pinPresentacio;?>">
                  <input type="hidden" id="presentacioAEditar" name="presentacioAEditar" value="<?php echo $id?>">
                  <input type="hidden" id="idDiapositivaClicable" name="idDiapositivaClicable">
                </form>

              <form id="formVistaPrevia" action="../Views/vistaPreviaPresentacio.php" method="post">
                <input type="hidden" id="hiddenInputVistaPreviaDiapositives" name="hiddenInputVistaPreviaDiapositives" value="<?php echo htmlspecialchars(json_encode($arrayDiapositives));?>">
                <input type="hidden" id="hiddenInputVistaPreviaURL" name="hiddenInputVistaPreviaURL">
                <input type="hidden" id="estilPresentacioVistaPrevia" name="estilPresentacioVistaPrevia" value="<?php echo $nomClasseEstilSeleccionat; ?>">
                <input type="hidden" id="titolPresentacioVistaPrevia" name="titolPresentacioVistaPrevia">
                <input type="hidden" id="descripcioPresentacioVistaPrevia" name="descripcioPresentacioVistaPrevia">
                <input type="hidden" id="hiddenInputVistaPreviaPin" name="hiddenInputVistaPreviaPin" class="inputOpcionsPesentacio"
                          value="<?php echo $pinPresentacio;?>">
                <input type="hidden" id="idPresentacio" name="idPresentacio" value="<?php echo $id?>">
              </form>

              

            </div>

            <div id="eliminarSinColor" class="afegirDiapositives">
                <div class="botonDespegable">
                    <button id="afegirTitol" class="afegirDiapositiva">Afegir Titol</button>
                    <button id="afegirTitolContingut" class="afegirDiapositiva">Afegir Titol i Contingut</button>
                </div>
                
                <div id="PadrecontenedorDiapositivas">
                <?php
                $contador=1;
                $posicions = array_column($arrayRecojerDiapositiva, "posicio");
                array_multisort($posicions, SORT_ASC, $arrayRecojerDiapositiva);
                
                foreach ($arrayRecojerDiapositiva as $linea) {  
                  if(isset($linea['ID_Diapositiva'])){
                      if($linea['tipus']=='titolContingut'){
                      $titol = $linea['titol'];
                      $contingut = $linea['contingut'];
                      $idDiapositiva = $linea['ID_Diapositiva'];
                      
                    echo "<template id='TitolContingutTemplate".$contador."'>
                            <input type='text' id='titolDiapositivaContingut' name='titolDiapositivaContingut'
                            class='inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."' placeholder='TITOL' value='".(trim($titol))."'>
                            <textarea id='ContingutDiapositiva ' name='contingutDiapositiva'
                            class='inputOpcionsPesentacio inputContingutOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."' placeholder='CONTINGUT' value='".trim($contingut)."'></textarea>
                          </template>";
                          

                        echo "<div id='contenedorDiapositiva".$contador."' class='diapositivesAlContenidorScrolleable divClicable titolContingut ".$idDiapositiva." ".$nomClasseEstilSeleccionat."'>
                          <p>".$titol."</p>
                          <p>".$contingut."</p>
                        </div>";
                      }else if ($linea['tipus']=='nomesTitol'){
                    $titol = $linea['titol'];
                    $idDiapositiva = $linea['ID_Diapositiva'];
                    echo "<template id='TitolTemplate".$contador."'>
                          <input type='text' id='titolDiapositiva' name='titolDiapositiva' class='inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."'
                          placeholder='TITOL' value='".trim($titol)."'>
                          </template>";

                        echo "<div id='contenedorDiapositiva".$contador."' class='diapositivesAlContenidorScrolleableNomesTitol divClicable nomesTitol ".$idDiapositiva." ".$nomClasseEstilSeleccionat."'>
                          <p>".$titol."</p>
                        </div>";
                      }
              }else{
                if($linea['tipus']=='titolContingut'){
                  $titol = $linea['titol'];
                  $contingut = $linea['contingut'];
                  
                echo "<template id='TitolContingutTemplate".$contador."'>
                        <input type='text' id='titolDiapositivaContingut' name='titolDiapositivaContingut'
                        class='inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."' placeholder='TITOL' value='".(trim($titol))."'>
                        <textarea id='ContingutDiapositiva ' name='contingutDiapositiva'
                        class='inputOpcionsPesentacio inputContingutOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."' placeholder='CONTINGUT' value='".trim($contingut)."'></textarea>
                      </template>";
                      

                    echo "<div id='contenedorDiapositiva".$contador."' class='diapositivesAlContenidorScrolleable divClicable titolContingut ".$nomClasseEstilSeleccionat."'>
                      <p>".$titol."</p>
                      <p>".$contingut."</p>
                    </div>";
                  }else if ($linea['tipus']=='nomesTitol'){
                $titol = $linea['titol'];
                echo "<template id='TitolTemplate".$contador."'>
                      <input type='text' id='titolDiapositiva' name='titolDiapositiva' class='inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva".$nomClasseEstilSeleccionat."'
                      placeholder='TITOL' value='".trim($titol)."'>
                      </template>";

                    echo "<div id='contenedorDiapositiva".$contador."' class='diapositivesAlContenidorScrolleableNomesTitol divClicable nomesTitol ".$nomClasseEstilSeleccionat."'>
                      <p>".$titol."</p>
                    </div>";
                  }
              }
              $contador++;
            }
                ?>
            </div>
            </div>
        </div>
        <div class="opcionsDiapositiva">

            <div class="divBotoGuardarPresentacio">
                <img src='../../../Documentacion/imatges/icones/afegir.png' id="afegirDiapositives" alt='Icona afegir' class='icones afegir' />
                <img src='../../../Documentacion/imatges/icones/EliminaDiapositiva.png' id="elimina" alt='Icona elimina' class='icones elimina' />
                <img src='../../../Documentacion/imatges/icones/adalt.png' id="adaltPosicio" alt='Icona adalt' class='icones adalt' />
                <img src='../../../Documentacion/imatges/icones/abaix.png' id="abaixPosicio" alt='Icona abaix' class='icones abaix' />
                <div class="estils">
                    <div id="dark" class="darkEstils dark">
                      DARK
                  </div>
                  <div id="blue" class="blueEstils blue">
                      BLUE
                  </div>
                </div>
                <button form="enviaDadesPresentacio" class="botoGuardarPresentacio">Guardar Canvis</button>
            </div>
            
              <template class="TitolTemplate">
                  <input type="text" id="titolDiapositiva" class="inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat?>" placeholder="TITOL">
                  <input type="hidden" id="tipusTitol" name="tipusTitol">
                </template>
              <template class="TitolContingutTemplate">
                  <input type="text" id="titolDiapositivaContingut" class="inputOpcionsPesentacio inputTitolOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat?>" placeholder="TITOL">
                  <textarea id="ContingutDiapositiva" class="inputOpcionsPesentacio inputContingutOpcionsPresentacio diapositiva<?php echo $nomClasseEstilSeleccionat?>" placeholder="CONTINGUT"></textarea>
                  <input type="hidden" id="tipusContingut" name="tipusContingut">
                </template>
              
            <div class="boxDiapositives">
                <div class="diapositiva <?php echo $nomClasseEstilSeleccionat; ?>">
                
                </div>

            </div>

        </div>
    </div>
    <script src="../../JavaScript/editarPresentacio.js"></script>
</body>

</html>