<?php

namespace Zimbra\Common\Tests;

use \PHPUnit_Framework_TestCase;
use Zimbra\Common\TypedSequence;

/**
 * Testcase class for typed sequence.
 */
class TypedSequenceTest extends PHPUnit_Framework_TestCase
{
    public function testTypedSequence()
    {
        $object1 = new \ArrayObject([1,2,3]);
        $object2 = new \ArrayObject([3,2,1]);
        $sequence = new TypedSequence('\ArrayObject', [$object1]);

        $this->assertSame([$object1], $sequence->all());

        $sequence->add($object2);
        $this->assertSame([$object1, $object2], $sequence->all());

        $sequence->update(0, $object2)->update(1, $object1);
        $this->assertSame([$object2, $object1], $sequence->all());

        $sequence = new TypedSequence('\ArrayObject');
        $sequence->addAll([$object1, $object2]);
        $this->assertSame([$object1, $object2], $sequence->all());

        $sequence->removeElement($object2);
        $this->assertSame([$object1], $sequence->all());
    }
}
