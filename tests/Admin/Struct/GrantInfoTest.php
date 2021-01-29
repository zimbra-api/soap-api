<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\GrantInfo;
use Zimbra\Admin\Struct\TypeIdName;
use Zimbra\Admin\Struct\GranteeInfo;
use Zimbra\Admin\Struct\RightModifierInfo;
use Zimbra\Enum\GranteeType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for GrantInfo.
 */
class GrantInfoTest extends ZimbraStructTestCase
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

        $grant = new GrantInfo(
            $target, $grantee, $right
        );
        $this->assertSame($target, $grant->getTarget());
        $this->assertSame($grantee, $grant->getGrantee());
        $this->assertSame($right, $grant->getRight());

        $grant = new GrantInfo(new TypeIdName('', '', ''), new GranteeInfo('', ''), new RightModifierInfo(''));
        $grant->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $grant->getTarget());
        $this->assertSame($grantee, $grant->getGrantee());
        $this->assertSame($right, $grant->getRight());

        $xml = <<<EOT
<?xml version="1.0"?>
<grant>
    <target type="$type" id="$id" name="$name" />
    <grantee id="$id" name="$name" type="usr" />
    <right deny="true" canDelegate="true" disinheritSubGroups="true" subDomain="true">$value</right>
</grant>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($grant, 'xml'));
        $this->assertEquals($grant, $this->serializer->deserialize($xml, GrantInfo::class, 'xml'));

        $json = json_encode([
            'target' => [
                'type' => $type,
                'id' => $id,
                'name' => $name,
            ],
            'grantee' => [
                'id' => $id,
                'name' => $name,
                'type' => 'usr',
            ],
            'right' => [
                'deny' => TRUE,
                'canDelegate' => TRUE,
                'disinheritSubGroups' => TRUE,
                'subDomain' => TRUE,
                '_content' => $value,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($grant, 'json'));
        $this->assertEquals($grant, $this->serializer->deserialize($json, GrantInfo::class, 'json'));
    }
}
