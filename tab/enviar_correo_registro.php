<?php 
session_start();
date_default_timezone_set ( "America/Mexico_City");
include 'bd/mnpBDsas.class.php';

$consulta="SELECT * FROM registrados r INNER JOIN paises p ON r.id_pais=p.id_pais INNER JOIN estados e ON r.id_estado = e.id_estado WHERE r.id_registrado=".$_POST['id_registrado'];
$rescon=$bd->ExecuteE($consulta);
foreach($rescon as &$registrado){}

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
            .mainContent{width: 400px !important;}

            .main-image{width: 400px !important; height: auto !important;}
            .banner{width: 400px !important; height: auto !important;}
            /*------ sections ---------*/
            .section-item{width: 400px !important;}
            .section-img{width: 400px !important; height: auto !important;}
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

            .container{width: 280px !important;}
            .container-middle{width: 260px !important;}
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

    <style type="text/css" charset="utf-8">

        /** reset styling **/

        .firebugResetStyles {

            z-index: 2147483646 !important;

            top: 0 !important;

            left: 0 !important;

            display: block !important;

            border: 0 none !important;

            margin: 0 !important;

            padding: 0 !important;

            outline: 0 !important;

            min-width: 0 !important;

            max-width: none !important;

            min-height: 0 !important;

            max-height: none !important;

            position: fixed !important;

            transform: rotate(0deg) !important;

            transform-origin: 50% 50% !important;

            border-radius: 0 !important;

            box-shadow: none !important;

            background: transparent none !important;

            pointer-events: none !important;

            white-space: normal !important;

        }



        .firebugBlockBackgroundColor {

            background-color: transparent !important;

        }



        .firebugResetStyles:before, .firebugResetStyles:after {

            content: "" !important;

        }

        /**actual styling to be modified by firebug theme**/

        .firebugCanvas {

            display: none !important;

        }



        /* ------------------------- */

        .firebugLayoutBox {

            width: auto !important;

            position: static !important;

        }



        .firebugLayoutBoxOffset {

            opacity: 0.8 !important;

            position: fixed !important;

        }



        .firebugLayoutLine {

            opacity: 0.4 !important;

            background-color: #000000 !important;

        }



        .firebugLayoutLineLeft, .firebugLayoutLineRight {

            width: 1px !important;

            height: 100% !important;

        }



        .firebugLayoutLineTop, .firebugLayoutLineBottom {

            width: 100% !important;

            height: 1px !important;

        }



        .firebugLayoutLineTop {

            margin-top: -1px !important;

            border-top: 1px solid #999999 !important;

        }



        .firebugLayoutLineRight {

            border-right: 1px solid #999999 !important;

        }



        .firebugLayoutLineBottom {

            border-bottom: 1px solid #999999 !important;

        }



        .firebugLayoutLineLeft {

            margin-left: -1px !important;

            border-left: 1px solid #999999 !important;

        }



        /* ----------------- */

        .firebugLayoutBoxParent {

            border-top: 0 none !important;

            border-right: 1px dashed #E00 !important;

            border-bottom: 1px dashed #E00 !important;

            border-left: 0 none !important;

            position: fixed !important;

            width: auto !important;

        }



        .firebugRuler{

            position: absolute !important;

        }



        .firebugRulerH {

            top: -15px !important;

            left: 0 !important;

            width: 100% !important;

            height: 14px !important;

            border-top: 1px solid #BBBBBB !important;

            border-right: 1px dashed #BBBBBB !important;

            border-bottom: 1px solid #000000 !important;

        }



        .firebugRulerV {

            top: 0 !important;

            left: -15px !important;

            width: 14px !important;

            height: 100% !important;

            border-left: 1px solid #BBBBBB !important;

            border-right: 1px solid #000000 !important;

            border-bottom: 1px dashed #BBBBBB !important;

        }



        .overflowRulerX > .firebugRulerV {

            left: 0 !important;

        }



        .overflowRulerY > .firebugRulerH {

            top: 0 !important;

        }



        /* --------------------------------- */

        .fbProxyElement {

            position: fixed !important;

            pointer-events: auto !important;

        }

    </style>

</head>

<body leftmargin="0" topmargin="0" marginheight="0" marginwidth="0">
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <tbody><tr><td height="30"></td></tr>
            <tr bgcolor="#F1F2F7">
                <td align="center" bgcolor="#F1F2F7" valign="top" width="100%">

                    <!--  top header -->
                    <table class="container" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
                        <tbody>
                            <tr bgcolor="7087A3"><td height="15"></td></tr>

                            <tr bgcolor="7087A3">
                                <td align="center">
                                    <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                                        <tbody><tr>
                                            <td>
                                                <table class="top-header-left" align="left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody><tr>
                                                        <td align="center">
                                                            <table class="date" border="0" cellpadding="0" cellspacing="0">
                                                                <tbody><tr>
                                                                    <td>&nbsp;&nbsp;</td>
                                                                    <td style="color: #fefefe; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">
                                                                        <singleline>
                                                                            Registro a Sistema de transmisión en vivo 
                                                                        </singleline>
                                                                    </td>
                                                                </tr>

                                                            </tbody></table>
                                                        </td>
                                                    </tr>
                                                </tbody></table>

                                                <table class="top-header-right" align="left" border="0" cellpadding="0" cellspacing="0">
                                                    <tbody><tr><td height="20" width="30"></td></tr>
                                                    </tbody></table>
                                                </td>
                                            </tr>
                                        </tbody></table>
                                    </td>
                                </tr>

                                <tr bgcolor="7087A3"><td height="10"></td></tr>

                            </tbody>
                        </table>

                        <!--  end top header  -->


                        <!-- main content -->
                        <table class="container" align="center"  border="0" cellpadding="0" cellspacing="0" width="600" bgcolor="ffffff">


                            <!--Header-->
                            <tbody><tr ><td height="20"> </td></tr>


                                <!-- end header -->


                                <!--section 2 -->
                                <tr>
                                    <td>
                                        <table class="container-middle" align="center" border="0" cellpadding="0" cellspacing="0" width="560">
                                            <tr >
                                                <td>
                                                    <table class="mainContent" align="center" border="0" cellpadding="0" cellspacing="0" width="528">
                                                        <tbody><tr><td height="20"></td></tr>
                                                            <tr>
                                                                <td>



                                                                    <table class="section-item" align="left" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                                        <tbody>
                                                                            <tr>
                                                                                <td style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif; text-align: justify;">
                                                                                    Estimad@ '.$registrado["nombreconstancia"].', usted ha quedado registrado al sistema de transmisión en vivo.
                                                                                </td>
                                                                            </tr>
                                                                            <tr><td height="20"></td></tr>
                                                                            <tr>
                                                                                <td style="color: #484848; font-size: 16px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                                                                    Datos de registro

                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="15"></td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td style="color: #a4a4a4; line-height: 25px; font-size: 12px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;">

                                                                                    <strong>Nombre completo: </strong>'.$registrado["nombre"].' '.$registrado["apellidop"].' '.$registrado["apellidom"].'<br>
                                                                                    <strong>Prefijo: </strong>'.$registrado["prefijo"].'<br>
                                                                                    <strong>Correo: </strong>'.$registrado["email"].'<br>
                                                                                    <strong>Teléfono: </strong>'.$registrado["telefono"].'<br>
                                                                                    <strong>Pais: </strong>'.$registrado["pais"].'<br>
                                                                                    <strong>Estado: </strong>'.$registrado["estado"].'<br>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td height="15"></td>
                                                                            </tr>
                                                                            <tr><td height="15">Nota: Para esta sesión y las próximas, solo tendra que ingresar su correo para entrar.</td></tr>
                                                                        </tbody>
                                                                    </table>

                                                                    <img src> 

                                                                    <table align="left" border="0" cellpadding="0" cellspacing="0">
                                                                        <tbody><tr><td height="30" width="30"></td></tr>
                                                                        </tbody>
                                                                    </table>




                                                                </td>
                                                            </tr>


                                                        </tbody></table>
                                                    </td>
                                                </tr>



                                            </table>
                                        </td>
                                    </tr>
                                    <!-- end section 2 -->


                                    <tr><td height="35"></td></tr>


                                    <tr><td height="20"></td></tr>

                                    <tr><td height="30"></td></tr>
                                </tbody></table>
                                <!--end main Content -->


                                <!-- footer -->
                                <table class="container" border="0" cellpadding="0" cellspacing="0" width="600">
                                    <tbody>
                                        <tr bgcolor="7087A3"><td height="15"></td></tr>
                                        <tr bgcolor="7087A3">
                                            <td  style="color: #fff; font-size: 10px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;" align="center">
                                                Asofarma © Copyright 2020. Powered by <a href="http://www.grupolahe.com/">Grupo LAHE</a>

                                            </td>
                                        </tr>

                                        <tr>
                                            <td bgcolor="7087A3" height="14"></td>
                                        </tr>
                                    </tbody></table>
                                    <!-- end footer-->
                                </td>
                            </tr>

                            <tr><td height="30"></td></tr>

                        </tbody>
                    </table>


                </body>
                </html>';


                use PHPMailer\PHPMailer\PHPMailer;
                use PHPMailer\PHPMailer\Exception;

                require 'phpmailer/Exception.php';
                require 'phpmailer/PHPMailer.php';
                require 'phpmailer/SMTP.php';




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
$mail->FromName = 'Asofarma';           // Nombre del remitente
$mail->Subject = utf8_decode('Registro exitoso a la sesión de Asofarma Ginecología');                // Asunto

/** Incluir destinatarios. El nombre es opcional **/
$mail->addAddress($registrado['email'], $registrado['nombreconstancia']);

/** Con RE, CC, BCC **/
// $mail->addReplyTo('info@correo.com', 'Informacion');
$mail->addBCC('RegistroGrupoLahe@gmail.com');
// $mail->addBCC('marco.gonzalez@grupolahe.com');

/** Enviarlo en formato HTML **/
$mail->isHTML(true);                                  

/** Configurar cuerpo del mensaje **/
$mail->Body    = utf8_decode($html);

/** Para que use el lenguaje español **/
$mail->setLanguage('es');

/** Enviar mensaje... **/
$mail->send();