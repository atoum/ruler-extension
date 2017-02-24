# atoum/ruler-extension [![Build Status](https://travis-ci.org/atoum/ruler-extension.svg?branch=master)](https://travis-ci.org/atoum/ruler-extension)

This extension allows you to precisely filter test cases to run with a "natural language".

The extension adds a `--filter` option to atoum. This line now appears on the atoum help:

```
--filter: Filters tests to execute. For example 'not("featureA" in tags) and namespace = "foo\bar"'
```

You can now filter your tests using any [Hoa\Ruler filter](https://github.com/hoaproject/Ruler).


## Example

```
./vendor/bin/atoum -d tests --filter 'not("featureA" in tags) and namespace = "foo\bar"'
```

This will only launch test that are not tagged with "featureA" and have the `foo\bar` namespace.


## Available filters

Those variables are available in the filter:

* `method`
* `class`
* `namespace`
* `testedclass`
* `testedclassnamespace`
* `tags` (as an array)
* `extensions` (as an array)


## Install it

Install extension using [composer](https://getcomposer.org):

```
composer require --dev atoum/ruler-extension
```

The extension will be automatically loaded. If you ever want to unload it, you can add this to your configuration file:

```php
<?php

// .atoum.php

use mageekguy\atoum\ruler;

$runner->removeExtension(ruler\extension::class);
```

## Examples


### Filter on tags

Run all tests who have the `needsDatabase` tag:

```
./vendor/bin/atoum -d tests --filter 'tags contains "needsDatabase"'
```

Run all tests except those who have the `needsDatabase` tag:

```
./vendor/bin/atoum -d tests --filter 'not (tags contains "needsDatabase")'
```

You can also use the ruler's default `in` operator, but in that case that's less readable:

```
./vendor/bin/atoum -d tests --filter 'not ("needsDatabase" in tags)'
```

Read more about tags in [atoum's documentation](http://docs.atoum.org/en/latest/launch_test.html?highlight=tags#tags).


### Filter on the test method name

Run all tests with a method named `testMethod1`:

```
./vendor/bin/atoum -d tests --filter 'method = "testMethod1'
```

Run all tests with a method named `testMethod1` (using an array representing a list of methods to filter):

```
./vendor/bin/atoum -d tests --filter 'method in ["testMethod1"]'
```


### Filter on the test classname

Run the test with the `mageekguy\atoum\ruler\tests\units\testClass1` classname:

```
./vendor/bin/atoum -d tests --filter 'class = "mageekguy\atoum\ruler\tests\units\testClass1'
```


### Filter on the test namespace

Run all tests in the `mageekguy\atoum\ruler\tests\units` namespace:

```
./vendor/bin/atoum -d tests --filter 'namespace = "mageekguy\atoum\ruler\tests\units'
```


### Filter on the tested class name

Run the tests that test the `mageekguy\atoum\ruler\testClass1` class:

```
./vendor/bin/atoum -d tests --filter 'testedclass = "mageekguy\atoum\ruler\testClass1'
```


### Filter on the tested class namespace

Run the tests that test the classes in the `mageekguy\atoum\ruler` namespace:

```
./vendor/bin/atoum -d tests --filter 'testedclassnamespace = "mageekguy\atoum\ruler'
```


### Filter on the test required extensions

Run all tests that needs the blackfire extension :

```
./vendor/bin/atoum -d tests --filter 'extensions contains "blackfire"'
```

You can also use the ruler's default `in` operator, but in that case that's less readable:

```
./vendor/bin/atoum -d tests --filter '"blackfire" in tags'
```

You can read more about the test required extensions in [atoum's documentation](http://docs.atoum.org/en/latest/written_help.html#php-extensions).


### Apply multiple filters


You can also define more complex filters like this: Run all tests tagged `needsDatabase` and with method `testClass1` or with a method `testClass`:

```
./vendor/bin/atoum --filter '("needsDatabase" in tags and method = "testClass1") or (method = "testClass")'
```

## Links

* [Hoa\Ruler](https://github.com/hoaproject/Ruler)
* [Hoa\Ruler's documentation](http://hoa-project.net/En/Literature/Hack/Ruler.html)
* [atoum](http://atoum.org)
* [atoum's documentation](http://docs.atoum.org)

## License

ruler-extension is released under the MIT License. See the bundled LICENSE file for details.

![atoum](http://atoum.org/images/logo/atoum.png)
