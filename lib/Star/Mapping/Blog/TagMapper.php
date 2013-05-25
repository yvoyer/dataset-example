<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Mapping\Blog;

use Star\Mapping\AbstractMapper;

/**
 * Class TagMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class TagMapper extends AbstractMapper
{
    /**
     * Returns the class name of the object to map
     *
     * @return mixed
     */
    public function getClass()
    {
        return "Star\Blog\Tag";
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
     *
     * @return integer|string
     */
    public function getIdentifier()
    {
        return "id";
    }

    /**
     * Returns the mapping of the fields to a setter method.
     *
     * @return array
     */
    protected function getMapping()
    {
        return array(
            "id"   => "setId",
            "name" => "setName",
        );
    }
}
