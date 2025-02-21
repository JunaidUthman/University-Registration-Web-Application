<?php
  include("database.php");
  session_start();
  if(!isset($_SESSION["email"])) {
    header("Location: login_sudo.php");
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

            <div class="table_division">
            <table class="table">
                <thead>
                  <tr>
                    
                    <th>Nom&Prenom</th>
                    <th>Email</th>
                    <th>Filiere</th>
                    <th>Modifier</th>
                    <th>supprimer</th>
                  </tr>
                </thead>
              <tbody>
                <?php
                  
                  
                  $query =$db -> prepare("SELECT * FROM chef_filiere");
                  $query -> execute();
                  $rows=$query ->fetchAll();

                  
                  
                  if($query){
                    
                      foreach($rows as $row){
                        ////////////chercher le nom du filiere/////////
                        $query_filiere =$db -> prepare("SELECT nom_filiere FROM filiere WHERE id_filiere=:id_filiere");
                        $id_filiere_fk = $row["id_filiere_fk"];
                        $query_filiere->bindparam(":id_filiere",$id_filiere_fk);
                        $query_filiere -> execute();
                        $rows_filiere=$query_filiere ->fetch();
                          echo '<tr>
                                  
                                  <td>'.$row["fullname"].'</td>
                                  <td>'.$row["email"].'</td>
                                  <td>'.$rows_filiere["nom_filiere"].'</td>
                                  <td class=\"td_buttons\" >
                                      <a href="modifier_chef.php?id='.$row["id_chef"].'"><button>&#9998;</button></a>
                                  </td>
                                  <td class=\"td_buttons\" >
                                      <a href="supprimer_chef.php?id='.$row["id_chef"].'"><button>&#128465;</button></a>
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