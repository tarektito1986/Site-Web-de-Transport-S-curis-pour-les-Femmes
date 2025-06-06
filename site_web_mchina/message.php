
<?php
require_once 'config.php';

// Récupération des messages pour affichage
try {
    $result = $db->query("SELECT * FROM messages ORDER BY date_envoi ASC");
    $messages = $result->fetchAll();
} catch (PDOException $e) {
    $erreur = "Erreur lors de la récupération des messages : " . $e->getMessage();
}
// Récupération des commentaires pour affichage
try {
    $result = $db->query("SELECT * FROM commentaires ORDER BY date_envoi ASC");
    $commentaires = $result->fetchAll();
} catch (PDOException $e) {
    $erreur = "Erreur lors de la récupération des commentaires: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages et Commentaires</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <h2 class="mb-4">Messages reçus</h2>
    <?php if (!empty($erreurMessages)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreurMessages) ?></div>
    <?php endif; ?>
    <?php if (!empty($messages)) : ?>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date d'envoi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($messages as $msg) : ?>
                    <tr>
                        <td><?= (int)$msg['id'] ?></td>
                        <td><?= htmlspecialchars($msg['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($msg['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= nl2br(htmlspecialchars($msg['message'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td><?= htmlspecialchars($msg['date_envoi'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="text-muted">Aucun message enregistré pour le moment.</p>
    <?php endif; ?>

    <h2 class="mb-4">Commentaires reçus</h2>
    <?php if (!empty($erreurCommentaires)) : ?>
        <div class="alert alert-danger"><?= htmlspecialchars($erreurCommentaires) ?></div>
    <?php endif; ?>
    <?php if (!empty($commentaires)) : ?>
        <div class="table-responsive">
            <table class="table table-bordered table-hover table-striped">
                <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Ville</th>
                    <th>Commentaire</th>
                    <th>Date d'envoi</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($commentaires as $com) : ?>
                    <tr>
                        <td><?= (int)$com['id'] ?></td>
                        <td><?= htmlspecialchars($com['nom'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($com['email'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($com['ville'], ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= nl2br(htmlspecialchars($com['commentaire'], ENT_QUOTES, 'UTF-8')) ?></td>
                        <td><?= htmlspecialchars($com['date_envoi'], ENT_QUOTES, 'UTF-8') ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else : ?>
        <p class="text-muted">Aucun commentaire enregistré pour le moment.</p>
    <?php endif; ?>

</div>
</body>
</html>
