<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
    if(isset($_POST["submit"])){
        include("data_base.php");
        if($_POST["password"] == $_POST["v_password"]){
            $fullname = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $hashed_password=password_hash($password , PASSWORD_BCRYPT);

            $CheckIfExisted= $db -> prepare('SELECT * FROM etudiant WHERE email=:email');
            $CheckIfExisted ->bindparam(":email",$email);

            if($CheckIfExisted -> execute()){
                $rows = $CheckIfExisted->fetch();
                if(!empty($rows)){
                    echo "ce email est deja utilisé!";
                }
                else{
                    $code=rand(1000,2000);
                    $query = $db -> prepare('INSERT INTO etudiant(email,password,fullname,verified,code_verification) VALUES(:email,:password,:fullname,0,:code)');
                    $query ->bindparam(":fullname",$fullname);
                    $query ->bindparam(":email",$email);
                    $_SESSION["email_verified"]=$email;
                    $query ->bindparam(":password",$hashed_password);
                    $query ->bindparam(":code",$code);
                    $query ->execute();
                    
                        //echo "the query is executed";

                        //send an email to the use
                        require 'vendor/autoload.php';
                        $mail = new PHPMailer(true);

                        try {
                             
                            $mail->isSMTP();                                            
                            $mail->Host       = 'smtp.gmail.com';                     
                            $mail->SMTPAuth   = true;                                   
                            $mail->Username   = 'uthmanjunaid400@gmail.com';                     
                            $mail->Password   = 'tbqu jeay ujhi mhve';                               
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
                            $mail->Port       = 465;


                            $mail->setFrom('uthmanjunaid400@gmail.com', 'junaid uthman');
                            $mail->addAddress($email, 'junaid');
                            $mail->addReplyTo('uthmanjunaid400@gmail.com', 'junaid uthman');

                            $mail->isHTML(true); 
                            $mail->Subject = 'Code de verification pour votre compte';
                            $mail->Body    = 'Bonjour '.$fullname.',<br><br>Nous vous envoyons ce message pour valider votre adresse email. Veuillez trouver ci-dessous votre code de vérification :<br><br><strong>Code : '.$code.'</strong><br><br>Merci de l\'entrer sur la page de vérification pour terminer votre processus d\'inscription.<br><br>Cordialement,<br>L\'équipe de FST TANGER.';
                            $mail->AltBody = 'Bonjour, nous vous envoyons ce message pour valider votre adresse email. Voici votre code de vérification : '.$code.'. Merci de l\'entrer pour terminer votre inscription. Cordialement, l\'équipe de FST TANGER.';


                            $mail->send();
                            echo 'Message has been sent';
                        } catch (Exception $e) {
                            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                        }
                        $query = $db -> prepare('SELECT * FROM etudiant WHERE email=:email');
                        $query -> bindparam(":email",$email);
                        $query -> execute();
                        $row = $query -> fetch();
                        if($row){
                            $_SESSION["id"]=$row["id"];
                        }
                        header("location: demande_de_check.php");
                    
                    
                }
            }
        }
        else{
            echo "les deux mot de passes sont pas compatible ";
        }   
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin_etape1.css">
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
                <h1>Créez Votre Compte</h1>
            </div>
            <div class="form_container">
                <form action="signin_etape1.php" method="post">
                    <div class="info">
                        <div class="fullname">
                            <label class="text_fullname">Nom&Prénom</label>
                            <input type="text" name="fullname" placeholder="Nom Prénom" required class="input_fullname"><br>
                        </div>
                        <div class="email">
                            <label class="text_email">Email</label>
                            <input type="email" name="email" placeholder="Email &#128231;" required class="input_email"><br>
                        </div>
                        <div class="password1">
                            <label class="text_password1">Mot de Passe</label>
                            <input type="password" name="password" placeholder="mot de passe &#128273;" required class="input_password1"><br>
                        </div>
                        <div class="password2">
                            <label class="text_password2">Confirmez le Mot de Passe</label>
                            <input type="password" name="v_password" placeholder="mot de passe &#128273;" required class="input_password2"><br>
                        </div>
                        <input type="submit" name="submit" value="S'inscrire" class="envoyer">
                        
                    </div>
                </form>
            </div>
            <a href="login.php" class="lien_login">aller à la page d'identification</a>
        </div>
    </div>
    
</body>
