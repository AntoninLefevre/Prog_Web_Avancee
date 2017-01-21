<?php

include('tableau.class.php');

$tab = new Tableau(array(10,12,15,16,26,145,14));

echo "<b>Valeurs par défaut:</b> " . $tab->getContenu();

$tab->triCroissant();

echo "<b>Tri croissant:</b> " . $tab->getContenu();

$tab->triDecroissant();

echo "<b>Tri décroissant:</b> " . $tab->getContenu();

$tab->melange();

echo "<b>Valeurs mélangées:</b> " . $tab->getContenu();

echo "<b>Plus grande valeur:</b> " . $tab->max() . "<br>";

echo "<b>Plus petite valeur:</b> " . $tab->min() . "<br>";
