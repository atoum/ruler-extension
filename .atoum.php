<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'autoloader.php';

use mageekguy\atoum\ruler;

$runner->addExtension(new ruler\extension($script));
$runner->addTestsFromDirectory(__DIR__ . '/tests/units');
