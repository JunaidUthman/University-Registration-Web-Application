<?php
    if(isset($_POST["id_filiere"])){
        //echo $_POST["id_filiere"];
        $id_filiere = $_POST["id_filiere"];
        $nbr_candidat=$_POST["nbr_candidat"];
    }
    else{
        echo "la filiere n'est pas connue";
    }


    require 'vendor/autoload.php'; // Inclure PhpSpreadsheet via Composer

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    include('database.php'); // Assurez-vous que la connexion à la base de données est bien établie

    // Exemple de requête SQL pour récupérer des données
    $query =$db -> prepare("SELECT e.id, e.fullname, e.email, e.CNE, e.moyenne_bac2_3, i.filiere 
    FROM etudiant e
    INNER JOIN inscription i ON e.id = i.id_etd
    WHERE i.id_filiere = :id_filiere
    ORDER BY e.moyenne_bac2_3 DESC
    LIMIT $nbr_candidat" );
    $query ->bindParam(":id_filiere",$id_filiere);
    $query -> execute();
    $rows=$query ->fetchAll();

    // Créer un objet Spreadsheet
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    // Ajouter les en-têtes (titres des colonnes)
    $sheet->setCellValue('A1', 'ID');
    $sheet->setCellValue('B1', 'Fullname');
    $sheet->setCellValue('C1', 'Email');
    $sheet->setCellValue('D1', 'CNE');
    $sheet->setCellValue('E1', 'Moyenne Bac 2-3');
    $sheet->setCellValue('F1', 'Filière');

    // Remplir les données récupérées depuis la base de données dans les lignes suivantes
    $rowNumber = 2; // On commence à la ligne 2
    foreach ($rows as $row) {
        $sheet->setCellValue('A' . $rowNumber, $row['id']);
        $sheet->setCellValue('B' . $rowNumber, $row['fullname']);
        $sheet->setCellValue('C' . $rowNumber, $row['email']);
        $sheet->setCellValue('D' . $rowNumber, $row['CNE']);
        $sheet->setCellValue('E' . $rowNumber, $row['moyenne_bac2_3']);
        $sheet->setCellValue('F' . $rowNumber, $row['filiere']);
        $rowNumber++;
    }

    // Créer un fichier Excel
    $writer = new Xlsx($spreadsheet);

    // Définir les headers pour le téléchargement
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment;filename="data_export.xlsx"');
    header('Cache-Control: max-age=0');

    // Écrire et télécharger le fichier Excel
    $writer->save('php://output');
    exit();


?>