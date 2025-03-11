<?php
require 'config.php';
$clients = $pdo->query("SELECT * FROM clients")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Clients</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestion des Clients</h2>
        <div class="text-end mb-3">
            <a href="ajouter_client.php" class="btn btn-success">Ajouter</a>
        </div>
        <table class="table">
            <thead>
                <tr><th>ID</th><th>Nom</th><th>Email</th><th>Téléphone</th><th>Actions</th></tr>
            </thead>
            <tbody>
                <?php foreach ($clients as $c) { ?>
                    <tr>
                        <td><?= $c['id'] ?></td>
                        <td><?= $c['name'] ?></td>
                        <td><?= $c['email'] ?></td>
                        <td><?= $c['phone'] ?></td>
                        <td>
                            <a href="modifier_client.php?id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                            <a href="supprimer_client.php?id=<?= $c['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce client ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
