<?php include 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Gestion Étudiants - GASA FORMATION</title>
    
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>

<div class="container">
    <h1>Système de Gestion des Étudiants</h1>

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
        
        <button type="submit" name="valider">Inscrire l'étudiant</button>
    </form>

    <?php
    $nb = $pdo->query("SELECT count(*) FROM etudiants")->fetchColumn();
    ?>
    <p class="stats">Liste des inscrits (Total : <?php echo $nb; ?>)</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Filière</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT etudiants.*, filieres.nom AS nom_filiere 
                    FROM etudiants 
                    LEFT JOIN filieres ON etudiants.filiere_id = filieres.id 
                    ORDER BY etudiants.id DESC";
            $liste = $pdo->query($sql);
            
            while ($etudiant = $liste->fetch()) {
                echo "<tr>
                        <td>".$etudiant['id']."</td>
                        <td>".htmlspecialchars($etudiant['nom'])."</td>
                        <td>".htmlspecialchars($etudiant['prenom'])."</td>
                        <td>".$etudiant['nom_filiere']."</td>
                        <td>
                            <a href='update.php?id=".$etudiant['id']."' class='btn-edit'>Modifier</a>
                            
                            <a href='delete.php?id=".$etudiant['id']."' class='btn-del' onclick='return confirmerSuppression()'>Supprimer</a>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<script src="Assets/script.js"></script>

</body>
</html>
