<?php
session_start();
if(!isset($_SESSION['utilisateurs'])){
  header('location:signUp.php');
  exit;
}else{

require 'database.php';
$projet_id = $_GET['id'];
$_SESSION['projet_id'] = $projet_id;
$statment = $pdo->prepare('SELECT * FROM taches WHERE projet_id = :projet_id');
$statment->execute([
  ':projet_id' => $projet_id
]);
$taches = $statment->fetchAll(PDO::FETCH_ASSOC);
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

    <?php require 'menu.php' ?>
    <div class="container">
        
    <h1 class="text-center mb-3">List des Taches</h1>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Satatut </th>
                <th scope="col">Date creation</th>
                <th scope="col">Date echeance</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($taches as $tache) :?>
                    <tr>
                        <td><?php echo $tache['titre'] ?></td>
                        <td><?php echo $tache['description'] ?></td>
                        <td><?php echo $tache['statut'] ?></td>
                        <td><?php echo $tache['date_creation'] ?></td>
                        <td><?php echo $tache['date_echeance'] ?></td>
                        <td><a class="btn btn-success" href="supprimer_tache.php?id=<?php echo $tache['tache_id'];?>" name="id">Supprimer</a> <a class="btn btn-success" href="modifie_tache.php?id=<?php echo $tache['tache_id'];?>" name="id">Modifie</a></td>
                    </tr>
                  <?php endforeach;?>
            </tbody>
        </table>
        <a href="ajouter-tache.php" class="btn btn-dark mb-3">ajouter tache</a>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<?php } ?>