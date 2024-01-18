<html>

    <head>
        <title> Medecin </title>
        <link rel="stylesheet" href= "navigation.css">
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
        <form action = "pAjoutM0.php" method="post">
            <button type="submit" value="Ajout d'un Médecin"><img src="medecin1.png"></button>
        </form>

        <form action = "pAffichage2.php" method="post">
            <button type="submit"  value="Affichage des médecins" name="affichage2" id="affichage2"><img src="medecin2.png"></button>
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