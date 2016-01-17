<?php

namespace mageekguy\atoum\ruler;

use mageekguy\atoum;

$vendorDirectory = __DIR__ . '/vendor';

if (is_dir($vendorDirectory) === false)
{
	$vendorDirectory = __DIR__ . '/../..';
}

$hoa = array(
	'hoa/core' => 'Core.php',
	'hoa/consistency' => 'Prelude.php',
	'hoa/protocol' => 'Wrapper.php',
	'hoa/compiler' => null,
	'hoa/event' => null,
	'hoa/exception' => null,
	'hoa/file' => null,
	'hoa/iterator' => null,
	'hoa/math' => null,
	'hoa/regex' => null,
	'hoa/ruler' => null,
	'hoa/stream' => null,
	'hoa/string' => null,
	'hoa/ustring' => null,
	'hoa/visitor' => null,
	'hoa/zformat' => null
);

foreach ($hoa as $library => $file)
{
	$parts = explode('/', $library);
	$parts = array_map('ucfirst', $parts);

	$namespace = implode('\\', $parts);
	$root = $vendorDirectory . DIRECTORY_SEPARATOR . $library;

	if (is_dir($root))
	{
		if (null === $file)
		{
			atoum\autoloader::get()->addDirectory($namespace, $root);
		}
		else
		{
			if (file_exists($root . DIRECTORY_SEPARATOR . $file))
			{
				atoum\autoloader::get()->addDirectory($namespace, $root);

				require_once $root . DIRECTORY_SEPARATOR . $file;
			}
		}
	}
}

atoum\autoloader::get()
	->addNamespaceAlias('atoum\ruler', __NAMESPACE__)
	->addDirectory(__NAMESPACE__, __DIR__ . '/classes')
;
