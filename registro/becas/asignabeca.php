<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'phpmailer/Exception.php';
require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';

include '../../bd/mnpBDsas2.class.php';

$id_usuario=$_POST['id_usuario'];



$sqlbeca = "SELECT nombrecompleto, codigo, r.email FROM becas b, laboratorios l, registrados r WHERE usadopor = ".$id_usuario." AND l.id_laboratorio = b.id_laboratorio AND r.id_registrado =".$id_usuario;

$becas = $bd->ExecuteE($sqlbeca);
foreach($becas as $beca){}


$html='

            
<!DOCTYPE html>
<html lang="en">

<!-- Define Charset -->
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

<!-- Responsive Meta Tag -->
<meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;">

<title>Email Template</title>

<!-- Responsive and Valid Styles -->
<style type="text/css">
body{
    width: 100%;
    background-color: #F1F2F7;
    margin:0;
    padding:0;
    -webkit-font-smoothing: antialiased;
    font-family: arial;
}

html{
    width: 100%;
}

table{
    font-size: 14px;
    border: 0;
}

/* ----------- responsive ----------- */
@media only screen and (max-width: 640px){

/*------ top header ------ */
.header-bg{width: 440px !important; height: 10px !important;}
.main-header{line-height: 28px !important;}
.main-subheader{line-height: 28px !important;}

.container{width: 440px !important;}
.container-middle{width: 420px !important;}
.mainContent{width: 440px !important;}

.main-image{width: 440px !important; height: auto !important;}
.banner{width: 440px !important; height: auto !important;}
/*------ sections ---------*/
.section-item{width: 440px !important;}
.section-img{width: 440px !important; height: auto !important;}
/*------- prefooter ------*/
.prefooter-header{padding: 0 10px !important; line-height: 24px !important;}
.prefooter-subheader{padding: 0 10px !important; line-height: 24px !important;}
/*------- footer ------*/
.top-bottom-bg{width: 420px !important; height: auto !important;}

}

@media only screen and (max-width: 479px){

/*------ top header ------ */
.header-bg{width: 280px !important; height: 10px !important;}
.top-header-left{width: 260px !important; text-align: center !important;}
.top-header-right{width: 260px !important;}
.main-header{line-height: 28px !important; text-align: center !important;}
.main-subheader{line-height: 28px !important; text-align: center !important;}

/*------- header ----------*/
.logo{width: 260px !important;}
.nav{width: 260px !important;}

.container{width: 600px !important;}
.container-middle{width: 600px !important;}
.mainContent{width: 240px !important;}

.main-image{width: 240px !important; height: auto !important;}
.banner{width: 240px !important; height: auto !important;}
/*------ sections ---------*/
.section-item{width: 240px !important;}
.section-img{width: 240px !important; height: auto !important;}
/*------- prefooter ------*/
.prefooter-header{padding: 0 10px !important;line-height: 28px !important;}
.prefooter-subheader{padding: 0 10px !important; line-height: 28px !important;}
/*------- footer ------*/
.top-bottom-bg{width: 260px !important; height: auto !important;}

}


    </style>

</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody>
            <tr>
                <td height="30"></td>
            </tr>
            <tr bgcolor="#F1F2F7">
                <td align="center" bgcolor="#F1F2F7" valign="top" width="100%">
                    <!--  top header -->
                    <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                            <tr style="background-color: rgb(210,210,210);">
                                <td height="100" style="padding-left: 20px; padding-right: 20px;">
                                    <center><img src="https://congresoamh2021.mx/admin/img/cintillo_conf.png" width="450"></center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--  end top header  -->
                    <!-- main content -->
                    <table class="container" align="center"  border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="ffffff">
                    <!--section 1 -->
                        <tr>
                            <td>
                                <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                    <tr >
                                        <td>
                                            <table class="mainContent" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                                                <tr>
                                                    <td>
                                                        <table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                            <tbody >
                                                                

                                                                <tr>
                                                                    <td style="color: rgb(70,70,70); padding: 15px 30px 0 30px; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif; text-align: justify;">
                                                                        <p>
																		
																	 Bienvenido al <strong>XVI CONGRESO NACIONAL DE HEPATOLOGÍA 2021</strong> Usted a sido becado para participar en el evento que se estará realizando del 13 al 16 de Octubre del 2021. <br><br>
                                                                                       
                                                                     Podrá ingresar a la plataforma a partir del día <strong>13 de octubre</strong> con los siguientes datos:
        
                                                                        </p>
																		<hr>
																		<br>Nombre del laboratorio: <strong>'.$beca['nombrecompleto'].'</strong>
																		<br>Su c&oacute;digo de beca: <strong>'.$beca['codigo'].'</strong>
																		<br>Su correo electr&oacute;nico registrado: <strong>'.$beca['email'].'</strong><br>
																		<hr>  
																			<p>
                                                                           <a href="https://congresoamh2021.mx/" target="_blank">Link de la plataforma</a>
	
                                                                        </p>

                                                                         <p>
                                                                        <br><br>
                                                                            Sin otro particular agradecemos su participación.
                                                                        </p>
                                                                                                                                               
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td style="color: rgb(70,70,70); padding: 20px 30px 0 30px; font-size: 14px; font-weight: normal; font-family: Helvetica, Arial, sans-serif; text-align: justify;">
                                                                        <p>                                
                                                                            
                                                                        </p>
                                                                    </td>
                                                                </tr>

                                                            </tbody>
                                                        </table> 
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <!-- end section 1 -->
                </tbody>
            </table>
            <!--end main Content -->
            <!-- footer -->
            <table class="container" border="0" cellpadding="0" cellspacing="0" width="600">
                <tbody>
                <tr style="background-color: rgb(210,210,210);">
                        <td height="50"style="color: #333; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;" align="center">
                             AMH © Copyright 2021. 
                             <br>
                             Powered by <a style="color: #333;"href="http://www.grupolahe.com/">Grupo LAHE</a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <!-- end footer-->
        </td>
    </tr>
    <tr><td height="30"></td></tr>
</tbody>
</table>
</body>
</html>
        
			
			';

			//http://localhost/ametd_2020/verify.php?email='.$emailp.'&hash='.$hash.'
			
			$mail = new phpmailer;
			/** Configurar SMTP **/
			$mail->isSMTP();                                      // Indicamos que use SMTP
			$mail->Host = 'smtp.gmail.com';  // Indicamos los servidores SMTP
			$mail->SMTPAuth = true;                               // Habilitamos la autenticación SMTP
			$mail->Username = 'correosregistrogrupolahe@gmail.com';                 // SMTP username
			$mail->Password = 'Correosregistrogrupolahe1;';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Habilitar encriptación TLS o SSL
			$mail->Port = 587;                                    // TCP port

			/** Configurar cabeceras del mensaje **/
			$mail->From = 'registrogrupolahe@gmail.com';                       // Correo del remitente
			$mail->FromName = 'AMH';           // Nombre del remitente
			$mail->Subject = utf8_decode('Beca XVI CONGRESO NACIONAL DE HEPATOLOGÍA 2021');                   // Asunto

			/** Incluir destinatarios. El nombre es opcional **/
			$mail->addAddress($beca['email']);

			/** Con RE, CC, BCC **/
			// $mail->addReplyTo('info@correo.com', 'Informacion');
            //copia oculta
			$mail->addBCC('RegistroGrupoLahe@gmail.com');
			// $mail->addBCC('marco.gonzalez@grupolahe.com');

			/** Enviarlo en formato HTML **/
			$mail->isHTML(true);   
			$mail->AddEmbeddedImage('../../img/logos_2021.png','logo'); 
                               

			/** Configurar cuerpo del mensaje **/
			$mail->Body    = utf8_decode($html);
			
			/** Para que use el lenguaje español **/
			$mail->setLanguage('es');

			/** Enviar mensaje... **/
			$mail->send();
			echo 1;

?>