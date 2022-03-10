<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\DomainAdminRight;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for DomainAdminRight.
 */
class DomainAdminRightTest extends ZimbraTestCase
{
    public function testDomainAdminRight()
    {
        $name = $this->faker->word;
        $desc = $this->faker->word;

        $r = new RightWithName($name);

        $right = new DomainAdminRight($name, RightType::PRESET(), $desc, [$r]);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame([$r], $right->getRights());

        $right = new DomainAdminRight('', RightType::COMBO(), '');
        $right->setName($name)
            ->setType(RightType::PRESET())
            ->setDesc($desc)
            ->setRights([$r])
            ->addRight($r);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame([$r, $r], $right->getRights());
        $right->setRights([$r]);

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" type="preset">
    <desc>$desc</desc>
    <rights>
        <r n="$name" />
    </rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, DomainAdminRight::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'type' => 'preset',
            'desc' => [
                '_content' => $desc,
            ],
            'rights' => [
                'r' => [
                    [
                        'n' => $name,
                    ],
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, DomainAdminRight::class, 'json'));
    }
}
