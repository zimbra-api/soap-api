<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\BlackList;
use Zimbra\Common\Struct\OpValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for BlackList.
 */
class BlackListTest extends ZimbraTestCase
{
    public function testBlackList()
    {
        $value1 = $this->faker->word;
        $addr1 = new OpValue('+', $value1);

        $blackList = new MockBlackList([$addr1]);
        $this->assertSame([$addr1], $blackList->getAddrs());

        $value2 = $this->faker->word;
        $addr2 = new OpValue('-', $value2);

        $blackList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $blackList->getAddrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAccount">
    <urn:addr op="+">$value1</urn:addr>
    <urn:addr op="-">$value2</urn:addr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($blackList, 'xml'));
        $this->assertEquals($blackList, $this->serializer->deserialize($xml, MockBlackList::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: 'urn')]
class MockBlackList extends BlackList
{
}
