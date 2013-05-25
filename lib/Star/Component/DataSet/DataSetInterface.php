<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet;

/**
 * Class DataSetInterface
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\DataSet
 */
interface DataSetInterface
{
    /**
     * Returns the data set as a flat array.
     *
     * @return array
     */
    public function toArray();
}
