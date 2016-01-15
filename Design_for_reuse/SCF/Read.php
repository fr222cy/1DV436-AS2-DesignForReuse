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
    
    
    // public function isMatch()
    // {
        
    //     $folders = scandir("collections");
            
    //     foreach($folders as $folderName)    
    //     {
    //         if($_POST["searchID"] == $folderName)
    //         {
    //           //findDirectory; 
    //         }
    //     }
        
    //     return false;
    // }
    
    //Returns all the files in the specificed folder(collectionID).
    public function getFolderContent($collectionID)
    {
        $path = $this->findDirectory($collectionID);
        if ($path == null)
            throw new Exception("No such collection");
        $folder = scandir($path);
        $contentArray = array();
        
        $folderPos = -2;
        
        foreach($folder as $itemName)    
        {
            
           
            
            $artifact = new Artifact($collectionID, $itemName, $folderPos, $path);
                
            array_push($contentArray, $artifact);
            $folderPos++;
        }
        
        //Slice to remove the two "empty files" from scandir.
        $contentArray = array_slice($contentArray, 2);
        
        // här gör vi html för knappar
        
        return $contentArray;
        
       
    }
    
    
    
    public function findDirectory($id, $folder = null)
    {
        if ($folder == null)
            $folder = $this->main_path;
       
        $content = scandir($folder);
        
        for ($i = 2; $i<count($content); $i++)
        {
            $subfolder = $content[$i];
            if (basename($subfolder) == $id)
            {
                return $folder.$subfolder;
            }
            else
            {
                if (is_dir($folder.$subfolder))
                {
                    $result = $this->findDirectory($id, $folder.$subfolder."/");
                    if ($result != null)
                        return $result;
                }
            }
        }
        
        return null;
    }
    
}