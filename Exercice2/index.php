<?php

include('motdepasse.class.php');

if(isset($_POST['formMotDePasse'])){
    $formMotDePasse = MotDePasse::formMotDePasse($_POST);
    $mdp = new MotDePasse($_POST['taille'], $_POST['method']);
} else {
    $formMotDePasse = MotDePasse::formMotDePasse();
}

echo $formMotDePasse;

if(isset($mdp)){
    echo "Mot de passe: " . $mdp->motdepasse;
}
