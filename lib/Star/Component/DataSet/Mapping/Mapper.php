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
class Mapper extends AbstractMapper
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
    private $identifier;

    /**
     * @var array
     */
    private $mappings;

    public function __construct($name, $class, $identifier = 'id')
    {
        $this->name       = $name;
        $this->class      = $class;
        $this->identifier = $identifier;
        $this->mappings   = array();
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
     * Returns the mapping of the fields to a setter method.
     *
     * @return array
     */
    protected function getMapping()
    {
        return $this->mappings;
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
     * Returns the unique identifier.
     *
     * @return integer|string
     */
    public function getIdentifier()
    {
        return $this->identifier;
    }
}
