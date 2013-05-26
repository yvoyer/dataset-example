<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Test\Unit\Mapping;

use Star\Component\DataSet\Mapping\Mapper;

/**
 * Class MapperTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Test\Unit\Mapping
 */
class MapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param string $name
     * @param string $class
     * @param string $uniqueFieldName
     *
     * @return Mapper
     */
    public function getMapper($name = null, $class = null, $uniqueFieldName = null)
    {
        return new Mapper($name, $class, $uniqueFieldName);
    }

    public function testShouldPopulateObject()
    {
        $value  = uniqid();
        $mapper = $this->getMapper();
        $mapper->addMap('id', 'setId');

        $object = $this->getMock('\stdClass', array('setId'));
        $object
            ->expects($this->once())
            ->method('setId')
            ->with($value);

        $mapper->populate($object, 'id', $value);
    }
}
