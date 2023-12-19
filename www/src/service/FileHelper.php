<?php

/**
 * [Description FileHelper]
 */
class FileHelper 
{
    
    /**
     * @param string $file_path
     * @param string $line
     * 
     * @return void
     */
    public static function addRowToFile (string $file_path, string $line): void
    {
        $myfile = fopen($file_path, "a") or die("Unable to open file!");
        $txt = $line . PHP_EOL;
        fwrite($myfile, $txt);
        fclose($myfile);
    }
}