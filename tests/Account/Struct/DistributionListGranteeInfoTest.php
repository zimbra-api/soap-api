<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Account\Struct\DistributionListGranteeInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListGranteeInfo.
 */
class DistributionListGranteeInfoTest extends ZimbraTestCase
{
    public function testDistributionListGranteeInfo()
    {
        $id = $this->faker->uuid;
        $name = $this->faker->word;
        $type = GranteeType::USR();

        $grantee = new DistributionListGranteeInfo(
            $type, $id, $name
        );
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertSame($type, $grantee->getType());

        $grantee = new DistributionListGranteeInfo();
        $grantee->setId($id)
                ->setName($name)
                ->setType($type);
        $this->assertSame($id, $grantee->getId());
        $this->assertSame($name, $grantee->getName());
        $this->assertSame($type, $grantee->getType());

        $xml = <<<EOT
<?xml version="1.0"?>
<result type="usr" id="$id" name="$name" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grantee, 'xml'));
        $this->assertEquals($grantee, $this->serializer->deserialize($xml, DistributionListGranteeInfo::class, 'xml'));
    }
}
