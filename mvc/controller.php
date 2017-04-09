<?

//Appel du model
require_once ('./mvc/modele.php');

//Reçoit les requêtes de l'utilisateur et les transmet à la vue

class controller extends modele {

	/* 
	###################
	#   Inscription   #
	###################
	*/

	private $contenu = "";

	function inscription(){
		//Création du modèle.
		$modele = new modele();

		if($_POST)
		{
			//debug($_POST);
			$verif_caractere = preg_match('#^[a-zA-Z0-9._-]+$#', $_POST['pseudo']); 
			if(!$verif_caractere || strlen($_POST['pseudo']) < 1 || strlen($_POST['pseudo']) > 20 )
			{
				$this->contenu .= "<div class='erreur'>Le pseudo doit contenir entre 1 et 20 caractères. <br> Caractère accepté : Lettre de A à Z et chiffre de 0 à 9</div>";
				return $this->contenu;
			}
			if(empty($contenu)) 
			{

				$membre = $modele->verif_pseudo();
				if($membre->num_rows > 0)
				{
					$this->contenu .= "<div class='erreur'>Pseudo indisponible. Veuillez en choisir un autre svp.</div>";
					return $this->contenu;
				}
				else
				{
					foreach($_POST as $indice => $valeur)
					{
						$_POST[$indice] = htmlEntities(addSlashes($valeur));
					}
					$modele->ajout_membre();
					$this->contenu .= "<div class='validation'>Vous êtes inscrit à notre site web. <a href=\"connexion.php\"><u>Cliquez ici pour vous connecter</u></a></div>";
					return $this->contenu;
				}
			}
		}
		
	}

	public function getContenu()
    {
        return $this->contenu;
    }


    /* 
	###################
	#    Connexion    #
	###################
	*/

	public function connexion(){
		//Création du modèle.
		$modele = new modele();


		if(isset($_GET['action']) && $_GET['action'] == "deconnexion") 
		{
			session_destroy(); 
		}
		if(internauteEstConnecte()) 
		{
			header("location:profil.php");
		}
		if($_POST)
		{
		    $resultat = $modele->verif_pseudo(); //executeRequete("SELECT * FROM membre WHERE pseudo='$_POST[pseudo]'");
		    if($resultat->num_rows != 0)
		    {
		        $membre = $resultat->fetch_assoc();
		        if($membre['mdp'] == $_POST['mdp'])
		        {
		            foreach($membre as $indice => $element)
		            {
		                if($indice != 'mdp')
		                {
		                    $_SESSION['membre'][$indice] = $element; 
		                }
		            }
		            header("location:profil.php"); 
		        }
		        else
		        {
		            $this->contenu .= '<div class="erreur">Erreur de MDP</div>';
		            return $this->contenu;
		        }       
		    }
		    else
		    {
		        $this->contenu .= '<div class="erreur">Erreur de pseudo</div>';
		        return $this->contenu;
		    }
		}
	}


	/* 
	#######################
	#    fiche_produit    #
	#######################
	*/

	public function fiche_produit(){
		//Création du modèle.
		$modele = new modele();

		if(isset($_GET['id_produit'])) 	{ 
			$resultat = $modele->verif_produit(); //executeRequete("SELECT * FROM produit WHERE id_produit = '$_GET[id_produit]'"); 
		}

		if($resultat->num_rows <= 0) { header("location:boutique.php"); exit(); }

		$produit = $resultat->fetch_assoc();
		$this->contenu .= "<h3>Titre : $produit[titre]</h3><hr /><br />";
		$this->contenu .= "<p>Categorie: $produit[categorie]</p>";
		$this->contenu .= "<p>Couleur: $produit[couleur]</p>";
		$this->contenu .= "<p>Taille: $produit[taille]</p>";
		$this->contenu .= "<img src='$produit[photo]' width='150' height='150' />";
		$this->contenu .= "<p><i>Description: $produit[description]</i></p><br />";
		$this->contenu .= "<p>Prix : $produit[prix] €</p><br />";

		if($produit['stock'] > 0)
		{
			$this->contenu .= "<i>Nombre d'produit(s) disponible : $produit[stock] </i><br /><br />";
			$this->contenu .= '<form method="post" action="panier.php">';
				$this->contenu .= "<input type='hidden' name='id_produit' value='$produit[id_produit]' />";
				$this->contenu .= '<label for="quantite">Quantité : </label>';
				$this->contenu .= '<select id="quantite" name="quantite">';
					for($i = 1; $i <= $produit['stock'] && $i <= 5; $i++)
					{
						$this->contenu .= "<option>$i</option>";
					}
				$this->contenu .= '</select>';
				$this->contenu .= '<input type="submit" name="ajout_panier" value="ajout au panier" />';
			$this->contenu .= '</form>';
		}
		else
		{
			$this->contenu .= 'Rupture de stock !';
		}
		$this->contenu .= "<br /><a href='boutique.php?categorie=" . $produit['categorie'] . "'>Retour vers la séléction de " . $produit['categorie'] . "</a>";


		return $this->contenu;
	}

}


?>