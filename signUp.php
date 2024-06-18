<?php
session_start();
require 'database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['signUp']){
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $role = $_POST['role'];
    if(!empty($nom) && !empty($prenom) && !empty($email) && !empty($mot_de_passe)){
        $statment = $pdo->prepare('INSERT INTO utilisateurs(nom,prenom,email,mot_de_passe,role) VALUES(:nom,:prenom,:email,:mot_de_passe,:role)');
        $statment->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':mot_de_passe' => $mot_de_passe,
            ':role' => $role
        ]);
        header('location:signIn.php');
    }else{
        ?>
        <div class="alert alert-danger" role="alert">champs obligatiore</div>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style/bootstrap.min.css">
    <style>
        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: 700;
        }
        body{
            background: #e4e9f7;
            background-size: cover;
        }
        .header{
            margin-bottom: 20px;
        }
        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            position: relative;
        }
        .box{
            width: 450px;
            height: 650px;
            background: #fff;
            backdrop-filter: blur(20px);
            border-radius: 30px;
            padding: 40px;
            box-shadow: 2px 2px 15px 2px rgba(0,0,0,0.1),-2px -0px 15px rgba(0,0,0,0.1);
            z-index: 10;

        }
        .wrapper{
            position: absolute;
            width: 455px;
            height: 655px;
            border-radius: 30px;
            background: rgba(255,255,255,0.53);
            box-shadow: 2px 2px 15px 2px rgba(0,0,0,0.115),-2px -0px 15px rgba(0,0,0,0.054);
            transform: rotate(5deg);
        }

        .header p{
            font-size: 25px;
            font-weight: 800;
            margin-top: 10px;
        }

        .input-box{
            display: flex;
            flex-direction: column;
            margin: 10px 0;
            position: relative;
        }

        svg{
            width: 12px;
            font-size: 22px;
            position: absolute;
            top: 35px;
            right: 12px;
            color: #595b5e;
        }
        input , select{
            height: 40px;
            border: 2px solid rgb(153,157,158);
            border-radius: 7px;
            margin: 5px 0;
            outline: none;
        }
        .input-field{
            font-weight: 500;
            padding: 0 10px;
            font-size: 17px;
            color: #333;
            background: transparent;
            transition: all .3s ease-in-out;
        }
        .input-field:focus{
            border: 2px solid rgb(89,53,180);
        }

        .input-submit{
            background: #1e263a;
            border: none;
            color: #fff;
            cursor: pointer;
            transition: add .3s ease-in-out;
        }
        .input-submit:hover{
            background: #122b71;
        }
        .bottom{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            margin-top: 25px;
        }
        .bottom a{
            color: #727374;
            text-decoration: none;
        }
        .bottom a:hover{
            text-decoration: underline;
        }
        .message{
            color:red;
        }

    </style>
</head>
<body>
    <form action="" method="POST" class="container mb-3">
        <div class="box">
            <div class="header">
                <p>Log Up to Ludiflex</p>
            </div>
            
            <div class="input-box">
                <label for="nom">Nom :</label>
                <input type="text" class="input-field" name="nom" id="nom">
            </div>
            
            <div class="input-box">
                <label for="prenom">Prenom :</label>
                <input type="text" class="input-field" name="prenom" id="prenom">
            </div>
            
            <div class="input-box">
                <label for="role">Role :</label>
                <select name="role" id="role" class="input-field" >
                    <option value="utilisateur" >utilisateur</option>
                    <option value="chef_de_projet" >chef de projet</option>
                </select>
            </div>
            
            <div class="input-box">
                <label for="email">Email :</label>
                <input type="email" class="input-field" name="email" id="email">
            </div>

            <div class="input-box">
                <label for="mot_de_passe">mot de passe :</label>
                <input type="password" class="input-field" name="mot_de_passe" id="mot_de_passe">
            </div>

            <div class="input-box">
                <input type="submit" class="input-submit" value="SIGN Up" name="signUp">
            </div>

            <div class="bottom">
                <a href="signIn.php">Sign In</a>
            </div>
        </div>
        <div class="wrapper">

        </div>
        
    </form>
        
    
</body>
</html>