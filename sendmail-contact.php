<?php
/**
 * Script d'envoi d'email pour le formulaire de contact
 * Utilise PHPMailer avec SMTP Gmail pour un envoi fiable
 */

// Charger la configuration
require_once 'config-email.php';

// Charger PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupération des données du formulaire
    $nom = isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $tel = isset($_POST['tel']) ? htmlspecialchars($_POST['tel']) : '';
    $country = isset($_POST['country']) ? htmlspecialchars($_POST['country']) : '';
    $profession = isset($_POST['profession']) ? htmlspecialchars($_POST['profession']) : '';
    $income = isset($_POST['income']) ? htmlspecialchars($_POST['income']) : '';
    $address = isset($_POST['address']) ? htmlspecialchars($_POST['address']) : '';
    $sujet = isset($_POST['sujet']) ? htmlspecialchars($_POST['sujet']) : '';
    $message = isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';
    
    // Charger le template HTML
    require_once 'email-template.php';
    
    // Préparer les données pour le template
    $emailData = [
        'nom' => $nom,
        'email' => $email,
        'tel' => $tel,
        'country' => $country,
        'profession' => $profession,
        'income' => $income,
        'address' => $address,
        'sujet' => $sujet,
        'message' => $message
    ];
    
    // Créer une version texte pour les clients qui ne supportent pas HTML
    $email_message_text = "Nouveau message de contact depuis le site\n\n";
    $email_message_text .= "Cognome e nome: $nom\n";
    $email_message_text .= "E-mail: $email\n";
    $email_message_text .= "Numero di telefono: $tel\n";
    $email_message_text .= "Pays: $country\n";
    $email_message_text .= "Profession: $profession\n";
    $email_message_text .= "Revenu mensuel: $income\n";
    $email_message_text .= "Adresse de domicile: $address\n";
    $email_message_text .= "Soggetto: $sujet\n";
    $email_message_text .= "Notizia:\n$message\n";
    
    // Créer une instance de PHPMailer
    $mail = new PHPMailer(true);
    
    try {
        // Configuration SMTP
        $mail->isSMTP();
        $mail->Host = SMTP_HOST;
        $mail->SMTPAuth = true;
        $mail->Username = SMTP_EMAIL;
        $mail->Password = SMTP_PASSWORD;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = SMTP_PORT;
        $mail->CharSet = 'UTF-8';
        
        // Expéditeur et destinataire
        $mail->setFrom(SMTP_EMAIL, SMTP_NAME);
        $mail->addAddress(EMAIL_DESTINATAIRE);
        $mail->addBCC(SMTP_EMAIL); // Copie pour l'expéditeur
        $mail->addReplyTo($email ? $email : SMTP_EMAIL, $nom ? $nom : SMTP_NAME);
        
        // Contenu HTML professionnel
        $mail->isHTML(true);
        $subject = $sujet ? "Nouveau message de contact - $sujet" : "Nouveau message de contact - Sans sujet";
        $mail->Subject = $subject;
        
        // Générer le template HTML
        $htmlBody = getEmailTemplate('contact', $emailData);
        $mail->Body = $htmlBody;
        $mail->AltBody = $email_message_text; // Version texte pour compatibilité
        
        // Headers supplémentaires pour forcer l'affichage HTML
        $mail->addCustomHeader('X-Mailer', 'PHPMailer');
        $mail->addCustomHeader('MIME-Version', '1.0');
        
        // S'assurer que le HTML est prioritaire
        $mail->ContentType = 'text/html; charset=UTF-8';
        
        // Envoi de l'email au destinataire
        $mail->send();
        
        // ENVOI DE L'EMAIL DE CONFIRMATION À L'UTILISATEUR
        if (!empty($email)) {
            $mailConfirmation = new PHPMailer(true);
            
            try {
                // Configuration SMTP (même configuration)
                $mailConfirmation->isSMTP();
                $mailConfirmation->Host = SMTP_HOST;
                $mailConfirmation->SMTPAuth = true;
                $mailConfirmation->Username = SMTP_EMAIL;
                $mailConfirmation->Password = SMTP_PASSWORD;
                $mailConfirmation->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mailConfirmation->Port = SMTP_PORT;
                $mailConfirmation->CharSet = 'UTF-8';
                
                // Expéditeur et destinataire (email de confirmation à l'utilisateur)
                $mailConfirmation->setFrom(SMTP_EMAIL, SMTP_NAME);
                $mailConfirmation->addAddress($email, $nom ? $nom : '');
                $mailConfirmation->addReplyTo(SMTP_EMAIL, SMTP_NAME);
                
                // Contenu HTML de confirmation
                $mailConfirmation->isHTML(true);
                $mailConfirmation->Subject = "Conferma ricezione messaggio - pożyczka prywatna";
                
                // Générer le template de confirmation
                $confirmationBody = getConfirmationEmailTemplate('contact', $emailData);
                $mailConfirmation->Body = $confirmationBody;
                
                // Version texte de confirmation
                $confirmationText = "Gentile $nom,\n\n";
                $confirmationText .= "Abbiamo ricevuto il tuo messaggio.\n\n";
                $confirmationText .= "Il tuo messaggio è stato ricevuto con successo e sarà esaminato al più presto.\n\n";
                $confirmationText .= "VERIFICA LE INFORMAZIONI:\n";
                $confirmationText .= "Ti preghiamo di verificare che tutte le informazioni fornite siano corrette.\n";
                $confirmationText .= "Se noti qualche errore o desideri modificare qualcosa, rispondi semplicemente a questa email.\n\n";
                $confirmationText .= "Cordiali saluti,\nIl team pożyczka prywatna";
                $mailConfirmation->AltBody = $confirmationText;
                
                // Envoi de l'email de confirmation
                $mailConfirmation->send();
            } catch (Exception $e) {
                // Si l'email de confirmation échoue, on continue quand même
                error_log("Erreur envoi confirmation: " . $mailConfirmation->ErrorInfo);
            }
        }
        
        // Réponse JSON pour AJAX
        header('Content-Type: application/json');
        echo json_encode(['success' => true, 'message' => 'Messaggio inviato con successo! Grazie per averci contattato.']);
        
    } catch (Exception $e) {
        // En cas d'erreur
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Errore nell\'invio del messaggio. Riprova più tardi.']);
        
        // Log de l'erreur (optionnel, pour le débogage)
        error_log("Erreur PHPMailer: " . $mail->ErrorInfo);
    }
} else {
    header("Location: contacto.html");
    exit();
}
?>
