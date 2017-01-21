<?php

include('motdepasse.class.php');

$mdp = new MotDePasse(10, "MUniqid");

echo "<b>Mot de pass généré avec uniqid():</b> " . $mdp->motdepasse . "<br>";

$mdp->MChaineAleatoire();

echo "<b>Mot de pass généré avec une chaine de caractère aléatoire:</b> " . $mdp->motdepasse . "<br>";

$mdp->MNonRedondance();

echo "<b>Mot de pass généré sans caractère redondant:</b> " . $mdp->motdepasse . "<br>";

$mdp->taille = 6;

echo "<hr><br><b>Changement de taille du mot de passe</b><br><br>";

$mdp->MUniqid();

echo "<b>Mot de pass généré avec uniqid():</b> " . $mdp->motdepasse . "<br>";

$mdp->MChaineAleatoire();

echo "<b>Mot de pass généré avec une chaine de caractère aléatoire:</b> " . $mdp->motdepasse . "<br>";

$mdp->MNonRedondance();

echo "<b>Mot de pass généré sans caractère redondant:</b> " . $mdp->motdepasse . "<br>";
