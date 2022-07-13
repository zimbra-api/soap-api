<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\SuggestedQueryString;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for SuggestedQueryString.
 */
class SuggestedQueryStringTest extends ZimbraTestCase
{
    public function testSuggestedQueryString()
    {
        $string = $this->faker->word;

        $suggest = new SuggestedQueryString($string);
        $this->assertSame($string, $suggest->getSuggestedQueryString());

        $suggest = new SuggestedQueryString();
        $suggest->setSuggestedQueryString($string);
        $this->assertSame($string, $suggest->getSuggestedQueryString());

        $xml = <<<EOT
<?xml version="1.0"?>
<result>$string</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($suggest, 'xml'));
        $this->assertEquals($suggest, $this->serializer->deserialize($xml, SuggestedQueryString::class, 'xml'));
    }
}
