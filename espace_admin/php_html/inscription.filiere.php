<?php
  include("database.php");
  session_start();
  if(!isset($_SESSION["email"])) {
    header("Location: login_sudo.php");
}
  if(isset($_GET["id"])){
    $id_filiere=$_GET["id"];
    $_SESSION["id"]=$id_filiere;
  }
  else{
    $id_filiere=$_SESSION["id"];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/inscription_filiere.css">
    <title>Document</title>
</head>
<body>
  <div class="title_container">
        <div class="logo_fst">
          <div >
            <img src="../images/FST-Tanger-modified.png" alt="" class="fst_img">
          </div>
          
        </div>

        <div class="h1_div">
          <h1 class="h1_style">FST TANGER</h1>
        </div>

        <div class="logo_uni">
          <img src="../images/logopuae.png" class="uni_img">
        </div>
  </div>
  <div class="menue">
    <a href="affichage_filiere_sudo.php"><button class="menue_button">menue</button></a>
    <a href="deconexion.php"><button class="menue_button">deconexion</button></a>
  </div>
  <div class="container">
    

    <div class="box" >
            <div class="adduser_div">
              
            <form action="exele.php" method="POST">
              <label>Choisir le Nombre des Candidats Admits :</label>
              <input  class ="download_exel_input" type="number" name="nbr_candidat" min="0" required>
                <input type="hidden" name="id_filiere" value=<?php echo $id_filiere;?>>
                <button type="submit" name="submit" class="add_user_button">Download Exel</button>
            </form>
              
            </div>

            <div class="table_division">
            <table class="table">
                <thead>
                  <tr>
                    
                    <th>Nom&Prenom</th>
                    <th>Email</th>
                    <th>CNE</th>
                    <th>Moyenne</th>
                    <th>Filiere</th>
                    <th>Dossier</th>
                    <th>supprimer</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                  
                  
                  $query =$db -> prepare("SELECT e.id, e.fullname, e.email, e.CNE, e.moyenne_bac2_3, i.filiere 
                                          FROM etudiant e
                                          INNER JOIN inscription i ON e.id = i.id_etd
                                          WHERE i.id_filiere = :id_filiere
                                          ORDER BY e.moyenne_bac2_3 DESC" );
                  $query ->bindParam(":id_filiere",$id_filiere);
                  $query -> execute();
                  $rows=$query ->fetchAll();

                  if($query){
                      foreach($rows as $row){
                          echo '<tr>
                                  
                                  <td>'.$row["fullname"].'</td>
                                  <td>'.$row["email"].'</td>
                                  <td>'.$row["CNE"].'</td>
                                  <td>'.$row["moyenne_bac2_3"].'</td>
                                  <td>'.$row["filiere"].'</td>
                                  <td class=\"td_buttons\" >
                                      <form action="display_file.php" method="POST">
                                        <input type="hidden" name="id_etd" value='.$row["id"].'>
                                        <button type="submit" class="update_button">&#128193;</button>
                                      </form>
                                  </td>
                                  <td class=\"td_buttons\" >
                                      <form action="delete_etd.php" method="POST">
                                        <input type="hidden" name="id_etd" value='.$row["id"].'>
                                        <input type="hidden" name="id_filiere" value='.$id_filiere.'>
                                        <button type="submit" name="submit" class="update_button">&#128465;</button>
                                      </form>
                                      
                                  </td>
                                </tr>';
                      }
                      
                  }
                ?>
                
                  
              </tbody>
            </table>
            </div>
    </div>
  </div>
</body>
</html>