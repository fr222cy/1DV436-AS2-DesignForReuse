<?php
session_start();
require_once("Design_for_reuse/SCF/SCF.php");

var_dump(isset($_SESSION['searchID']));
var_dump($_SERVER['REQUEST_METHOD']==$_POST["collections/4919/12_4.jpg"]);
$api = new SCF();

$api->startHTMLRender();

    $api->addFolderForm();
    $api->addSearchForm();
   
    if($api->getSearchInfo()['isMatch'] || isset($_SESSION['searchID']))
    {
        echo "<b>You are in folder: </b>" . $api->getSearchInfo()['searchID'] . "<br>";
        
        $api->startFolderSession($_POST['searchID']); 
         

        $collectionID = $_SESSION['searchID']; 
        
        // Used to check if changes have happened in the current folder.
       
        $api->updateCurrentFolder($collectionID);
        
        $api->addFileForm($collectionID);
        
        $itemArray = $api->getFolderContent($collectionID);
        var_dump($itemArray);
        
        if($itemArray != 0)
        {
            foreach ($itemArray as $item) 
            {
                echo $item->Name();
                echo $item->getDownloadButton();
                echo $item->getDeleteButton();
               
            }  
        }
         
    
        
    }
    
    
$api->stopHTMLRender();







//var_dump($api->getFolders());