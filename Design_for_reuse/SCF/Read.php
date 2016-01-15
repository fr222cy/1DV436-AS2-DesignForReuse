<?php

require_once("Artifact.php");

class Read
{
    /*This class is used to download artifacts 
        and list collections */
        
    private $main_path;
    
    public function __construct($main_path)
    {
        $this->main_path = $main_path;
    }
    
    
    public function isMatch()
    {
        
        $folders = scandir("collections");
            
        foreach($folders as $folderName)    
        {
            if($_POST["searchID"] == $folderName)
            {
              //findDirectory; 
            }
        }
        
        return false;
    }
    
    //Returns all the files in the specificed folder(collectionID).
    public function getFolderContent($collectionID)
    {
        $folder = scandir($this->main_path.$collectionID);
        $contentArray = array();
        
        $folderPos = -2;
         
        foreach($folder as $itemName)    
        {
            
           
            
            $artifact = new Artifact($collectionID, $itemName, $folderPos, $this->main_path);
                
            array_push($contentArray, $artifact);
            $folderPos++;
        }
        
        //Slice to remove the two "empty files" from scandir.
        $contentArray = array_slice($contentArray, 2);
        
        // här gör vi html för knappar
        
        return $contentArray;
        
       
    }
    
    
    public static function findDirectory($dirPath) 
    {
        if (! is_dir($dirPath)) 
        {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
        {
            $dirPath .= '/';
        }
        $folders = glob($dirPath . '*', GLOB_MARK);
        
       

        foreach ($folders as $folder) 
        {
            if($dirPath.$_POST['searchID']."/" == $folder)
            {
                return true;
            }
            
            
            echo "FOLDER: ". $folder."<br>";
            $subFiles = scandir($folder);
            
            while($subFiles != null)
            {
                foreach ($subFiles as $subFile) 
                {
                    echo "Input Search: ".$folder.$_POST['searchID']."<br>";
                    echo "Server  Search: ". $folder.$subFile."<br>";
                    if($folder.$_POST['searchID'] == $folder.$subFile)
                    {
                        $_POST['searchID'] = substr($folder.$_POST['searchID'], strlen($dirPath . "/") - 1);
                        return true;
                    }
                    else
                    {
                    $path = realpath($dirPath.$_POST['searchID']."/");
                    foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path)) as $filename)
                    {
                            echo "$filename</br>";
                    }
                    }
                    
                } 
                break;
            }

           
        }
        
          
        
      return false;
    }
    
}