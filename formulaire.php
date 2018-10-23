<?php 
 
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlentities($_POST['prenom']);
$email = $_POST['email'];
$os = $_POST['os'];
$os = $_POST['balise'];
$message = htmlentities($_POST['message']);
$message_erreur = '';


/*
if (isset($_POST['envoi'])) {
    echo '<pre>';
    echo 'Voici vos informations : <br>';
    print_r($_POST);
    echo '</pre>';
 }
*/

// Vérification des données
$resultat = '';

//if( !empty($_POST) ){
if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    if ( empty($nom) ) { 
        $resultat.= 'Nom <br>';
    }

    if ( empty($prenom) ) { 
        $resultat.= 'Prenom <br>';
    }

    if ( empty($email) ){ 
        $resultat.= 'Adresse mail <br>';
    }
    else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo 'Adresse email invalide !<br>';
        }
    }
    
    if ( empty($message) ){ 
        $resultat.= 'Message <br>';
    }
}

if( !empty($nom) && !empty($prenom) && !empty($message) ){  // Envoi email
    
        $to = 'clementine.l@codeur.online';
        $subject = 'Message envoyé via le site';
        
        // Pour envoyer un email HTML, l'en-tête Content-type doit être défini !
        $headers = 'MIME-Version: 1.0' . "\r\n"; // Version MIME
        $headers .= 'Content-type: text/html; charset=UTF-8'."\r\n"; // l'en-tête Content-type pour le format HTML
        $headers .= 'FROM:' . $nom . $prenom . '-' . $email . "\r\n"; // Expéditeur
        $headers .= 'TO:' . $destinataire . "\r\n"; //  
        $message_mail = 
        ' <table>
            <tr>
                <td><b>Contenu du message:</b></td>
            </tr>
            <tr>
                <td>'. htmlspecialchars($_POST['message']) .'</td>
            </tr>
            <tr>
            <td><b>Signé par</b> '. $nom . $prenom .'</td>
        </tr>
            </table>
        ';

        if ( mail($to, $subject, $message_mail, $headers) ) // Envoi du message
        {
            echo 'Votre message a bien été envoyé ';
        }
        else // Non envoyé
        {
            echo "Votre message n'a pas pu être envoyé";
		}
		
		if( empty($nom) || empty($prenom) || empty($message) ){ 
			$message_erreur = echo 'Veuillez remplir les champs suivants : ' . $resultat;
		}
}

 ?>


<!DOCTYPE html>
<html lang="fr">
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1.0, user-scalable=yes">
        <link rel="stylesheet" type="text/css" href="style.css">
        <script type="text/javascript" src="validation.js"></script>
		<title>WIKI HTML </title>
	</head>

	<body>

		<header class="header">
			<img src="html5.jpg" alt="banniere">
		</header>

		<main class="main">
			<nav class="navigation">
				<h1>WIKIHTML</h1>
				
				<ul class="listenav">
					<li><a href="index.html">Accueil</a></li>
					<li> <a href="meta.html"> meta</a></li>
					<li> <a href="link.html"> link</a></li>
					<li> <a href="title.html"> title</a></li>
					<li> <a href="pageimg.html"> img</a></li>
					<li> <a href="pagea.html"> a </a></li>
					<li> <a href="pageh1h6.html"> h1 à h6</a></li>
					<li> <a href="pageform.html"> form</a></li>
					<li> <a href="input.html"> input</a></li>
					<li> <a href="div.html"> div</a></li>
					<li> <a href="header.html"> header</a></li>
					<li> <a href="section.html"> section</a></li>
					<li> <a href="footer.html"> footer</a></li>
				</ul>
			</nav>

			<section class="section">
				<h2>Présentation HTML</h2>

				<article class="article">
					<h3>Vos remarques</h3>
                    
                    <form name="formulaire" action="formulaire.php" method="post"> <!-- onsubmit="return validateform()"> -->

                        <div>
                            <label for="nom">Nom :</label>
                            <input type="text" name="nom" id="nom" placeholder="ex : Dupont" value="<?php isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
                        </div>

                        <div>
                            <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" id="prenom" placeholder="ex : Richard" value="<?php isset($_POST['prenom']) ? $_POST['prenom'] : ''; ?>">
                        </div>

                        <div>
                            <label for="email">email :</label>
                            <input type="text" name="email" id="email" placeholder="ex : abcdef@ghij.com" value="<?php isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        </div>

                        <div>
                            <label for="os">Système d'exploitation :</label>
                            <input type="radio" name="os" id="os1" value="Windows">Windows
                            <input type="radio" name="os" id="os2" value="Linux">Linux
                            <input type="radio" name="os" id="os3" value="Mac">Mac
                        </div>

                        <div>
                            <label for="">Balises :</label>
                            <input type="checkbox" name="balise[]" id="meta">&lt;meta&gt;
                            <input type="checkbox" name="balise[]" id="link">&lt;link&gt;
                            <input type="checkbox" name="balise[]" id="title">&lt;title&gt;
                        </div>

                        <div>
                            <label for="message">Votre message :</label><br>
                            <textarea name="message" id="message" rows="10" cols="100"></textarea>
                        </div>

                        <div>
                            <input type="submit" value="Envoyer" name="envoyer">
                        </div>

                    </form>


				<div id="alertbox" class="alertbox">
				<?php echo $message_erreur; ?>
                </div>
    
				</article>
			</section>

		</main>

		<footer class="footer">
			Réalisé par Pierre-Yves, Armelle et Clémentine.
		</footer>

	</body>


	


</html>