<?php
session_start();
require_once("Design_for_reuse/SCF/SCF.php");


$api = new SCF();

$api->startHTMLRender();

    $api->addFolderForm();
    $api->addSearchForm();
   
    if($api->getSearchInfo()['isMatch'])
    {
        echo "<b>You are in folder: </b>" . $api->getSearchInfo()['searchID'] . "<br>";
        
        
        $array =  $api->getFolderContent($api->getSearchInfo()['searchID']);
        
        
        // Used to show values in the array.
        print_r(array_values($array));
        
        $collectionID = $api->getSearchInfo()['searchID'];

        // Might not use sessions.
        //$api->startSession($api->getSearchInfo());

        $api->addFileForm($collectionID);

    }

$api->stopHTMLRender();







//var_dump($api->getFolders());