#!/bin/env php

<?php 

require_once 'Hzip.php';

// Name of the file we're compressing
$level = $argv[2] ?? 3;
$size = $argv[1];
$srcFolder = 'batchs/'.$size;
$destFolder = 'results/'.$size;
$resultZip = $destFolder.'/php.'.$level.'.zip';

HZip::zipDir($srcFolder, $destFolder.'/php.'.$level.'.zip');
// Name of the gz file we're creating
$compressedResult = $destFolder.'/php.'.$level.'.gz';
// Open the gz file (w9 is the highest compression)
$fp = gzopen($compressedResult, 'w'.$level);
// Compress the file
gzwrite ($fp, file_get_contents($resultZip));
// Close the gz file and we're done
gzclose($fp);

?>