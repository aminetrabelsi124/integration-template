<?php
require '../Config.php';
class UserController {
    public function getUsers() {
        $db = config::getConnexion();
        $sql = "SELECT * FROM users";
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function addUser($user) {
        $db = config::getConnexion();
        $req = "INSERT INTO users(email, pwd) VALUES(:email, :pwd)";
        try {
            $query = $db->prepare($req);
            $query->execute([
                'email' => $user['email'],
                'pwd' => password_hash($user['pwd'], PASSWORD_DEFAULT)
            ]);
        } catch (Exception $e) {
            die('Erreur: ' . $e->getMessage());
        }
    }
    public function updateUser($id, $newPwd) {
        $db = config::getConnexion();
        $checkSql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($checkSql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        if ($user) {
            $updateSql = "UPDATE users SET pwd = :pwd WHERE id = :id";
            try {
                $query = $db->prepare($updateSql);
                $query->execute([
                    'pwd' => password_hash($newPwd, PASSWORD_DEFAULT),
                    'id' => $id
                ]);
                return "Mot de passe mis à jour avec succès.";
            } catch (Exception $e) {
                return 'Erreur: ' . $e->getMessage();
            }
        } else {
            return "Utilisateur introuvable.";
        }
    }
    public function deleteUser($id) {
        $db = config::getConnexion();
        $checkSql = "SELECT * FROM users WHERE id = :id";
        $stmt = $db->prepare($checkSql);
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch();
        if ($user) {
            $deleteSql = "DELETE FROM users WHERE id = :id";
            try {
                $query = $db->prepare($deleteSql);
                $query->execute(['id' => $id]);
                return "Utilisateur supprimé avec succès.";
            } catch (Exception $e) {
                return 'Erreur: ' . $e->getMessage();
            }
        } else {
            return "Utilisateur introuvable.";
        }
    }
}
?>