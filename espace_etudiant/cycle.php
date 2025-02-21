<?php
    session_start();
    if(!isset($_SESSION["email_verified"])){
        header("location:login.php");
    }
    $id=$_SESSION["id"];
    include("data_base.php");
    if (isset($_POST["submit"])) {  $_SESSION['choix_form'] = $_POST;
        $selected_cycles=$_POST["cycles"];

        foreach ($selected_cycles as $cycle){
            list($id_filiere,$nom_filiere)=explode('=>',$cycle);
            $query= $db->prepare('SELECT * FROM inscription WHERE id_etd=:id_etd AND id_filiere=:id_filiere');
            $query -> bindparam("id_etd",$id);
            $query -> bindparam("id_filiere",$id_filiere);
            $query -> execute();
            $rows=$query->fetch();

            if(empty($rows)){
                $query_inscription = $db -> prepare('INSERT INTO inscription(filiere,id_filiere,id_etd,nom_orientation) VALUES(:filiere,:id_filiere,:id_etd,:orientation)');
                $query_inscription->bindParam(":filiere",$nom_filiere);
                $query_inscription->bindParam(":id_filiere",$id_filiere);
                $query_inscription->bindParam(":id_etd",$id);
                $orientation ="cycle";
                $query_inscription->bindParam(":orientation",$orientation);
                $query_inscription -> execute();
            }
        }
        header("location:download_file.php");
        }


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cycle_style.css">
    <title>Orientation FST Tanger</title>
</head>

<body>
    
    <div class="title_container">
        <div class="logo_fst">
            <img src="images/FST-Tanger-modified.png" alt="FST Logo" class="fst_img">
        </div>
        <div class="h1_div">
            <h1 class="h1_style">FST TANGER</h1>
        </div>
        <div class="logo_uni">
            <img src="images/logopuae.png" alt="University Logo" class="uni_img">
        </div>
    </div>
    
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1>Choisissez une ou plusieurs options.</h1>
            </div>
            <div class="form_container">
            <form action="cycle.php" method="post" enctype="multipart/form-data" onsubmit="return validateCheckboxes()">

                    
                    <label for="note_s6" class="choix_text">Selectionner un Cycle :</label><br>
                    <?php
                    
                        $query_cycle= $db->prepare('SELECT * FROM filiere WHERE nom_orientation=:orientation');
                        $orientation ="cycle";
                        $query_cycle -> bindParam("orientation",$orientation);
                        $query_cycle ->execute();
                        $rows_cycle=$query_cycle->fetchall();

                        foreach($rows_cycle as $row){
                            $keyValuePair=$row["id_filiere"].'=>'.$row["nom_filiere"];
                            echo '<input type="checkbox" name="cycles[]" value="'.$keyValuePair.'" >'.$row["nom_filiere"].'<br>';
                            }
                    ?>
                    <!--javascript script pour selectionner au moin une chechbox-->
                    <script>
                        function validateCheckboxes() {
                            const checkboxes = document.querySelectorAll('input[name="cycles[]"]');
                            let isChecked = false;

                            checkboxes.forEach((checkbox) => {
                                if (checkbox.checked) {
                                    isChecked = true;
                                }
                            });

                            if (!isChecked) {
                                alert("Veuillez sélectionner au moins une option.");
                                return false;
                            }

                            return true;
                        }
                        </script>

                    <input type="submit" name="submit" class="submit">
                </form>
            </div>
        </div>
    </div>
</body>

</html>
