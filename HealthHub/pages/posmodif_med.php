<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

// Récupération de la licence du joueur à modifier
$id_med = $_GET['id_med'];
$query = "SELECT * FROM medecin WHERE id_med=:id_med";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_med', $id_med);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
    <meta charset="UTF-8">
    <head>
        <title>Modifier un médecin</title>
        <link rel="stylesheet" href="navigation.css">
    </head>

    <body>
        <?php
        session_start();

        if (!$_SESSION['acce_autorise']) {
            header("Location: pIndex.php");
        }
        ?>

        <nav>
            <ul>
                <li><a href="pLandingPatients.php">Usagers</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="">Statistiques</a></li>
            </ul>
        </nav>

        <form method="POST" class="Ajout" action="modif_med.php">
            <h3>Modifier un médecin</h3><br>
            
            <label for="id_med">ID Medecin:</label>
            <input type="text" id="id_med" name="id_med" value="<?php echo $row['id_med']; ?>" readonly>

            <label for="civilite">Civilite:</label>
            <select id="civilite" name="civilite">
                <option value="Mr" <?php echo ($row['civilite'] == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                <option value="Mme" <?php echo ($row['civilite'] == 'Mme') ? 'selected' : ''; ?>>Mme</option>
                <option value="Mlle" <?php echo ($row['civilite'] == 'Mlle') ? 'selected' : ''; ?>>Mlle</option>
            </select>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required>

            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>" required>

            <label for="id_Patient">ID Patient:</label>
            <input type="text" id="id_Patient" name="id_Patient" value="<?php echo $row['id_Patient']; ?>" readonly>

            <!-- Les Boutons Valider & Annuler -->
            <input type="submit" value="Modifier">
            <a href="pAffichage2.php" class="form-button">Annuler</a>
        </form>
    </body>
</html>
