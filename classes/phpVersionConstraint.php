<?php

namespace mageekguy\atoum\ruler;

class phpVersionConstraint
{
	/**
	 * @var array
	 */
	protected $versions;

	/**
	 * @param array $versions
	 */
	public function __construct(array $versions)
	{
		$this->versions = $versions;
	}

	/**
	 * @param string $version
	 *
	 * @return bool
	 */
	public function containsGte($version)
	{
		return $this->compare($version, '>=');
	}

	/**
	 * @param string $version
	 *
	 * @return bool
	 */
	public function containsGt($version)
	{
		return $this->compare($version, '>');
	}

	/**
	 * @param string $version
	 *
	 * @return bool
	 */
	public function containsEq($version)
	{
		return $this->compare($version, '=');
	}

	/**
	 * @param string $version
	 *
	 * @return bool
	 */
	public function containsLt($version)
	{
		return $this->compare($version, '<');
	}

	/**
	 * @param string $version
	 *
	 * @return bool
	 */
	public function containsLte($version)
	{
		return $this->compare($version, '<=');
	}

	/**
	 * @param string $version
	 * @param string $operator
	 *
	 * @return bool
	 */
	private function compare($version, $operator)
	{
		return array_key_exists($version, $this->versions) && $this->versions[$version] == $operator;
	}
}
