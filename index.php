<?php include 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Étudiants - GASA</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; margin: 40px; background-color: #f4f4f9; }
        .container { background: white; padding: 20px; border-radius: 8px; box-shadow: 0 0 10px rgba(0,0,0,0.1); }
        h1 { color: #333; }
        form { margin-bottom: 30px; border-bottom: 2px solid #eee; padding-bottom: 20px; }
        input, select { padding: 10px; margin: 5px 0; width: 200px; border: 1px solid #ccc; border-radius: 4px; }
        button { padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #218838; }
        table { border-collapse: collapse; width: 100%; margin-top: 20px; background: white; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #007bff; color: white; }
        tr:nth-child(even) { background-color: #f2f2f2; }
        .btn-del { color: #dc3545; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<div class="container">
    <h1>Inscription Étudiant</h1>

    <form action="traitement.php" method="POST">
        <input type="text" name="nom" placeholder="Nom de l'étudiant" required>
        <input type="text" name="prenom" placeholder="Prénom" required>
        
        <select name="filiere_id" required>
            <option value="">-- Choisir une filière --</option>
            <?php
            $res = $pdo->query("SELECT * FROM filieres");
            while ($filiere = $res->fetch()) {
                echo "<option value='".$filiere['id']."'>".$filiere['nom']."</option>";
            }
            ?>
        </select>
        
        <button type="submit" name="valider">Enregistrer</button>
    </form>

    <?php
    $nb = $pdo->query("SELECT count(*) FROM etudiants")->fetchColumn();
    ?>
    <h3>Liste des inscrits (Total : <?php echo $nb; ?>)</h3>

    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Filière</th>
            <th>Action</th>
        </tr>
        <?php
        // On fait une JOINTURE pour afficher le NOM de la filière et pas juste l'ID
        $sql = "SELECT etudiants.*, filieres.nom AS nom_filiere 
                FROM etudiants 
                LEFT JOIN filieres ON etudiants.filiere_id = filieres.id";
        $liste = $pdo->query($sql);
        
        while ($etudiant = $liste->fetch()) {
            echo "<tr>
                    <td>".$etudiant['id']."</td>
                    <td>".htmlspecialchars($etudiant['nom'])."</td>
                    <td>".htmlspecialchars($etudiant['prenom'])."</td>
                    <td>".$etudiant['nom_filiere']."</td>
                    <td>
                        <a href='supprimer.php?id=".$etudiant['id']."' class='btn-del' onclick='return confirm(\"Supprimer cet étudiant ?\")'>Supprimer</a>
                    </td>
                  </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>