<?php
    $Email = $_POST["email"];
    $object = $_POST["object"];
    $msg = $_POST["msg"];

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer\src\Exception.php';
    require 'PHPMailer\src\PHPMailer.php';
    require 'PHPMailer\src\SMTP.php';

    $email = new PHPMailer(TRUE);
    try {
        //Tentative de création d’une nouvelle instance de la classe PHPMailer
        $mail = new PHPMailer (true);
    } catch (Exception $e) {
        echo "Mailer Error: ".$mail->ErrorInfo;
    }

    $mail->isSMTP();
    $mail->SMTPAuth = true;
    //Informations personnelles
    $mail->Host = "ssl0.ovh.net";
    $mail->Port = "587";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Username = "oldschoolpizza@oldschoolpizza.fr";
    $mail->Password = "55FF0517D9ADCD08C5333460EF64";
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    if($Email != null) {
        //Expéditeur
        $mail->setFrom($Email, $Email);
        //Destinataire dont le nom peut également être indiqué en option
        $mail->addAddress('oldschoolpizza@oldschoolpizza.fr');
        // Copie
        $mail->addCC($Email);
    }
    $mail->isHTML(true);
    //object
    if($object != null) {
        $mail->Subject = $object;
    }
    //HTML-Inhalt
    $mail->Body = $msg;
    try {
        $mail->send();
        header("Location: ../index");
    } catch (Exception $e) {
        echo "Message could not be sent: ".$mail->ErrorInfo;
    }
?>