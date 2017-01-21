<?php

include('class/nom.class.php');

$personne1 = new Personne("Antonin", 21, "Poix-Terron");
$personne2 = new Personne("Ludovic", 25, "Charleville-Mézières");

var_dump($personne1->nom);
echo $personne1->infos();
echo $personne2->infos();
