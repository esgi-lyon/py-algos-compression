#!/bin/env php

<?php 

require_once 'Hzip.php';

// Name of the file we're compressing
$level = $argv[2] ?? 3;
$size = $argv[1];
$srcFolder = 'batchs/'.$size;
$destFolder = 'results/'.$size;
$resultZip = $destFolder.'/php'.$level.'.zip';
$fileName = $destFolder.'/php'.$level.'.gz';

// Name of the zip file we're rendering
$uncompressedResult = $destFolder.'/php'.$level.'.zip';

// Open our files (in binary mode)
$file = gzopen($fileName, 'rb');
$out_file = fopen($uncompressedResult, 'wb'); 

// Keep repeating until the end of the input file
while (!gzeof($file)) {
    // Read buffer-size bytes
    // Both fwrite and gzread and binary-safe
    fwrite($out_file, gzread($file, 4096));
}

// Files are done, close files
fclose($out_file);
gzclose($file);

?>