<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MimePartAttachSpec.
 */
class MimePartAttachSpecTest extends ZimbraTestCase
{
    public function testMimePartAttachSpec()
    {
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;

        $spec = new MimePartAttachSpec($messageId, $part);
        $this->assertSame($messageId, $spec->getMessageId());
        $this->assertSame($part, $spec->getPart());

        $spec = new MimePartAttachSpec('', '');
        $spec->setMessageId($messageId)
            ->setPart($part)
            ->setOptional(TRUE);
        $this->assertSame($messageId, $spec->getMessageId());
        $this->assertSame($part, $spec->getPart());

        $xml = <<<EOT
<?xml version="1.0"?>
<result mid="$messageId" part="$part" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, MimePartAttachSpec::class, 'xml'));
    }
}
