<?php
include 'connexion.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = $pdo->prepare("SELECT * FROM etudiants WHERE id = ?");
    $req->execute([$id]);
    $etudiant = $req->fetch();

    if (!$etudiant) {
        die("Étudiant introuvable.");
    }
}

if (isset($_POST['modifier'])) {
    $id_etudiant = $_POST['id_etudiant'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    $sql = "UPDATE etudiants SET nom = ?, prenom = ?, filiere_id = ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$nom, $prenom, $filiere_id, $id_etudiant]);

    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Étudiant</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>

<div class="container">
    <h1>Modifier les informations</h1>

    <form method="POST">
        <input type="hidden" name="id_etudiant" value="<?php echo $etudiant['id']; ?>">

        <label>Nom</label>
        <input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" required>

        <label>Prénom</label>
        <input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" required>

        <label>Filière</label>
        <select name="filiere_id" required>
            <?php
            $res = $pdo->query("SELECT * FROM filieres");
            while ($f = $res->fetch()) {
                $selected = ($f['id'] == $etudiant['filiere_id']) ? "selected" : "";
                echo "<option value='".$f['id']."' $selected>".$f['nom']."</option>";
            }
            ?>
        </select>

        <button type="submit" name="modifier">Enregistrer les modifications</button>
        <br><br>
        <a href="index.php" style="text-align:center; display:block; color:#666;">Annuler</a>
    </form>
</div>

<script src="Assets/script.js"></script>

</body>
</html>
