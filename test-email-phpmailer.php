<?php
/**
 * Test d'envoi d'email avec PHPMailer et SMTP Gmail
 * 
 * INSTRUCTIONS :
 * 1. Installez PHPMailer : composer require phpmailer/phpmailer
 * 2. Configurez vos identifiants Gmail ci-dessous
 * 3. Accédez à ce fichier via votre navigateur
 */

// CONFIGURATION GMAIL - À MODIFIER
// CONFIGURATION GMAIL - À MODIFIER
$smtp_email = "anonymeshareed@gmail.com"; // Votre email Gmail (ligne 12)
$smtp_password = "vsje lpfc euez gbws"; // Mot de passe d'application Gmail (ligne 13)
$email_destinataire = "anonymeshareed@gmail.com"; // Email de test (ligne 14) // Email de test

echo "<h2>Test d'envoi d'email avec PHPMailer + SMTP Gmail</h2>";

// Vérifier si PHPMailer est installé
if (!file_exists('vendor/autoload.php') && !file_exists('PHPMailer/PHPMailer.php')) {
    echo "<p style='color:red;'>ERREUR : PHPMailer n'est pas installé.</p>";
    echo "<p><strong>Installation :</strong></p>";
    echo "<pre>composer require phpmailer/phpmailer</pre>";
    echo "<p>Ou téléchargez PHPMailer manuellement et placez-le dans un dossier 'PHPMailer/'</p>";
    exit;
}

// Charger PHPMailer
if (file_exists('vendor/autoload.php')) {
    require 'vendor/autoload.php';
} else {
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);

try {
    // Configuration SMTP
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = $smtp_email;
    $mail->Password = $smtp_password;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->CharSet = 'UTF-8';
    
    // Expéditeur et destinataire
    $mail->setFrom($smtp_email, 'pożyczka prywatna');
    $mail->addAddress($email_destinataire);
    $mail->addBCC($smtp_email); // Copie pour l'expéditeur
    $mail->addReplyTo($smtp_email, 'pożyczka prywatna');
    
    // Contenu
    $mail->isHTML(false);
    $mail->Subject = 'Test d\'envoi email - pożyczka prywatna (PHPMailer)';
    $mail->Body = "Ceci est un email de test depuis votre site pożyczka prywatna.\n\n";
    $mail->Body .= "Si vous recevez cet email, cela signifie que PHPMailer fonctionne correctement !\n\n";
    $mail->Body .= "L'envoi via SMTP Gmail est beaucoup plus fiable que la fonction mail() de PHP.";
    
    // Envoi
    $mail->send();
    
    echo "<p style='color:green;'>Email envoyé avec succès via PHPMailer + SMTP Gmail !</p>";
    echo "<p>Vérifiez votre boîte de réception : <strong>$email_destinataire</strong></p>";
    echo "<p>Une copie a également été envoyée à l'expéditeur : <strong>$smtp_email</strong></p>";
    echo "<p style='color:orange;'>Si vous ne recevez pas l'email, vérifiez :</p>";
    echo "<ul>";
    echo "<li>Le mot de passe d'application Gmail est correct</li>";
    echo "<li>L'authentification à deux facteurs est activée sur Gmail</li>";
    echo "<li>Vérifiez le dossier SPAM</li>";
    echo "</ul>";
    
} catch (Exception $e) {
    echo "<p style='color:red;'>ERREUR : L'email n'a pas pu être envoyé.</p>";
    echo "<p><strong>Message d'erreur :</strong> {$mail->ErrorInfo}</p>";
    echo "<p><strong>Solutions :</strong></p>";
    echo "<ul>";
    echo "<li>Vérifiez que le mot de passe d'application Gmail est correct</li>";
    echo "<li>Assurez-vous que l'authentification à deux facteurs est activée</li>";
    echo "<li>Vérifiez que 'Accès aux applications moins sécurisées' est activé (si nécessaire)</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<h3>Instructions pour obtenir un mot de passe d'application Gmail :</h3>";
echo "<ol>";
echo "<li>Allez sur : <a href='https://myaccount.google.com/security' target='_blank'>https://myaccount.google.com/security</a></li>";
echo "<li>Activez la 'Validation en deux étapes' si ce n'est pas déjà fait</li>";
echo "<li>Allez sur : <a href='https://myaccount.google.com/apppasswords' target='_blank'>https://myaccount.google.com/apppasswords</a></li>";
echo "<li>Sélectionnez 'Mail' et 'Autre (nom personnalisé)'</li>";
echo "<li>Entrez 'pożyczka prywatna' comme nom</li>";
echo "<li>Cliquez sur 'Générer'</li>";
echo "<li>Copiez le mot de passe de 16 caractères et collez-le dans \$smtp_password ci-dessus</li>";
echo "</ol>";
?>







