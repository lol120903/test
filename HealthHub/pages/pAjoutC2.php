<html>

    <meta charset="UTF-8">
    <head>
        <title> Affichage </title>
        <link rel="stylesheet" href= "Navigation.css">
		<style>
			.bouton{
                text-align: center;
                color: white;
                background-color: crimson;
                border-width: 0;
                width: 200px;
                font-weight: 600;
            }

            .img {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 50vh; /* Ajustez la hauteur selon vos besoins */
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

        <img src="thumbs.png">
        <h2 align = "center">Le créneau est ajouté à la base de données</h2>
        

        <form action = "pAffichage1.php" method="post">
            <input type="submit" value="Voir la table des consultations" class='bouton'><br>
        </form>


    </body>

</html>

