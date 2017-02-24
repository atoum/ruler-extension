<?php

use mageekguy\atoum;
use mageekguy\atoum\scripts;

if (defined('mageekguy\atoum\scripts\runner') === true) {
    scripts\runner::addConfigurationCallable(function(atoum\configurator $script, atoum\runner $runner) {
        $extension = new atoum\ruler\extension($script);

        $extension->addToRunner($runner);
    });
}
