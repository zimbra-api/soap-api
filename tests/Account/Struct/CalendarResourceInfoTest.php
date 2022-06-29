<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\CalendarResourceInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CalendarResourceInfo.
 */
class CalendarResourceInfoTest extends ZimbraTestCase
{
    public function testCalendarResourceInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;

        $key1 = $this->faker->word;
        $value1 = $this->faker->word;
        $key2 = $this->faker->word;
        $value2 = $this->faker->word;

        $attr1 = new KeyValuePair($key1, $value1);
        $attr2 = new KeyValuePair($key2, $value2);

        $info = new MockCalendarResourceInfo($name, $id, [$attr1]);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1], $info->getKeyValuePairs());

        $info = new MockCalendarResourceInfo();
        $info->setName($name)
             ->setId($id)
             ->setKeyValuePairs([$attr1])
             ->addKeyValuePair($attr2);
        $this->assertSame($name, $info->getName());
        $this->assertSame($id, $info->getId());
        $this->assertSame([$attr1, $attr2], $info->getKeyValuePairs());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$key1">$value1</urn:a>
    <urn:a n="$key2">$value2</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($info, 'xml'));
        $this->assertEquals($info, $this->serializer->deserialize($xml, MockCalendarResourceInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockCalendarResourceInfo extends CalendarResourceInfo
{
}
