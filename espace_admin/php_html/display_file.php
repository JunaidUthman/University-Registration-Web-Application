<?php
    if (isset($_POST['id_etd']) ) {
        include("database.php");
        $id_etd = $_POST['id_etd'];
        $query= $db->prepare('SELECT fichier FROM etudiant where id=:id');
        $query -> bindParam(":id",$id_etd);
        $query -> execute();
        $row = $query -> fetch();
        $file_path_local = 'C:/xampp/htdocs/lsi_dev/lsi_projet_version_adminv2/espace_etudiant/files/' . $row['fichier'];
        if (file_exists($file_path_local)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path_local) . '"');
            header('Content-Length: ' . filesize($file_path_local));
            header('Pragma: public');

            // Lire le fichier et envoyer son contenu
            readfile($file_path_local);
            exit;
            header("location:inscription.filiere.php");
        } else {
            echo 'Le fichier PDF n\'existe pas.';
        }


    }
    else {
        echo "L'etudiant n'existe pas";
    }
?>
