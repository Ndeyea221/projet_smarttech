<?php
require 'config.php';

$id = $_GET['id'] ?? null;

if ($id) {
    $stmt = $pdo->prepare("DELETE FROM employes WHERE id = ?");
    $stmt->execute([$id]);
}

header("Location: employes.php");  // Redirection vers la page des employés
exit();
?>
