<?php 
    require("../../librairies/excel/PHPExcel.php");
    include("./fonctions.php");

    if(isset($_FILES['excel']) && $_FILES['excel']['error'] == UPLOAD_ERR_OK) {

        $file_name = $_FILES['excel']['name'];
        $file_tmp = $_FILES['excel']['tmp_name'];

        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_extensions = array('xlsx', 'csv', 'ods', 'xls');

        if(!in_array(strtolower($file_extension), $allowed_extensions)) {
            header('Location: ../../pages/journal/ajout_journal.php?upload_error=Fichier non pris en charge');
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
              $values[] = $cell->getValue();
            }
            save($values[0], $values[1]);
        }
        header('Location: ../../pages/journal/ajout_journal.php?upload_message=Import terminée avec succès !');
    } else {
        header('Location: ../../pages/journal/ajout_journal.php?upload_error=Une erreur s\'est produite');
        exit();
    }
?>
