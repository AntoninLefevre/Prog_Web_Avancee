<?php

Class MotDePasse {

	/**
	 * Valeurs du tableau
	 * @var Array
	 */
    private $motdepasse;

    /**
     * Taille du mot de passe
     * @var int
     */
    private $taille;

    /**
     * Constructeur du mot de passe
     * @param int    $taille  Taille du mot de passe
     * @param String $methode Méthode de création de mot de passe à utiliser
     */
	public function __construct(int $taille, String $methode){
        $this->taille = $taille;
        $this->$methode();
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
     * Définition d'un mot de passe en utilisant la foction PHP uniqid()
     */
    public function MUniqid(){
        $mdp = "";
        while(strlen($mdp) < $this->taille){
            $mdp .= substr(uniqid(), 0, $this->taille);
        }
        $this->motdepasse = substr($mdp, 0, $this->taille);
    }

    /**
     * Définition d'un mot de passe avec une chaine de caractères aléatoire
     */
    public function MChaineAleatoire(){
        $chars = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN0123456789";
        $mdp = "";
        for ($i=0; $i < $this->taille; $i++) {
            $mdp .= $chars[rand(0, strlen($chars)-1)];
        }
        $this->motdepasse = $mdp;
    }

    /**
     * Définition d'un mot de passe sans redondance de caractères
     */
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
