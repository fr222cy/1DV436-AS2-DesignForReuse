<?php
require_once("Create.php");
require_once("Read.php");
require_once("Update.php");
require_once("Delete.php");
class SCF
{
    private $create;
    private $read;
    //private $update;
    //private $remove;
    
    public function __construct()
    {
        $main_path = "collections/";
        $this->create = new Create($main_path); 
        $this->read = new Read($main_path); 
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
          $this->create->artifact(7028);
          echo "File Uploaded";
        }
    }
    
    public function searchCollection()
    {
        if(isset($_POST['searchCollection']))
        {
            if($this->read->isMatch())
            {
                echo "Success!";
            }
            else
            {
                echo "Folder not found.";
            }
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
    public function addSearchForm()
    {
        echo "<form action='".$this->searchCollection()."' method='post' enctype='multipart/form-data'>
                <input type='input' placeholder='Search Collection by ID' name='searchID' id='searchID'>
                <input type='submit' value='Search Collection' name='searchCollection' id='searchCollection'>
            </form>";
    }
    
    
    
    public function getFolders()
    { 
        return scandir("collections");
    }

    
    
    
    
    
    

    
    
    
}

