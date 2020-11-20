<?php declare(strict_types=1);

namespace Zimbra\Soap\Tests\Header;

use Zimbra\Enum\RequestFormat;
use Zimbra\Soap\Header\FormatInfo;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for FormatInfo.
 */
class FormatInfoTest extends ZimbraStructTestCase
{
    public function testHeaderFormatInfo()
    {
        $info = new FormatInfo(RequestFormat::JS());
        $this->assertEquals(RequestFormat::JS(), $info->getFormat());
        $info->setFormat(RequestFormat::XML());
        $this->assertEquals(RequestFormat::XML(), $info->getFormat());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<format type="' . RequestFormat::XML() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, FormatInfo::class, 'xml'));

        $json = json_encode([
            'type' => (string) RequestFormat::XML(),
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($info, 'json'));
        $this->assertEquals($info, $this->serializer->deserialize($json, FormatInfo::class, 'json'));
    }
}
