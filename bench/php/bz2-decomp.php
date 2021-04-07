#!/bin/env php

<?php 

require_once 'Hzip.php';

/**
* @return bool
* @param string $in
* @param string $out
* @desc uncompressing the file with the bzip2-extension
*/
function bunzip2 ($in, $out)
{
    if (!file_exists ($in) || !is_readable ($in))
        return false;
    if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) ))
        return false;

    $in_file = bzopen($in, "r") or die("Impossible d'ouvrir le fichier $in pour lecture");
    $out_file = fopen($out, "wb") or die("Impossible d'ouvrir le fichier $out pour lecture");

    while ($buffer = bzread($in_file, 4096)) {
        fwrite ($out_file, $buffer, 4096);
    }

    bzclose ($in_file);
    fclose ($out_file);
   
    return true;
}

// Name of the file we're compressing
$level = $argv[2] ?? 3;
$size = $argv[1];
$srcFolder = 'batchs/'.$size;
$destFolder = 'results/'.$size;
$resultZip = $destFolder.'/php.'.$level.'.zip';
$compressed = $destFolder.'/php.'.$level.'.bz2';

bunzip2($compressed, ($resultZip));

?>