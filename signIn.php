<?php
session_start();
require 'database.php';
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    if(!empty($email) && !empty($mot_de_passe)){
        $statment = $pdo->prepare('SELECT * FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe');
        $statment->execute([
            ':email' => $email,
            ':mot_de_passe' =>$mot_de_passe
        ]);
        $utilisateurs = $statment->fetch(PDO::FETCH_ASSOC);
        if($utilisateurs){
            $_SESSION['utilisateurs'] = $utilisateurs;
            header('location:list-projet.php');
        }else{
        ?>
        <div class="alert alert-danger" role="alert">champs obligatiore</div>
        <?php
    }
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
    <title>Sign In</title>
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
            height: 480px;
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
            height: 485px;
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
        input{
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
    <form action="" method="POST" class="container">
        <div class="box">
            <div class="header">
                <p>Log In to Ludiflex</p>
            </div>
            
            <div class="input-box">
                <label for="email">Email</label>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#939393" d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z"/></svg>
                <input type="email" class="input-field" name="email" id="email">
            </div>

            <div class="input-box">
                <label for="mot_de_passe">mot de passe</label>
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.--><path fill="#919191" d="M144 144v48H304V144c0-44.2-35.8-80-80-80s-80 35.8-80 80zM80 192V144C80 64.5 144.5 0 224 0s144 64.5 144 144v48h16c35.3 0 64 28.7 64 64V448c0 35.3-28.7 64-64 64H64c-35.3 0-64-28.7-64-64V256c0-35.3 28.7-64 64-64H80z"/></svg>
                <input type="password" class="input-field" name="mot_de_passe" id="mot_de_passe">
            </div>

            <div class="input-box">
                <input type="submit" class="input-submit" value="SIGN IN">
            </div>

            <div class="bottom">
                <a href="signUp.php">Sign Up</a>
            </div>
        </div>
        <div class="wrapper">

        </div>
        
    </form>
        
    
</body>
</html>