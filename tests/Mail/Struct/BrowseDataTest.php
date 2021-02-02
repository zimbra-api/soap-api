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

        $bd = new BrowseData('', 0);
        $bd->setBrowseDomainHeader($browseDomainHeader)
            ->setFrequency($frequency)
            ->setData($data);
        $this->assertSame($browseDomainHeader, $bd->getBrowseDomainHeader());
        $this->assertSame($frequency, $bd->getFrequency());
        $this->assertSame($data, $bd->getData());

        $xml = <<<EOT
<?xml version="1.0"?>
<bd h="$browseDomainHeader" freq="$frequency">$data</bd>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($bd, 'xml'));
        $this->assertEquals($bd, $this->serializer->deserialize($xml, BrowseData::class, 'xml'));

        $json = json_encode([
            'h' => $browseDomainHeader,
            'freq' => $frequency,
            '_content' => $data,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($bd, 'json'));
        $this->assertEquals($bd, $this->serializer->deserialize($json, BrowseData::class, 'json'));
    }
}
