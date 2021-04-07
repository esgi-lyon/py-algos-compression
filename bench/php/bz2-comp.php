#!/bin/env php

<?php 

require_once 'Hzip.php';

/**
* @return bool
* @param string $in
* @param string $out
* @desc compressing the file with the bzip2-extension
*/
function bzip2 ($in, $out)
{
    if (!file_exists ($in) || !is_readable ($in))
        return false;
    if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
        return false;
   
    $in_file = fopen ($in, "rb") or die("Impossible d'ouvrir le fichier $in pour lecture");
    $out_file = bzopen ($out, "w") or die("Impossible d'ouvrir le fichier $out pour lecture");
   
    while (!feof ($in_file)) {
        $buffer = fgets ($in_file, 4096);
        bzwrite ($out_file, $buffer, 4096);
    }

    fclose ($in_file);
    bzclose ($out_file);
   
    return true;
}

// Name of the file we're compressing
$level = $argv[2] ?? 3;
$size = $argv[1];
$srcFolder = 'batchs/'.$size;
$destFolder = 'results/'.$size;
$resultZip = $destFolder.'/php.'.$level.'.zip';
 // exec
HZip::zipDir($srcFolder, $destFolder.'/php.'.$level.'.zip');

$compressedResult = $destFolder.'/php.'.$level.'.bz2';

bzip2($resultZip, ($compressedResult));

?>