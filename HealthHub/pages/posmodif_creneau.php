<?php
// Connexion à la base de données
$host = "localhost"; // Hôte de la base de données
$username = "root"; // Nom d'utilisateur de la base de données
$password = ""; // Mot de passe de la base de données
$database = "gestion_patient"; // Nom de la base de données

$pdo = new PDO("mysql:host=$host;dbname=$database", $username, $password);

// Récupération de l'ID du créneau à modifier
$id_med = $_GET['id_med'];
$query = "SELECT * FROM creneau WHERE id_med=:id_med";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id_med', $id_med);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<html>

<meta charset="UTF-8">

<head>
    <title>Modifier un créneau</title>
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
			
    <form method="POST" class="Ajout" action="modif_creneau.php">
        
		<h3>Modifier un créneau</h3><br>
        <label for="id_med">ID Médecins:</label>
        <input type="text" id="id_med" name="id_med" value="<?php echo $row['id_med']; ?>" readonly>

        <label for="DateJour">Date:</label>
        <input type="date" id="DateJour" name="DateJour" value="<?php echo $row['DateJour']; ?>" required>

        <label for="heureDEB">Heure:</label>
        <input type="time" id="heureDEB" name="heureDEB" value="<?php echo $row['heureDEB']; ?>" required>

        <label for="Duree">Durée (en min):</label>
        <input type="text" id="Duree" name="Duree" value="<?php echo $row['Duree']; ?>" required>

        <label for="id_Patient">ID Patient:</label>
        <input type="text" id="id_Patient" name="id_Patient" value="<?php echo $row['id_Patient']; ?>" required>

        <input type="submit" value="Modifier">
        <a href="pAffichage1.php" class="form-button">Annuler</a>
    </form>
</body>

</html>