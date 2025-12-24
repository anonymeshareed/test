<?php
/**
 * Test d'envoi d'email HTML professionnel
 */

// Charger la configuration
require_once 'config-email.php';

// Charger PHPMailer
require 'vendor/autoload.php';

// Charger le template
require_once 'email-template.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Données de test
$testData = [
    'fullName' => 'Test User',
    'email' => 'test@example.com',
    'phone' => '+2296565653231',
    'country' => 'Benin',
    'profession' => 'Test Profession',
    'income' => '46556',
    'address' => 'Test Address',
    'amount' => '2000',
    'motif' => 'Spese impreviste',
    'duration' => '24'
];

echo "<h2>Test d'envoi d'email HTML professionnel</h2>";

$mail = new PHPMailer(true);

try {
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_EMAIL;
    $mail->Password = SMTP_PASSWORD;
    $mail->SMTPSecure = SMTP_SECURE;
    $mail->Port = SMTP_PORT;
    $mail->CharSet = 'UTF-8';
    
    // Expéditeur et destinataire
    $mail->setFrom(SMTP_EMAIL, SMTP_NAME);
    $mail->addAddress(EMAIL_DESTINATAIRE);
    
    // Contenu HTML
    $mail->isHTML(true);
    $mail->Subject = "Test email HTML - pożyczka prywatna";
    
    // Générer le template HTML
    $htmlBody = getEmailTemplate('prestito', $testData);
    $mail->Body = $htmlBody;
    
    // Version texte
    $mail->AltBody = "Test email - Version texte";
    
    // Headers pour forcer HTML
    $mail->addCustomHeader('X-Mailer', 'PHPMailer');
    
    // Envoi
    $mail->send();
    
    echo "<p style='color:green;'>Email HTML envoyé avec succès !</p>";
    echo "<p>Vérifiez votre boîte email : <strong>" . EMAIL_DESTINATAIRE . "</strong></p>";
    echo "<p style='color:orange;'><strong>IMPORTANT :</strong> Dans Gmail, cliquez sur 'Afficher le message original' ou vérifiez que l'email s'affiche en HTML (pas en texte brut).</p>";
    echo "<p>Si vous voyez toujours le texte brut, Gmail peut avoir choisi d'afficher la version texte. Essayez de :</p>";
    echo "<ul>";
    echo "<li>Ouvrir l'email dans un autre client (Outlook, Apple Mail)</li>";
    echo "<li>Dans Gmail, cliquer sur les trois points (...) et choisir 'Afficher le message original'</li>";
    echo "<li>Vérifier que votre client email supporte le HTML</li>";
    echo "</ul>";
    
    echo "<hr>";
    echo "<h3>Prévisualisation du HTML généré :</h3>";
    echo "<iframe srcdoc='" . htmlspecialchars($htmlBody, ENT_QUOTES) . "' style='width:100%; height:600px; border:1px solid #ccc;'></iframe>";
    
} catch (Exception $e) {
    echo "<p style='color:red;'>ERREUR : L'email n'a pas pu être envoyé.</p>";
    echo "<p><strong>Message d'erreur :</strong> {$mail->ErrorInfo}</p>";
}
?>




