<?php

	session_start(); 
	date_default_timezone_set('America/Mexico_City');
	include 'bd/mnpBDsas.class.php';

?>

<ul class="chat">
                                    <!--------------Buscar todas las preguntas que existan-->
                                    <?php 
                                    
                                      $consultapreguntas="SELECT id_sesion, c.id_registrado, pregunta, fecha, nombreconstancia FROM chat as c INNER JOIN registrados as r ON c.id_registrado = r.id_registrado WHERE id_sesion = 1 ORDER BY fecha DESC";
                                      $preguntas=$bd->ExecuteE($consultapreguntas);
                                      ?>
                                      <?php if($preguntas!=null):?>
                                        <?php foreach ($preguntas as $pregunta):?>
                                          <!--Aqui las preguntas-->
                                          <?php 
                                          $fecha = $pregunta['fecha'];
                                          $nuevafecha = strtotime ( '-0 hour' , strtotime ( $fecha ) ) ;
                                          $pregunta["fecha_hora"] = date ( 'Y-m-d H:i:s' , $nuevafecha );
                                          ?>
                                          <?php  if($pregunta["id_registrado"]==$_SESSION['registrado']['id_registrado']){ ?>
                                          <li class="right clearfix"><span class="chat-img pull-right">
                                            <img src="https://placehold.it/50/55C1E7/fff&amp;text=Yo" alt="User Avatar" class="img-circle">
                                          </span>
                                          <div class="chat-body clearfix">
                                            <div class="header">
                                              <small class=" text-muted">
                                                <?php echo $pregunta['fecha_hora']; ?>
                                              </small>
                                              <strong class="pull-right primary-font"><?php echo $pregunta["nombreconstancia"]; ?>
                                              </strong>
                                            </div>
                                            <p style="color: black;">
                                             <?php echo $pregunta["pregunta"]; ?>
                                           </p>
                                         </div>
                                       </li>
                                       <?php  }else{ ?>
                                       <li class="left clearfix">
                                        <span class="chat-img pull-left">
                                          <img src="https://placehold.it/50/55C1E7/fff&amp;text=X" alt="User Avatar" class="img-circle">
                                        </span>
                                        <div class="chat-body clearfix">
                                          <div class="header">
                                            <strong class="primary-font">
                                              <?php echo $pregunta["nombreconstancia"]; ?>
                                            </strong> 
                                            <small class="pull-right text-muted">
                                              <?php echo $pregunta['fecha']; ?>
                                            </small>
                                          </div>
                                          <p style="color: black;">
                                            <?php echo $pregunta["pregunta"]; ?>
                                          </p>
                                        </div>
                                      </li> 
                                      <?php  } ?>                                                 
                                      <!--Fin de preguntas-->
                                    <?php endforeach; ?>
                                  <?php else: ?>
                                    No hay Preguntas
                                  <?php endif; ?>
    
                                <!--fin del listado e preguntas-->                                    
                              </ul>