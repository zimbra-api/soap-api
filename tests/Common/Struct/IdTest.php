<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\Id;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for Id.
 */
class IdTest extends ZimbraTestCase
{
    public function testId()
    {
        $value = $this->faker->uuid;

        $id = new Id($value);
        $this->assertSame($value, $id->getId());

        $id = new Id();
        $id->setId($value);
        $this->assertSame($value, $id->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$value" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($id, 'xml'));
        $this->assertEquals($id, $this->serializer->deserialize($xml, Id::class, 'xml'));
    }
}
