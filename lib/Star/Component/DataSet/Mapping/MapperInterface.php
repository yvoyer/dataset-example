<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Mapping;

/**
 * Class MapperInterface
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
interface MapperInterface
{
    /**
     * Returns the class name of the object to map
     *
     * @return mixed
     */
    public function getClass();

    /**
     * Populate the $object according to the mapping strategy.
     *
     * @param object $object
     * @param string $column
     * @param mixed  $value
     *
     * @return mixed
     */
    public function populate(&$object, $column, $value);

    /**
     * Return the name of the mapping
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the unique field name.
     *
     * @return integer|string
     */
    public function getUniqueFieldName();
}
