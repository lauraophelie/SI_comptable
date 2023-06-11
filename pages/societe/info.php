<?php 
    include("../inc/societe/fonctions.php");
    $id = $_SESSION["id_societe"];
    $societe = findDetails($id);
?>
<!--<h1 id="main-title"> Informations sur la société </h1>-->
<h2 id="subtitle">Dénomination</h2>
    
    <table class="info_soc">
        <tr>
            <td>Nom </td>
            <td><?php if(isset($societe['nom'])) echo($societe['nom']); ?></td>
        </tr>
        <tr>
            <td>Objet</td>
            <td><?php if(isset($societe['objet'])) echo($societe['objet']); ?></td>
        </tr> 
        <tr>
            <td>Date de creation</td>
            <td><?php if(isset($societe['date_creation'])) echo($societe['date_creation']); ?></td>
        </tr> 
        <tr>
            <td>Dirigeant</td>
            <td><?php if(isset($societe['dirigeant'])) echo($societe['dirigeant']); ?></td>
        </tr>
        <tr>
            <td>Employé</td>
            <td><?php if(isset($societe['employe'])) echo($societe['employe']); ?></td>
        </tr>
    </table>    

<h2 id="subtitle">Contacts</h2>
<table class="info_soc">
    <tr>
        <td>Siège</td>
        <td><?php if(isset($societe['siege'])) echo($societe['siege']); ?></td>
    </tr>
    <tr>
        <td>Adresse</td>
        <td><?php if(isset($societe['adresse'])) echo($societe['adresse']); ?></td>
    </tr>      
    <tr>
        <td>Téléphone</td>
        <td><?php if(isset($societe['telephone'])) echo($societe['telephone']); ?></td>
    </tr>
    <tr>
        <td>Télécopie</td>
        <td><?php if(isset($societe['telecopie'])) echo($societe['telecopie']); ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td><?php if(isset($societe['mail'])) echo($societe['mail']); ?></td>
    </tr>
</table>   

<h2 id="subtitle">Identification administrative</h2>
<table class="info_soc">
    <tr>
        <td>Numéro d'Identification Fiscale (NIF)</td>
        <td><?php if(isset($societe['nif'])) echo($societe['nif']); ?></td>
    </tr>
    <tr>
        <td>Scan du NIF</td>
        <td><img src="<?php if(isset($societe['scan_nif'])) echo($societe['scan_nif']); ?>"></td>
    </tr>
    <tr>
        <td>Numéro Statistique (NS)</td>
        <td><?php if(isset($societe['ns'])) echo($societe['ns']); ?></td>
    </tr>
    <tr>
        <td>Scan du NS</td>
        <td><img src="<?php if(isset($societe['scan_ns'])) echo($societe['scan_ns']); ?>"></td>
    </tr>
    <tr>
        <td>Numéro de Registre de Commerce de la Société (NRCS)</td>
        <td><?php if(isset($societe['nrcs'])) echo($societe['nrcs']); ?></td>
    </tr>
    <tr>
        <td>Scan du NRCS</td>
        <td><img src="<?php if(isset($societe['scan_nrcs'])) echo($societe['scan_nrcs']); ?>"></td>
    </tr>
</table>   

<h2 id="subtitle">Comptabilité <></h2>
<table class="info_soc">
    <tr>
        <td>Capital</td>
        <td><?php if(isset($societe['capital'])) echo($societe['capital']); ?></td>
    </tr>
    <tr>
        <td>Devise</td>
        <td><?php //if(isset($societe['nom_devise'])) echo($societe['capital']); ?></td>
    </tr>
    <tr>
        <td>Début de l'exercice</td>
        <td><?php if(isset($societe['capital'])) echo($societe['capital']); ?></td>
    </tr>
</table> 
    
<h2 id="subtitle">Confidentiel</h2>
<table class="info_soc">
    <tr>
        <td>Mot de passe</td>
        <td><?php if(isset($societe['mdp'])) echo($societe['mdp']); ?></td>
    </tr>
</table>