#!/bin/env php

<?php

$level = (int) $argv[2] ?? 3;

//ini_set('brotli.output_compression', 1);
ini_set('brotli.output_compression_level',  $level);

require_once 'Hzip.php';
/**
 * Compress using brotli library
 * 
* @return bool
* @param string $in
* @param string $out
 * @desc https://github.com/kjdev/php-ext-brotli
 */
function br($in, $out)
{
    if (!file_exists ($in) || !is_readable ($in)) {
        return false;
    }

    if ((!file_exists ($out) && !is_writeable (dirname ($out)) || (file_exists($out) && !is_writable($out)) )) {
        return false;
    }
    
    $in_file = fopen($in, 'rb');
    $out_file = fopen($out, 'wb');
    $streamContent = '';

    while (!feof ($in_file)) {
        $streamContent .= fgets($in_file, 4096);
    }
    
    fwrite ($out_file, brotli_compress((string) $streamContent), 4096);
    fclose($out_file);
    fclose($in_file);
   
    return true;
}

$level = (string) $level;
$size = $argv[1];
$srcFolder = 'batchs/'.$size;
$destFolder = 'results/'.$size;
$resultZip = $destFolder.'/php.'.$level.'.zip';
// exec
HZip::zipDir($srcFolder, $destFolder.'/php.'.$level.'.zip');

$compressedResult = $destFolder.'/php.'.$level.'.br';
br($resultZip, ($compressedResult));

?>