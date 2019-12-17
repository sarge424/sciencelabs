<?php
$file = fopen("testFile.txt", "r") or exit("Unable to open file!");
//Output a line of the file until the end is reached
while(!feof($file))
{

    $line = fgets($file, 1024); 
    if(strtolower(trim($line)) == "note"){
    	break;
    }
    echo $line ."<br>";

}
fclose($file); 