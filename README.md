# cli-keygen
Command line tool to generate unique alphanumeric keys and write them to a csv file. Only uses easily distinguishable characters. Written in PHP. 

## usage
```Shell
$ php keygen.php quantity length [filename]
```
Generating 2'000'000 keys of length 16 took 17 seconds on my laptop.

## example
![Keygen](https://raw.githubusercontent.com/eschmar/cli-keygen/master/example.jpg)

## append additional keys
Simply enter the amount of additional keys and target the same file. This process may take a while - it's always easier to generate enough keys than appending.
Generating 500'000 keys of length 16 and then appending the same amount took 4 seconds for the first part and 2387 seconds for the second part (~40 minutes).

For an independent correctness check i used Microsoft Excel's "remove duplicate values" function.

## license
MIT License
