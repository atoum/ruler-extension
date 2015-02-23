# atoum/ruler-extension [![Build Status](https://travis-ci.org/atoum/ruler-extension.svg?branch=master)](https://travis-ci.org/atoum/ruler-extension)

![atoum](http://downloads.atoum.org/images/logo.png)

## Install it

Install extension using [composer](https://getcomposer.org):

```
composer require --dev atoum/ruler-extension:~1.0
```

Enable the extension using atoum configuration file:

```php
<?php

// .atoum.php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';

$runner->addExtension(new \mageekguy\atoum\ruler\extension($script));
```

## Use it

The extension adds a `--filter` option to atoum. This line now appears on the atoum help:

```
--filter: Filters tests to execute. For example 'not("featureA" in tags) and namespace = "foo\bar"'
```

You can now filter your tests using any [Hoa\Ruler filter](https://github.com/hoaproject/Ruler).

Those variables are available in the filter:

* `method`
* `class`
* `namespace`
* `testedclass`
* `testedclassnamespace`
* `tags` (as an array)

## Examples

Run all tests except those who have the `needsDatabase` tag:

```
./vendor/bin/atoum -d tests --filter 'not ("needsDatabase" in tags)'
```

Run all tests with a method named `testMethod1`:

```
./vendor/bin/atoum -d tests --filter 'method = "testMethod1'
```


Run all tests with a method named `testMethod1` (using an array representing a list of methods to filter):

```
./vendor/bin/atoum -d tests --filter 'method in ["testMethod1"]'
```


You can also define more complex filters like this: Run all tests tagged `needsDatabase` and with method `testClass1` or with a method `testClass`:

```
./vendor/bin/atoum --filter '("needsDatabase" in tags and method = "testClass1") or (method = "testClass")'
```


Run the test with the `mageekguy\atoum\ruler\tests\units\testClass1` classname:

```
./vendor/bin/atoum -d tests --filter 'class = "mageekguy\atoum\ruler\tests\units\testClass1'
```


Run all tests in the `mageekguy\atoum\ruler\tests\units` namespace:

```
./vendor/bin/atoum -d tests --filter 'namespace = "mageekguy\atoum\ruler\tests\units'
```


Run the tests that test the `mageekguy\atoum\ruler\testClass1` class:

```
./vendor/bin/atoum -d tests --filter 'testedclass = "mageekguy\atoum\ruler\testClass1'
```

Run the tests that test the classes in the `mageekguy\atoum\ruler` namespace:

```
./vendor/bin/atoum -d tests --filter 'testedclassnamespace = "mageekguy\atoum\ruler'
```
