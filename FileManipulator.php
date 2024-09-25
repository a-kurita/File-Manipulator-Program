<?php
require 'vendor/autoload.php';

function reverese(string $input, string $output) {
    $file = fopen($input, 'r');
    $contents = fread($file, filesize($input));
    fclose($file);

    $reverse = strrev($contents);

    $file = fopen($output, 'w');
    fwrite($file, $reverse);
    fclose($file);
}

function copyText(string $input, string $output) {
    $file = fopen($input, 'r');
    $contents = fread($file, filesize($input));
    fclose($file);
    
    $file = fopen($output, 'w');
    fwrite($file, $contents);
    fclose($file);
}

function duplicateContents(string $input, int $n) {
    $file = fopen($input, 'r');
    $contents = fread($file, filesize($input));
    fclose($file);

    $duplicaText = PHP_EOL;
    for($i = 0; $i < $n-1; $i++){
        $duplicaText = $duplicaText . $contents . PHP_EOL; 
    }

    $file = fopen($input, 'a');
    fwrite($file, $duplicaText);
    fclose($file);
}

function replaceString(string $input, string $old, string $new) {
    $file = fopen($input, 'r');
    $contents = fread($file, filesize($input));
    fclose($file);

    $replaceText = str_replace($old, $new, $contents);

    $file = fopen($input, 'w');
    fwrite($file, $replaceText);
    fclose($file);
}

function markdown(string $input, string $output){
    $file = fopen($input, 'r');
    $markdownContent = fread($file, filesize($input));
    fclose($file);

    $parsedown = new Parsedown();
    $htmlContent = $parsedown->text($markdownContent);

    $file = fopen($output, 'w');
    fwrite($file, $htmlContent);
    fclose($file);

}

if($argc <= 3){
    echo "引数が足りません";
    return;
}

$inputText = file_get_contents($argv[2]);
if($argv[1] == "reverse"){
    reverese($argv[2], $argv[3]);
}else if($argv[1] == "copy"){
    copyText($argv[2], $argv[3]);
}else if($argv[1] == "duplicate-contents"){
    duplicateContents($argv[2], $argv[3]);
}else if($argv[1] == "markdown"){
    markdown($argv[2], $argv[3]);
}else if($argv[1] == "replace-string"){
    if($argc !== 5){
        echo "引数が足りません";
    }else {
    replaceString($argv[2], $argv[3], $argv[4]);
    }
}else {
    echo "ERROR";
}

?>