<?php include("../inc/bilans/actifs/fonctions.php"); ?>

<h1 id="main-title"> Bilan : Actifs </h1>

<div style="height: 125px"> </div>

<div class="info-societe-box">
    <h3> Société : </h3>
    <h3> Adresse : </h3>
    <h3> Capital : </h3>
    <h3> CIF : </h3>
    <h3> STAT : </h3>
</div>

<div class="bilan-box">
    <h3> Bilan </h3>
    <h3> EXERCICE CLOS AU : </h3>
    <h3> Unité monétaire : Ariary </h3>
</div>

<div class="bilan-box-content">
    <table>
        <tr class="passif-line">
            <th></th>
            <th class="title">Compte</th>
            <th class="title" colspan="2">Montant</th>
        </tr>
        <tr class="passif-line">
            <th></th>
            <th></th>
            <th class="case">Brut</th>
            <th class="case">Amort./Prov.</th>
            <th class="case">Net</th>
        </tr>
        <tr class="passif-line">
            <th colspan="4"> 
                <h4> ACTIFS NON COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS INCORPORELLES</td>
            <td>20</td>
            <td>Ar <?php
                $val1 = getImmoInco($_SESSION['id_societe']);
                if($val1 == null){
                    echo "0";
                } else{
                    echo ($val1['deb']-$val1['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS CORPORELLES</td>
            <td>21</td>
            <td>Ar <?php
                $val2 = getImmoCo($_SESSION['id_societe']);
                if($val2 == null){
                    echo "0";
                } else{
                    echo ($val2['deb']-$val2['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS BIOLOGIQUES</td>
            <td>22</td>
            <td>Ar <?php
                $val3 = getImmoBio($_SESSION['id_societe']);
                if($val3 == null){
                    echo "0";
                } else{
                    echo ($val3['deb']-$val3['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS EN COURS</td>
            <td>23</td>
            <td>Ar <?php
                $val4 = getImmoEnCours($_SESSION['id_societe']);
                if($val4 == null){
                    echo "0";
                } else{
                    echo ($val4['deb']-$val4['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS FINANCIERES</td>
            <td>25</td>
            <td>Ar <?php
                $val5 = getImmoFin("25",$_SESSION['id_societe']);
                if($val5 == null){
                    echo "0";
                } else{
                    echo ($val5['deb']-$val5['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMPOTS DIFFERES</td>
            <td>13</td>
            <td>Ar <?php
                $val6 = getinfo("13",$_SESSION['id_societe']);
                if($val6 == null){
                    echo "0";
                } else{
                    echo ($val6['deb']-$val6['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS NON COURANTS </h4>
            </th>
            <th> </th>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <th colspan="4"> 
                <h4> ACTIFS COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line">
            <td>STOCKS ET EN-COURS</td>
            <td>3</td>
            <td>Ar <?php
                $val6 = getinfo("3",$_SESSION['id_societe']);
                if($val6 == null){
                    echo "0";
                } else{
                    echo ($val6['deb']-$val6['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>CREANCES ET EMPLOIS ASSIMILES</td>
            <td>4...</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>Clients et autres débiteurs</td>
            <td>4...</td>
            <td>Ar <?php
                $client = getinfo("41",$_SESSION['id_societe']);
                if($client == null){
                    echo "0";
                } else{
                    echo ($client['debit']-$client['debit']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>Impôts /bénéfice</td>
            <td>...</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>Autres créances et actifs assimilés</td>
            <td>4...</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>TRESORERIE ET EQUIVALENTS DE TRESORERIE</td>
            <td>5...</td>
            <td>Ar <?php
                $val6 = getTresor($_SESSION['id_societe']);
                if($val6 == null){
                    echo "0";
                } else{
                    echo ($val6['deb']-$val6['cred']);
                }
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS COURANTS </h4>
            </th>
            <th> </th>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <br/>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS </h4>
            </th>
            <th> </th>
            <td>Ar 0</td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
    </table>
</div>