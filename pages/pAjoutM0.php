<html>

    <meta charset="UTF-8">
    <head>
        <title> Ajout d'un medecin </title>
        <link rel="stylesheet" href= "Navigation.css">
        
    </head>

    <body>

        <?php
            session_start();

            if (!$_SESSION['acce_autorise']){
              header("Location: pIndex.php");
            }
        ?>
	
        <nav>
            <img id="logo" src="HealHub.png">
            <ul>
                <li><a href="pLandingPatients.php">Patient</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="dureeConsMed.php">Statistiques</a></li>
            </ul>
        </nav>
        
        <form method="POST" class='Ajout' action="pAjoutM1.php">
		<h3>Ajouter un médecin</h3><br>
            <!--Civilité-->
			
			<label for="civilite">Civilite:</label>
			<select id="civilite" name="civilite">
			<option value="Mr">Mr</option>
			<option value="Mme">Mme</option>
			<option value="Mlle">Mlle</option>
			</select>
			
			
            <!--Nom-->
            <label for="nom">Nom: </label>
            <input type="text" id="nom" name="nom" required>

            <!--Prenom-->
            <label for="prenom">Prenom: </label>
            <input type="text" id="prenom" name="prenom" required>

            <!--Les Boutons Valider & Effacer-->
            <input type="submit" value="Valider" class='bouton'>
            <input type="reset" value="Effacer" class='bouton'>

        </form>


    </body>

</html>