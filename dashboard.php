<?php
session_start();
require 'config.php';

// Récupérer les statistiques des tables
$nb_employes = $pdo->query("SELECT COUNT(*) FROM employes")->fetchColumn();
$nb_clients = $pdo->query("SELECT COUNT(*) FROM clients")->fetchColumn();
$nb_documents = $pdo->query("SELECT COUNT(*) FROM documents")->fetchColumn();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tableau de Bord</h2>
        <div class="row">
            <!-- Section Employés -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Employés</h5>
                        <p class="card-text"><?= $nb_employes ?> enregistrés</p>
                        <a href="employes.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
            
            <!-- Section Clients -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Clients</h5>
                        <p class="card-text"><?= $nb_clients ?> enregistrés</p>
                        <a href="clients.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
            
            <!-- Section Documents -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Documents</h5>
                        <p class="card-text"><?= $nb_documents ?> enregistrés</p>
                        <a href="documents.php" class="btn btn-primary">Gérer</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
