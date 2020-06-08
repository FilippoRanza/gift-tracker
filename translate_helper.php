<?php 

function translate($map, $name, $destination) {
    $output = [];
    
    foreach($map as $k => $v) {
        echo "In file: $name\n";
        echo "Key: $k - Value: $v\n";
        $tranlation = readline("Translation for $k in $destination: ");
        $output[$k] = $tranlation;
    }
    $path = join(DIRECTORY_SEPARATOR, [$destination, $name]);
    $handle = fopen($path, 'w');
    fwrite($handle, "<?php\n\n\nreturn [\n");
    foreach($output as $k => $v) {
        fwrite($handle, "\t'$k' => '$v',\n");
    }
    fwrite($handle, "];\n");
    fclose($handle);
}

function run_translation($source, $destination) 
{
    $files = scandir($source);
    foreach($files as $file) {
        $ans = readline("Process file: $file?[y/N]");
        if($ans == 'y') {
            $path = join(DIRECTORY_SEPARATOR, [$source, $file]);
            $map = include $path;
            translate($map, $file, $destination);
        }
    }
}

if($argc == 3) {
    $from = join(DIRECTORY_SEPARATOR, ['resources/lang', $argv[1]]);
    $to = join(DIRECTORY_SEPARATOR, ['resources/lang', $argv[2]]);
    run_translation($from, $to);
} else {
    echo "$argv[0]: help you translate Laravel's translation maps\n";
    echo "run as\n";
    echo "$argv[0] <from-lang> <to-lang>\n";
}


