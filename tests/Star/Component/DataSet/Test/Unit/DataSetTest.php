<?php
/**
 * This file is part of the Dataset.
 * 
 * (c) Yannick Voyer (http://github.com/yvoyer)
 */

namespace Star\Component\DataSet\Test\Unit;

use Star\Component\DataSet\DataSet;
use Star\Component\DataSet\Mapping\MapperInterface;

/**
 * Class DataSetTest
 *
 * @author  Yannick Voyer (http://github.com/yvoyer)
 *
 * @package Star\Component\DataSet\Test\Unit
 */
class DataSetTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @param array           $data
     * @param MapperInterface $mapping
     *
     * @return DataSet
     */
    private function getDataSet(array $data = array(), MapperInterface $mapping = null)
    {
        $mapping = $this->getMockMapping($mapping);

        return new DataSet($data, $mapping);
    }

    /**
     * @param MapperInterface $mapper
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|MapperInterface
     */
    private function getMockMapping(MapperInterface $mapper = null)
    {
        if (null === $mapper) {
            $mapper = $this->getMock('Star\Component\DataSet\Mapping\MapperInterface');
        }

        return $mapper;
    }

    /**
     * @param MapperInterface $mapper
     *
     * @return \PHPUnit_Framework_MockObject_MockObject|MapperInterface
     */
    private function getMockMappingExpectsValidClass(MapperInterface $mapper = null)
    {
        $mapper = $this->getMockMapping($mapper);
        $mapper
            ->expects($this->once())
            ->method('getClass')
            ->will($this->returnValue('Star\Component\DataSet\Stub\Blog\Entity\Tag'));

        return $mapper;
    }

    /**
     * @expectedException        \Star\Component\DataSet\Exception\MappingException
     * @expectedExceptionMessage The mapped class do not exists.
     */
    public function testShouldThrowExceptionWhenInvalidClassSuppliedByMapper()
    {
        $this->getDataSet();
    }

    public function testShouldReturnEmptyArrayWhenDataEmpty()
    {
        $mapper = $this->getMockMappingExpectsValidClass();

        $this->assertEmpty($this->getDataSet(array(), $mapper)->toArray());
    }

    public function testShouldReturnEmptyArrayWhenMappingNameNotPresentInData()
    {
        $mapper = $this->getMockMappingExpectsValidClass();
        $mapper
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('index'));

        $dataSet = $this->getDataSet(array('index' => array()), $mapper);
        $this->assertEmpty($dataSet->toArray());
    }

    /**
     * @expectedException        \Star\Component\DataSet\Exception\MappingException
     * @expectedExceptionMessage The mapping name is invalid for the data.
     */
    public function testShouldThrowExceptionWhenInvalidMappingNameWithNotEmptyData()
    {
        $mapper = $this->getMockMappingExpectsValidClass();

        $dataSet = $this->getDataSet(array('index' => array()), $mapper);
        $this->assertEmpty($dataSet->toArray());
    }

    public function testShouldAddTheElementBasedOnMappingUIdColumn()
    {
        $uid    = uniqid();
        $mapper = $this->getMockMappingExpectsValidClass();
        $mapper
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('index'));
        $mapper
            ->expects($this->once())
            ->method('getUniqueFieldName')
            ->will($this->returnValue($uid));

        $data = array(
            'index' => array(
                array(
                    'name' => 1234,
                    $uid   => 9876,
                ),
            ),
        );
        $dataSet    = $this->getDataSet($data, $mapper);
        $arrayValue = $dataSet->toArray();

        $this->assertNotEmpty($arrayValue);
        $this->assertTrue(array_key_exists(9876, $arrayValue), 'The uid key should exists');
        $this->assertTrue(is_object($arrayValue[9876]), 'The value at uid key should be object');
    }

    /**
     * @expectedException        \Star\Component\DataSet\Exception\MappingException
     * @expectedExceptionMessage The uid index could not be found in data.
     */
    public function testShouldThrowExceptionWhenUidCouldNotBeFoundInData()
    {
        $mapper = $this->getMockMappingExpectsValidClass();
        $mapper
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('index'));

        $data = array(
            'index' => array(
                array(
                    'name' => 1234,
                    'id'   => 9876,
                ),
            ),
        );
        $this->getDataSet($data, $mapper);
    }

    /**
     * @expectedException        \Star\Component\DataSet\Exception\Exception
     * @expectedExceptionMessage The value ('9876') for uid ('id') was not unique in data.
     */
    public function testShouldThrowExceptionWhenDataContainsSameValueForUidColumn()
    {
        $mapper = $this->getMockMappingExpectsValidClass();
        $mapper
            ->expects($this->once())
            ->method('getName')
            ->will($this->returnValue('index'));
        $mapper
            ->expects($this->once())
            ->method('getUniqueFieldName')
            ->will($this->returnValue('id'));

        $data = array(
            'index' => array(
                array(
                    'name' => 'First occurrence of id',
                    'id'   => 9876,
                ),
                array(
                    'name' => 'Second occurrence of id',
                    'id'   => 9876,
                ),
            ),
        );
        $this->getDataSet($data, $mapper);
    }
}
