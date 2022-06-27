<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Account\Struct\DLInfo;
use Zimbra\Common\Struct\KeyValuePair;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DLInfo.
 */
class DLInfoTest extends ZimbraTestCase
{
    public function testDLInfo()
    {
        $id = $this->faker->uuid;
        $ref = $this->faker->word;
        $name = $this->faker->word;
        $displayName = $this->faker->word;
        $via = $this->faker->word;
        $key = $this->faker->word;
        $value = $this->faker->word;

        $dl = new MockDLInfo($id, $ref, $name, $displayName, FALSE, $via, FALSE, FALSE);
        $this->assertSame($ref, $dl->getRef());
        $this->assertSame($displayName, $dl->getDisplayName());
        $this->assertFalse($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());
        $this->assertFalse($dl->isOwner());
        $this->assertFalse($dl->isMember());

        $dl = new MockDLInfo($id, '', $name, '', FALSE, '', FALSE, FALSE, [new KeyValuePair($key, $value)]);
        $dl->setRef($ref)
            ->setDisplayName($displayName)
            ->setDynamic(TRUE)
            ->setVia($via)
            ->setIsOwner(TRUE)
            ->setIsMember(TRUE);
        $this->assertSame($ref, $dl->getRef());
        $this->assertSame($displayName, $dl->getDisplayName());
        $this->assertTrue($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());
        $this->assertTrue($dl->isOwner());
        $this->assertTrue($dl->isMember());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true" xmlns:urn="urn:zimbraAccount">
    <urn:a n="$key">$value</urn:a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, MockDLInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
class MockDLInfo extends DLInfo
{
}
