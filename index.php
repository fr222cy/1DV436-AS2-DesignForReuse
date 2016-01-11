<?php

require_once("Design_for_reuse/SCF/SCF.php");


$api = new SCF();

echo "<!DOCTYPE html>
<html>
<body>

        ".$api->addFileForm()."
        ".$api->addFolderForm()."
        
</body>
</html>";


var_dump($api->getFolders());