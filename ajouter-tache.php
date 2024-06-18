<?php
session_start();
if(!isset($_SESSION['utilisateurs'])){
  header('location:signUp.php');
  exit;
}else{
    

require 'database.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $statut = $_POST['statut'];
    $date_creation = $_POST['date_creation'];
    $date_echeance = $_POST['date_echeance'];
    if(!empty($titre) && !empty($description)){
        
        $statment = $pdo->prepare('INSERT INTO taches (projet_id,utilisateur_id,titre,description,statut,date_creation,date_echeance) VALUES (:projet_id,:utilisateur_id,:titre,:description,:statut,:date_creation,:date_echeance)');
        $statment->execute([
            ':utilisateur_id' => $_SESSION['utilisateurs']['utilisateur_id'],
            ':projet_id' => $_SESSION['projet_id'],
            ':titre' => $titre,
            ':description' => $description,
            ':statut' => $statut,
            ':date_creation' => $date_creation,
            ':date_echeance' => $date_echeance
        ]);
        header('location:list-projet.php');

    }else{
        ?>
        <div class="alert alert-danger" role="alert">champs obligatiore</div>
        <?php
    }
}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ajouter</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#00ff5573;">
        Gestion du projets
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Ajouter</h3>
            <p class="text-muted">Remplissez le formulaire ci-dessous pour ajouter un nouvel projet</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label for="titre" class="form-label">Titre :</label>
                        <input type="text" class="form-control" name="titre" placeholder="titre">
                    </div>

                    <div class="col">
                        <label for="description" class="form-label">Description :</label>
                        <input type="text" class="form-control" name="description" placeholder="description">
                    </div>

                </div>
                <div class="col">
                    <label for="statut" class="form-label">Statut :</label>
                    <input type="text" class="form-control" name="statut" placeholder="statut">
                </div>
                <div class="mb-3">
                    <label for="date_creation" class="form-label">Date Creation :</label>
                    <input type="date" class="form-control" name="date_creation">
                </div>
                <div class="mb-3">
                    <label for="date_echeance" class="form-label">Date Echeance :</label>
                    <input type="date" class="form-control" name="date_echeance">
                </div>

                <div>
                    <button class="btn btn-success" type="submit" name="submit">Ajouter</button>
                    <a href="traitment/cancel.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<?php } ?>