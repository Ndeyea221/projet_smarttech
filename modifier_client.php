<?php
require 'config.php';

// Récupérer l'ID du client à modifier
$id = $_GET['id'] ?? null;
if ($id) {
    $stmt = $pdo->prepare("SELECT * FROM clients WHERE id = ?");
    $stmt->execute([$id]);
    $client = $stmt->fetch();
} else {
    header("Location: clients.php");
    exit();
}

// Modifier le client
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_client'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $telephone = $_POST['telephone'];

    $stmt = $pdo->prepare("UPDATE clients SET name = ?, email = ?, phone = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $telephone, $id]);

    header("Location: clients.php");  // Redirection après modification
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Client</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Modifier le Client</h2>
        <form method="POST">
            <div class="mb-3">
                <label>Nom</label>
                <input type="text" name="nom" class="form-control" value="<?= $client['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $client['email'] ?>" required>
            </div>
            <div class="mb-3">
                <label>Téléphone</label>
                <input type="text" name="telephone" class="form-control" value="<?= $client['phone'] ?>" required>
            </div>
            <button type="submit" name="update_client" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>
</body>
</html>
