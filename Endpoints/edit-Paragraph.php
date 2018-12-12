<?php

include '../Classes/Database.php';
include '../Classes/SongManager.php';
include 'Response.php';

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(isset($_POST["song_ID"]) && isset($_POST["paragraph_ID"]) && isset($_POST["content"]) && isset($_POST["is_Hook"])) {

    $song_ID = $_POST["song_ID"];
    $paragraph_ID = $_POST["paragraph_ID"];
    $content = $_POST["content"];
    $is_Hook = $_POST["is_Hook"];
    $Manager = new SongManager();
    $song = $Manager->editParagraph($song_ID, $paragraph_ID, $content, $is_Hook);
    $result = json_encode($song);
    print_r($result) ;
}
else{
    // send out status 422 for missing params
    http_response_code(422);
    $result = json_encode(new Response(Status::$Fail, 'Missing Params'));
    print_r($result);


}
?>