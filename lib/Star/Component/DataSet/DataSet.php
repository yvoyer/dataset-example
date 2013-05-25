<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet;

use Star\Component\DataSet\Mapping\DataSetMapping;

/**
 * Class DataSet
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star
 */
class DataSet implements DataSetInterface
{
    /**
     * The collection of elements.
     *
     * @var array
     */
    private $elements;

    public function __construct(array $data, DataSetMapping $mapping)
    {
        $class = $mapping->getClass();
        $data  = $data[$mapping->getName()];

        foreach ($data as $aRow) {
            $object     = new $class();
            $identifier = $mapping->getIdentifier();
            $id = null;
            foreach ($aRow as $column => $value) {
                if ($identifier === $column) {
                    $id = $value;
                }
                $mapping->populate($object, $column, $value);
            }

            $this->elements[$id] = $object;
        }
    }

    /**
     * Returns the data set as a flat array.
     *
     * @return array
     */
    public function toArray()
    {
        return $this->elements;
    }
}
