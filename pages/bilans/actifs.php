<?php include("../inc/bilans/actifs/fonctions.php"); ?>

<h1 id="main-title"> Bilan : Actifs </h1>

<div style="height: 125px"> </div>

<div class="bilan-box">
    <h3> Bilan </h3>
    <h3> EXERCICE CLOS AU : </h3>
    <h3> Unité monétaire : Ariary </h3>
</div>

<div class="bilan-box-content">
    <table>
        <tr class="passif-line actif-line">
            <th> </th>
            <th class="title"> Compte </th>
            <th class="title" colspan="2"> Montant </th>
        </tr>
        <tr class="passif-line actif-line">
            <th colspan="2"> </th>
            <th class="case">Brut</th>
            <th class="case">Amort./Prov.</th>
            <th class="case">Net</th>
        </tr>
        <tr class="passif-line actif-line">
            <th colspan="4"> 
                <h4> ACTIFS NON COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line actif-line">
            <td>IMMOBILISATIONS INCORPORELLES</td>
            <td>20</td>
            <td><?php
                $val1 = getInfo("20",$_SESSION['id_societe']);
                $immoInco = 0;
                if($val1 != null)
                {
                    $immoInco = $val1['deb']-$val1['cred'];
                }
                echo number_format($immoInco, 0, ' ', ' ');
            ?></td>
            <td><?php
                $val2 = getInfo("280",$_SESSION['id_societe']);
                $amortInco = 0;
                if($val2 != null)
                {
                    $amortInco = $val2['cred']-$val2['deb'];
                }
                echo number_format($amortInco, 0, ' ', ' ');
            ?></td>
            <td><?php $netInco = $immoInco - $amortInco;
            echo $netInco; ?></td>
        </tr>
        <tr class="passif-line actif-line">
            <td>IMMOBILISATIONS CORPORELLES</td>
            <td>21</td>
            <td><?php
                $val1 = getInfo("21",$_SESSION['id_societe']);
                $immoCo = 0;
                if($val1 != null)
                {
                    $immoCo = $val1['deb']-$val1['cred'];
                }
                echo number_format($immoCo, 0, ' ', ' ');
            ?></td>
            <td><?php
                $val2 = getInfo("281",$_SESSION['id_societe']);
                $amortCo = 0;
                if($val2 != null)
                {
                    $amortCo = $val2['cred']-$val2['deb'];
                }
                echo number_format($amortCo, 0, ' ', ' ');
            ?></td>
            <td><?php $netCo = $immoCo - $amortCo;
            echo $netCo; ?></td>
        </tr>
        <tr class="passif-line actif-line">
            <td>IMMOBILISATIONS BIOLOGIQUES</td>
            <td>22</td>
            <td><?php
                $val1 = getInfo("22",$_SESSION['id_societe']);
                $immoBio = 0;
                if($val1 != null)
                {
                    $immoBio = $val1['deb']-$val1['cred'];
                }
                echo number_format($immoBio, 0, ' ', ' ');
            ?></td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>IMMOBILISATIONS EN COURS</td>
            <td>23</td>
            <td><?php
                $val1 = getInfo("23",$_SESSION['id_societe']);
                $immoCours = 0;
                if($val1 != null)
                {
                    $immoCours = $val1['deb']-$val1['cred'];
                }
                echo number_format($immoCours, 0, ' ', ' ');
            ?></td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td> IMMOBILISATIONS FINANCIERES</td>
            <td> 25 </td>
            <td><?php
                $val1 = getInfo("25",$_SESSION['id_societe']);
                $immoFin = 0;
                if($val1 != null)
                {
                    $immoFin = $val1['deb']-$val1['cred'];
                }
                echo number_format($immoFin, 0, ' ', ' ');
            ?></td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>IMPOTS DIFFERES</td>
            <td>13</td>
            <td><?php
                $val1 = getInfo("21",$_SESSION['id_societe']);
                $impotDiff = 0;
                if($val1 != null)
                {
                    $impotDiff = $val1['deb']-$val1['cred'];
                }
                echo number_format($impotDiff, 0, ' ', ' ');
            ?></td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS NON COURANTS </h4>
            </th>
            <th> </th>
            <td><?php
                $brutNonCourant = $immoInco + $immoCo + $immoBio + $immoCours + $immoFin + $impotDiff;
                echo number_format($brutNonCourant, 0, ' ', ' ');
            ?></td>
            <td><?php
                $amortNonCourant = $amortInco + $amortCo;
                echo number_format($amortNonCourant, 0, ' ', ' ');
            ?></td>
            <td><?php $netNonCourant = $brutNonCourant - $amortNonCourant;
            echo number_format($netNonCourant, 0, ' ', ' '); ?></td>
        </tr>
        <tr class="passif-line actif-line">
            <th colspan="4"> 
                <h4> ACTIFS COURANTS </h4>
            </th>
        </tr>
        <tr class="passif-line actif-line">
            <td>STOCKS ET EN-COURS</td>
            <td>3</td>
            <td><?php
                $val1 = getInfo("3",$_SESSION['id_societe']);
                $stockBrut = 0;
                if($val1 != null)
                {
                    $stockBrut = $val1['deb']-$val1['cred'];
                }
                echo number_format($stockBrut, 0, ' ', ' ');
            ?></td>
            <td><?php
                $val2 = getInfo("397",$_SESSION['id_societe']);
                $provisionStock = 0;
                if($val2 != null)
                {
                    $provisionStock = $val2['cred']-$val2['deb'];
                }
                echo number_format($provisionStock, 0, ' ', ' ');
            ?></td>
            <td><?php $netStock = $stockBrut - $provisionStock;
            echo $netStock; ?></td>
        </tr>

        <tr class="passif-line actif-line">
            <td>CREANCES ET EMPLOIS ASSIMILES</td>
            <td>4...</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>Clients et autres débiteurs</td>
            <td>4...</td>
            <td> <?php
                $val1 = getInfo("4",$_SESSION['id_societe']);
                $client = 0;
                if($val1 != null)
                {
                    $client = $val1['deb']-$val1['cred'];
                }
                echo number_format($client, 0, ' ', ' ');
            ?>
            </td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>Impôts /bénéfice</td>
            <td>...</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>Autres créances et actifs assimilés</td>
            <td>4...</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line">
            <td>TRESORERIE ET EQUIVALENTS DE TRESORERIE</td>
            <td>5...</td>
            <td><?php
                $val1 = getInfo("5",$_SESSION['id_societe']);
                $tresor = 0;
                if($val1 != null)
                {
                    $tresor = $val1['deb']-$val1['cred'];
                }
                echo number_format($tresor, 0, ' ', ' ');
            ?></td>
            <td>0</td>
            <td>0</td>
        </tr>
        <tr class="passif-line actif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS COURANTS </h4>
            </th>
            <th> </th>
            <td> <?php
                $brutCourant = $stockBrut + $client + $tresor;
                echo number_format($brutCourant, 0, ' ', ' ');
            ?></td>
            <td> <?php
                $amortCourant = $provisionStock;
                echo number_format($amortCourant, 0, ' ', ' ');
            ?></td>
            <td> <?php $netCourant = $brutCourant - $amortCourant;
            echo number_format($netCourant, 0, ' ', ' '); ?>
        </tr>
        <br/>
        <tr class="passif-line actif-line total-line">
            <th> 
                <h4 style="text-align:center"> TOTAL DES ACTIFS </h4>
            </th>
            <th> </th>
            <td> <?php
                $brutTot = $brutCourant + $brutNonCourant;
                echo number_format($brutTot, 0, ' ', ' ');
            ?></td>
            <td> <?php
                $amortTot = $amortCourant + $amortNonCourant;
                echo number_format($amortTot, 0, ' ', ' ');
            ?></td>
            <td> <?php $netTot = $brutTot - $amortTot;
            echo number_format($netTot, 0, ' ', ' '); ?>
        </tr>
    </table>
</div>