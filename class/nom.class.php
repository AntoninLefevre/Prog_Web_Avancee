<?php

Class Personne {

    private $nom;
    private $age;
    private $ville;

	public function __construct(String $nom, int $age, String $ville){
        $this->nom = $nom;
        $this->age = $age;
        $this->ville = $ville;
	}

	public function __get($name){
		if(property_exists(__CLASS__, $name)){
			return $this->$name;
		} else {
			return 'Attribut inexistant';
		}
	}


    public function infos():String{
        return $this->nom . " a " . $this->age . " ans et habite à " . $this->ville . "<br>";
    }

}
