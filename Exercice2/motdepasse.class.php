<?php

Class MotDePasse {

	/**
	 * Valeurs du tableau
	 * @var Array
	 */
    private $motdepasse;
    private $taille;

	public function __construct(int $taille, String $methode){
        $this->taille = $taille;
        $this->$methode();
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

    public function MUniqid(){
        $mdp = "";
        while(strlen($mdp) < $this->taille){
            $mdp .= substr(uniqid(), 0, $this->taille);
        }
        $this->motdepasse = substr($mdp, 0, $this->taille);
    }

    public function MChaineAleatoire(){
        $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        $mdp = "";
        for ($i=0; $i < $this->taille; $i++) {
            $mdp .= $chars[rand(0, strlen($chars)-1)];
        }
        $this->motdepasse = $mdp;
    }

    public function MNonRedondance(){
        $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        $mdp = "";
        for ($i=0; $i < $this->taille; $i++) {
            $char = $chars[rand(0, strlen($chars)-1)];
            $chars = str_replace($char, "", $chars);
            $mdp .= $char;
            if(strlen($chars) <= 0){
                $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
            }
        }
        $this->motdepasse = $mdp;
    }

}
