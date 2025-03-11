<?php
require 'config.php';

// Ajouter un document
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_document'])) {
    $titre = $_POST['titre'];
    $fichier = $_FILES['fichier']['name'];
    $chemin = 'upload/' . basename($fichier);

    // Déplacer le fichier dans le répertoire uploads
    if (move_uploaded_file($_FILES['fichier']['tmp_name'], $chemin)) {
        $stmt = $pdo->prepare("INSERT INTO documents (title, file_path) VALUES (?, ?)");
        $stmt->execute([$titre, $chemin]);

        header("Location: documents.php");  // Redirection après l'ajout

        exit();
    } else {
        echo "Échec du téléchargement du fichier.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Ajouter un Document</h2>
        <form method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label>Titre</label>
                <input type="text" name="titre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Fichier</label>
                <input type="file" name="fichier" class="form-control" required>
            </div>
            <button type="submit" name="add_document" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</body>
</html>
