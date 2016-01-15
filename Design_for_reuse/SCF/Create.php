<?php

class Create
{
        /*This class is used to upload artifacts 
        and add collections */
    
    private $main_path;
    public function __construct($main_path)
    {
        $this->main_path = $main_path;
    }
    
    public function collection($path)
    {
        
        $pathName = $path;
        // Make Directory | 0777 by default, which means the widest possible access.
        mkdir($pathName,0777);
    }
    
    public function artifact($path)
    {
        if(isset($_SESSION['fileToUpload']))
        {
            $_POST['fileToUpload'] = $_SESSION['fileToUpload'];
        }
        
        
     
        
        $target_file = $path ."/". basename($_FILES["fileToUpload"]["name"]);
        
        
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
        {
            echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            unset($_SESSION['fileToUpload']);
        } else
        {
            echo "Sorry, there was an error uploading your file.";
      
        }
     
    }
    

  
}


