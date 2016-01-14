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
               return true; 
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
    
}