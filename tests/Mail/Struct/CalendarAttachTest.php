<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\CalendarAttach;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarAttach.
 */
class CalendarAttachTest extends ZimbraTestCase
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
<result uri="$uri" ct="$contentType">$binaryB64Data</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($attach, 'xml'));
        $this->assertEquals($attach, $this->serializer->deserialize($xml, CalendarAttach::class, 'xml'));
    }
}
