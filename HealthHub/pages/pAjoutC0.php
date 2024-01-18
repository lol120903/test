<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8">

<head>
    <title>Ajout d'un créneau</title>
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
            <img id="logo" src="HealHub.png">
            <ul>
                <li><a href="pLandingPatients.php">Patient</a></li>
                <li><a href="pLandingMedecins.php">Médecins</a></li>
                <li><a href="pLandingConsultation.php">Consultations</a></li>
                <li><a href="dureeConsMed.php">Statistiques</a></li>
            </ul>
    </nav>

    <form method="POST" class='Ajout' action="pAjoutC1.php">
        <h3>Ajouter un Créneau</h3><br>
        <!--id Medecin-->
        <label for="idMed">ID Medecin: </label>
        <input type="text" id="idMed" name="idMed">

        <!--Date-->
        <label for="date">Date: </label>
        <input type="date" id="date" name="date" required>

        <!--Heure-->
        <label for="heure">Heure: </label>
        <input type="time" id="heure" name="heure" required>

        <!--Duree-->
        <label for="number">Duree (en min): </label>
        <input type="text" id="duree" name="duree" required>

        <!--!id Patient-->
        <label for="idPat">ID Patient: </label>
        <input type="text" id="idPat" name="idPat">

        <!--Les Boutons Valider & Effacer-->
        <input type="submit" value="Valider" class='bouton'>
        <input type="reset" value="Effacer" class='bouton'>
    </form>


        

    </body>

</html>