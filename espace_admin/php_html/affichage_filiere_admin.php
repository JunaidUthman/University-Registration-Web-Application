<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login_chef.php");
}
include("database.php");
    $id_chef=$_SESSION["id_chef"];
    $id_filiere_fk=$_SESSION["id_filiere_fk"];
//calcul de nombre total des candidats
      $query = $db->prepare('SELECT COUNT(DISTINCT id) as nbr FROM etudiant  NATURAL JOIN inscription WHERE id=id_etd AND id_filiere=:id_filiere_fk');
      $query ->bindparam(":id_filiere_fk",$id_filiere_fk);
      $query->execute();
      $nbr_etudiant=$query->fetch();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/affichage_filiere_admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <title>orientation FST Tanger</title>
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
    <a href="deconexion_chef.php">deconexion</a>
    <div class="container">
      <div class="top_container">
      <div class="nbr_cdt_box">
          <h2>Nombre Total de Candidats :<?php echo $nbr_etudiant["nbr"];?></h2>
        </div>
      </div>
        
        <?php
        
        $query_dep=$db->prepare('SELECT nom_orientation FROM orientation NATURAL JOIN filiere WHERE id_filiere=:id_filiere');
        $query_dep->bindparam(":id_filiere",$id_filiere_fk);
        $query_dep ->execute();
        $rows_dep=$query_dep->fetchAll();

  

        foreach($rows_dep as $row) {
      
          //////////// Récupérer les filières pour chaque orientation //////////
          $query_filiere = $db->prepare('SELECT * FROM filiere WHERE id_filiere=:id_filiere');
          $query_filiere->bindparam(":id_filiere",$id_filiere_fk);
          $query_filiere->execute();
          $row_filiere = $query_filiere->fetchAll();
      

          $filieres = [];
          $tab_nbr = [];
      
          ///////// Affichage les filières et leurs inscriptions  ///////////////
          echo '<div class="departement">
          <span class="ligne-separation"></span>
          <span class="orientation-nom">' . $row["nom_orientation"] . '</span>
          <span class="ligne-separation"></span>
          </div>';
          echo '<div class="grids">';
      
          foreach($row_filiere as $row_f) {
              ////// Récupérer le nombre d'inscriptions pour chaque filière //////////
              $nbr_candidat = $db->prepare('SELECT COUNT(id_ins) AS i FROM inscription WHERE id_filiere=:id_filiere');
              $nbr_candidat->bindparam(":id_filiere", $row_f["id_filiere"]);
              $nbr_candidat->execute();
              $candidat = $nbr_candidat->fetch();
      
              $filieres[] = $row_f["nom_filiere"];
              $tab_nbr[] = $candidat["i"];
      
              /////// Affichagr de chaque filière avec le nombre d'inscrits ///////////
              echo '<div class="contenue"><button>' . $row_f["nom_filiere"] . ': <strong>(' . $candidat["i"] . ') Candidats</strong></button></div>';
          }
      
          echo '</div>';
        }
        ?>
        
    </div>
    <div class="container_tab">

    <div class="box" >
            <div class="adduser_div">
              
            <form action="exele.php" method="POST">
              <label class="nbr_cdt_text">Choisir le Nombre des Candidats Admits :</label>
              <input type="number" name="nbr_candidat" class="nbr_candidat" required>
                <input type="hidden" name="id_filiere" value=<?php echo $id_filiere_fk;?>>
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
                  $query ->bindParam(":id_filiere",$id_filiere_fk);
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
                                      <form action="delete_etd_admin.php" method="POST">
                                        <input type="hidden" name="id_etd" value='.$row["id"].'>
                                        <input type="hidden" name="id_filiere" value='.$id_filiere_fk.'>
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

