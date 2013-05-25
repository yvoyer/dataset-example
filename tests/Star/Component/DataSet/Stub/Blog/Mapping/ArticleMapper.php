<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Mapping;

use Star\Component\DataSet\Mapping\AbstractMapper;

/**
 * Class ArticleMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Mapping
 */
class ArticleMapper extends AbstractMapper
{
    /**
     * Returns the mapping of the fields to a setter method.
     *
     * @return array
     */
    protected function getMapping()
    {
        return array(
            'id'          => 'setId',
            'name'        => 'setName',
            'description' => 'setDescription',
            'Tags'        => 'setRawTags',
        );
    }

    /**
     * Returns the class name of the object to map
     *
     * @return mixed
     */
    public function getClass()
    {
        return 'Star\Component\DataSet\Stub\Blog\Entity\Article';
    }

    /**
     * Return the name of the mapping
     *
     * @return string
     */
    public function getName()
    {
        return 'Article';
    }

    /**
     * Returns the unique identifier.
     *
     * @return integer|string
     */
    public function getIdentifier()
    {
        return 'id';
    }
}
