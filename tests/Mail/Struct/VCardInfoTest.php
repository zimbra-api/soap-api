<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\VCardInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for VCardInfo.
 */
class VCardInfoTest extends ZimbraTestCase
{
    public function testVCardInfo()
    {
        $messageId = $this->faker->uuid;
        $part = $this->faker->word;
        $attachId = $this->faker->uuid;
        $value = $this->faker->text;

        $vcard = new VCardInfo($messageId, $part, $attachId, $value);
        $this->assertSame($messageId, $vcard->getMessageId());
        $this->assertSame($part, $vcard->getPart());
        $this->assertSame($attachId, $vcard->getAttachId());
        $this->assertSame($value, $vcard->getValue());

        $vcard = new VCardInfo();
        $vcard->setMessageId($messageId)
            ->setPart($part)
            ->setAttachId($attachId)
            ->setValue($value);
        $this->assertSame($messageId, $vcard->getMessageId());
        $this->assertSame($part, $vcard->getPart());
        $this->assertSame($attachId, $vcard->getAttachId());
        $this->assertSame($value, $vcard->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<vcard mid="$messageId" part="$part" aid="$attachId">$value</vcard>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($vcard, 'xml'));
        $this->assertEquals($vcard, $this->serializer->deserialize($xml, VCardInfo::class, 'xml'));

        $json = json_encode([
            'mid' => $messageId,
            'part' => $part,
            'aid' => $attachId,
            '_content' => $value,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($vcard, 'json'));
        $this->assertEquals($vcard, $this->serializer->deserialize($json, VCardInfo::class, 'json'));
    }
}
