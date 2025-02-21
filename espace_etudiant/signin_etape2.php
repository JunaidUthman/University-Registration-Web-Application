<?php
session_start();
    include("data_base.php");
    if(!isset($_SESSION["email_verified"])){
        header("location:signin_etape1.php");
        exit();
    }
    $id=$_SESSION["id"];
    if(isset($_POST["submit"])){//$_SESSION['inscription_form']=$_POST;
        
            $cin=$_POST["cin"];
            $cne=$_POST["cne"];
            $date=$_POST["date_naissance"];
            $ville=$_POST["ville_naissance"];
            $bac=$_POST["serie_bac"];
            $mention_bac=$_POST["mention_bac"];
            $bac_2=$_POST["bac_2"];
            $bac_3=isset($_POST["bac_3"])? $_POST["bac_3"]: '';
            $s1=$_POST["note_s1"]; $s2=$_POST["note_s2"]; $s3=$_POST["note_s3"];
            $s4=$_POST["note_s4"]; $s5=$_POST["note_s5"]; $s6=$_POST["note_s6"];
            if(empty($_POST["bac_3"])){
                $moyenne=($s1+$s2+$s3+$s4)/4;
            }
            else{
                $moyenne=($s1+$s2+$s3+$s4+$s5+$s6)/6; 
            }


            $query= $db -> prepare('UPDATE etudiant SET CIN=:cin,
                                                        CNE=:cne,
                                                        date_de_naissance=:date,
                                                        ville_de_naissance=:ville,
                                                        bac=:bac,
                                                        mention_bac=:mention_bac,
                                                        bac_2=:bac_2,
                                                        bac_3=:bac_3,
                                                        note_s1=:s1,
                                                        note_s2=:s2,
                                                        note_s3=:s3,
                                                        note_s4=:s4,
                                                        note_s5=:s5,
                                                        note_s6=:s6,
                                                        moyenne_bac2_3=:moyenne WHERE id=:id');
                                    
            $query->bindParam(":id",$id);
            $query->bindParam(":cin",$cin);
            $query->bindParam(":cne",$cne);
            $query->bindParam(":date",$date);
            $query->bindParam(":ville",$ville);
            $query->bindParam(":bac",$bac);
            $query->bindParam(":mention_bac",$mention_bac);
            $query->bindParam(":bac_2",$bac_2);
            $query->bindParam(":bac_3",$bac_3);
            $query->bindParam(":s1",$s1);    $query->bindParam(":s4",$s4);
            $query->bindParam(":s2",$s2);    $query->bindParam(":s5",$s5);
            $query->bindParam(":s3",$s3);    $query->bindParam(":s6",$s6);
            $query->bindParam(":moyenne",$moyenne);
            $query -> execute();
        

        if (isset($_FILES["image"]) && isset($_FILES["file"])){
            $image_name=$_FILES["image"]["name"]; 
            $image_name_filtred = pathinfo($image_name , PATHINFO_EXTENSION);
            $tempname=$_FILES["image"]["tmp_name"];
            $allowed_types = array("jpg", "jpeg", "png", "gif", "bmp", "tiff", "webp","PNG");
            $targetpath = "images/". $image_name;

            $file_name=$_FILES["file"]["name"];  
            $file_name_filtred = pathinfo($image_name , PATHINFO_EXTENSION);
            $tempname_file=$_FILES["file"]["tmp_name"];
            $allowed_types_file = array("pdf");
            $targetpath_file = "files/". $file_name;

            if(in_array($image_name_filtred , $allowed_types)){
                
                if(move_uploaded_file($tempname , $targetpath)){
                    $query= $db -> prepare('UPDATE etudiant SET image=:image WHERE id=:id');
                    $query->bindParam(":image",$image_name);
                    $query->bindParam(":id",$id);
                if($query -> execute()){
                    echo "the image is on the db right now";
                }
                }
            }
            else{
                echo "il faut entrer une photo dans le champ des photos".'<br>';
            }
            if(in_array($file_name_filtred , $allowed_types)){
                
                if(move_uploaded_file($tempname_file , $targetpath_file)){
                    $query= $db -> prepare('UPDATE etudiant SET fichier=:fichier WHERE id=:id');
                    $query->bindParam(":fichier",$file_name);
                    $query->bindParam(":id",$id);
                if($query -> execute()){
                    echo "the file is on the db right now";
                    header("location:felicitation.php");
                }
                }
            }
            else{
                echo "il faut entrer un pdf dans le champ des fichiers".'<br>';
            }


            
        } else {
            echo "Erreur lors du téléchargement des fichiers.";
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin_etape2.css">
    <title>orientation FST Tanger</title>
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
                <h3 style="color:gray;">inscription etape 2:  </h3>
                <h1>Completez L'inscription</h1>
            </div>
            <div class="form_container">
                <form action="signin_etape2.php" method="post" enctype="multipart/form-data">
                    <div class="info">
                        <div class="fullname">
                            <label class="text_cin">CIN :</label><br>
                            <input type="text" name="cin" placeholder="CIN" required class="input_cin"><br>
                        </div>
                        <div class="cne">
                            <label class="text_cne">CNE :</label><br>
                            <input type="text" name="cne" placeholder="CNE" required class="input_cne"><br>
                        </div>
                        <div class="date">
                            <label class="text_date">Date de Naissance :</label><br>
                            <input type="date" name="date_naissance" placeholder="mot de passe &#128273;" required class="input_date"><br>
                        </div>
                        <div class="ville">
                            <label class="text_ville">Ville de Naissance :</label><br>
                            <input type="text" name="ville_naissance" placeholder="Ville de Naissance" required class="input_ville"><br>
                        </div>
                        <label for="serie_bac" class="text_serie_bac">Serie du Bac :</label><br>
                        <select type="text" name="serie_bac" class="serie_bac">
                        <?php

                        $query_bac= $db->prepare('SELECT * FROM bac');
                        $query_bac ->execute();
                        $rows_bac=$query_bac->fetchall();
                        
                        foreach($rows_bac as $row){
                            echo '
                            <option value="'.$row["nom_bac"].'">'.$row["nom_bac"].'</option>
                            ';
                        }
                        ?>
                        </select><br>

                        <label for="mention_bac" class="text_mention_bac">Mention Bac :</label><br>
                        <input type="number" step="0.01" class="mention_bac"  name="mention_bac" min="0" max="20" required><br>

                        <label for="bac_2" class="text_bac_2">Diplome Bac+2 :</label><br>
                        <select type="text" name="bac_2" class="input_bac_2" required>
                            <option value="" disabled selected></option>
                            <?php

                            $query_deust= $db->prepare('SELECT * FROM deust');
                            $query_deust ->execute();
                            $rows_deust=$query_deust->fetchall();
                            
                            foreach($rows_deust as $row){
                                echo '
                                <option value="'.$row["nom_deust"].'">'.$row["nom_deust"].'</option>
                                ';
                            }
                            ?>
                        </select><br>

                        <label for="bac_3" class="text_bac_3">Diplome Bac+3 :</label><br>
                        <select type="text" name="bac_3" class="input_bac_3"><br>
                        <option value="" disabled selected></option>
                        <?php

                        $query_licence= $db->prepare('SELECT * FROM licence');
                        $query_licence ->execute();
                        $rows_licence=$query_licence->fetchall();
                        
                        foreach($rows_licence as $row){
                            echo '
                            <option value="'.$row["nom_licence"].'">'.$row["nom_licence"].'</option>
                            ';
                        }
                        ?>
                        </select><br>

                        <label for="note_s1" class="s" >Note S1 :</label><br>
                        <input type="number" step="0.01"  name="note_s1" class="input_s" min="0" max="20" required><br>
                        
                        <label for="note_s2" class="s">Note S2 :</label><br>
                        <input type="number" step="0.01" name="note_s2" class="input_s" min="0" max="20" required><br>
                        
                        <label for="note_s3" class="s">Note S3 :</label><br>
                        <input type="number" step="0.01" name="note_s3" class="input_s" min="0" max="20" required><br>
                        
                        <label for="note_s4" class="s">Note S4 :</label><br>
                        <input type="number" step="0.01" name="note_s4" class="input_s" min="0" max="20" required><br>
                        
                        <label for="note_s5" class="s">Note S5 :</label><br>
                        <input type="number" step="0.01" class="input_s" name="note_s5" min="0" max="20"><br>

                        <label for="note_s6" class="s">Note S6 :</label><br>
                        <input type="number" step="0.01" class="input_s" name="note_s6" min="0" max="20"><br>

                        <label for="photo" class="text_photo">Photo :</label><br>
                        <input type="file" name="image" class="input_photo" required><br><br>

                        <label for="pdf_fichier" class="text_file">Dossier PDF(baccalauréat, relevé de notes, attestation de réussite bac+2/3)</label><br>
                        <input type="file" name="file" required class="text_file"><br>
                            <input type="submit" name="submit" value="S'inscrire" class="input_envoyer">
                            
                        </div>
                </form>
            </div>
            <a href="login.php" class="lien_login">aller à la page d'identification</a>
        </div>
    </div>
    
</body>