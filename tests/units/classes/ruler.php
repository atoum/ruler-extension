<?php

namespace mageekguy\atoum\ruler\tests\units;

use
	mageekguy\atoum,
	mageekguy\atoum\ruler\ruler as testedClass
	;

class ruler extends atoum\test
{
	/**
	 * @dataProvider testFilterDataProvider
	 */
	public function testIsMethodIgnored($case, $rules)
	{
		$test = new \mock\mageekguy\atoum\test();

		$test->getMockController()->getTestMethods = array_keys($case['methodTags']);
		$test->getMockController()->getClass = $case['class'];
		$test->getMockController()->getClassNamespace = $case['classNamespace'];
		$test->getMockController()->getTestedClassName = $case['testedClassName'];
		$test->getMockController()->getTestedClassNameNamespace = $case['testedClassNamespace'];
		$test->getMockController()->getMethodTags = $case['methodTags'];
		$test->getMockController()->getMandatoryMethodExtensions = $case['mandatoryMethodExtensions'];


		foreach ($rules as $rule => $methodCases) {
			$testedClass = new testedClass($rule);
			foreach ($methodCases as $methodName => $isIgnored) {
				$this
					->boolean($testedClass->isMethodIgnored($test, $methodName))
						->isEqualTo($isIgnored, sprintf("rule : '%s' method: '%s', expected : %s", $rule, $methodName, var_export($isIgnored, true)))
				;
			}
		}
	}

	protected function testFilterDataProvider()
	{
		$data = array();

		$case = array(
			'methodTags' => array(
				'testMethod1' => array(
					'unSuperTagAuNiveauDeLaMethode1'
				),
			),
			'class' => 'mageekguy\atoum\ruler\tests\units\testClass1',
			'classNamespace' => 'mageekguy\atoum\ruler\tests\units',
			'testedClassName' => 'mageekguy\atoum\ruler\testClass1',
			'testedClassNamespace' => 'mageekguy\atoum\ruler',
			'mandatoryMethodExtensions' => array(
				'testMethod1' => array(
					'opcache',
				),
			),
		);

		//rule.method => isMethodIgnored
		$rules = array(
			'not("unSuperTagAuNiveauDeLaMethode1" in tags)' => array(
				'testMethod1' => true,
			),
			'not(tags contains "unSuperTagAuNiveauDeLaMethode1")' => array(
				'testMethod1' => true,
			),
			'not("opcache" in extensions)' => array(
				'testMethod1' => true,
			),
			'"opcache" in extensions' => array(
				'testMethod1' => false,
			),
			'method = "testMethod1"' => array(
				'testMethod1' => false,
			),
			'method in ["testMethod1"]' => array(
				'testMethod1' => false,
			),
			'class = "mageekguy\atoum\ruler\tests\units\testClass1"' => array(
				'testMethod1' => false,
			),
			'class = "mageekguy\atoum\ruler\tests\units\testClass54"' => array(
				'testMethod1' => true,
			),
			'namespace = "mageekguy\atoum\ruler\tests\units"' => array(
				'testMethod1' => false,
			),
			'namespace = "mageekguy\atoum\rulerz\tests\units"' => array(
				'testMethod1' => true,
			),
			'testedclass = "mageekguy\atoum\ruler\testClass1"' => array(
				'testMethod1' => false,
			),
			'testedclassnamespace = "mageekguy\atoum\ruler"' => array(
				'testMethod1' => false,
			),
		);

		$data[] = array($case, $rules);

		return $data;
	}
}
