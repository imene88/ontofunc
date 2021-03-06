<?php

$id = (int)$_GET['id'];
$type = $_GET['type'];

$dir  = "/mnt/ontofunc/dataout/$id/" ;
$statistics = $dir . "statistics.txt";
$groups = $dir . "groups.txt";

$filename = "" ;
if (strcmp($type, "stat") == 0) {
  $filename = $statistics ;
} else if (strcmp($type, "group") == 0) {
  $filename = $groups ;
} else {
  $filename = "" ;
}

if(file_exists($filename))
  {    
    header("Pragma: public");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("Cache-Control: private", false);
    
    //sending download file
    if (strcmp($type, "group") == 0) {
      header("Content-Type: text/csv");
    } else {
      header("Content-Type: text/plain");
    }
    header("Content-Disposition: attachment; filename=\"$id-" . basename($filename) . "\""); //ok
    header("Content-Transfer-Encoding: binary");
    header("Content-Length: " . filesize($filename)); //ok
    readfile($filename);
  }

?>