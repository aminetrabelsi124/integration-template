<?php
require_once '../Controller/UserController.php';
$userController = new UserController();
$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"] ?? null;
    $newPwd = $_POST["new_password"] ?? null;
    $confirmPwd = $_POST["confirm_password"] ?? null;
    if ($id && $newPwd && $confirmPwd) {
        if ($newPwd === $confirmPwd) {
            $message = $userController->updateUser($id, $newPwd);
            if ($message === "Mot de passe mis à jour avec succès.") {
                header("Location: ListUsers.php");
                exit;
            }
        } else {
            $message = "Les mots de passe ne correspondent pas.";
        }
    } else {
        $message = "Tous les champs sont obligatoires.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Password</h2>
        <form action="updateUser.php" method="POST">
            <input type="text" name="id" placeholder="ID utilisateur" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="confirm_password" placeholder="Confirmer le mot de passe" required>
            <button type="submit">Mettre à jour</button>
        </form>
        <?php if ($message): ?>
            <p class="message"><?php echo $message; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>