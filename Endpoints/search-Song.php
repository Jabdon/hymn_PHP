<?php

include '../Classes/Database.php';
include '../Classes/SongManager.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["text_Song"])){

    $text_Song = $_POST["text_Song"];
    $Manager = new SongManager();
    $song = $Manager->searchSong($text_Song);
    $result = json_encode($song);
    print_r($result) ;
}
else{
    // send out status 422 for missing params
      // send out status 422 for missing params
      http_response_code(422);
      $result = json_encode(new Response(Status::$Fail, 'Missing Params'));
      print_r($result);

}


    




?>