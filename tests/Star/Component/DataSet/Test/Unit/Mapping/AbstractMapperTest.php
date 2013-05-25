<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Test\Unit\Mapping;

/**
 * Class AbstractMapperTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Test\Unit\Mapping
 */
class AbstractMapperTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \PHPUnit_Framework_MockObject_MockObject|\Star\Component\DataSet\Mapping\AbstractMapper
     */
    private $mapper;

    public function setUp()
    {
        $this->mapper = $this->getMockForAbstractClass('Star\Component\DataSet\Mapping\AbstractMapper');
    }

    public function testShouldPopulateObject()
    {
        $value = uniqid();

        $this->mapper
            ->expects($this->once())
            ->method('getMapping')
            ->will($this->returnValue(array('id' => 'setId')));

        $object = $this->getMock('\stdClass', array('setId'));
        $object
            ->expects($this->once())
            ->method('setId')
            ->with($value);

        $this->mapper->populate($object, 'id', $value);
    }
}
