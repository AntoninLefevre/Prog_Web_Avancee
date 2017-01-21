<?php

Class Indemnisation {

    private $cv;
    private $distance;

	public function __construct(int $cv, int $distance){
        $this->cv = $cv;
        $this->distance = $distance;
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

    public function calculIndemnisation(){
        $distance = $this->distance;

        if($this->cv <= 3 ){
            $taux5000 = 0.41;
            $taux5001 = 0.245;
            $tauxFixe5001 = 824;
            $taux20001 = 0.285;
        }elseif($this->cv == 4){
            $taux5000 = 0.493;
            $taux5001 = 0.27;
            $tauxFixe5001 = 1082;
            $taux20001 = 0.332;
        }elseif($this->cv == 5){
            $taux5000 = 0.543;
            $taux5001 = 0.305;
            $tauxFixe5001 = 1188;
            $taux20001 = 0.364;
        }elseif($this->cv == 6){
            $taux5000 = 0.568;
            $taux5001 = 0.32;
            $tauxFixe5001 = 1244;
            $taux20001 = 0.382;
        } else {
            $taux5000 = 0.595;
            $taux5001 = 0.337;
            $tauxFixe5001 = 1288;
            $taux20001 = 0.401;
        }

        $montantIndemnite = 0;

        if($distance > 20000){
            $distanceTranche = $distance - 20000;
            $montantIndemnite += $taux20001 * $distanceTranche;
            $distance = 20000;
        }

        if($distance > 5000){
            $distanceTranche = $distance - 5000;
            $montantIndemnite += $taux5001 * $distanceTranche + $tauxFixe5001;
            $distance = 5000;
        }

        if($distance > 0){
            $montantIndemnite += $taux5000 * $distance;
        }

        return round($montantIndemnite,2);
    }

    public function informations(){
        return "Le montant des indemnisations est de " . $this->calculIndemnisation() . "€";
    }

}
