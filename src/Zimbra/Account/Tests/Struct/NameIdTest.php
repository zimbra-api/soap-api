<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Account\Struct\NameId;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for NameId.
 */
class NameIdTest extends ZimbraStructTestCase
{
    public function testNameId()
    {
        $name = $this->faker->word;
        $id = $this->faker->word;

        $nameId = new NameId($name, $id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $nameId = new NameId('', '');
        $nameId->setName($name)
               ->setId($id);
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<nameid name="' . $name . '" id="' . $id . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($nameId, 'xml'));

        $nameId = $this->serializer->deserialize($xml, 'Zimbra\Account\Struct\NameId', 'xml');
        $this->assertSame($name, $nameId->getName());
        $this->assertSame($id, $nameId->getId());
    }
}
