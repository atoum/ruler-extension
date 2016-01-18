<?php

namespace mageekguy\atoum\ruler\tests;

use mageekguy\atoum;

require_once __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'autoloader.php';

atoum\autoloader::get()
	->addDirectory(__NAMESPACE__, __DIR__)
;
