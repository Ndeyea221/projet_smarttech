<?php
require 'config.php';
$documents = $pdo->query("SELECT * FROM documents")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Documents</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestion des Documents</h2>
        <div class="text-end mb-3">
            <a href="ajouter_document.php" class="btn btn-success">Ajouter</a>
        </div>
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Titre</th><th>Fichier</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($documents as $d) { ?>
                    <tr>
                        <td><?= $d['id'] ?></td>
                        <td><?= $d['title'] ?></td>
                        <td><a href="<?= $d['file_path'] ?>" download>Télécharger</a></td>
                        <td>
                            <a href="supprimer_document.php?id=<?= $d['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce document ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
