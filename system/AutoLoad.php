<?php
$baseDir = dirname(__DIR__);
$dir = new RecursiveDirectoryIterator($baseDir);
$iter = new RecursiveIteratorIterator($dir);
$files = new RegexIterator($iter, '/^.+\.php$/i', RecursiveRegexIterator::GET_MATCH);
foreach ($files as $file) {
    $file = $file[0];
    if ($file == __FILE__) {
        continue;
    }
    // bỏ qua file index.php
    if (strpos($file, 'index.php') !== false) {
        continue;
    }
    //bỏ qua thư mục [resources, public]
    if (strpos($file, 'resources') !== false || strpos($file, 'public') !== false) {
        continue;
    }
   // echo "> Loading: $file\n<br>";
    require_once $file;
}
