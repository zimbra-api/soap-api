<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\ModifyContactAttr;

/**
 * Testcase class for ModifyContactAttr.
 */
class ModifyContactAttrTest extends ZimbraMailTestCase
{
    public function testModifyContactAttr()
    {
        $id = mt_rand(1, 10);
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->uuid;
        $part = $this->faker->word;
        $op = $this->faker->word;

        $a = new ModifyContactAttr(
            $name, $value, $aid, $id, $part, $op
        );
        $this->assertSame($name, $a->getName());
        $this->assertSame($aid, $a->getAttachId());
        $this->assertSame($id, $a->getId());
        $this->assertSame($part, $a->getPart());
        $this->assertSame($op, $a->getOperation());

        $a->setName($name)
          ->setAttachId($aid)
          ->setId($id)
          ->setPart($part)
          ->setOperation($op);
        $this->assertSame($name, $a->getName());
        $this->assertSame($aid, $a->getAttachId());
        $this->assertSame($id, $a->getId());
        $this->assertSame($part, $a->getPart());
        $this->assertSame($op, $a->getOperation());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '" op="' . $op . '">' . $value . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => $name,
                '_content' => $value,
                'aid' => $aid,
                'id' => $id,
                'part' => $part,
                'op' => $op,
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }
}
