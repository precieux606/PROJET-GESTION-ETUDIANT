<?php 
include 'connexion.php';
$stmt = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
$stmt->execute([$_GET['id']]);
$e = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Modifier Étudiant</title>
</head>
<body>
<div class="container">
    <h2>Modifier Étudiant</h2>
    <form id="studentForm" action="traitement.php" method="POST">
        <input type="hidden" name="id" value="<?= $e['id'] ?>">
        <input type="text" name="nom" id="nom" value="<?= $e['nom'] ?>">
        <input type="text" name="prenom" id="prenom" value="<?= $e['prenom'] ?>">
        <select name="filiere_id">
            <?php
            $q = $pdo->query("SELECT * FROM filieres");
            while ($f = $q->fetch()) {
                $sel = ($f['id'] == $e['filiere_id']) ? "selected" : "";
                echo "<option value='{$f['id']}' $sel>{$f['nom']}</option>";
            }
            ?>
        </select>
        <button type="submit" name="modifier">Mettre à jour</button>
    </form>
</div>
<script src="assets/js/script.js"></script>
</body>
</html>
