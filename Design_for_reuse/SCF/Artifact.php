<?php


class Artifact
{
    
    private $collectionID;
    private $itemName;
    private $folderPosition;
   
    private $filePath;
    
    public function __construct($collectionID, $itemName , $folderpos, $main_path)
    {
        
        $this->collectionID = $collectionID;
        $this->itemName = $itemName;
        $this->folderPosition = $folderpos;
        $this->filePath = $main_path.$collectionID."/".$itemName;
    }
    
    
    public function Name()
    {
        return $this->itemName;
    }
    
    public function CollectionID()
    {
        return $this->collectionID;
    }
    
    public function FolderPosition()
    {
        return $this->folderPosition;
    }
    
    public function getActionButton()
    {
        if(strpos($this->itemName, ".") == true)
        {
            return "<a href='".$this->filePath."' download='".$this->itemName."'>".
            "<input type='button' value='Download'/></a>";  
        }
        else 
        {
            return "<form method='post' action='?file=".$this->itemName."'>
             <input 
              name='openFile' type='submit' value='Open'>
            </form> ";
            
        }
       
    }
    
    public function getDeleteButton()
    {
        
     
        
        
        
      
        return "<form method='post' action='?file=".$this->filePath."'>
         <input 
          name='filedelete' type='submit' value='Delete Now!'>
        </form> ";
        
    
    
    }
    
}