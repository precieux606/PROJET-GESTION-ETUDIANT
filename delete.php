<?php
include 'connexion.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $req = $pdo->prepare("DELETE FROM etudiants WHERE id = ?");
    $req->execute([$id]);
}
header("Location: index.php");
exit();
?>
