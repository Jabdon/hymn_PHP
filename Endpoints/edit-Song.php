<?php

include '../Classes/Database.php';
include '../Classes/SongManager.php';
include 'Response.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["song_ID"]) && isset($_POST["song_Title"]) && isset($_POST["num"])) {

    $song_ID = $_POST["song_ID"];
    $song_Title = $_POST["song_Title"];
    $num = $_POST["num"];
    $Manager = new SongManager();
    $song = $Manager->editSong($song_ID, $song_Title, $num );
    $result = json_encode($song);
    print_r($result) ;
}
else{
    // send out status 422 for missing params
    http_response_code(422);
    $result = json_encode(new Response(Status::$Fail, 'Missing Params'));
    print_r($result);


}