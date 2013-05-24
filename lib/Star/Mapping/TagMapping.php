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
 * Class TagMapping
 *
 * @package  Star\Mapping
 * @author   Yannick Voyer <yvoyer@crakmedia.com>
 */
class TagMapping implements DataSetMapping
{
    private $mapping = array(
        "id" => "setId",
        "name" => "setName",
    );

    /**
     * Returns the class name of the object to map
     * @return mixed
     */
    public function getClass()
    {
        return "Star\Blog\Tag";
    }

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
        $method = $this->mapping[$column];

        $object->{$method}($value);
    }

    /**
     * Return the name of the mapping
     *
     * @return string
     */
    public function getName()
    {
        return "Tag";
    }

    /**
     * Returns the unique identifier.
     * @return integer|string
     */
    public function getIdentifier()
    {
        return "id";
    }
}
