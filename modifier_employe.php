<?php

require_once 'config.php'; // Assure-toi d'inclure la connexion � la base de donn�es

// R�cup�rer l'ID de l'employ� � modifier
$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: employes.php");
    exit();
}

// V�rifier si l'employ� existe
$stmt = $pdo->prepare("SELECT * FROM employes WHERE id = ?");
$stmt->execute([$id]);
$employe = $stmt->fetch();

// Si l'employ� n'existe pas, rediriger
if (!$employe) {
    header("Location: employes.php");
    exit();
}

// Initialiser le r�le (dans le cas o� il n'existe pas dans $_POST)
$role = $employe['role'] ?? '';

// V�rifier si la variable $_POST['role'] existe et est valide
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_employe'])) {
    $nom = $_POST['nom'] ?? '';
    $email = $_POST['email'] ?? '';
    $role = $_POST['role'] ?? '';

    // V�rifier que la variable $role est non vide
    if (empty($role)) {
        echo "Erreur : Le r�le est obligatoire.";
        exit();
    }

    // V�rifier la longueur du r�le
    if (strlen($role) > 255) {
        $role = substr($role, 0, 255);
    }

    // Mise � jour des informations
    $stmt = $pdo->prepare("UPDATE employes SET name = ?, email = ?, role = ? WHERE id = ?");
    $stmt->execute([$nom, $email, $role, $id]);

    // Redirection apr�s modification
    header("Location: employes.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Employ�</title>
</head>
<body>
    <h2>Modifier l'employ�</h2>
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
