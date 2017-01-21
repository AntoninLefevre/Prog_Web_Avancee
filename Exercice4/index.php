<?php

include('indemnisation.class.php');

$infos = "";

if(isset($_POST['formIndemnisation'])){
    $indemnisation = new Indemnisation($_POST['cv'], $_POST['distance']);

    $infos = $indemnisation->informations();
}


$html = <<<HTML

<!DOCTYPE html>
<html>
<head>
    <title>Indemnisation</title>
    <style>
        label{
            display: block;
        }
    </style>
</head>
<body>
    $infos
    <form method="post">
        <label>Nombre de CV: <select name="cv">
            <option value=3>3 ou moins</option>
            <option value=4>4</option>
            <option value=5>5</option>
            <option value=6>6</option>
            <option value=7>7 ou plus</option>
        </select></label>
        <label>Distance parcourue: <input type="number" min=0 name="distance"></label>
        <input type="submit" name="formIndemnisation">
    </form>
</body>
</html>

HTML;

echo $html;
?>
