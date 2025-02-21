<?php
    include("database.php");
    if(isset($_POST["id_etd"], $_POST["id_filiere"])){
        $id_etd=$_POST["id_etd"];
        $id_filiere=$_POST["id_filiere"];
        $query = $db->prepare("DELETE FROM inscription WHERE id_etd=:id AND id_filiere=:id_filiere");
        $query ->bindparam(":id",$id_etd);
        $query ->bindparam(":id_filiere",$id_filiere);
        $query -> execute();
        header("location:affichage_filiere_admin.php");
    }
    else{
        echo "mawrkch 3la submit";
    }
?>