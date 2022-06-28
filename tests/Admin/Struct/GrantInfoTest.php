<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\GrantInfo;
use Zimbra\Admin\Struct\TypeIdName;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Common\Enum\GranteeType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for GrantInfo.
 */
class GrantInfoTest extends ZimbraTestCase
{
    public function testGrantInfo()
    {
        $type = $this->faker->word;
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $value = $this->faker->word;

        $target = new TypeIdName(
            $type, $id, $name
        );
        $grantee = new GranteeInfo(
            $id, $name, GranteeType::USR()
        );
        $right = new RightModifierInfo($value, TRUE, TRUE, TRUE, TRUE);

        $grant = new StubGrantInfo(
            $target, $grantee, $right
        );
        $this->assertSame($target, $grant->getTarget());
        $this->assertSame($grantee, $grant->getGrantee());
        $this->assertSame($right, $grant->getRight());

        $grant = new StubGrantInfo(new TypeIdName(), new GranteeInfo(), new RightModifierInfo());
        $grant->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $grant->getTarget());
        $this->assertSame($grantee, $grant->getGrantee());
        $this->assertSame($right, $grant->getRight());

        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:target type="$type" id="$id" name="$name" />
    <urn:grantee id="$id" name="$name" type="usr" />
    <urn:right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</urn:right>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grant, 'xml'));
        $this->assertEquals($grant, $this->serializer->deserialize($xml, StubGrantInfo::class, 'xml'));
    }
}

/**
 * @XmlNamespace(uri="urn:zimbraAdmin", prefix="urn")
 */
class StubGrantInfo extends GrantInfo
{
}
