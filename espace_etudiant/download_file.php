<?php
    require 'vendor/autoload.php';
    use setasign\Fpdi\Fpdi;
    session_start();
    if(!isset($_SESSION["email_verified"])){
        header("location:login.php");
        exit();
    }
if(isset($_POST["submit"])){
    include("data_base.php");


    $choix_form =$_SESSION['choix_form'];
    $id=$_SESSION["id"];

    $query = $db -> prepare('SELECT * FROM etudiant WHERE id=:id');
    $query -> bindparam(":id",$id);
    $query -> execute();
    $row = $query -> fetch();


    /////////////// recuperation de data ///////////
    $cin=$row["CIN"];
    $cne=$row["CNE"];
    $date=$row["date_de_naissance"];
    $ville=$row["ville_de_naissance"];
    $bac=$row["bac"];
    $mention_bac=$row["mention_bac"];
    $bac_2=$row["bac_2"];
    $bac_3=$row["bac_3"];
    $s1=$row["note_s1"]; $s2=$row["note_s2"]; $s3=$row["note_s3"];
    $s4=$row["note_s4"]; $s5=$row["note_s5"]; $s6=$row["note_s6"];
    $image_name=$row["image"];
    $fullname=$row["fullname"];
    $email=$row["email"];
    
    $selected_cycles=$choix_form['cycles'];




    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 14);

 
    $pdf->Image('images/FST-Tanger-modified.png', 10, 10, 30); // Logo gauche
    $pdf->Image('images/logopuae.png', 170, 10, 30); // Logo droit

  
    $pdf->Cell(0, 20, 'Fiche de candidature : 2024/2025', 0, 1, 'C');
    $pdf->Ln(5);

    /////////////////////////////  photo detudiant   ///////////////////////////

    $pdf->Rect(150, 40, 40, 50);
    $pdf->SetFont('Arial', 'I', 10);


    $imagePath = 'images/'.$image_name; 


    $pdf->Image($imagePath, 150, 40, 40, 50);


    $pdf->SetXY(150, 90); 
    $pdf->Cell(40, 10, 'Photo Etudiant', 0, 1, 'C');

    ///////////////////////////////////////////////////////////////////////////////

    
    $pdf->SetXY(10, 40); 
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Informations Personnelles', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);

  
    $infos_perso = [
        'Nom complet' => $fullname,
        'CNE' => $cne,
        'CIN' => $cin,
        'Date naissance' => $date,
        'Lieu naissance' => $ville,
        'Email' => $email
    ];

    foreach ($infos_perso as $key => $value) {
        $pdf->Cell(50, 8, utf8_decode($key) . ':', 0, 0);
        $pdf->Cell(0, 8, utf8_decode($value), 0, 1);
    }

    
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Informations sur le Bac', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(50, 8, 'Serie:', 0, 0);
    $pdf->Cell(0, 8, $bac, 0, 1);
    $pdf->Cell(50, 8, 'Mention:', 0, 0);
    $pdf->Cell(0, 8, $mention_bac, 0, 1);

    
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Diplomes Bac+2 :', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, $bac_2, 0, 1);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Diplomes Bac+3 :', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);
    $pdf->Cell(0, 8, $bac_3, 0, 1);

   
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Notes des Semestres', 0, 1, 'L');
    $pdf->SetFont('Arial', '', 10);

    
    for ($i = 1; $i <= 6; $i++) {
        $pdf->Cell(15, 8, 'S' . $i, 1, 0, 'C');
    }
    $pdf->Ln();
    $pdf->Cell(15, 8, $s1, 1, 0, 'C');
    $pdf->Cell(15, 8, $s2, 1, 0, 'C');
    $pdf->Cell(15, 8, $s3, 1, 0, 'C');
    $pdf->Cell(15, 8, $s4, 1, 0, 'C');
    $pdf->Cell(15, 8, $s5, 1, 0, 'C');
    $pdf->Cell(15, 8, $s6, 1, 0, 'C');
    $pdf->Ln(10);

    ///////////////////////////////filiere choisit ///////////////////
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Choix des Filieres', 0, 1, 'L');

  

    foreach ($selected_cycles as $filiere) {
        list($id_filiere,$nom_filiere)=explode('=>',$filiere);
        $pdf->Cell(0, 8,$nom_filiere, 1, 1); // Affichage de chaque filière dans une nouvelle ligne
    }

    ////////////////////////////////////////////////////////////////////////////////

   
    $pdf->Ln(5);
    $pdf->SetFont('Arial', 'I', 10);
    $pdf->Cell(0, 10, 'Signature du candidat:', 0, 1, 'R');


    $pdf->Output('D', 'fiche_candidature.pdf');

}
 
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="license_cycle_master.css">
    <title>orientation FST Tanger</title>
</head>
<body>

    <div class="title_container">
      <div class="logo_fst">
        <div >
          <img src="images/FST-Tanger-modified.png" alt="" class="fst_img">
        </div>
        
      </div>

      <div class="h1_div">
      <h1 class="h1_style">FST TANGER</h1>
      </div>

      <div class="logo_uni">
        <img src="images/logopuae.png" class="uni_img">
      </div>
      
    </div>
    <div class="container">
        <div class="box">
            <div class="titre">
                <h1 style="margin-left:140px;">&#127881;Félicitations&#127881;</h1>
                <h2 style="margin-left:50px;">Votre candidature est maintenant terminée</h2>
                <h3>Télécharger votre fiche de candidature :</h3>
            </div>
            <div class="form_container">
                <form action="download_file.php" method="post">
                    <div class="info">
                        
                        <input style="margin-left:250px; border-radius:10px; width: 100px; height: 40px;" type="submit" name="submit" value="telecharger" class="input_envoyer"><br>
                        <a href="license_cycle_master.php">Choisissez un autre choix</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>



