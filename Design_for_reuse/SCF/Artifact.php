<?php


class Artifact
{
    
    private $collectionID;
    private $itemName;
    private $folderPosition;
    private $main_path;
    
    public function __construct($collectionID, $itemName , $folderpos, $main_path)
    {
        
        $this->collectionID = $collectionID;
        $this->itemName = $itemName;
        $this->folderPosition = $folderpos;
        $this->main_path = $main_path;
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
    
    public function getDownloadButton()
    {
        return "<a href='".$this->main_path.$this->collectionID."/".$this->itemName."' download='".$this->itemName."'>".
        "<input type='button' value='Download'/></a>";
    }
    
    public function getDeleteButton()
    {
         $myFile = $this->main_path.$this->collectionID."/".$this->itemName;
        
        
    if(isset($_POST['delete']))
    {
        unlink($myFile);
    }

        
      echo "<form method='post'>
        <input name='delete' type='submit' value='Delete Now!'>
        </form> ";
        
  
        
    }
    
    
    public function test()
    {
        
        
        if($_POST['deleteButton'])
        {
            unlink($this->main_path.$this->collectionID."/".$this->itemName);
            echo "Post, deleteButton.";
        }
        else
        {
            echo "INTE post, deleteButton";
        }
    }
    
}