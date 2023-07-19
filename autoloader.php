<?php
$dirs = array('core', 'lib');
foreach ($dirs as $dir) {
    foreach(scandir($dir) as $file) {
        if (pathinfo($file, PATHINFO_EXTENSION) !== "php") continue;
        include_once $dir . '/' . $file;
    }
}