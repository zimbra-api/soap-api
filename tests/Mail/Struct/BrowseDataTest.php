<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use Zimbra\Mail\Struct\BrowseData;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BrowseData.
 */
class BrowseDataTest extends ZimbraTestCase
{
    public function testBrowseData()
    {
        $browseDomainHeader = $this->faker->word;
        $frequency = $this->faker->randomNumber;
        $data = $this->faker->text;

        $bd = new BrowseData($browseDomainHeader, $frequency, $data);
        $this->assertSame($browseDomainHeader, $bd->getBrowseDomainHeader());
        $this->assertSame($frequency, $bd->getFrequency());
        $this->assertSame($data, $bd->getData());

        $bd = new BrowseData();
        $bd->setBrowseDomainHeader($browseDomainHeader)
            ->setFrequency($frequency)
            ->setData($data);
        $this->assertSame($browseDomainHeader, $bd->getBrowseDomainHeader());
        $this->assertSame($frequency, $bd->getFrequency());
        $this->assertSame($data, $bd->getData());

        $xml = <<<EOT
<?xml version="1.0"?>
<result h="$browseDomainHeader" freq="$frequency">$data</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($bd, 'xml'));
        $this->assertEquals($bd, $this->serializer->deserialize($xml, BrowseData::class, 'xml'));
    }
}
