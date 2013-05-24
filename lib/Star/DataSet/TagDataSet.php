<?php
/**
 * This file is property of crakmedia (http://crakmedia.com)
 *
 * PHP Version 5.4
 *
 * @copyright 2013 Crakmedia
 */

namespace Star\DataSet;

use Star\Mapping\DataSetMapping;

/**
 * Class TagDataSet
 *
 * @package  Star\DataSet
 * @author   Yannick Voyer <yvoyer@crakmedia.com>
 */
class TagDataSet
{
    private $tags = array();

    public function __construct(array $data, DataSetMapping $mapping)
    {
        $class = $mapping->getClass();
        $data  = $data[$mapping->getName()];

        foreach ($data as $aRow) {
            $tag = new $class();
            $identifier = $mapping->getIdentifier();
            $id = null;
            foreach ($aRow as $column => $value) {
                if ($identifier === $column) {
                    $id = $value;
                }
                $mapping->populate($tag, $column, $value);
            }

            $this->tags[$id] = $tag;
        }

    }

    public function getName()
    {
        return "Tag";
    }

    public function toArray()
    {
        return $this->tags;
    }
}
