<?php

include('statistiques.class.php');

$statistiques = new Statistiques("email.csv");
$statistiques->obtenirEmails();
$statistiques->obtenirDomaines();
echo $statistiques->obtenirStatisques();

echo "<br><br><br>";

$statistiques2 = new Statistiques("email2.csv");
$statistiques2->obtenirEmails();
$statistiques2->obtenirDomaines();
echo $statistiques2->obtenirStatisques();

