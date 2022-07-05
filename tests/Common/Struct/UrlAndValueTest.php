<?php declare(strict_types=1);

namespace Zimbra\Tests\Common\Struct;

use Zimbra\Common\Struct\UrlAndValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for UrlAndValue.
 */
class UrlAndValueTest extends ZimbraTestCase
{
    public function testUrlAndValue()
    {
        $url = $this->faker->url;
        $value = $this->faker->text;

        $urlValue = new UrlAndValue($url, $value);
        $this->assertSame($url, $urlValue->getUrl());
        $this->assertSame($value, $urlValue->getValue());

        $urlValue = new UrlAndValue();
        $urlValue->setUrl($url)
               ->setValue($value);
        $this->assertSame($url, $urlValue->getUrl());
        $this->assertSame($value, $urlValue->getValue());

        $xml = <<<EOT
<?xml version="1.0"?>
<result url="$url">$value</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($urlValue, 'xml'));
        $this->assertEquals($urlValue, $this->serializer->deserialize($xml, UrlAndValue::class, 'xml'));
    }
}
