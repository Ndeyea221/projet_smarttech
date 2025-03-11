<?php
require 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    // R�cup�rer le chemin du fichier avant de le supprimer
    $stmt = $pdo->prepare("SELECT file_path FROM documents WHERE id = ?");
    $stmt->execute([$id]);
    $document = $stmt->fetch();

    if ($document) {
        // Supprimer le fichier physique du serveur
        unlink($document['file_path']);
        
        // Supprimer l'entr�e de la base de donn�es
        $stmt = $pdo->prepare("DELETE FROM documents WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header("Location: documents.php");  // Redirection vers la page des documents
exit();
?>
