<?php

    session_start();

    if (isset($_POST["user"]) && isset($_POST["mdp"])){
        
        $utilisateur=$_POST["user"];
        $motsdepasse=$_POST["mdp"];

        if ($utilisateur=="user001" and $motsdepasse=="0000"){
            $_SESSION['acce_autorise']=TRUE;
            header("Location: pLanding.php");
        }else{
            $_SESSION['acce_autorise']=FALSE;
            $erreur = "Nom d'utilisateur ou mots de passe incorrecte";
            header("Location: pIndex.php?erreur=".urldecode($erreur));
        }

    }else{
        header("Location: pIndex.php");
    }

?>