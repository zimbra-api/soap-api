<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for GranteeInfo.
 */
class GranteeInfoTest extends ZimbraStructTestCase
{
    public function testGranteeInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;

        $grantee = new GranteeInfo(
            $id, $name, GranteeType::ALL()
        );
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertEquals(GranteeType::ALL(), $grantee->getType());

        $grantee = new GranteeInfo('', '');
        $grantee->setId($id)
                ->setName($name)
                ->setType(GranteeType::USR());
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertEquals(GranteeType::USR(), $grantee->getType());

        $type = GranteeType::USR()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<grantee id="$id" name="$name" type="$type" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeInfo::class, 'xml'));

        $json = json_encode([
            'id' => $id,
            'name' => $name,
            'type' => $type,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grantee, 'json'));
        $this->assertEquals($grantee, $this->serializer->deserialize($json, GranteeInfo::class, 'json'));
    }
}
