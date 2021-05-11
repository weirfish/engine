<?php

namespace Engine\Abstracts;

abstract class Factory
{
	use \Engine\Traits\Singleton;

	/** @var mixed[] */
	private array $objects = [];

	public final function __construct()
	{
		foreach($this->defineObjects() as $object)
		{
			$reflection = new \ReflectionClass($object);
			$this->objects[$reflection->getName()] = $object;
		}
	}

	protected function get(string $key) : mixed
	{
		if(!$this->hasKey($key))
			return null;

		return $this->objects[$key];
	}

	/**
	 * @return mixed[]
	 */
	protected function getAll() : array
	{
		return $this->objects;
	}

	protected function hasKey(string $key) : bool
	{
		foreach($this->objects as $k => $object)
		{
			if($key === $k)
				return true;
		}

		return false;
	}

	abstract protected function defineObjects() : array;
}