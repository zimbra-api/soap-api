<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Common\Enum\DistributionListGranteeBy as DLGranteeBy;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Account\Struct\DistributionListGranteeSelector;
use Zimbra\Account\Struct\DistributionListRightSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DistributionListRightSpec.
 */
class DistributionListRightSpecTest extends ZimbraTestCase
{
    public function testDistributionListRightSpec()
    {
        $name = $this->faker->word;
        $value1 = $this->faker->word;
        $value2 = $this->faker->word;
        $grantee1 = new DistributionListGranteeSelector(GranteeType::ALL(), DLGranteeBy::NAME(), $value1);
        $grantee2 = new DistributionListGranteeSelector(GranteeType::USR(), DLGranteeBy::ID(), $value2);

        $right = new MockDistributionListRightSpec($name, [$grantee1]);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1], $right->getGrantees());

        $right = new MockDistributionListRightSpec();
        $right->setRight($name)
              ->setGrantees([$grantee1])
              ->addGrantee($grantee2);
        $this->assertSame($name, $right->getRight());
        $this->assertSame([$grantee1, $grantee2], $right->getGrantees());

        $typeAll = GranteeType::ALL()->getValue();
        $typeUsr = GranteeType::USR()->getValue();
        $byName = DLGranteeBy::NAME()->getValue();
        $byId = DLGranteeBy::ID()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result right="$name" xmlns:urn="urn:zimbraAccount">
    <urn:grantee type="$typeAll" by="$byName">$value1</urn:grantee>
    <urn:grantee type="$typeUsr" by="$byId">$value2</urn:grantee>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, MockDistributionListRightSpec::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAccount", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAccount', prefix: "urn")]
class MockDistributionListRightSpec extends DistributionListRightSpec
{
}
