# cli-keygen
Command line tool to generate unique alphanumeric keys and write them to a csv file. Only uses easily distinguishable characters. Written in PHP. 

## usage
```Shell
$ php keygen.php quantity length [filename]
```

## example
![Keygen](https://raw.githubusercontent.com/eschmar/cli-keygen/master/example.jpg)

## append additional keys
Simply enter the amount of additional keys and target the same file. This process may take a while - it's always easier to generate enough keys instead of generating new ones later.

While generating 500'000 keys of length 16 took only 4 seconds, appending again 500'000 took 2387 seconds - that's almost 40 minutes!

For an independent correctness check i used Microsoft Excel's "remove duplicate values" function.

## license
MIT License
