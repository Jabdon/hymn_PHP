<?php

include '../Classes/Database.php';
include '../Classes/SongManager.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = Database::getConnection() ;
//$db->connect ;
if ($db) {
    echo 'connected ok';

    $Manager = new SongManager();
    $song = $Manager->paragraphExists(8, 4);
    $resutl = json_encode($song);
    echo('answer is ');
    print_r($resutl);
    if($resutl !='false'){
      echo('oh yes please continue');
    }
    else{
      echo("nope stop");
    }
  } else {
    echo 'not connected';
  } 

  
  /*
     $dsn = 'mysql:host=localhost;dbname=hymn' ;
     $user = 'root' ;
     $password = 'Morisset1' ;
    $connection ;

    try {
      if (is_null($connection) || empty($connection)) {
          $connection = new PDO($dsn, $user, $password);
      }
  } catch (Exception $e) {
      $connection = $e;
      echo $e ;
  }

  if ($connection) {
    echo 'connected';
  } else {
    echo 'not connected';
  } */
?>