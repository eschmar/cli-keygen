<?php

    /**
     * keygen.php v1
     * @author Marcel Eschmann, https://github.com/eschmar/cli-keygen
     * @license MIT license
     *
     * @description
     *
     * This script generates `$quantity` unique alphanumeric keys of length
     * `$length` and writes them to a csv file. If you need to append additional
     * keys, simply enter the amount of additional keys and target the same file.
     * Appending additional keys may take some time.
     *
     * @usage
     * 
     * php keygen.php $quantity $length [$filename]
     */

    echo "\033[0;33m  _  __                       \n";
    echo "\033[0;33m | |/ /___ _  _ __ _ ___ _ _  \n";
    echo "\033[0;33m | ' </ -_) || / _` / -_) ' \ \n";
    echo "\033[0;33m |_|\_\___|\_, \__, \___|_||_|\n";
    echo "\033[0;33m           |__/|___/          \n\n";

    // minimal user input validation
    if (!$argv[1] || !$argv[2] || !preg_match('/^\d+$/', $argv[1]) || intval($argv[1]) < 1 || !preg_match('/^\d+$/', $argv[2]) || intval($argv[2]) < 1) {
        echo " \033[1;31mInvalid input.\n";
        echo " \033[0;0musage: php {$argv[0]} [\033[1;30mint \033[36mquantity \033[1;30mint \033[36mlength \033[1;30mstring \033[36mfilename\033[0m]\n";
        return;
    }

    // you may need to increase the memory_limit for large quantities
    ini_set("memory_limit","512M");

    // config
    $chars = 'abcdefghjkmnpqrstuvwxyABCDEFGHJKLMNPQRSTUVWYX2345678';
    $quantity = intval($argv[1]);
    $length = intval($argv[2]);
    $filename = isset($argv[3]) ? $argv[3] : 'keys.csv';

    // init
    $start = time();
    $codes = array();

    if (!is_file($filename)) { touch($filename); }
    $validation = file_get_contents($filename);

    echo " \033[0;0mGenerating \033[36m$quantity\033[0;0m unique alphanumeric keys of length \033[36m$length\033[0;0m...\n\n";

    // generate `$quantity` keys
    for ($i=0; $i < $quantity; $i++) { 
        $code = generateCode($length, $chars);
        if (strpos($validation, $code) === false) { $codes[] = $code; }
    }

    // remove duplicates
    $codes = array_unique($codes);

    // fill up and recheck until `$quantity` unique keys are available
    while (count($codes) < $quantity)
    {
        for ($i=0; $i < ($quantity - count($codes)); $i++) { 
            $code = generateCode($length, $chars);
            if (strpos($validation, $code) === false) { $codes[] = $code; }
        }

        // remove duplicates
        $codes = array_unique($codes);
    }

    // write to csv
    $handle = fopen($filename, 'a+');
    if ($validation != '') { fwrite($handle, "\n"); }
    fwrite($handle, implode("\n", $codes));

    // console feedback
    $end = time();
    $elapsed = $end-$start;
    echo " ...done in \033[36m$elapsed\033[0;0m seconds.\n";

    // returns a single key
    function generateCode($length, $abc = 'abcdefghjkmnpqrstuvwxyABCDEFGHJKLMNPQRSTUVWYX2345678') 
    {
        for ($code = '', $cl = strlen($abc)-1, $i = 0; $i < $length; $code .= $abc[mt_rand(0, $cl)], ++$i);
        return $code;
    }

?>