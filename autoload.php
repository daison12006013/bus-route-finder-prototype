<?php

$rootAutoload = __DIR__.'/vendor/autoload.php';
$laravelVendorAutoload = __DIR__.'/../../vendor/autoload.php';

if (file_exists($rootAutoload)) {
    require_once $rootAutoload;
} elseif (file_exists($laravelVendorAutoload)) {
    require_once $laravelVendorAutoload;
} else {
    throw new Exception('File /vendor/autoload.php not found from the package root or the laravel itself.');
}
