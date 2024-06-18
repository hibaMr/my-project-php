<?php
$projet_id = $_GET['projet_id'];
require 'database.php';
$statment = $pdo->prepare('DELETE FROM projets WHERE projet_id = :projet_id');
$statment->execute([
    ':projet_id' => $projet_id
]);

header('location:list-projet.php');
