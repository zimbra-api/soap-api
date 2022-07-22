<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Soap\Header;

use Zimbra\Common\Enum\RequestFormat;
use Zimbra\Common\Soap\Header\FormatInfo;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for FormatInfo.
 */
class FormatInfoTest extends ZimbraTestCase
{
    public function testHeaderFormatInfo()
    {
        $info = new FormatInfo(RequestFormat::JS());
        $this->assertEquals(RequestFormat::JS(), $info->getFormat());
        $info->setFormat(RequestFormat::XML());
        $this->assertEquals(RequestFormat::XML(), $info->getFormat());

        $requestFormat = RequestFormat::XML()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result type="$requestFormat" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, FormatInfo::class, 'xml'));
    }
}
