<?php declare(strict_types=1);

namespace Zimbra\Mail\Tests\Struct;

use Zimbra\Mail\Struct\CalendarAttach;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CalendarAttach.
 */
class CalendarAttachTest extends ZimbraStructTestCase
{
    public function testCalendarAttach()
    {
        $uri = $this->faker->url;
        $contentType = $this->faker->mimeType;
        $binaryB64Data = base64_encode($this->faker->text);

        $attach = new CalendarAttach($uri, $contentType, $binaryB64Data);
        $this->assertSame($uri, $attach->getUri());
        $this->assertSame($contentType, $attach->getContentType());
        $this->assertSame($binaryB64Data, $attach->getBinaryB64Data());

        $attach = new CalendarAttach();
        $attach->setUri($uri)
            ->setContentType($contentType)
            ->setBinaryB64Data($binaryB64Data);
        $this->assertSame($uri, $attach->getUri());
        $this->assertSame($contentType, $attach->getContentType());
        $this->assertSame($binaryB64Data, $attach->getBinaryB64Data());

        $xml = <<<EOT
<?xml version="1.0"?>
<attach uri="$uri" ct="$contentType">$binaryB64Data</attach>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attach, 'xml'));
        $this->assertEquals($attach, $this->serializer->deserialize($xml, CalendarAttach::class, 'xml'));

        $json = json_encode([
            'uri' => $uri,
            'ct' => $contentType,
            '_content' => $binaryB64Data,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($attach, 'json'));
        $this->assertEquals($attach, $this->serializer->deserialize($json, CalendarAttach::class, 'json'));
    }
}
