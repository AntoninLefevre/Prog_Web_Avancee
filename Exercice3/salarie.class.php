<?php

Class Salarie {

	/**
	 * Matricule du salarié
	 * @var Integer
	 */
    private $matricule;

    /**
     * Nom du salarié
     * @var String
     */
    private $nom;

    /**
     * Prénom du salarié
     * @var String
     */
    private $prenom;

    /**
     * Salaire du salarié
     * @var float
     */
    private $salaire;

    /**
     * Taux des charges salariales
     * @var float
     */
    private $tauxCS;

    /**
     * Taux des charges patronales
     * @var float
     */
    private $tauxCP;

    /**
     * Constructeur du salarié
     * @param int    $matricule Matricule du salarié
     * @param String $nom       Nom du salarié
     * @param String $prenom    Prénom du salarié
     * @param float  $salaire   Salaire du salarié
     * @param float  $tauxCS    Taux des charges sociales
     * @param float  $tauxCP    Taux des charges patronales
     */
	public function __construct(int $matricule, String $nom, String $prenom, float $salaire, float $tauxCS, float $tauxCP){
        $this->matricule = $matricule;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->salaire = $salaire;
        $this->tauxCP = $tauxCP;
        $this->tauxCS = $tauxCS;
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
     * Calcul du salaire net du salarié
     */
    public function CalculerSalaireNet(){
        return round($this->salaire - ($this->salaire*$this->tauxCS), 2);
    }

    /**
     * Retourne le montant des charges sociales selon le salaire
     * @return float Montant des charges sociales
     */
    public function montantCS(){
        return round($this->salaire * $this->tauxCS,2);
    }

    /**
     * Retourne le montant des charges patronales selon le salaire
     * @return float Montant des charges patronales
     */
    public function montantCP(){
        return round($this->salaire * $this->tauxCP,2);
    }

    /**
     * Calcul des impôts à payer
     * @return flozt   Montant des impôts à payer
     */
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

    /**
     * Informations sur le salarié
     * @return String Informations au format HTML
     */
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
