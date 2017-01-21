<?php

include('email.class.php');

$data = array();
$infos = "";

if(isset($_POST['formEmail'])){
    $email = new Email($_POST['expediteur'], explode(',', $_POST['destinataires']), $_POST['sujet'], $_POST['contenu']);

    $data = $_POST;

    if(is_bool($res = $email->verifDonnées())){
        session_start();
        $infos = $email->informations();
        $_SESSION['email'] = $email;
    } else {
        $infos = $res;
    }
} elseif(isset($_POST['formConfirme'])){
    session_start();
    $email = $_SESSION['email'];

    var_dump($email->envoi());
}

$form = Email::formEmail("", $data);

$html = <<<HTML

<!DOCTYPE html>
<html>
<head>
    <title>Indemnisation</title>
    <style>
        label{
            display: block;
        }
        div {
            border: 2px solid black;
            display: table;
            padding: 0 20px 0 20px;
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
