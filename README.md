# atoum/ruler-extension

![atoum](http://downloads.atoum.org/images/logo.png)

## Install it

Install extension using [composer](https://getcomposer.org):

```
composer require atoum/ruler-extension:dev-master
```

Enable the extension using atoum configuration file:

```php
<?php

// .atoum.php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$runner->addExtension(new \mageekguy\atoum\ruler\extension($script));
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
