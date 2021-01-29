<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MsgAttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MsgAttachSpec.
 */
class MsgAttachSpecTest extends ZimbraTestCase
{
    public function testMsgAttachSpec()
    {
        $id = $this->faker->uuid;

        $spec = new MsgAttachSpec($id);
        $this->assertSame($id, $spec->getId());

        $spec = new MsgAttachSpec('');
        $spec->setId($id)
            ->setOptional(TRUE);
        $this->assertSame($id, $spec->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<m id="$id" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, MsgAttachSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'optional' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($spec, 'json'));
        $this->assertEquals($spec, $this->serializer->deserialize($json, MsgAttachSpec::class, 'json'));
    }
}
