<?php

include('tirage.class.php');

$infos="";

if(isset($_POST['formTirage'])){
    $tirage = new Tirage($_POST['nombres'], $_POST['etoiles']);
    if(!$tirage->verifSaisieChiffre()){
        $infos = "Vous devez saisir 5 nombres entiers compris entre 1 et 49 pour les chiffres et 2 nombres entiers compris entre 1 et 11 pour les étoiles";
    } else {
        $tirage->tirage();
        $infos = $tirage->resultat();
    }
}

$form = Tirage::formSaisie("");

$html = <<<HTML

<!DOCTYPE html>
<html>
<head>
    <title>Tirage</title>
    <style>
        label{
            display: block;
        }
        div {
            border: 2px solid black;
            display: table;
            padding: 0 20px 0 20px;
        }
        input[type="number"]{
            width:50px;
        }
    </style>
</head>
<body>
    $form
    <div>
        $infos
    </div>
</body>
</html>

HTML;

echo $html;
?>
