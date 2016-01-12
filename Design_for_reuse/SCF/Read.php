<?php



class Read
{
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
    
    public function getFolderContent($collectionID)
    {
        $folder = scandir($this->main_path.$collectionID);
        $contentArray = array();
         
         
        foreach($folder as $item)    
        {
           array_push($contentArray, $item);
        }
        
        return $contentArray;
    }
    
}