<?php

namespace mageekguy\atoum\ruler;

use mageekguy\atoum;

require_once __DIR__ . '/vendor/hoa/core/Core.php';

atoum\autoloader::get()
	->addNamespaceAlias('atoum\ruler', __NAMESPACE__)
	->addDirectory(__NAMESPACE__, __DIR__ . DIRECTORY_SEPARATOR . 'classes')
	->addDirectory('Hoa\Core', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/core')
	->addDirectory('Hoa\Compiler', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/compiler')
	->addDirectory('Hoa\File', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/file')
	->addDirectory('Hoa\Iterator', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/iterator')
	->addDirectory('Hoa\Math', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/math')
	->addDirectory('Hoa\Regex', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/regex')
	->addDirectory('Hoa\Ruler', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/ruler')
	->addDirectory('Hoa\Stream', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/stream')
	->addDirectory('Hoa\String', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/string')
	->addDirectory('Hoa\Visitor', __DIR__ . DIRECTORY_SEPARATOR . 'vendor/hoa/visitor')
;
