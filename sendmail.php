<?php
/**
 * Script d'envoi d'email pour le formulaire de demande de prêt
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
    $fullName = isset($_POST['demande']['fullName']) ? htmlspecialchars($_POST['demande']['fullName']) : '';
    $email = isset($_POST['demande']['email']) ? htmlspecialchars($_POST['demande']['email']) : '';
    $phone = isset($_POST['demande']['phone']) ? htmlspecialchars($_POST['demande']['phone']) : '';
    $country = isset($_POST['demande']['country']) ? htmlspecialchars($_POST['demande']['country']) : '';
    $profession = isset($_POST['demande']['profession']) ? htmlspecialchars($_POST['demande']['profession']) : '';
    $income = isset($_POST['demande']['income']) ? htmlspecialchars($_POST['demande']['income']) : '';
    $address = isset($_POST['demande']['address']) ? htmlspecialchars($_POST['demande']['address']) : '';
    $amount = isset($_POST['demande']['amount']) ? htmlspecialchars($_POST['demande']['amount']) : '';
    $motif = isset($_POST['demande']['motif']) ? htmlspecialchars($_POST['demande']['motif']) : '';
    $duration = isset($_POST['demande']['duration']) ? htmlspecialchars($_POST['demande']['duration']) : '';
    
    // Charger le template HTML
    require_once 'email-template.php';
    
    // Préparer les données pour le template
    $emailData = [
        'fullName' => $fullName,
        'email' => $email,
        'phone' => $phone,
        'country' => $country,
        'profession' => $profession,
        'income' => $income,
        'address' => $address,
        'amount' => $amount,
        'motif' => $motif,
        'duration' => $duration
    ];
    
    // Créer une version texte pour les clients qui ne supportent pas HTML
    $email_message_text = "Nuova richiesta di prestito dal sito\n\n";
    $email_message_text .= "Nome e cognome: $fullName\n";
    $email_message_text .= "E-mail: $email\n";
    $email_message_text .= "Telefono cellulare: $phone\n";
    $email_message_text .= "Paese: $country\n";
    $email_message_text .= "Professione: $profession\n";
    $email_message_text .= "Reddito mensile: $income\n";
    $email_message_text .= "Indirizzo di residenza: $address\n";
    $email_message_text .= "Di quanti soldi hai bisogno?: $amount\n";
    $email_message_text .= "Per cosa ti servono i soldi?: $motif\n";
    $email_message_text .= "Scegli la durata: $duration\n";
    
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
        $mail->addReplyTo($email ? $email : SMTP_EMAIL, $fullName ? $fullName : SMTP_NAME);
        
        // Contenu HTML professionnel
        $mail->isHTML(true);
        $mail->Subject = "Nuova richiesta di prestito dal sito";
        
        // Générer le template HTML
        $htmlBody = getEmailTemplate('prestito', $emailData);
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
                $mailConfirmation->addAddress($email, $fullName ? $fullName : '');
                $mailConfirmation->addReplyTo(SMTP_EMAIL, SMTP_NAME);
                
                // Contenu HTML de confirmation
                $mailConfirmation->isHTML(true);
                $mailConfirmation->Subject = "Conferma ricezione richiesta di prestito - pożyczka prywatna";
                
                // Générer le template de confirmation
                $confirmationBody = getConfirmationEmailTemplate('prestito', $emailData);
                $mailConfirmation->Body = $confirmationBody;
                
                // Version texte de confirmation
                $confirmationText = "Gentile $fullName,\n\n";
                $confirmationText .= "Abbiamo ricevuto la tua richiesta di prestito.\n\n";
                $confirmationText .= "La tua richiesta è stata ricevuta con successo e sarà esaminata al più presto.\n\n";
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
        echo json_encode(['success' => true, 'message' => 'Richiesta inviata con successo! Grazie per averci contattato.']);
        
    } catch (Exception $e) {
        // En cas d'erreur
        header('Content-Type: application/json');
        echo json_encode(['success' => false, 'message' => 'Errore nell\'invio della richiesta. Riprova più tardi.']);
        
        // Log de l'erreur (optionnel, pour le débogage)
        error_log("Erreur PHPMailer: " . $mail->ErrorInfo);
    }
} else {
    header("Location: anfrage.html");
    exit();
}
?>
