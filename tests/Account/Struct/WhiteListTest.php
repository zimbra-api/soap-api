<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\WhiteList;
use Zimbra\Common\Struct\OpValue;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for WhiteList.
 */
class WhiteListTest extends ZimbraTestCase
{
    public function testWhiteList()
    {
        $value = $this->faker->word;

        $addr1 = new OpValue('+', $value);
        $addr2 = new OpValue('-', $value);

        $whiteList = new MockWhiteList([$addr1]);
        $this->assertSame([$addr1], $whiteList->getAddrs());

        $whiteList->addAddr($addr2);
        $this->assertSame([$addr1, $addr2], $whiteList->getAddrs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAccount">
    <urn:addr op="+">$value</urn:addr>
    <urn:addr op="-">$value</urn:addr>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($whiteList, 'xml'));
        $this->assertEquals($whiteList, $this->serializer->deserialize($xml, MockWhiteList::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockWhiteList extends WhiteList
{
}
