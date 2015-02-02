<?php

use mageekguy\atoum;
atoum\autoloader::get()
    ->addDirectory(__NAMESPACE__, __DIR__ . DIRECTORY_SEPARATOR . 'classes');
;
