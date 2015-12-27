<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Common\TypedMap;

/**
 * Testcase class for typed map.
 */
class TypedMapTest extends PHPUnit_Framework_TestCase
{
    public function testTypedMap()
    {
        $object1 = new \ArrayObject([1,2,3]);
        $object2 = new \ArrayObject([3,2,1]);

        $map = new TypedMap('\ArrayObject', ['object' => $object1]);
        $this->assertSame($object1, $map->get('object')->get());

        $map->set('object', $object2);
        $this->assertSame($object2, $map->get('object')->get());

        $map->setAll(['object1' => $object1, 'object2' => $object2]);
        $this->assertSame($object1, $map->get('object1')->get());
        $this->assertSame($object2, $map->get('object2')->get());
    }
}
