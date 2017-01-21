<?php

include('salarie.class.php');

$infos = "";

if(isset($_POST['formSalaire'])){
    $salarie = new Salarie($_POST['matricule'], $_POST['nom'], $_POST['prenom'], $_POST['salaire'], $_POST['tauxcs'], $_POST['tauxcp']);

    $infos = $salarie->informations();
}

$html = <<<HTML

<!DOCTYPE html>
<html>
<head>
    <title>Calcul du salaire</title>
    <style type="text/css">
        label{
            display: block;
        }
    </style>
</head>
<body>
    <form action="" method="post">
        <div>
            $infos
        </div>
        <label>Matricule: <input type="number" name="matricule" required></label>
        <label>Nom: <input type="text" name="nom" required></label>
        <label>Prénom: <input type="text" name="prenom" required></label>
        <label>Salaire: <input type="number" name="salaire" step=0.01 min=0 required></label>
        <label>Taux CS: <input type="number" name="tauxcs" step=0.0005 min=0 max=1 required></label>
        <label>Taux CP: <input type="number" name="tauxcp" step=0.0005 min=0 max=1 required></label>
        <input type="submit" name="formSalaire">
    </form>
</body>
</html>

HTML;

echo $html;
?>
