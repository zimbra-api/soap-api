<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use JMS\Serializer\Annotation\XmlNamespace;

use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Common\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ComboRights.
 */
class ComboRightsTest extends ZimbraTestCase
{
    public function testComboRights()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;

        $right = new ComboRightInfo(
            $name, RightType::PRESET(), $targetType
        );

        $rights = new StubComboRights([$right]);
        $this->assertSame([$right], $rights->getComboRights());
        $rights->setComboRights([$right])
            ->addComboRight($right);
        $this->assertSame([$right, $right], $rights->getComboRights());
        $rights->setComboRights([$right]);

        $type = RightType::PRESET()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<result xmlns:urn="urn:zimbraAdmin">
    <urn:r n="$name" type="$type" targetType="$targetType" />
</result>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, StubComboRights::class, 'xml'));
    }
}

#[XmlNamespace(uri: 'urn:zimbraAdmin', prefix: 'urn')]
class StubComboRights extends ComboRights
{
}
