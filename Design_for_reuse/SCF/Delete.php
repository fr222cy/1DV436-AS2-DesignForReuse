<?php

class Delete
{
/*This class is used to remove artifacts from collections
and delete collections (if the collection contains other collections or artifacts, they are removed aswell). */

    
    public function item()
    {
        if(strpos($_GET["file"], ".") == true) 
        {
            unlink($_GET["file"]);
        }
        else 
        {
            $this->deleteDir($_GET["file"]);
        }
    }
    
    // Found this solution here: http://stackoverflow.com/questions/3349753/delete-directory-with-files-in-it
    public static function deleteDir($dirPath) 
    {
        if (! is_dir($dirPath)) 
        {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') 
        {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        
        var_dump($files);
        foreach ($files as $file) 
        {
            if (is_dir($file)) 
            {
                self::deleteDir($file);
            } 
            else 
            {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }
}