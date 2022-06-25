<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GranteeInfo.
 */
class GranteeInfoTest extends ZimbraTestCase
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

        $xml = <<<EOT
<?xml version="1.0"?>
<result id="$id" name="$name" type="usr" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, GranteeInfo::class, 'xml'));
    }
}
