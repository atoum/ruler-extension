<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$runner->addExtension(new \atoum\ruler\extension($script));
$runner->addTestsFromDirectory(__DIR__ . '/tests/units');
