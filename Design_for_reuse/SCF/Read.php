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
               $folder = scandir($this->main_path.$folderName);
               
               foreach ($folder as $value) 
               {
                   echo $value;
               }
               
               return true; 
            }
        }
        
        return false;
    }
    
}