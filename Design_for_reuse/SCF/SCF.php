<?php
require_once("Create.php");
require_once("Read.php");
require_once("Update.php");
require_once("Delete.php");
class SCF
{
    private $create;
    //private $read;
    //private $update;
    //private $remove;
    
    public function __construct()
    {
        $main_path = "collections/";
        $this->create = new Create($main_path); 
        //$this->read = new Read(); 
        //$this->update = new Update(); 
        //$this->remove = new Delete(); 
    }
    // ADD needs to recieve an object.
    
    public function addFolder()
    {
        //Else there is a folder.
        if(isset($_POST['createFolder']))
        {
            $collectionID = rand(0,10000);
            
            try
            {
                $files = $this->getFolders();
                
                foreach ($files as $fileName)
                {
                    if($fileName == $collectionID)
                    {
                      throw new Exception("FolderID Exist");
                    }
                }

                $this->create->collection($collectionID);
                echo "Folder Created, here is your ID: ".$collectionID. " (You will need it to access the folder)";

            }
            catch(Exception $e)
            {
                $this->addFolder();
            }
        }
    }
    
    public function addFile()
    {
        //If there is a file to upload
        if(isset($_POST['fileToUpload']))
        {
          $this->create->artifact(477);
          echo "File Uploaded";
        }
    }
    
    public function addFileForm()
    {
        echo "<form action='".$this->addFile()."' method='post' enctype='multipart/form-data'>
                <input type='file' name='fileToUpload' id='fileToUpload'>
                <input type='submit' value='Upload' name='fileToUpload'>
            </form>";
    }
    public function addFolderForm()
    {
        echo "<form action='".$this->addFolder()."' method='post' enctype='multipart/form-data'>
                <input type='submit' value='Create Folder' name='createFolder' id='createFolder'>
            </form>";
    }
    public function searchForm()
    {
        echo "<form action='".$this->addFolder()."' method='post' enctype='multipart/form-data'>
                <input type='submit' value='Create Folder' name='createFolder' id='createFolder'>
            </form>";
    }
    
    
    public function getFolders()
    { 
        return scandir("collections");
    }

    
    
    
    
    
    

    
    
    
}

