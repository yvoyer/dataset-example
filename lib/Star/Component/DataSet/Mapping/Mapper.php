<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Mapping;

/**
 * Class Mapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Mapping
 */
class Mapper implements MapperInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $class;

    /**
     * @var string
     */
    private $uniqueFieldName;

    /**
     * @var array
     */
    private $mappings;

    public function __construct($name, $class, $uniqueFieldName = 'id')
    {
        $this->name            = $name;
        $this->class           = $class;
        $this->uniqueFieldName = $uniqueFieldName;
        $this->mappings        = array();
    }

    /**
     * Add a map for a method.
     *
     * @param string|integer $field
     * @param string         $method
     */
    public function addMap($field, $method)
    {
        $this->mappings[$field] = $method;
    }

    /**
     * Populate the $object according to the mapping strategy.
     *
     * @param object $object
     * @param string $column
     * @param mixed  $value
     *
     * @return mixed
     */
    public function populate(&$object, $column, $value)
    {
        $method = $this->mappings[$column];

        $object->{$method}($value);
    }

    /**
     * Returns the class name of the object to map
     *
     * @return mixed
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Return the name of the mapping
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the unique field name.
     *
     * @return integer|string
     */
    public function getUniqueFieldName()
    {
        return $this->uniqueFieldName;
    }
}
