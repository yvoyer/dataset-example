<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet;

use Star\Component\DataSet\Exception\Exception;
use Star\Component\DataSet\Exception\MappingException;
use Star\Component\DataSet\Mapping\DataSetMapping;
use Star\Component\DataSet\Mapping\MapperInterface;

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

    /**
     * The name of the class to map to.
     *
     * @var string
     */
    private $class;

    /**
     * The external data.
     *
     * @var array
     */
    private $rawData;

    /**
     * @var integer|string
     */
    private $uidColumn;

    public function __construct(array $data, MapperInterface $mapper)
    {
        $this->elements = array();
        $this->mapper   = $mapper;

        $this->setUidColumn($this->mapper->getUniqueFieldName());
        $this->setClass($this->mapper->getClass());
        $this->setRawData($data);

        $this->transform();
    }

    /**
     * Transform the data as object.
     */
    private function transform()
    {
        foreach ($this->rawData as $aRow) {
            $object = $this->createObject();

            $id = null;
            foreach ($aRow as $column => $value) {
                if ($this->uidColumn === $column) {
                    $id = $value;
                }

                $this->mapper->populate($object, $column, $value);
            }

            // No column could be found for the uid
            if (null === $id) {
                throw new MappingException('The uid index could not be found in data.');
            }

            $this->addElement($id, $object);
        }
    }

    /**
     * Set the name of the uid column.
     *
     * @param string $uidColumn
     */
    private function setUidColumn($uidColumn)
    {
        $this->uidColumn = $uidColumn;
    }

    /**
     * Set the raw data
     *
     * @param array $data
     *
     * @throws MappingException
     */
    private function setRawData(array $data)
    {
        $index = $this->mapper->getName();
        if (isset($data[$index])) {
            $data = $data[$index];
        } else if (false === empty($data)) {
            throw new MappingException('The mapping name is invalid for the data.');
        }

        $this->rawData = $data;
    }

    /**
     * Set the object class name.
     *
     * @param string $class
     *
     * @throws MappingException
     */
    private function setClass($class)
    {
        if (false === class_exists($class)) {
            throw new MappingException('The mapped class do not exists.');
        }

        $this->class = $class;
    }

    /**
     * Returns the object to map.
     *
     * @return object
     */
    private function createObject()
    {
        return new $this->class();
    }

    /**
     * Add the $object to the elements.
     *
     * @param integer|string $id
     * @param object $object
     *
     * @throws Exception
     */
    private function addElement($id, $object)
    {
        if (array_key_exists($id, $this->elements)) {
            throw new Exception("The value ('9876') for uid ('id') was not unique in data.");
        }

        $this->elements[$id] = $object;
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
