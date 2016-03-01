<?php

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Tests\ZimbraMailTestCase;
use Zimbra\Mail\Struct\NewContactAttr;

/**
 * Testcase class for NewContactAttr.
 */
class NewContactAttrTest extends ZimbraMailTestCase
{
    public function testNewContactAttr()
    {
        $name = $this->faker->word;
        $value = $this->faker->word;
        $aid = $this->faker->word;
        $part = $this->faker->word;
        $id = mt_rand(1, 10);

        $a = new NewContactAttr(
            $name, $value, $aid, $id, $part
        );
        $this->assertSame($name, $a->getName());
        $this->assertSame($aid, $a->getAttachId());
        $this->assertSame($id, $a->getId());
        $this->assertSame($part, $a->getPart());

        $a = new NewContactAttr('name', $value);
        $a->setName($name)
          ->setAttachId($aid)
          ->setId($id)
          ->setPart($part);
        $this->assertSame($name, $a->getName());
        $this->assertSame($aid, $a->getAttachId());
        $this->assertSame($id, $a->getId());
        $this->assertSame($part, $a->getPart());

        $xml = '<?xml version="1.0"?>' . "\n"
            .'<a n="' . $name . '" aid="' . $aid . '" id="' . $id . '" part="' . $part . '">' . $value . '</a>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $a);

        $array = array(
            'a' => array(
                'n' => $name,
                '_content' => $value,
                'aid' => $aid,
                'id' => $id,
                'part' => $part,
            ),
        );
        $this->assertEquals($array, $a->toArray());
    }
}
