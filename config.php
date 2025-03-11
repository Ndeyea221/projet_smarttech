<?php
$host = 'localhost';
$dbname = 'smarttech_db';  // Le nom de ta base de données
$user = 'rabia';           // Ton utilisateur
$pass = 'Galsen2022';      // Ton mot de passe

try {
    // Créer une connexion PDO avec les bonnes variables
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
    
    // Définir l'option pour lever des exceptions en cas d'erreur
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Définir le jeu de caractères en UTF-8
    $pdo->exec("SET NAMES 'utf8'");

} catch (PDOException $e) {
    // En cas d'erreur, afficher un message et arrêter l'exécution du script
    die("Échec de la connexion à la base de données : " . $e->getMessage());
}
?>
