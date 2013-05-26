<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Mapping;

use Star\Component\DataSet\Mapping\Mapper;

/**
 * Class ArticleMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Mapping
 */
class ArticleMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct('Article', 'Star\Component\DataSet\Stub\Blog\Entity\Article', 'id');

        $this->addMap('id', 'setId');
        $this->addMap('name', 'setName');
        $this->addMap('description', 'setDescription');
        $this->addMap('Tags', 'setRawTags');
    }
}
