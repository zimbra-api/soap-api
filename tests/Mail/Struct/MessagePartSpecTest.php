<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MessagePartSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MessagePartSpecTest.
 */
class MessagePartSpecTest extends ZimbraTestCase
{
    public function testMessagePartSpec()
    {
        $part = $this->faker->uuid;
        $id = $this->faker->uuid;

        $spec = new MessagePartSpec(
            $part, $id
        );
        $this->assertSame($part, $spec->getPart());
        $this->assertSame($id, $spec->getId());

        $spec = new MessagePartSpec();
        $spec->setPart($part)
            ->setId($id);
        $this->assertSame($part, $spec->getPart());
        $this->assertSame($id, $spec->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<result part="$part" id="$id" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, MessagePartSpec::class, 'xml'));
    }
}
