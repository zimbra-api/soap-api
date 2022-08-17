<?php declare(strict_types=1);

namespace Zimbra\Tests\Mail\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Mail\Struct\MailKeyValuePairs;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for MailKeyValuePairs.
 */
class MailKeyValuePairsTest extends ZimbraTestCase
{
    public function testMailKeyValuePairs()
    {
        $key1 = $this->faker->unique->word;
        $key2 = $this->faker->unique->word;
        $value1 = $this->faker->unique->text;
        $value2 = $this->faker->unique->text;

        $kvp1 = new KeyValuePair($key1, $value1);
        $kvp2 = new KeyValuePair($key1, $value2);
        $kvp3 = new KeyValuePair($key2, $value2);

        $kvp = new StubMailKeyValuePairs([$kvp1]);
        $this->assertSame([$kvp1], $kvp->getKeyValuePairs());

        $kvp->setKeyValuePairs([$kvp1, $kvp2])
            ->addKeyValuePair($kvp3);
        $this->assertSame([$kvp1, $kvp2, $kvp3], $kvp->getKeyValuePairs());
        $this->assertSame($value1, $kvp->firstValueForKey($key1));
        $this->assertSame([$value1, $value2], $kvp->valuesForKey($key1));

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraMail">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key1">$value2</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($kvp, 'xml'));
        $this->assertEquals($kvp, $this->serializer->deserialize($xml, StubMailKeyValuePairs::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraMail", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraMail', prefix: "urn")]
class StubMailKeyValuePairs extends MailKeyValuePairs
{
}
