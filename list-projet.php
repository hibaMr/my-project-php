<?php
session_start();
if(!isset($_SESSION['utilisateurs'])){
  header('location:signUp.php');
  exit;
}else{


require 'database.php';
$statment = $pdo->prepare('SELECT * FROM projets');
$statment->execute();
$projets = $statment->fetchAll(PDO::FETCH_ASSOC);
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
        <h1 class="text-center mb-3">List des Projets</h1>
        <?php if($_SESSION['utilisateurs']['role'] == 'chef_de_projet'): ?>
          <a href="ajouter-projet.php" class="btn btn-dark mb-3">ajouter projet</a>
        <?php endif; ?>

        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                <th scope="col">Titre</th>
                <th scope="col">Description</th>
                <th scope="col">Date debut</th>
                <th scope="col">Date fin</th>
                <th scope="col">Action </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($projets as $projet){ ?>
                    <tr>
                        <td><?php echo $projet['titre']; ?></td>
                        <td><?php echo $projet['descriprion']; ?></td>
                        <td><?php echo $projet['date_debut']; ?></td>
                        <td><?php echo $projet['date_fin']; ?></td>
                        <td><a class="btn btn-success" href="list-tache.php?id=<?php echo $projet['projet_id'];?>" name="id">afficher taches</a> <a class="btn btn-success" href="supprimer_projet.php?id=<?php echo $projet['projet_id'];?>" name="projet_id" onclick="return confirm('voler vous vraiment supprimer le lients ?')">Supprimer</a> <a class="btn btn-success" href="modifie_projet.php?id=<?php echo $projet['projet_id'];?>" name="projet_id">Modifie</a></td>
                    </tr>
                  <?php } ?>
            </tbody>
        </table>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

<?php } ?>