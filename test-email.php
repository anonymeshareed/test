<?php
/**
 * Script de test pour vérifier si l'envoi d'email fonctionne
 * 
 * INSTRUCTIONS :
 * 1. Modifiez l'email de test ci-dessous
 * 2. Accédez à ce fichier via votre navigateur : http://votre-domaine.com/test-email.php
 * 3. Vérifiez si vous recevez l'email de test
 */

// MODIFIEZ CETTE ADRESSE AVEC VOTRE EMAIL DE TEST
$email_test = "sagbomichaelmahulicajenus@gmail.com";

echo "<h2>Test d'envoi d'email</h2>";

// Vérifier si la fonction mail() est disponible
if (!function_exists('mail')) {
    echo "<p style='color:red;'>ERREUR : La fonction mail() n'est pas disponible sur ce serveur.</p>";
    echo "<p>Vous devrez utiliser PHPMailer ou une autre solution SMTP.</p>";
    exit;
}

echo "<p style='color:green;'>La fonction mail() est disponible.</p>";

// Test d'envoi
$to = $email_test;
$subject = "Test d'envoi email - pożyczka prywatna";
$message = "Ceci est un email de test depuis votre site pożyczka prywatna.\n\n";
$message .= "Si vous recevez cet email, cela signifie que l'envoi fonctionne correctement !";
$headers = "From: noreply@prest-plus.com\r\n";
$headers .= "Reply-To: noreply@prest-plus.com\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

echo "<p>Envoi d'un email de test à : <strong>$email_test</strong></p>";

if (mail($to, $subject, $message, $headers)) {
    echo "<p style='color:green;'>Email envoyé avec succès !</p>";
    echo "<p>Vérifiez votre boîte de réception (et les spams) dans quelques instants.</p>";
    echo "<p><strong>Si vous ne recevez pas l'email :</strong></p>";
    echo "<ul>";
    echo "<li>Vérifiez votre dossier spam/courrier indésirable</li>";
    echo "<li>Vérifiez que l'adresse email est correcte</li>";
    echo "<li>Le serveur peut avoir besoin d'une configuration SMTP (contactez votre hébergeur)</li>";
    echo "</ul>";
} else {
    echo "<p style='color:red;'>ERREUR : L'email n'a pas pu être envoyé.</p>";
    echo "<p><strong>Solutions possibles :</strong></p>";
    echo "<ul>";
    echo "<li>Vérifier la configuration PHP du serveur</li>";
    echo "<li>Utiliser PHPMailer avec SMTP au lieu de la fonction mail()</li>";
    echo "<li>Contacter votre hébergeur pour activer l'envoi d'emails</li>";
    echo "</ul>";
}

echo "<hr>";
echo "<h3>Informations du serveur :</h3>";
echo "<p><strong>Version PHP :</strong> " . phpversion() . "</p>";
echo "<p><strong>Serveur :</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
?>








