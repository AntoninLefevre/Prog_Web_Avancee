<?php

Class Tirage {

    private $grilleNombres = null;
    private $grilleEtoiles = null;
    private $nombres;
    private $etoiles;
    private $tirageNombres = null;
    private $tirageEtoiles = null;
    private $resultatNombres = null;
    private $resultatEtoiles = null;

	public function __construct(Array $nombres, Array $etoiles){
        $this->nombres = $nombres;
        $this->etoiles = $etoiles;
        sort($this->nombres);
        sort($this->etoiles);
        for ($i=1; $i < 50; $i++) {
            $this->grilleNombres[] = $i;
        }

        for ($i=1; $i < 12; $i++) {
            $this->grilleEtoiles[] = $i;
        }
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

    public static function formSaisie(String $action = "", Array $data = array()){

        $html = <<<HTML
        	<form action="$action" method="post">
        		<ul>
        			<li>Chiffres</li>
        			<ul>
        				<li><label>N°1: <input type="number" min=1 max=49 name="nombres[]" ></label></li>
        				<li><label>N°2: <input type="number" min=1 max=49 name="nombres[]" ></label></li>
        				<li><label>N°3: <input type="number" min=1 max=49 name="nombres[]" ></label></li>
        				<li><label>N°4: <input type="number" min=1 max=49 name="nombres[]" ></label></li>
        				<li><label>N°5: <input type="number" min=1 max=49 name="nombres[]" ></label></li>
        			</ul>
        			<li>Étoiles</li>
        			<ul>
        				<li><label>N°1: <input type="number" min=1 max=11 name="etoiles[]" ></label></li>
        				<li><label>N°2: <input type="number" min=1 max=11 name="etoiles[]" ></label></li>
        			</ul>
        		</ul>
        		<input type="submit" name="formTirage" value="Valider">
        	</form>
HTML;

		return $html;
    }

    public function verifSaisieChiffre(){

    	foreach ($this->nombres as $nombre) {
    		if(!is_numeric($nombre) || $nombre < 1 || $nombre > 49){
    			return false;
    		}
    	}

    	foreach ($this->etoiles as $etoile) {
    		if(!is_numeric($etoile) || $etoile < 1 || $etoile > 11){
    			return false;
    		}
    	}

    	for ($i=0; $i < sizeof($this->nombres)-1; $i++) {
    		if($this->nombres[$i] == $this->nombres[$i+1]){
    			return false;
    		}
    	}

    	for ($i=0; $i < sizeof($this->etoiles)-1; $i++) {
    		if($this->etoiles[$i] == $this->etoiles[$i+1]){
    			return false;
    		}
    	}

    	return true;
    }

    public function tirage(){
    	$grilleNombres = $this->grilleNombres;
    	$grilleEtoiles = $this->grilleEtoiles;
    	shuffle($grilleNombres);
    	shuffle($grilleEtoiles);
    	$grilleNombres = array_slice($grilleNombres,0,5);
    	$grilleEtoiles = array_slice($grilleEtoiles,0,2);
    	sort($grilleNombres);
    	sort($grilleEtoiles);
    	$this->tirageNombres = $grilleNombres;
    	$this->tirageEtoiles = $grilleEtoiles;
    }

    public function resultat(){

    	$res = "<ul><li>Numéros tirés: " . implode(', ', $this->tirageNombres) . "</li>";
    	$res .= "<li>Étoiles tirées: " . implode(', ', $this->tirageEtoiles) . "</li></ul>";

    	$res .= "<ul><li>Numéros choisis: " . implode(', ', $this->nombres) . "</li>";
    	$res .= "<li>Étoiles choisies: " . implode(', ', $this->etoiles) . "</li></ul>";

    	foreach ($this->tirageNombres as $nombre) {
    		if(in_array($nombre, $this->nombres))
    		$this->resultatNombres[] = $nombre;
    	}

    	$res .= "<ul>";
    	if(sizeof($this->resultatNombres) > 0){
    		$res .= "<li>Numéros trouvés: " . implode(', ', $this->resultatNombres) . "</li>";
    	} else {
    		$res .= "<li>Numéros trouvés: Aucun numéro trouvé</li>";
    	}

    	foreach ($this->tirageEtoiles as $etoile) {
    		if(in_array($etoile, $this->etoiles))
    		$this->resultatEtoiles[] = $etoile;
    	}

    	if(sizeof($this->resultatEtoiles) > 0){
    		$res .= "<li>Étoiles trouvés: " . implode(', ', $this->resultatEtoiles) . "</li>";
    	} else {
    		$res .= "<li>Étoiles trouvés: Aucune étoiles trouvée</li>";
    	}

    	$res .= "</ul>";

    	return $res;
    }

}
