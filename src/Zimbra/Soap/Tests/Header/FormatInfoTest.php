<?php

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
        $info = new FormatInfo(RequestFormat::JS()->value());
        $this->assertSame(RequestFormat::JS()->value(), $info->getFormat());
        $info->setFormat(RequestFormat::XML()->value());
        $this->assertSame(RequestFormat::XML()->value(), $info->getFormat());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<format type="' . RequestFormat::XML() . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));

        $info = $this->serializer->deserialize($xml, 'Zimbra\Soap\Header\FormatInfo', 'xml');
        $this->assertSame(RequestFormat::XML()->value(), $info->getFormat());
    }
}
