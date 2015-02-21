<?php

if (is_file($vendorAutoloader = __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php'))
{
    require_once $vendorAutoloader;
}

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';
