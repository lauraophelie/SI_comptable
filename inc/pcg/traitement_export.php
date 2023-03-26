<?php
    include("./fonctions.php");
    require("../../librairies/excel/PHPExcel.php");
    date_default_timezone_set('Africa/Nairobi');


    $comptes = find_all();

    $nom_fichier = $_POST['nom_fichier'];
    $type_fichier = $_POST['type_fichier'];

    if($type_fichier == "csv") {

        $delimiter = ",";
        header("Content-Type: text/csv; charset=utf-8");
        header("Content-Disposition: attachment; filename=".$nom_fichier.".csv");
            
        $output = fopen('php://output', 'w');

        fputcsv($output, array('N° de compte', 'Désignation'), $delimiter);

        foreach($comptes as $compte) {
            fputcsv($output, array($compte['numero'], $compte['designation']), $delimiter);
        }
        fclose($output);
        exit();

    } else if($type_fichier != "csv") {

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment; filename='.$nom_fichier.'.'.$type_fichier);
        $spreadsheet = new PHPExcel();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'N° de compte');
        $sheet->setCellValue('B1', 'Désignation');
        $i = 2;
        foreach($comptes as $compte) {
            $sheet->setCellValue('A'.$i, $compte['numero']);
            $sheet->setCellValue('B'.$i, $compte['designation']);
            $i++;
        }
        $writer = PHPExcel_IOFactory::createWriter($spreadsheet, 'Excel2007');
        $writer->save('php://output');
        exit();

    }
?>