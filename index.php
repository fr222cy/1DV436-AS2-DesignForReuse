<?php
session_start();
require_once("Design_for_reuse/SCF/SCF.php");
var_dump($_POST);
$api = new SCF();

$api->startHTMLRender();

    $api->addFolderForm();
    $api->addSearchForm();
    
    // Used to check if changes have happened in the current folder.
    $api->updateCurrentFolder();
    if($api->getSearchInfo()['isMatch'] || isset($_SESSION['searchID']))
    {
        echo "<b>You are in folder: </b>" . $api->getSearchInfo()['searchID'] . "<br>";
        
        $api->startFolderSession($_POST['searchID']); 
        

        $collectionID = $_SESSION['searchID']; 
        
       
       
        
        $api->addFileForm($collectionID);
        
        $itemArray = $api->getFolderContent($collectionID);
      
        
        if($itemArray != 0)
        {
            foreach ($itemArray as $item) 
            {
                echo $item->Name();
                
                echo $item->getActionButton();
                
                echo $item->getDeleteButton();
            }  
        }
    }
    
    
$api->stopHTMLRender();


//var_dump($api->getFolders());