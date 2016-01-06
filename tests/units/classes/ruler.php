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

		$test->getMockController()->getTestMethods = $case['testMethods'];
		$test->getMockController()->getClass = $case['class'];
		$test->getMockController()->getClassNamespace = $case['classNamespace'];
		$test->getMockController()->getTestedClassName = $case['testedClassName'];
		$test->getMockController()->getTestedClassNameNamespace = $case['testedClassNamespace'];
		$test->getMockController()->getMethodTags = $case['methodTags'];
		$this->calling($test)->getMethodPhpVersions = function($methodName) use ($case) {
			if (!isset($case['methodPhpVersions'][$methodName])) {
				return array();
			}

			return $case['methodPhpVersions'][$methodName];
		};

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
			'testMethods' => array(
				'testMethod1',
			),
			'methodTags' => array(
				'testMethod1' => array(
					'unSuperTagAuNiveauDeLaMethode1'
				),
			),
			'class' => 'mageekguy\atoum\ruler\tests\units\testClass1',
			'classNamespace' => 'mageekguy\atoum\ruler\tests\units',
			'testedClassName' => 'mageekguy\atoum\ruler\testClass1',
			'testedClassNamespace' => 'mageekguy\atoum\ruler',
			'methodPhpVersions' => array(),
		);

		//rule.method => isMethodIgnored
		$rules = array(
			'not("unSuperTagAuNiveauDeLaMethode1" in tags)' => array(
				'testMethod1' => true,
			),
			'not(tags contains "unSuperTagAuNiveauDeLaMethode1")' => array(
				'testMethod1' => true,
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

		$case['testMethods'][] = 'testMethod2';
		$case['testMethods'][] = 'testMethod3';
		$case['testMethods'][] = 'testMethod4';
		$case['testMethods'][] = 'testMethod5';
		$case['testMethods'][] = 'testMethod6';
		$case['testMethods'][] = 'testMethod7';
		$case['methodPhpVersions'] = array(
			'testMethod2' => array(
				'7.0' => '>='
			),
			'testMethod3' => array(
				'5.5' => '>'
			),
			'testMethod4' => array(
				'5.4' => '='
			),
			'testMethod5' => array(
				'5.3' => '<'
			),
			'testMethod6' => array(
				'5.2' => '<='
			),
			'testMethod7' => array(
				'5.3' => '<=',
				'5.5' => '=',
			),
		);

		$rules = array(
			'phpVersionConstraint.containsGte("7.0")' => array(
				'testMethod1' => true,
				'testMethod2' => false,
				'testMethod3' => true,
				'testMethod4' => true,
				'testMethod5' => true,
				'testMethod6' => true,
				'testMethod7' => true,
			),
			'phpVersionConstraint.containsGt("5.5")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => false,
				'testMethod4' => true,
				'testMethod5' => true,
				'testMethod6' => true,
				'testMethod7' => true,
			),
			'phpVersionConstraint.containsEq("5.4")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => true,
				'testMethod4' => false,
				'testMethod5' => true,
				'testMethod6' => true,
				'testMethod7' => true,
			),
			'phpVersionConstraint.containsLt("5.3")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => true,
				'testMethod4' => true,
				'testMethod5' => false,
				'testMethod6' => true,
				'testMethod7' => true,
			),
			'phpVersionConstraint.containsLte("5.2")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => true,
				'testMethod4' => true,
				'testMethod5' => true,
				'testMethod6' => false,
				'testMethod7' => true,
			),
			'phpVersionConstraint.containsEq("5.5")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => true,
				'testMethod4' => true,
				'testMethod5' => true,
				'testMethod6' => true,
				'testMethod7' => false,
			),
			'phpVersionConstraint.containsLte("5.3")' => array(
				'testMethod1' => true,
				'testMethod2' => true,
				'testMethod3' => true,
				'testMethod4' => true,
				'testMethod5' => true,
				'testMethod6' => true,
				'testMethod7' => false,
			),
		);

		$data[] = array($case, $rules);

		return $data;
	}
}
