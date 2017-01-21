<?php

Class Salarie {

	/**
	 * Valeurs du tableau
	 * @var Array
	 */
    private $matricule;
    private $nom;
    private $prenom;
    private $salaire;
    private $tauxCS;
    private $tauxCP;

	public function __construct(int $matricule, String $nom, String $prenom, float $salaire, float $tauxCS, float $tauxCP){
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->salaire = $salaire;
        $this->tauxCP = $tauxCP;
        $this->tauxCS = $tauxCS;
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

    public function CalculerSalaireNet(){
        return round($this->salaire - ($this->salaire*$this->tauxCS), 2);
    }

    public function montantCS(){
        return round($this->salaire * $this->tauxCS,2);
    }

    public function montantCP(){
        return round($this->salaire * $this->tauxCP,2);
    }

    public function calculImpots(){
        $salaireAnnuel = $this->CalculerSalaireNet() * 12;

        $montantImpots = 0;
        if($salaireAnnuel > 152260){
            $montantTranche = $salaireAnnuel - 152260;
            $montantImpots += $montantTranche * 0.45;
            $salaireAnnuel = 152260;
        }

        if($salaireAnnuel > 71898){
            $montantTranche = $salaireAnnuel - 71898;
            $montantImpots += $montantTranche * 0.41;
            $salaireAnnuel = 71898;
        }

        if($salaireAnnuel > 26818){
            $montantTranche = $salaireAnnuel - 26818;
            $montantImpots += $montantTranche * 0.30;
            $salaireAnnuel = 26818;
        }

        if($salaireAnnuel > 9711){
            $montantTranche = $salaireAnnuel - 9711;
            $montantImpots += $montantTranche * 0.14;
        }

        return round($montantImpots,2);
    }

    public function informations(){

        $salaireNet = $this->CalculerSalaireNet();
        $montantCS = $this->montantCS();
        $montantCP = $this->montantCP();
        $montantImpots = $this->calculImpots();

        $html = <<<HTML
        <span>Information sur $this->prenom $this->nom:</span>
        <ul>
            <li>Salaire net: $salaireNet €</li>
            <li>Montant des charges salariales: $montantCS €</li>
            <li>Montant des charges patronales: $montantCP €</li>
            <li>Montant des impôts: $montantImpots €</li>
        </ul>
HTML;
        return $html;
    }



}
