<?php

Class Statistiques {

    private $listeEmails = null;
    private $fichier;
    private $listeDomaines;

	public function __construct(String $fichier){
        $this->fichier = $fichier;
	}

    public function __get($name){
        if(property_exists(__CLASS__, $name)){
            return $this->$name;
        } else {
            return "Attribut inxistant";
        }
    }

    public function __set($name, $value){
        if(property_exists(__CLASS__, $name)){
            $this->$name = $value;
        } else {
            return "Attribut inexistant";
        }
    }

    public static function genEmail(){
        $tab = array("live.fr","gmail.com","free.fr","hotmail.fr","hotmail.com","ironfle.com","yahoo.fr","verizon.net","laposte.net","aol.com","orange.fr");

        for($i = 0; $i < 720; $i++){
            $email[] = substr(md5(uniqid()), 0, rand(10,20)) . "@" . $tab[rand(0, sizeof($tab)-1)];
        }

        return implode("<br>", $email);
    }

    public function obtenirEmails(){
        $fic = fopen($this->fichier, "a+");

        while($tab=fgetcsv($fic,1024,';')){
            $this->listeEmails[] = $tab[0];
        }
    }

    public function obtenirDomaines(){
        foreach ($this->listeEmails as $email) {
            $this->listeDomaines[] = explode("@", $email)[1];
        }
    }

    public function obtenirStatisques(){
        $statistiques = array_count_values($this->listeDomaines);
        arsort($statistiques);

        $res = "Dnas le fichier " . $this->fichier . ":<ul>";

        foreach ($statistiques as $domaine => $valeur) {
            $res .= "<li>" . $domaine . " est utilisé " . $valeur . " fois</li>";
        }

        $res .= "</ul>";

        return $res;
    }



}
