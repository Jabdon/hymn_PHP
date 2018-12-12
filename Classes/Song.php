<?php

//include 'Database.php';

class Song{
    
    private $DB;
    public $title;
    public $number;
    public $paragraphs = array();
    public $song_ID;


    function __construct($song_ID){

    
        $this->DB = Database::getConnection() ;

        try{
            $stmt = $this->DB->prepare("SELECT * FROM SONGS WHERE SONG_ID=:song_ID");
            $stmt -> bindParam(':song_ID', $song_ID);
            $stmt->execute();
            $title_Number = $stmt->fetch(PDO::FETCH_ASSOC);

        }
        catch (PDOException $e){
            return new Response(Status::$Fail ,'Something went wrong');
        }
        // assign title and number 
        $this->title = $title_Number['TITLE'];
        $this->number = $title_Number['NUM'];
        $this->song_ID = $title_Number['SONG_ID'];

        try{

            $stmt = $this->DB->prepare ("SELECT * FROM PARAGRAPHS WHERE SONG_ID=:song_ID");
            $stmt -> bindParam(':song_ID', $song_ID);
            $stmt->execute();
            $paragraphs_DB = $stmt->fetchAll();

            foreach( $paragraphs_DB as $row){
                $a = array($row['CONTENT'], $row['IS_HOOK']);
                array_push($this->paragraphs, $a);
                
            }

        }
        catch (PDOException $e){

        }
    }

    function isValid(){
        if($this->song_ID != null){
            return true ;
        }
        else{
            return false ;
        }
    }
}
?>