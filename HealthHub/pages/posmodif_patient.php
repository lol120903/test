<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

// Récupération de la licence du joueur à modifier
$id_Patient = $_GET['id_Patient'];
$query = "SELECT * FROM Patient WHERE id_Patient=:id_Patient";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_Patient', $id_Patient);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>
    
    <head>
		<meta charset="UTF-8">
        <title>Modifier un patient</title>
        <link rel="stylesheet" href="Navigation.css">
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
        <form method="POST" class="Ajout" action="modif_patient.php">
            <h3>Modifier un patient</h3> <br>
            
            <label for="id_Patient">ID Patient:</label>
            <input type="text" id="id_Patient" name="id_Patient" value="<?php echo $row['id_Patient']; ?>" readonly>
		
			<label for="num_sécurité_sociale">Numéro de sécurité sociale:</label>
            <input type="text" id="num_sécurité_sociale" name="num_sécurité_sociale" value="<?php echo $row['num_sécurité_sociale']; ?>" readonly>
		
            <label for="civilité">Civilite:</label>
            <select id="civilité" name="civilité">
                <option value="Mr" <?php echo ($row['civilité'] == 'Mr') ? 'selected' : ''; ?>>Mr</option>
                <option value="Mme" <?php echo ($row['civilité'] == 'Mme') ? 'selected' : ''; ?>>Mme</option>
                <option value="Mlle" <?php echo ($row['civilité'] == 'Mlle') ? 'selected' : ''; ?>>Mlle</option>
            </select>

            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" value="<?php echo $row['nom']; ?>" required>

            <label for="prenom">Prenom:</label>
            <input type="text" id="prenom" name="prenom" value="<?php echo $row['prenom']; ?>" required>
			
			<label for="adresse">Adresse:</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $row['adresse']; ?>" required>
			
			<label for="lieu_naissance">Lieu de naissance:</label>
            <input type="text" id="lieu_naissance" name="lieu_naissance" value="<?php echo $row['lieu_naissance']; ?>" required>
			
			<label for="prenom">Date de naissance:</label>
            <input type="date" id="date_naissance" name="date_naissance" value="<?php echo $row['date_naissance']; ?>" required>

            <!-- Les Boutons Valider & Annuler -->
            <input type="submit" value="Modifier">
            <a href="pAffichage0.php" class="form-button">Annuler</a>
        </form>
    </body>
</html>
