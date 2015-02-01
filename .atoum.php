<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use mageekguy\atoum\ruler;
$runner->addExtension(new ruler\extension($script));
$runner->addTestsFromDirectory(__DIR__ . '/tests/units');
