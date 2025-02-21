<?php
    $user='root';
    $pass='';
    try{
        $db=new PDO('mysql:host=localhost;dbname=platforme_version_adminv2',$user,$pass); 
    }

    catch(PDOException $e){
        print "erreur :".$e->getMessage()."<br/>";
        die;
    }
    if($db){
        //echo "ur connected";
    }
?>
