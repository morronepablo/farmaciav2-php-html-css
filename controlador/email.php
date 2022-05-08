<link rel="stylesheet" href="../css/pdf.css">
<?php 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../modelo/Exception.php';
require '../modelo/PHPMailer.php';
require '../modelo/SMTP.php';
//require '../modelo/OAuth.php';


$plantilla='
    <body>
    <header class="clearfix">
      <div id="logo">
        <img src="../img/logo.png" width="60" height="60">
      </div>
      <h1>RECUPERACION DE CONTRASEÑA</h1>
      <div id="company" class="clearfix">
        <div id="negocio">Farmacia Morrone</div>
        <div>Direccion Numero ###,<br /> Ciudad, Provincia</div>
        <div>(344) 342234</div>
        <div><a href="mailto:company@example.com">company@example.com</a></div>
      </div>';
    $plantilla.='
    </header>
    <main>
        <tbody>';
          
          $plantilla.='
          <tr>
            <td>SU NUEVA CONTRASEÑA :     jkdshkjfhkjh <br><br><br></td>
          </tr>';

       $plantilla.='
        </tbody>
      </table>
      <div id="notices">
      </div>
    </main>
    <footer>
      Created by Warpiece (Morrone Pablo Martín) Ingeniero Informatico y Analista desarrollador.
    </footer>
  </body>';









	
	$mail = new PHPMailer(true);

	try {
	    //Server settings
	    $mail->SMTPDebug = 2;                      // Enable verbose debug output
	    $mail->isSMTP();
	                                               // Send using SMTP
	    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
	    $mail->SMTPAuth   = true;
	                                       // Enable SMTP authentication
	    $mail->Username   = 'morronepablo@gmail.com';                     // SMTP username
	    $mail->Password   = 'natyteamo11';
	                                   // SMTP password
	    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
	    $mail->Port       = 587 ;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

	    //Recipients
	    $mail->setFrom('morronepablo@gmail.com');
	    $mail->addAddress('morronepablo@gmail.com');     // Add a recipient

	    // Content
        $mail->isHTML(true);
                                 // Set email format to HTML
	    $mail->Subject = 'RECUPERO DE CONTRASEÑA';
	    $mail->Body    = $plantilla;

	    $mail->send();
	    $mail->getSMTPInstance()->reset();
	    
	} catch (Exception $e) {
	    echo 'Algo salio mal:', $e->getMessage();
	}