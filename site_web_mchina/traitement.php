<?php
require_once 'config.php';

// Gestion des soumissions de formulaire
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Formulaire 1 : messages simples
    if (isset($_POST['envoyer'])) {
        $nom = trim($_POST['name']);
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        if (!empty($nom) && !empty($email) && !empty($message)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: index.html#contact?erreur=email");
                exit();
            } else {
                try {
                    $stmt = $db->prepare("INSERT INTO messages (nom, email, message) VALUES (:nom, :email, :message)");
                    $stmt->execute([
                        ':nom' => $nom,
                        ':email' => $email,
                        ':message' => $message
                    ]);
                    header("Location: index.html#contact?success=1");
                    exit();
                } catch (PDOException $e) {
                    header("Location: index.html#contact?erreur=bd");
                    exit();
                }
            }
        } else {
            header("Location: index.html#contact?erreur=vide");
            exit();
        }
    }

    // Formulaire 2 : commentaires avec ville
    if (isset($_POST['envoyer_comment'])) {
        $nom = trim($_POST['name']);
        $email = trim($_POST['email']);
        $ville = trim($_POST['ville']);
        $commentaire = trim($_POST['commentaire']);

        if (!empty($nom) && !empty($email) && !empty($ville)) {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                header("Location: index.html#contact?erreur=email");
                exit();
            } else {
                try {
                    $stmt = $db->prepare("INSERT INTO commentaires (nom, email, ville, commentaire) VALUES (:nom, :email, :ville, :commentaire)");
                    $stmt->execute([
                        ':nom' => $nom,
                        ':email' => $email,
                        ':ville' => $ville,
                        ':commentaire' => $commentaire
                    ]);
                    header("Location: index.html#contact?success=1");
                    exit();
                } catch (PDOException $e) {
                    header("Location: index.html#contact?erreur=bd");
                    exit();
                }
            }
        } else {
            header("Location: index.html#contact?erreur=vide");
            exit();
        }
    }

    // Si POST mais aucune des deux actions
    header("Location: index.html");
    exit();
}

// --- Affichage des données ---
// Messages simples
try {
    $resultMessages = $db->query("SELECT * FROM messages ORDER BY date_envoi DESC");
    $messages = $resultMessages->fetchAll();
} catch (PDOException $e) {
    $erreurMessages = "Erreur lors de la récupération des messages : " . $e->getMessage();
}

// Commentaires avec ville
try {
    $resultCommentaires = $db->query("SELECT * FROM commentaires ORDER BY date_envoi DESC");
    $commentaires = $resultCommentaires->fetchAll();
} catch (PDOException $e) {
    $erreurCommentaires = "Erreur lors de la récupération des commentaires : " . $e->getMessage();
}

?>


