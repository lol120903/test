<html>

    <meta charset="UTF-8">
    <head>
        <title> Affichage </title>
        <link rel="stylesheet" href= "Navigation.css">
		<style>
			.bouton{
                color: white;
                background-color: crimson;
                border-color: crimson;
                width: 200px;
                font-weight: 600;
            }
		</style>
    </head>

    <body>

        <nav>
            <img id="logo" src="HealHub.png">
            <ul>
                <li><a href="pLandingPatients.php">Patient</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="dureeConsMed.php">Statistiques</a></li>
            </ul>
        </nav>

        <br><br>

        <div class = "text">
            <img src="thumbs.png">
            <h2>Le patient est ajouté à la base de données</h2>
        </div>

        <form action = "pAffichage0.php" method="post">
            <input type="submit" value="Voir la table des patients" class='bouton'><br>
        </form>

    </body>

</html>