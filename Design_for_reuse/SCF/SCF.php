<?php
require_once("Create.php");
require_once("Read.php");
require_once("Update.php");
require_once("Delete.php");
class SCF
{
    private $create;
    private $read;
    private $searchInfo;
    //private $update;
    private $remove;
    private $main_path;
    
    public function __construct()
    {
        $this->main_path = "collections/";
        $this->create = new Create($this->main_path); 
        $this->read = new Read($this->main_path); 
        $this->searchInfo = [];
        //$this->update = new Update(); 
        $this->remove = new Delete(); 
        
    }
    // ADD needs to recieve an object.
    
    private function addFolder()
    {
        // If there is a folder.
        if(isset($_POST['createFolder']))
        {
            
            //if there is a session, we create a folder in the current folder.
            if(isset($_SESSION['searchID']))
            {
                $collectionID = $_SESSION['searchID'];
                $collectionID .= "/".substr(str_shuffle(MD5(microtime())), 0, 10);

                $lastCollectionID = $collectionID;
                
                header('Location: ?');
                
                $this->create->collection($collectionID);
                
                return;
            }
            
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
    
    private function addFile($collectionID)
    {
        if($_POST['fileToUpload'])
        {
            
            $_SESSION['fileToUpload'] = $_POST['fileToUpload'];
            
        }
        
        //If there is a file to upload
        if($collectionID != null && $_SESSION['fileToUpload'])
        {
            $this->create->artifact($collectionID);
        }
     
    }
    
    private function searchCollection()
    {
        if(isset($_POST['searchCollection']))
        {
            $this->stopFolderSession();
            
            if($this->read->isMatch())
            {
                $this->searchInfo = ["isMatch" => true, "searchID" => $_POST['searchID']];
            }
            else
            {
                echo "Folder not found.";
            }
        }
    }
    
    // Might not use sessions.
    public function startFolderSession($post)
    {    
        if(!isset($_SESSION['searchID']))
        {
            $_SESSION['searchID'] = $post;
        }
    }
    
    public function stopFolderSession()
    {
        unset($_SESSION['searchID']);
    }
    
    public function getSearchInfo()
    {
        if(isset($_POST['searchCollection']))
        {
            
            return $this->searchInfo; 
            
        }
        else if (isset($_SESSION['searchID']))
        {
 
           $this->searchInfo = ["isMatch" => true, "searchID" => $_SESSION['searchID']];
           
                
           return $this->searchInfo;
            
        }
        
        
        
    }
    
    public function updateCurrentFolder()
    {
        if(isset($_POST["goBack"]))
        {
            $_SESSION['searchID'] = iconv_substr($_SESSION['searchID'], 0, strlen($_SESSION['searchID']) - 11);
        }
        
        if (isset($_POST["filedelete"]))
        {
            $this->remove->item();
            header('Location:?');
        }
        
        if(isset($_POST["openFile"]))
        {
            $_SESSION['searchID'] .= "/" . $_GET['file'];
            header('Location:?');
        }
        
    }
    
    public function getFolderContent($collectionID)
    {
        if($this->getSearchInfo()['isMatch'] && $this->getSearchInfo()['searchID'] == $collectionID)
        {
            
            $itemArray = $this->read->getFolderContent($collectionID);
            if($itemArray != null)
            {
                return $itemArray;
            }
            else
            {
                return 0;
            }
        }
        else
        {
            return "Folder is Empty";
        }
    }
    
    public function getBackButton()
    {
        
         echo "<form method='post' enctype='multipart/form-data'>
                <input type='submit' value='<-' name='goBack' id='goBack'>
            </form>";
    }
    
    // Double check this. Back magically appears.
    public function isInChildFolder()
    {
        if(strpos($_SESSION['searchID'],"/"))
        {
            if(strlen($_SESSION['searchID']) <= 4){
                return false;
            }
            
            return true;
        }
        return false;
        
        
       
    }
    
    public function addFileForm($collectionID)
    {
        if($collectionID != null)
        {
            echo "<form action='".$this->addFile($collectionID)."' method='post' enctype='multipart/form-data'>
                <input type='file' name='fileToUpload' id='fileToUpload'>
                <input type='submit' value='Upload' name='fileToUpload'>
            </form>"; 
        }
        else {
            throw new Exception("addFile needs a collectionID");
        }
        
       
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

    public function startHTMLRender()
    {
        echo "<!DOCTYPE html>
                <html>
                    <body>";
    }
    
    public function stopHTMLRender()
    {
        echo "</body>
            </html>";
    }
    
    
    
    
    

    
    
    
}

