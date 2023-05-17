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
                $val1 = getInfo("20",$_SESSION['id_societe']);
                $immoInco = 0;
                if($val1 != null)
                {
                    $immoInco = $val1['deb']-$val1['cred'];
                }
                echo $immoInco;
            ?></td>
            <td>Ar <?php
                $val2 = getInfo("280",$_SESSION['id_societe']);
                $amortInco = 0;
                if($val2 != null)
                {
                    $amortInco = $val2['cred']-$val2['deb'];
                }
                echo $amortInco;
            ?></td>
            <td>Ar <?php $netInco = $immoInco - $amortInco;
            echo $netInco; ?></td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS CORPORELLES</td>
            <td>21</td>
            <td>Ar <?php
                $val1 = getInfo("21",$_SESSION['id_societe']);
                $immoCo = 0;
                if($val1 != null)
                {
                    $immoCo = $val1['deb']-$val1['cred'];
                }
                echo $immoCo;
            ?></td>
            <td>Ar <?php
                $val2 = getInfo("281",$_SESSION['id_societe']);
                $amortCo = 0;
                if($val2 != null)
                {
                    $amortCo = $val2['cred']-$val2['deb'];
                }
                echo $amortCo;
            ?></td>
            <td>Ar <?php $netCo = $immoCo - $amortCo;
            echo $netCo; ?></td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS BIOLOGIQUES</td>
            <td>22</td>
            <td>Ar <?php
                $val1 = getInfo("22",$_SESSION['id_societe']);
                $immoBio = 0;
                if($val1 != null)
                {
                    $immoBio = $val1['deb']-$val1['cred'];
                }
                echo $immoBio;
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS EN COURS</td>
            <td>23</td>
            <td>Ar <?php
                $val1 = getInfo("23",$_SESSION['id_societe']);
                $immoCours = 0;
                if($val1 != null)
                {
                    $immoCours = $val1['deb']-$val1['cred'];
                }
                echo $immoCours;
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMMOBILISATIONS FINANCIERES</td>
            <td>25</td>
            <td>Ar <?php
                $val1 = getInfo("25",$_SESSION['id_societe']);
                $immoFin = 0;
                if($val1 != null)
                {
                    $immoFin = $val1['deb']-$val1['cred'];
                }
                echo $immoFin;
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line">
            <td>IMPOTS DIFFERES</td>
            <td>13</td>
            <td>Ar <?php
                $val1 = getInfo("21",$_SESSION['id_societe']);
                $impotDiff = 0;
                if($val1 != null)
                {
                    $impotDiff = $val1['deb']-$val1['cred'];
                }
                echo $impotDiff;
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS NON COURANTS </h4>
            </th>
            <th> </th>
            <td>Ar <?php
                $brutNonCourant = $immoInco + $immoCo + $immoBio + $immoCours + $immoFin + $impotDiff;
                echo $brutNonCourant;
            ?></td>
            <td>Ar <?php
                $amortNonCourant = $amortInco + $amortCo;
                echo $amortNonCourant;
            ?></td>
            <td>Ar <?php $netNonCourant = $brutNonCourant - $amortNonCourant;
            echo $netNonCourant; ?></td>
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
                $val1 = getInfo("3",$_SESSION['id_societe']);
                $stockBrut = 0;
                if($val1 != null)
                {
                    $stockBrut = $val1['deb']-$val1['cred'];
                }
                echo $stockBrut;
            ?></td>
            <td>Ar <?php
                $val2 = getInfo("397",$_SESSION['id_societe']);
                $provisionStock = 0;
                if($val2 != null)
                {
                    $provisionStock = $val2['cred']-$val2['deb'];
                }
                echo $provisionStock;
            ?></td>
            <td>Ar <?php $netStock = $stockBrut - $provisionStock;
            echo $netStock; ?></td>
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
                $val1 = getInfo("4",$_SESSION['id_societe']);
                $client = 0;
                if($val1 != null)
                {
                    $client = $val1['deb']-$val1['cred'];
                }
                echo $client;
            ?>
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
                $val1 = getInfo("5",$_SESSION['id_societe']);
                $tresor = 0;
                if($val1 != null)
                {
                    $tresor = $val1['deb']-$val1['cred'];
                }
                echo $tresor;
            ?></td>
            <td>Ar 0</td>
            <td>Ar 0</td>
        </tr>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS COURANTS </h4>
            </th>
            <th> </th>
            <td>Ar <?php
                $brutCourant = $stockBrut + $client + $tresor;
                echo $brutCourant;
            ?></td>
            <td>Ar <?php
                $amortCourant = $provisionStock;
                echo $amortCourant;
            ?></td>
            <td>Ar <?php $netCourant = $brutCourant - $amortCourant;
            echo $netCourant; ?>
        </tr>
        <br/>
        <tr class="passif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS </h4>
            </th>
            <th> </th>
            <td>Ar <?php
                $brutTot = $brutCourant + $brutNonCourant;
                echo $brutTot;
            ?></td>
            <td>Ar <?php
                $amortTot = $amortCourant + $amortNonCourant;
                echo $amortTot;
            ?></td>
            <td>Ar <?php $netTot = $brutTot - $amortTot;
            echo $netTot; ?>
        </tr>
    </table>
</div>