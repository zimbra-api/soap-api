<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\MimePartAttachSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for MimePartAttachSpec.
 */
class MimePartAttachSpecTest extends ZimbraStructTestCase
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
<mp mid="$messageId" part="$part" optional="true" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($spec, 'xml'));
        $this->assertEquals($spec, $this->serializer->deserialize($xml, MimePartAttachSpec::class, 'xml'));

        $json = json_encode([
            'mid' => $messageId,
            'part' => $part,
            'optional' => TRUE,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($spec, 'json'));
        $this->assertEquals($spec, $this->serializer->deserialize($json, MimePartAttachSpec::class, 'json'));
    }
}
