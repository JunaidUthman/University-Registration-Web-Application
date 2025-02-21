<?php
    $id_chef=$_GET["id"];
    include("database.php");
    $query = $db -> prepare('DELETE FROM chef_filiere WHERE id_chef=:id_chef');
    $query -> bindparam(":id_chef",$id_chef);
    $query -> execute();
    header("location:supprimer_chef_filiere.php");
?>