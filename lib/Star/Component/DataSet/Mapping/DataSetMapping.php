<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Mapping;

/**
 * Class DataSetMapping
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
interface DataSetMapping
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
     * @param $object
     * @param $column
     * @param $value
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
     * Returns the unique identifier.
     *
     * @return integer|string
     */
    public function getIdentifier();
}
