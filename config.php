<?php
$host = 'localhost';
$dbname = 'smarttech_db';  // Le nom de ta base de donn�es
$user = 'rabia';           // Ton utilisateur
$pass = 'Galsen2022';      // Ton mot de passe

try {
    // Cr�er une connexion PDO avec les bonnes variables
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    // D�finir l'option pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // D�finir le jeu de caract�res en UTF-8
    $pdo->exec("SET NAMES 'utf8'");

} catch (PDOException $e) {
    // En cas d'erreur, afficher un message et arr�ter l'ex�cution du script
    die("�chec de la connexion � la base de donn�es : " . $e->getMessage());
}
?>
