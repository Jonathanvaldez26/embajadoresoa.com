<?php
include '../virtual/bd/mnpBDsas.class.php';

  $pais=$_POST['pais'];
  $idEstado = $_POST['idEstado'];
  $operation = $_POST['operation']; 

  switch ($operation) {
      case 1 :
                $query="SELECT * FROM estados WHERE id_pais =".$pais;
                $estados=$bd->ExecuteE($query);
                $html="";  
                foreach ($estados as $estado){
                    $Selected  =  $idEstado == $estado['id_estado'] ?  "selected" : "";
                $html.='<option   '.$Selected .'    value="'.$estado['id_estado'].'">'.$estado['estado'].'</option>';
                }                
                                    
                class respuesta {
                public $success;
                public $html;
                }
                $respuesta = new respuesta();
                $respuesta->success = true;
                $respuesta->html = $html;
                echo json_encode($respuesta);
                break;
      case 2 :
                $query="SELECT * FROM estados WHERE id_pais =".$pais;
                $estados=$bd->ExecuteE($query);
                $html="";  
                foreach ($estados as $estado){
                $html.='<option value="'.$estado['id_estado'].'">'.$estado['estado'].'</option>';
                }                              
                class respuesta {
                public $success;
                public $html;
                }
                $respuesta = new respuesta();
                $respuesta->success = true;
                $respuesta->html = $html;
                echo json_encode($respuesta);      
      break ;   
  }



?>