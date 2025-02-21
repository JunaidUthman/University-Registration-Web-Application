<?php
session_start();
if (!isset($_SESSION["email"])) {
    header("Location: login_sudo.php");
}
include("database.php");
//calcul de nombre total des candidats
      $query = $db->prepare('SELECT COUNT(DISTINCT id) as nbr FROM etudiant NATURAL JOIN inscription WHERE id=id_etd');
      $query->execute();
      $nbr_etudiant=$query->fetch();
;
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/affichage_filiere_sudo.css">
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
    <div class="menu_container">
      <div class="menue">
      <a class="lien_deconexion" href="deconexion.php">deconexion</a>
    </div>
    </div>
    
    <div class="container">
      <div class="top_container">
        <div>
          <a href="ajouter_admin.php"><button class="ajouter_button">Ajouer un Chef de Filière</button></a>
        </div>
        <div class="nbr_cdt_box">
          <h2>Nombre Total de Candiddats :<?php echo $nbr_etudiant["nbr"];?></h2>
        </div>
        <div>
          <a href="supprimer_chef_filiere.php"><button class="ajouter_button">Modifier un Chef de Filière</button></a>
        </div>
        
      </div>
        
        <?php
        
        $query_dep=$db->prepare('SELECT nom_orientation FROM orientation');
        $query_dep ->execute();
        $rows_dep=$query_dep->fetchAll();

  

        foreach($rows_dep as $row) {
          ////// raquete pour le nombre de filières ////////
          $nbr_filiere = $db->prepare('SELECT COUNT(id_filiere) AS n FROM filiere WHERE nom_orientation=:nom_orientation');
          $nbr_filiere->bindparam(":nom_orientation", $row["nom_orientation"]);
          $nbr_filiere->execute();
          $nbr = $nbr_filiere->fetch();
      
          /////// requete pour trouver les filiere de chaque orientation /////////
          $query_filiere = $db->prepare('SELECT * FROM filiere WHERE nom_orientation=:nom_orientation');
          $query_filiere->bindparam(":nom_orientation", $row["nom_orientation"]);
          $query_filiere->execute();
          $row_filiere = $query_filiere->fetchAll();
      
          ///////////// Initialisation des tableaux de données pour chaque département ////////////////////
          $filieres = [];
          $tab_nbr = [];
      
          ////////////// Affichage des filières et leurs inscriptions /////////////////
          echo '<div class="departement">
          <span class="ligne-separation"></span>
          <span class="orientation-nom">' . $row["nom_orientation"] . ' (' . $nbr['n'] . ' Filières)</span>
          <span class="ligne-separation"></span>
          </div>';
          echo '<div class="grids">';
      
          foreach($row_filiere as $row_f) {
              ///////// Récupération du nombre d'inscriptions pour chaque filière //////////////////
              $nbr_candidat = $db->prepare('SELECT COUNT(id_ins) AS i FROM inscription WHERE id_filiere=:id_filiere');
              $nbr_candidat->bindparam(":id_filiere", $row_f["id_filiere"]);
              $nbr_candidat->execute();
              $candidat = $nbr_candidat->fetch();
      
              ///// ramplissage des tableaux ////////////
              $filieres[] = $row_f["nom_filiere"];
              $tab_nbr[] = $candidat["i"];
      
              /////// Affichage de chaque filiere /////////////////
              echo '<a href="inscription.filiere.php?id=' . $row_f["id_filiere"] . '"><div class="contenue"><button class="special_button">' . $row_f["nom_filiere"] . ':<strong>(' . $candidat["i"] . ') Candidats</strong></button></div></a>';
          }
      
          echo '</div>';
      
          // Afficher les graphiques côte à côte (Barres et Circulaire)
                echo '<div class="charts-container" style="display: flex; justify-content: space-evenly; width: 100%; margin: 0 auto; flex-wrap: wrap;">';

                // Graphique en barres
                echo '<div class="chart-container" style="flex: 1; min-width: 300px; height: 300px; margin-right: 20px;">';
                echo '<canvas id="chart_' . $row["nom_orientation"] . '"></canvas>'; // Créer un canvas pour le graphique en barres
                echo '</div>';

                // Graphique circulaire
                echo '<div class="chart-container" style="flex: 1; min-width: 300px; height: 300px; margin-left: 20px;">';
                echo '<canvas id="pie_chart_' . $row["nom_orientation"] . '"></canvas>'; // Créer un autre canvas pour le graphique circulaire
                echo '</div>';

                echo '</div>';
                        // Générer le graphique en barres pour ce département
                echo '<script>';
                echo 'var ctx = document.getElementById("chart_' . $row["nom_orientation"] . '").getContext("2d");';
                echo 'var chart = new Chart(ctx, {
                    type: "bar", // Type du graphique (barres)
                    data: {
                        labels: ' . json_encode($filieres) . ', // Labels (filières)
                        datasets: [{
                            label: "Nombre d\'inscriptions", // Légende
                            data: ' . json_encode($tab_nbr) . ', // Données (nombre d\'inscrits)
                            backgroundColor: "#f5f5f5",
                            borderColor: "rgba(54, 162, 235, 1)", // Garder la même couleur de bordure, mais plus visible
                            borderWidth: 3 // Augmenter la largeur de la bordure pour plus de visibilité
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                barThickness: 40 // Fixer une largeur uniforme pour les barres
                            }
                        }
                    }
                });';
                echo '</script>';

                // Générer le graphique circulaire (pie chart)
                echo '<script>';
                echo 'var ctxPie = document.getElementById("pie_chart_' . $row["nom_orientation"] . '").getContext("2d");';
                echo 'var pieChart = new Chart(ctxPie, {
                    type: "pie", // Changer le type de graphique en "pie"
                    data: {
                        labels: ' . json_encode($filieres) . ', // Labels (filières)
                        datasets: [{
                            label: "Nombre d\'inscriptions", // Légende
                            data: ' . json_encode($tab_nbr) . ', // Données (nombre d\'inscrits)
                            backgroundColor: [ // Couleurs pour chaque section du cercle
                                "rgba(255, 99, 132, 0.7)",
                                "rgba(54, 162, 235, 0.7)",
                                "rgba(255, 206, 86, 0.7)",
                                "rgba(75, 192, 192, 0.7)",
                                "rgba(153, 102, 255, 0.7)",
                                "rgba(255, 159, 64, 0.7)"
                            ],
                            borderColor: "rgba(255, 255, 255, 1)", // Couleur de bordure blanche
                            borderWidth: 2
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: "top" // Position de la légende
                            }
                        }
                    }
                });';
                echo '</script>';

      }
        ?>
        
    </div>
    
</body>

