<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\ContactAttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ContactAttachSpec.
 */
class ContactAttachSpecTest extends ZimbraTestCase
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
<result id="$id" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, ContactAttachSpec::class, 'xml'));
    }
}
