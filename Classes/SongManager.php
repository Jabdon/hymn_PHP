<?php
include 'Response.php';
include 'Status.php';
include 'Song.php';

class SongManager{

    public $DB ;

    function __construct(){
        $this->DB = Database::getConnection() ;
    }


    function fetchSong($Song_ID){
        $newSong = new Song($Song_ID);
        if($newSong->song_ID){
            return new Response(Status::$Success , $newSong);
        }
        else{
            return new Response(Status::$Fail, "Song ID not found");
        }
    }


    function fetchAllSongs(){

        try{
            $stmt = $this->DB->prepare ("SELECT SONG_ID FROM SONGS ");
            $stmt->execute();
            $list_Of_Song_IDs = $stmt ->fetchAll();
        }
        catch (PDOException $e){

        }
        
        

    }


    function editSong($Song_ID, $title, $num){
        // might not need this after all
        if($this->songExists($Song_ID)){
            try{
                $stmt = $this->DB->prepare("UPDATE SONGS SET TITLE=:title, NUM=:num WHERE SONG_ID=:song_ID");
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':num', $num);
                $stmt->bindParam(':song_ID', $Song_ID);
                //execute
                $result = $stmt->execute();
            }
            catch(PDOException $e){
                return new Response(Status::$Fail ,'Something went wrong');
            }
    
            if($stmt->rowCount()){
                // return status success with song_ID
                $newSong = $this->fetchSong($Song_ID);
                return $newSong ;
            }
            else{
                return new Response(Status::$Fail ,'Something went wrong, Song not edited');
            }
        }
        else{
            return new Response(Status::$Fail ,'Song does not exist');
        }
        
    }

    /*
    - title
    - number 
    */
    function addSong($song_Title, $num ){
        try{
            $stmt = $this->DB->prepare("INSERT INTO SONGS (TITLE, NUM) VALUES (:song_Title, :num)");
            $stmt->bindParam(':song_Title', $song_Title);
            $stmt->bindParam(':num', $num);
            //execute
            $result = $stmt->execute();
        }
        catch(PDOException $e){
            return new Response(Status::$Fail ,'Something went wrong');
        }

        if($result){
            // return status success with song_ID
            $newSong = $this->fetchSong($this->DB->LastInsertId());
            return $newSong ;
        }
        else{
            // return status failuer with error message
            return new Response(Status::$Fail ,'Something went wrong');
        }

    }

    function addParagraph($song_ID, $content, $is_Hook){
        // will be great to double check if song_ID exist before inserting into Database
        if($this->songExists($song_ID)){
            try{
                $stmt = $this->DB->prepare("INSERT INTO PARAGRAPHS (CONTENT, IS_HOOK, SONG_ID) VALUES (:content, :is_Hook, :song_ID)");
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':is_Hook', $is_Hook);
                $stmt->bindParam(':song_ID', $song_ID);
                //execute
                $result = $stmt->execute();
            }
            catch(PDOException $e){
                return new Response(Status::$Fail ,'Something went wrong');
            }
    
            if($result){
                // return status success with song_ID
                $song = $this->fetchSong($song_ID);
                return $song;
            }
            else{
                // return status failuer with error message
                return new Response(Status::$Fail ,'Something went wrong');
            }
        } else{
            return new Response(Status::$Fail ,'Paragraph cannot be added because song does not exist');
        }
        
    }

    function editParagraph($song_ID, $paragraph_ID, $content, $is_Hook){
        // will be greate to double check if song_ID exist before inserting into Database
            try{
                $stmt = $this->DB->prepare("UPDATE PARAGRAPHS SET CONTENT=:content, IS_HOOK=:is_Hook WHERE PARAGRAPH_ID=:paragraph_ID AND SONG_ID=:song_ID ");
                $stmt->bindParam(':content', $content);
                $stmt->bindParam(':is_Hook', $is_Hook);
                $stmt -> bindParam(':song_ID', $song_ID);
                $stmt->bindParam(':paragraph_ID', $paragraph_ID);
                //execute
                $stmt->execute();
                

            }
            catch(PDOException $e){
                return new Response(Status::$Fail ,'Something went wrong');
            }
    
            if($stmt->rowCount()){
                // return status success with song_ID
                $song = $this->fetchSong($song_ID);
                return $song;
            }
            else{
                // return status failure with error message
                return new Response(Status::$Fail ,'Song or Para was not valid');
            }
    }

    function deleteParagraph($paragraph_ID){
        
        try{
            $stmt = $this->DB->prepare("DELETE FROM PARAGRAPHS WHERE colour = :paragraph_ID");
            $stmt->bindParam(':paragraph_ID', $paragraph_ID);
            //execute
            $result = $stmt->execute();
        }
        catch(PDOException $e){
            return new Response(Status::$Fail ,'Something went wrong');
        }

        if($result){
            return new Response(Status::$Success ,'Something went wrong');
        }
        else{
            return new Response(Status::$Fail ,'Something went wrong');
        }

    }

    function searchSong($song_Text){
        // add array that will contain songs
        $songsArray = array();
        $count = 'nothing';
        $searchText = '%'. $song_Text.'%' ;
        // text has be more than 2 words long

        if( strlen($song_Text) >= 2){
            try{
                $stmt = $this->DB->prepare(" SELECT * FROM SONGS WHERE TITLE LIKE :searchText ");
                $stmt->bindValue(':searchText', $searchText);
                //$stmt->bindValue(1, "%$song_Text%", PDO::PARAM_STR);
                //execute
                $stmt->execute();
                $result =$stmt->fetchAll() ;

                foreach($result as $row){
                    $newSong = new Song($row['SONG_ID']) ;
                    // check to see if song is valid
                    if($newSong->isValid()){
                        array_push($songsArray, $newSong);
                   }
                   $count = 'inside';
                }
            }

            catch(PDOException $e){
                return new Response(Status::$Fail ,'Something went wrong');
            }
            
            
            // send array in response
            return new Response(Status::$Success ,$songsArray);
            
        } else{
            return new Response(Status::$Fail ,'not enough chars');
        }
        
    }


    function songExists($song_ID){
        $song_Object = $this->fetchSong($song_ID);
        if($song_Object->Status == Status::$Success){
            return true ;
        }
        else{
            return false ;
        }
    }
}

?>