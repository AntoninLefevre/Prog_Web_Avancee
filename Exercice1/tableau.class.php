<?php

Class Tableau {

	/**
	 * Valeurs du tableau
	 * @var Array
	 */
    private $contenu;

    /**
     * Constructeur du tableau
     * @param Array $contenu Valeurs à mettre dans le tableau
     */
	public function __construct(Array $contenu){
        $this->contenu = $contenu;
	}

	/**
	 * Liste le contenu du tableau
	 * @return String Liste des valeurs
	 */
	public function getContenu(){
        return implode(", ", $this->contenu) . "<br>";
	}

	/**
	 * Tri le tableau dans l'ordre croissant
	 */
    public function triCroissant(){
    	sort($this->contenu);
    }

    /**
     * Tri le tableau dans l'ordre décroissant
     */
    public function triDecroissant(){
    	arsort($this->contenu);
    }

    /**
     * Mélange les valeurs du tableau
     */
    public function melange(){
    	shuffle($this->contenu);
    }

    /**
     * La valeur la plus haute du tableau
     * @return Integer Valeur maximum
     */
    public function max(){
    	return max($this->contenu);
    }

    /**
     * La valeur la plus basse du tableau
     * @return Integer Valeur minimum
     */
    public function min(){
    	return min($this->contenu);
    }

}
