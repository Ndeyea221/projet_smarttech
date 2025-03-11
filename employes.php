<?php
require 'config.php';  // Fichier contenant la connexion à la base de données

// Récupérer tous les employés pour les afficher dans la liste
$employes = $pdo->query("SELECT * FROM employes")->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Gestion des Employés</h2>

        <!-- Lien pour ajouter un employé -->
        <a href="ajouter_employe.php" class="btn btn-success mb-3">Ajouter un Employé</a>

        <!-- Liste des employés -->
        <h3>Liste des Employés</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employes as $employe): ?>
                <tr>
                    <td><?= $employe['id'] ?></td>
                    <td><?= $employe['name'] ?></td>
                    <td><?= $employe['email'] ?></td>
                    <td><?= $employe['role'] ?></td>
                    <td>
                        <!-- Lien pour modifier un employé -->
                        <a href="modifier_employe.php?id=<?= $employe['id'] ?>" class="btn btn-warning">Modifier</a>
                        <!-- Lien pour supprimer un employé -->
                        <a href="supprimer_employe.php?id=<?= $employe['id'] ?>" class="btn btn-danger">Supprimer</a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
