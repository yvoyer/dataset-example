<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 *
 * PHP Version 5.4
 *
 * @copyright 2013 Crakmedia
 */

namespace Star\Mapping;

/**
 * Interface DataSetMapping
 *
 * @author   Yannick Voyer <yvoyer@crakmedia.com>
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
