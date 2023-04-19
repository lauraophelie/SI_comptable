<?php 
    require("../../librairies/excel/PHPExcel.php");
    include("./fonctions.php");
    date_default_timezone_set('Africa/Nairobi');

    $journal = $_POST['journal'];
    $societe = $_POST['societe'];

    if(isset($_FILES['excel']) && $_FILES['excel']['error'] == UPLOAD_ERR_OK) {

        $file_name = $_FILES['excel']['name'];
        $file_tmp = $_FILES['excel']['tmp_name'];

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_extensions = array('xlsx', 'csv', 'ods', 'xls');

        if(!in_array(strtolower($file_extension), $allowed_extensions)) {
            header('Location: ../../pages/page.php?page=ecritures/import_ecritures&upload_error=Fichier non pris en charge&journal='.$journal);
            exit();
        }

        $reader = PHPExcel_IOFactory::createReaderForFile($file_tmp);
        $reader->setReadDataOnly(true);
        $spreadsheet = $reader->load($file_tmp);
        $sheet = $spreadsheet->getActiveSheet();

        foreach ($sheet->getRowIterator() as $row) {
            if($row ->getRowIndex() == 1) {
                continue;
            }
            $cellIterator = $row->getCellIterator();
            $cellIterator->setIterateOnlyExistingCells(TRUE);
            $values = array();

            foreach ($cellIterator as $cell) {
                $value = $cell->getValue();
                if(!empty($value)) {
                    $values [] = $value;
                } else {
                    $values [] = null;
                }
            }
            save_ecriture($journal, $societe, date('Y-m-d', PHPExcel_Shared_Date::ExcelToPHP($values[0])), $values[1], $values[2], $values[3], $values[4], $values[5], $values[6], null, null, null);
        }
        //header('Location: ../../pages/page.php?page=ecritures/import_ecritures&upload_message=Import terminée avec succès !&journal='.$journal);
        //exit();
    } else {
        header('Location: ../../pages/page.php?page=ecritures/import_ecriture&supload_error=Veuillez choisire un fichier');
        exit();
    }
?>