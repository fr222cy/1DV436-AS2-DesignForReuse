<?php
require_once("Collection.php");
class Create
{
    private $main_path;
    public function __construct($main_path)
    {
        $this->main_path = $main_path;
    }
    
    public function collection($collectionID)
    {
        //TODO: CHECK IF COLLECTIONID EXISTS
        $pathName = $this->main_path.$collectionID;
        // Make Directory | 0777 by default, which means the widest possible access.
        mkdir($pathName,0777);
    }
    
    public function artifact($collectionID)
    {
        $target_dir = $this->main_path.$collectionID;
        echo $target_dir;
        $target_file = $target_dir ."/". basename($_FILES["fileToUpload"]["name"]);
        echo $target_file;
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        } else
        {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    

  
}


