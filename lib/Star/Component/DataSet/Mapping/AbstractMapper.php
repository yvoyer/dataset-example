<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Mapping;

/**
 * Class AbstractMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Mapping
 */
abstract class AbstractMapper implements DataSetMapping
{
    /**
     * Returns the mapping of the fields to a setter method.
     *
     * @return array
     */
    protected abstract function getMapping();

    /**
     * Populate the $object according to the mapping strategy.
     *
     * @param $object
     * @param $column
     * @param $value
     *
     * @return mixed
     */
    public function populate(&$object, $column, $value)
    {
        $mapping = $this->getMapping();
        $method  = $mapping[$column];

        $object->{$method}($value);
    }
}
