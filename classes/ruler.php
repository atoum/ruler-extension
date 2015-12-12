<?php

namespace mageekguy\atoum\ruler;

use mageekguy\atoum\test;
use Hoa\Ruler\Context as HoaContext;
use Hoa\Ruler\Ruler as HoaRuler;

class ruler
{
	/**
	 * @var string
	 */
	protected $rule;

	/**
	 * @var \Hoa\Ruler\Ruler
	 */
	protected $ruler;

	/**
	 * @param string $rule
	 */
	public function __construct($rule)
	{
		$this->rule = HoaRuler::interpret($rule);
		$this->ruler = new HoaRuler();
		$this->ruler->getAsserter()->setOperator('contains',  function (Array $a,  $b) { return in_array($b, $a); });
	}

	/**
	 * @param test   $test
	 * @param string $methodNameToCheck
	 * @return bool
	 * @throws \RuntimeException
	 */
	public function isMethodIgnored(test $test, $methodNameToCheck)
	{
		$contexts = array();
		foreach ($test->getTestMethods() as $methodName) {
			$contexts[$methodName] = new HoaContext();
			$contexts[$methodName]['method'] = $methodName;
			$contexts[$methodName]['class'] = $test->getClass();
			$contexts[$methodName]['namespace'] = $test->getClassNamespace();
			$contexts[$methodName]['testedclass'] = $test->getTestedClassName();
			$contexts[$methodName]['testedclassnamespace'] = $test->getTestedClassNamespace();
		}

		foreach ($test->getMandatoryMethodExtensions() as $methodName => $extensions) {
			$contexts[$methodName]['extensions'] = $extensions;
		}

		foreach ($test->getMethodTags() as $methodName => $tags) {
			$contexts[$methodName]['tags'] = $tags;
		}

		if (!isset($contexts[$methodNameToCheck])) {
			throw new \RuntimeException(sprintf('Method not found : %s', $methodNameToCheck));
		}

		return false === $this->ruler->assert($this->rule, $contexts[$methodNameToCheck]);
	}
}
