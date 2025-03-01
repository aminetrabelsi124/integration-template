<?php
require '../Controller/UserController.php';
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['id'])) {
        $userController = new UserController();
        $id = $_POST['id'];
        if ($userController->deleteUser($id)) {
            $message = "Utilisateur supprimé avec succès.";
        } else {
            $message = "Utilisateur introuvable.";
        }
    } else {
        $message = "Veuillez entrer un ID.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Supprimer un utilisateur</title>
</head>
<body>
    <h2>Supprimer un utilisateur</h2>
    <form method="POST" action="">
        <label>ID :</label>
        <input type="number" name="id" required><br>
        <button type="submit">Supprimer</button>
    </form>
    <p><?= $message; ?></p>
    <a href="ListUsers.php">Retour à la liste</a>
</body>
</html>