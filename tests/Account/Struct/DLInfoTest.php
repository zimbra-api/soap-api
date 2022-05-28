<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

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

        $dl = new DLInfo($id, $ref, $name, $displayName, FALSE, $via, FALSE, FALSE);
        $this->assertSame($ref, $dl->getRef());
        $this->assertSame($displayName, $dl->getDisplayName());
        $this->assertFalse($dl->isDynamic());
        $this->assertSame($via, $dl->getVia());
        $this->assertFalse($dl->isOwner());
        $this->assertFalse($dl->isMember());

        $dl = new DLInfo($id, '', $name, '', FALSE, '', FALSE, FALSE, [new KeyValuePair($key, $value)]);
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
<result name="$name" id="$id" ref="$ref" d="$displayName" dynamic="true" via="$via" isOwner="true" isMember="true">
    <a n="$key">$value</a>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($dl, 'xml'));
        $this->assertEquals($dl, $this->serializer->deserialize($xml, DLInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'ref' => $ref,
            'name' => $name,
            'd' => $displayName,
            'dynamic' => TRUE,
            'via' => $via,
            'isOwner' => TRUE,
            'isMember' => TRUE,
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($dl, 'json'));
        $this->assertEquals($dl, $this->serializer->deserialize($json, DLInfo::class, 'json'));
    }
}
