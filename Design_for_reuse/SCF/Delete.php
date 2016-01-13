<?php

class Delete
{
/*This class is used to remove artifacts from collections
and delete collections (if the collection contains other collections or artifacts, they are removed aswell). */
    public function __construct()
    {
    
    }
    
    public function artifact($myFile)
    {
         if(isset($_POST[$myFile]))
         {
             unlink($myFile); 
         }
    }
    



}