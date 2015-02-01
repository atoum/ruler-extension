# atoum/ruler-extension

![atoum](http://downloads.atoum.org/images/logo.png)

## Install it

Install extension using [composer](https://getcomposer.org):

Add this repository in your composer.json
```
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/agallou/ruler-extension"
        }
    ],
```

Then add the ruler-extension to your dev requirements :

```json
{
    "require-dev": {
        "atoum/ruler-extension": "dev-master"
    },
}

```

Enable the extension using atoum configuration file:

```php
<?php

// .atoum.php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

use mageekguy\atoum\ruler;

$runner->addExtension(new ruler\extension($script));
```

## Use it

Examples :
```
./vendor/bin/atoum -d tests --filter 'not ("unSuperTagAuNiveauDeLaMethode1" in tags)'
./vendor/bin/atoum -d tests --filter 'method = "testMethod1'
./vendor/bin/atoum -d tests --filter 'method in ["testMethod1"]'
./vendor/bin/atoum -d tests --filter 'class = "mageekguy\atoum\ruler\tests\units\testClass1'
./vendor/bin/atoum -d tests --filter 'namespace = "mageekguy\atoum\ruler\tests\units'
./vendor/bin/atoum -d tests --filter 'testedclass = "mageekguy\atoum\ruler\testClass1'
./vendor/bin/atoum -d tests --filter 'testedclassnamespace = "mageekguy\atoum\ruler'
```
