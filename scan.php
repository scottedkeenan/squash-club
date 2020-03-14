<?php 
    include 'config.php';
    
    // get the user id from python script
    $command = escapeshellcmd($pythonScriptName);
    $userName = shell_exec($command);
    echo $userName;
?>

