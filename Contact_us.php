<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Include PHPMailer autoload file

header('Content-Type: application/json'); // Make sure the response is in JSON format

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and retrieve form data
    $name = htmlspecialchars($_POST['Nom']);
    $email = htmlspecialchars($_POST['Email']);
    $phone = htmlspecialchars($_POST['Telephone']);
    $website = htmlspecialchars($_POST['Sujet']);
    $message = htmlspecialchars($_POST['Message']);

    if (!empty($email) && !empty($message)) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $mail = new PHPMailer(true);

            try {
                // SMTP configuration
                $mail->SMTPDebug = 0;
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'ikhlaselissaoui6@gmail.com'; 
                $mail->Password = 'zyngtojzuyltgnmp'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                // Email content
                $mail->setFrom($email, $name);
                $mail->addAddress('ikhlaselissaoui6@gmail.com'); 
                $mail->isHTML(true);
                $mail->Subject = "From: $name <$email>";
                $mail->Body = "Nom complet: $name<br>Email: $email<br>Téléphone: $phone<br>Sujet: $website<br><br>Message:<br>$message<br><br>Cordialement,<br>$name";

                $mail->send();
                $response['status'] = 'success';
                $response['message'] = 'Votre message a été envoyé avec succès';
            } catch (Exception $e) {
                $response['status'] = 'error';
                $response['message'] = 'Erreur: ' . $mail->ErrorInfo;
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Email invalide';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Tous les champs sont obligatoires';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Méthode de requête invalide';
}

echo json_encode($response);
?>
