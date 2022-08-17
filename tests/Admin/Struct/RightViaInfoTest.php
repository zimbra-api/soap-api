<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;
use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for RightViaInfo.
 */
class RightViaInfoTest extends ZimbraTestCase
{
    public function testRightViaInfo()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;

        $target = new TargetWithType($type, $value);
        $grantee = new GranteeWithType($type, $value);
        $right = new CheckedRight($value);

        $via = new StubRightViaInfo($target, $grantee, $right);
        $this->assertSame($target, $via->getTarget());
        $this->assertSame($grantee, $via->getGrantee());
        $this->assertSame($right, $via->getRight());

        $via = new StubRightViaInfo(new TargetWithType(), new GranteeWithType(), new CheckedRight());
        $via->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $via->getTarget());
        $this->assertSame($grantee, $via->getGrantee());
        $this->assertSame($right, $via->getRight());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:target type="$type">$value</urn:target>
    <urn:grantee type="$type">$value</urn:grantee>
    <urn:right>$value</urn:right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($via, 'xml'));
        $this->assertEquals($via, $this->serializer->deserialize($xml, StubRightViaInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: "urn")]
class StubRightViaInfo extends RightViaInfo
{
}
