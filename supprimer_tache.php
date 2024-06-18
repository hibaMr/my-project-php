<?php
$tache_id = $_GET['tache_id'];
require 'database.php';
$statment = $pdo->prepare('DELETE FROM taches WHERE tache_id = :tache_id');
$statment->execute([
    ':tache_id' => $tache_id
]);

header('location:list-tache.php');
