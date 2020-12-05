<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\RightViaInfo;
use Zimbra\Admin\Struct\TargetWithType;
use Zimbra\Admin\Struct\GranteeWithType;
use Zimbra\Admin\Struct\CheckedRight;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for RightViaInfo.
 */
class RightViaInfoTest extends ZimbraStructTestCase
{
    public function testRightViaInfo()
    {
        $type = $this->faker->word;
        $value = $this->faker->word;

        $target = new TargetWithType($type, $value);
        $grantee = new GranteeWithType($type, $value);
        $right = new CheckedRight($value);

        $via = new RightViaInfo($target, $grantee, $right);
        $this->assertSame($target, $via->getTarget());
        $this->assertSame($grantee, $via->getGrantee());
        $this->assertSame($right, $via->getRight());

        $via = new RightViaInfo(new TargetWithType('', ''), new GranteeWithType('', ''), new CheckedRight(''));
        $via->setTarget($target)
            ->setGrantee($grantee)
            ->setRight($right);
        $this->assertSame($target, $via->getTarget());
        $this->assertSame($grantee, $via->getGrantee());
        $this->assertSame($right, $via->getRight());

        $xml = <<<EOT
<?xml version="1.0"?>
<via>
    <target type="$type">$value</target>
    <grantee type="$type">$value</grantee>
    <right>$value</right>
</via>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($via, 'xml'));
        $this->assertEquals($via, $this->serializer->deserialize($xml, RightViaInfo::class, 'xml'));

        $json = json_encode([
            'target' => [
                'type' => $type,
                '_content' => $value,
            ],
            'grantee' => [
                'type' => $type,
                '_content' => $value,
            ],
            'right' => [
                '_content' => $value,
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($via, 'json'));
        $this->assertEquals($via, $this->serializer->deserialize($json, RightViaInfo::class, 'json'));
    }
}
