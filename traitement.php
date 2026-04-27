<?php
include 'connexion.php';

if (isset($_POST['valider'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $filiere_id = $_POST['filiere_id'];

    if (!empty($nom) && !empty($prenom)) {
        $req = $pdo->prepare("INSERT INTO etudiants (nom, prenom, filiere_id) VALUES (?, ?, ?)");
        $req->execute([$nom, $prenom, $filiere_id]);
    }
}

header("Location: index.php");
exit();
?>