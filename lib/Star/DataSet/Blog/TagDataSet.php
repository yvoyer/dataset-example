<?php
/**
 * This file is part of the Dataset.
 *
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\DataSet\Blog;

use Star\DataSet\AbstractDataSet;

/**
 * Class TagDataSet
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class TagDataSet extends AbstractDataSet
{
    /**
     * Returns the name of the data set.
     *
     * @return string
     */
    public function getName()
    {
        return "Tag";
    }
}
