<?php

Class Email {

    /**
     * E-mail de l'expéditeur
     * @var String
     */
    private $expediteur;

    /**
     * Tableau avec les e-mail des destinataires
     * @var Array
     */
    private $destinataires;

    /**
     * Sujet du mail
     * @var String
     */
    private $sujet;

    /**
     * Contenu du mail
     * @var String
     */
    private $contenu;

    /**
     * Constructeur de l'e-mail
     * @param String $expediteur    E-mail de l'expéditeur
     * @param Array  $destinataires Tableau des e-mails des destinataires
     * @param String $sujet         Sujet du mail
     * @param String $contenu       Contenu du mail
     */
	public function __construct(String $expediteur, Array $destinataires, String $sujet, String $contenu){
        $this->expediteur = $expediteur;
        $this->destinataires = $destinataires;
        $this->sujet = $sujet;
        $this->contenu = $contenu;
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
     * Formulaire de saisie du mail
     * @param  String $action Page de vérification des informations avant l'envoi du mail
     * @param  Array   $data   Tableaux des informations du mail si erreurs dans le formulaire
     * @return String          Le formulaire au format HTML
     */
    public static function formEmail(String $action="", Array $data=array()){
    	$expediteur = $data['expediteur'] ?? "";
    	$destinataires = $data['destinataires'] ?? "";
    	$sujet = $data['sujet'] ?? "";
    	$contenu = $data['contenu'] ?? "";

        $html = <<<HTML
            <form action="$action" method="post">
                <label>Expéditeur: <input type="email" name="expediteur" value="$expediteur" required></label>
                <label>Destinataires (Séparés par une virgule): <input type="text" name="destinataires" value="$destinataires" required></label>
                <label>Sujet: <input type="text" name="sujet" value="$sujet" required></label>
                <label>Message: <textarea name="contenu" required>$contenu</textarea></label>
                <input type="submit" name="formEmail">
            </form>
HTML;
        return $html;
    }

    /**
     * Vérifie que les données saisies sont cohérentes
     * @return Multiple Retourne une erreur ou True si il n'y pas pas de problème
     */
    public function verifDonnées(){
        if(empty($this->expediteur) || empty($this->destinataires) || empty($this->sujet) || empty($this->contenu)){
            return "Tous les champs doivent être remplis";
        }elseif(!filter_var($this->expediteur, FILTER_VALIDATE_EMAIL)){
            return "L'adresse e-mail de l'expediteur n'est pas valide";
        } else {
        	foreach ($this->destinataires as $destinataire) {
        		$destinataire = trim($destinataire);
        		if(!filter_var($destinataire, FILTER_VALIDATE_EMAIL)){
        			return "Erreur dans l'adresse email " . $destinataire;
        		}
        	}
        }

        return true;
    }

    /**
     * Visuel de l'e-mail avant envoi
     * @param  String $action Page de gestion de l'envoi du mail
     * @return String         Les informations au format HTML
     */
    public function informations($action=""){
    	$destinataires = implode(",", $this->destinataires);
    	$html = <<<HTML
    		<p>Vérifiez l'email avant envoi:</p>
    		<ul>
    			<li><b>Expéditeur:</b> $this->expediteur</li>
    			<li><b>Destinataire(s):</b> $destinataires</li>
    			<li><b>Sujet:</b> $this->sujet</li>
    			<li>
    				<b>Contenu:</b><br>
    				$this->contenu
    			</li>
    		</ul>
    		<form action="$action" method="post">
    			<input type="submit" value="Envoyer" name="formConfirme">
    			<input type="submit" value="Annuler" name="formAnnule">
    		</form>
HTML;

		return $html;
    }

    /**
     * Envoi du mail
     * @return Bool Renvoie True si tout c'est bien passé False sinon
     */
    public function envoi(){

    	$boundary = "-----=".md5(rand());

    	$header = "From: " . $this->expediteur . "\n";
    	$header.= "Reply-to: " . $this->expediteur ."\n";
    	$header.= "MIME-Version: 1.0\n";
    	$header.= "Content-Type: multipart/alternative;\n boundary=" . $boundary . "\n";
		$header .= "Bcc: " . implode(",",$this->destinataires) . "\n";

    	$message = "\n--" . $boundary . "\n";
    	$message .= "Content-Type: text/html; charset=\"ISO-8859-1\"\n";
		$message .= "Content-Transfer-Encoding: 8bit\n";
		$message .= "\n" . $this->contenu . "\n";
		$message .= "\n--" . $boundary . "--\n";
		return mail($this->expediteur,$this->sujet, $message, $header);
    }

}
