<?php

namespace Zimbra\Struct\Tests;

use Zimbra\Struct\Id;

/**
 * Testcase class for Id.
 */
class IdTest extends ZimbraStructTestCase
{
    public function testId()
    {
        $value = $this->faker->uuid;

        $id = new Id($value);
        $this->assertSame($value, $id->getId());

        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<id id="' . $value . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($id, 'xml'));

        $id = $this->serializer->deserialize($xml, 'Zimbra\Struct\Id', 'xml');
        $this->assertSame($value, $id->getId());
    }
}
