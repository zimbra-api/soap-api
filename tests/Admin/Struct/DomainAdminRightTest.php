<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\DomainAdminRight;
use Zimbra\Admin\Struct\RightWithName;
use Zimbra\Common\Enum\RightType;
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

        $right = new StubDomainAdminRight($name, RightType::PRESET(), $desc, [$r]);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame([$r], $right->getRights());

        $right = new StubDomainAdminRight();
        $right->setName($name)
            ->setType(RightType::PRESET())
            ->setDesc($desc)
            ->setRights([$r]);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertSame($desc, $right->getDesc());
        $this->assertSame([$r], $right->getRights());

        $xml = <<<EOT
<?xml version="1.0"?>
<result name="$name" type="preset" xmlns:urn="urn:zimbraAdmin">
    <urn:desc>$desc</urn:desc>
    <urn:rights>
        <urn:r n="$name" />
    </urn:rights>
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, StubDomainAdminRight::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubDomainAdminRight extends DomainAdminRight
{
}
