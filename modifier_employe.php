<?php

require_once 'config.php'; // Assure-toi d'inclure la connexion à la base de données

// Récupérer l'ID de l'employé à modifier
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: employes.php");
    exit();
}

// Vérifier si l'employé existe
$stmt = $pdo->prepare("SELECT * FROM employes WHERE id = ?");
$stmt->execute([$id]);
$employe = $stmt->fetch();

// Si l'employé n'existe pas, rediriger
if (!$employe) {
    header("Location: employes.php");
    exit();
}

// Initialiser le rôle (dans le cas où il n'existe pas dans $_POST)
$role = $employe['role'] ?? '';

// Vérifier si la variable $_POST['role'] existe et est valide
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_employe'])) {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';

    // Vérifier que la variable $role est non vide
    if (empty($role)) {
        echo "Erreur : Le rôle est obligatoire.";
        exit();
    }

    // Vérifier la longueur du rôle
    if (strlen($role) > 255) {
        $role = substr($role, 0, 255);
    }

    // Mise à jour des informations
    $stmt = $pdo->prepare("UPDATE employes SET name = ?, email = ?, role = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $role, $id]);

    // Redirection après modification
    header("Location: employes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Employé</title>
</head>
<body>
    <h2>Modifier l'employé</h2>
    <form method="POST">
        <label>Nom :</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($employe['name']) ?>" required>

        <label>Email :</label>
        <input type="email" name="email" value="<?= htmlspecialchars($employe['email']) ?>" required>

        <label>Poste :</label>
        <select name="role" required>
            <option value="admin" <?= $employe['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
            <option value="user" <?= $employe['role'] == 'user' ? 'selected' : '' ?>>User</option>
        </select>

        <button type="submit" name="update_employe">Modifier</button>
    </form>
</body>
</html>
