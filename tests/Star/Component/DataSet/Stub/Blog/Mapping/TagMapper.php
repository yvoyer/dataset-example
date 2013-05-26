<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Stub\Blog\Mapping;

use Star\Component\DataSet\Mapping\Mapper;

/**
 * Class TagMapper
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Stub\Blog\Mapping
 */
class TagMapper extends Mapper
{
    public function __construct()
    {
        parent::__construct('Tag', 'Star\Component\DataSet\Stub\Blog\Entity\Tag', 'id');

        $this->addMap('id', 'setId');
        $this->addMap('name', 'setName');
    }
}
