<?php

    function calcul_marge_brute($Chiffre_Affaire,$Cout_Fixe,$Cout_Variable) {
        return ($Chiffre_Affaire - $Cout_Variable - $Cout_Fixe);
    }

    function calcul_marge_fixe($Chiffre_Affaire,$Cout_Fixe) {
        return ($Chiffre_Affaire - $Cout_Fixe);
    }

?>