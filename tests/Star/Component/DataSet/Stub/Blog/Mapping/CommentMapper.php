<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Mapping;

use Star\Component\DataSet\Mapping\AbstractMapper;

/**
 * Class CommentMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Mapping
 */
class CommentMapper extends AbstractMapper
{
    /**
     * Returns the mapping of the fields to a setter method.
     *
     * @return array
     */
    protected function getMapping()
    {
        return array(
            'id'      => 'setId',
            'content' => 'setContent',
            'Article' => 'setArticleId',
        );
    }

    /**
     * Returns the class name of the object to map
     *
     * @return mixed
     */
    public function getClass()
    {
        return 'Star\Component\DataSet\Stub\Blog\Entity\Comment';
    }

    /**
     * Return the name of the mapping
     *
     * @return string
     */
    public function getName()
    {
        return 'Comment';
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
