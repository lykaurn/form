<?php 
 
$nom = htmlspecialchars($_POST['nom']);
$prenom = htmlentities($_POST['prenom']);
$email = $_POST['email'];
$os = $_POST['os'];
$os = $_POST['balise'];
$message = htmlentities($_POST['message']);


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

    if( empty($nom) || empty($prenom) || empty($message) ){
    echo 'Veuillez remplir les champs suivants:<br>' . $resultat;
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
}

 ?>
