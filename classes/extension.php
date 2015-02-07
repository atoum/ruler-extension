<?php

namespace atoum\ruler;

use mageekguy\atoum\observable;
use mageekguy\atoum\configurator;
use mageekguy\atoum\runner;
use atoum\exceptions\logic\invalidArgument;
use mageekguy\atoum\test;

class extension implements \atoum\extension
{
	/**
	 * @var string|null
	 */
	protected $rule = null;


	/**
	 * @param configurator $configurator
	 */
	public function __construct(configurator $configurator = null)
	{
		if ($configurator)
		{
			$script = $configurator->getScript();
			$parser = $script->getArgumentsParser();
			$extension = $this;
			$handler = function(\atoum\scripts\runner $script, $argument, $values) use ($extension) {
				if (sizeof($values) != 1)
				{
					throw new invalidArgument(sprintf($script->getLocale()->_('Bad usage of %s, do php %s --help for more informations'), $argument, $script->getName()));
				}
				$value = array_shift($values);
				if (0 === strlen(trim($value)))
				{
					throw new invalidArgument(sprintf($script->getLocale()->_('Bad usage of %s, do php %s --help for more informations'), $argument, $script->getName()));
				}
				$extension->setRule($value);
			};

			$example = <<<EOF
'not("featureA" in tags) and namespace = "foo\bar"'
EOF;

			$script
				->addArgumentHandler(
					$handler,
					array('--filter'),
					null,
					$script->getLocale()->_('Filters tests to execute. For example ' . $example)
				)
			;
		}
	}

	/**
	 * @param string $rule
	 * @return $this
	 */
	protected function setRule($rule)
	{
		$this->rule = $rule;

		return $this;
	}

	/**
	 * @param runner $runner
	 * @return $this
	 */
	public function setRunner(runner $runner)
	{
		return $this;
	}

	/**
	 * @param test $test
	 * @return $this
	 */
	public function setTest(test $test)
	{
		if (null === $this->rule)
		{
			return $this;
		}

		$ruler = new ruler($this->rule);
		foreach ($test->getTestMethods() as $testMethod)
		{
			$isMethodIgnored = $ruler->isMethodIgnored($test, $testMethod);
			$test->ignoreMethod($testMethod, $isMethodIgnored);
		}

		return $this;
	}

	/**
	 * @param string     $event
	 * @param observable $observable
	 */
	public function handleEvent($event, observable $observable) {

	}
}
