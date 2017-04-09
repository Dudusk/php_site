<?

	//Toutes les requêtess SQL
	
class modele {

	/* 
	###################
	#   Inscription   #
	#        &        #
	#    Connexion    #
	###################
	*/

	private $membre = "";
	private $produit = "";

	function verif_pseudo(){
		$this->membre = executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'"); 
		return $this->membre;
	}

	function ajout_membre(){
		$this->membre = executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse) VALUES ('$_POST[pseudo]', '$_POST[mdp]', '$_POST[nom]', '$_POST[prenom]', '$_POST[email]', '$_POST[civilite]', '$_POST[ville]', '$_POST[code_postal]', '$_POST[adresse]')");
		return $this->membre;
	}


	/* 
	#######################
	#    fiche_produit    #
	#######################
	*/

	function verif_produit(){
		$this->produit = executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); 
		return $this->produit;
	}

}
	

?>