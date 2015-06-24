<?php

namespace mageekguy\atoum\ruler;

use mageekguy\atoum;

$vendorDirectory = __DIR__ . '/vendor';

if (is_dir($vendorDirectory) === false)
{
	$vendorDirectory = __DIR__ . '/../..';
}

if (is_file($vendorAutoloader = $vendorDirectory . '/hoa/core/Core.php')) {
	require_once $vendorDirectory . '/hoa/core/Core.php';
}

atoum\autoloader::get()
	->addNamespaceAlias('atoum\ruler', __NAMESPACE__)
	->addDirectory(__NAMESPACE__, __DIR__ . '/classes')
	->addDirectory('Hoa\Core', $vendorDirectory . '/hoa/core')
	->addDirectory('Hoa\Compiler', $vendorDirectory . '/hoa/compiler')
	->addDirectory('Hoa\File', $vendorDirectory . '/hoa/file')
	->addDirectory('Hoa\Iterator', $vendorDirectory . '/hoa/iterator')
	->addDirectory('Hoa\Math', $vendorDirectory . '/hoa/math')
	->addDirectory('Hoa\Regex', $vendorDirectory . '/hoa/regex')
	->addDirectory('Hoa\Ruler', $vendorDirectory . '/hoa/ruler')
	->addDirectory('Hoa\Stream', $vendorDirectory . '/hoa/stream')
	->addDirectory('Hoa\Ustring', $vendorDirectory . '/hoa/ustring')
	->addDirectory('Hoa\Visitor', $vendorDirectory . '/hoa/visitor')
;
