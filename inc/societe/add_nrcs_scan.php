<?php
    session_start();
    require("fonctions.php");

    $id_societe = $_SESSION['id_societe'];
    $dossier = '../../assets/images/nrcs';
    $fichier = basename($_FILES['nrcs']['name']);
    $taille_maxi = 1000000;
    $taille = filesize($_FILES['nrcs']['tmp_name']);
    $extensions = array('.png', '.gif', '.jpg', '.jpeg');
    $extension = strrchr($_FILES['nrcs']['name'], '.');
    //Début des vérifications de sécurité...
    if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
    {
        $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg, txt ou doc';
    }
    if($taille>$taille_maxi)
    {
        $erreur = 'Le fichier est trop gros...';
    }
    if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
    {
    //On formate le nom du fichier ici...
        $fichier = strtr($fichier,
        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
        $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
    if(move_uploaded_file($_FILES['nrcs']['tmp_name'], $dossier . $fichier)) //Si
    {
        addScanNRCS($fichier,$societe);
        echo 'Upload effectué avec succès !';
    }
    else //Sinon (la fonction renvoie FALSE).
    {
        echo 'Echec de l\'upload !';
    }
    }
    else
    {
        echo $erreur;
    }
?>