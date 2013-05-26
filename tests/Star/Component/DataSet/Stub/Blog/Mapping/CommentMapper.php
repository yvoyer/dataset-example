<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Mapping;

use Star\Component\DataSet\Mapping\Mapper;

/**
 * Class CommentMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Mapping
 */
class CommentMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct('Comment', 'Star\Component\DataSet\Stub\Blog\Entity\Comment', 'id');

        $this->addMap('id', 'setId');
        $this->addMap('content', 'setContent');
        $this->addMap('Article', 'setArticleId');
    }
}
