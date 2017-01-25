<?php

Class Statistiques {

    /**
     * Liste des e-mails de $fichier
     * @var Array|null
     */
    private $listeEmails = null;

    /**
     * Nom du fichier
     * @var String
     */
    private $fichier;

    /**
     * Liste des domaines utilisés
     * @var Array
     */
    private $listeDomaines;

    /**
     * Constructeur des statistiques
     * @param String $fichier Nom du fichier
     */
	public function __construct(String $fichier){
        $this->fichier = $fichier;
	}

    /**
     * Accesseur
     * @param  String $name Nom de l'attribut
     * @return Multiple Valeur de l'attribut
     */
    public function __get($name){
        if(property_exists(__CLASS__, $name)){
            return $this->$name;
        } else {
            return "Attribut inxistant";
        }
    }

    /**
     * Modificateur
     * @param String $name  Nom de l'attribut à modifier
     * @param Multiple $value Valeur à appliquer
     */
    public function __set($name, $value){
        if(property_exists(__CLASS__, $name)){
            $this->$name = $value;
        } else {
            return "Attribut inexistant";
        }
    }

    /**
     * Récupère la liste des e-mails du fichier
     */
    public function obtenirEmails(){
        $fic = fopen($this->fichier, "a+");

        while($tab=fgetcsv($fic,1024,';')){
            $this->listeEmails[] = $tab[0];
        }
    }

    /**
     * Récupères les domaines des e-mails
     */
    public function obtenirDomaines(){
        foreach ($this->listeEmails as $email) {
            $this->listeDomaines[] = explode("@", $email)[1];
        }
    }

    /**
     * Affiche pour chaque domaines le nombre de fois qu'il est utilisé
     * @return String Informations sur les statistique au format HTML
     */
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
