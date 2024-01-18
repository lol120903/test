<html>

    <head>
        <title> Patients </title>
        <link rel="stylesheet" href= "Navigation.css">
        <style>
            img {
                width : 120px;
                height : 120px;
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
		<div>	
        <form action = "pAjoutP0.php" method="post">
            <button type="submit" value="Ajout d'un patient"><img src="patient1.png"></button> 
        </form>

        <form action = "pAffichage0.php" method="post">
            <button type="submit" value="Affichage des patients" name="affichage0" id="affichage0"><img src="patient2.png"></button> 
        </form>
		</div>
        <?php
            session_start();

            if (!$_SESSION['acce_autorise']){
              header("Location: pIndex.php");
            }

        ?>

    </body>

</htmL>