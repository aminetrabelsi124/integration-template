<?php
require '../Controller/UserController.php';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['email']) && !empty($_POST['pwd'])) {
        $userController = new UserController();
        $userController->addUser([
            'email' => $_POST['email'],
            'pwd' => password_hash($_POST['pwd'], PASSWORD_DEFAULT)
        ]);
        $message = "Utilisateur ajouté avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un utilisateur</title>
</head>
<body>
    <h2>Ajouter un utilisateur</h2>
    <form method="POST" action="">
        <label>Email :</label>
        <input type="email" name="email" required><br>
        <label>Mot de passe :</label>
        <input type="password" name="pwd" required><br>
        <button type="submit">Ajouter</button>
    </form>
    <p><?= $message; ?></p>
    <a href="ListUsers.php">Retour à la liste</a>
</body>
</html>