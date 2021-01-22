<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ContactAttachSpec.
 */
class ContactAttachSpecTest extends ZimbraStructTestCase
{
    public function testContactAttachSpec()
    {
        $id = $this->faker->uuid;

        $spec = new ContactAttachSpec($id);
        $this->assertSame($id, $spec->getId());

        $spec = new ContactAttachSpec('');
        $spec->setId($id)
            ->setOptional(TRUE);
        $this->assertSame($id, $spec->getId());

        $xml = <<<EOT
<?xml version="1.0"?>
<cn id="$id" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, ContactAttachSpec::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'optional' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($spec, 'json'));
        $this->assertEquals($spec, $this->serializer->deserialize($json, ContactAttachSpec::class, 'json'));
    }
}
