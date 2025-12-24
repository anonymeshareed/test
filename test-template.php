<?php
/**
 * Test du template HTML pour vérifier qu'il fonctionne
 */

require_once 'email-template.php';

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

// Générer le template
$html = getEmailTemplate('prestito', $testData);

// Afficher le HTML
header('Content-Type: text/html; charset=UTF-8');
echo $html;
?>





