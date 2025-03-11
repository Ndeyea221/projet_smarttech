<?php
require 'config.php';
session_start();

// V�rifie si le formulaire d'inscription a �t� soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // R�cup�re les donn�es du formulaire
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];

    // V�rifie si l'email existe d�j� dans la base de donn�es
    $stmt = $pdo->prepare("SELECT * FROM employes WHERE email = ?");
    $stmt->execute([$email]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        // Si l'email existe d�j�, on affiche un message d'erreur
        $error = "Cet email est d�j� utilis�.";
    } else {
        // Si l'email est unique, on cr�e un nouvel utilisateur
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hashage du mot de passe

        // Pr�pare et ex�cute la requ�te pour ins�rer l'utilisateur
        $stmt = $pdo->prepare("INSERT INTO employes (name, email, password, role) VALUES (?, ?, ?, ?)");
        $stmt->execute([$name, $email, $hashedPassword, $role]);

        // Redirige vers la page de connexion apr�s l'inscription
        header("Location: login.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cr�er un compte - Smarttech</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .register-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .btn-custom {
            background-color: #28a745;
            color: white;
            border: none;
        }
        .btn-custom:hover {
            background-color: #218838;
        }
        .error-message {
            color: red;
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>

<div class="register-container">
    <h2>Cr�er un compte</h2>
    <form method="POST">
        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">R�le</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
            </select>
        </div>
        <button type="submit" class="btn btn-custom w-100">S'inscrire</button>
    </form>

    <?php if (isset($error)) { echo "<p class='error-message'>$error</p>"; } ?>

    <div class="mt-3 text-center">
        <a href="login.php">D�j� un compte ? Connectez-vous</a>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
