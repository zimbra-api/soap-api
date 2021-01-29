<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Enum\RightType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for ComboRights.
 */
class ComboRightsTest extends ZimbraStructTestCase
{
    public function testComboRights()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;

        $right = new ComboRightInfo(
            $name, RightType::PRESET(), $targetType
        );

        $rights = new ComboRights([$right]);
        $this->assertSame([$right], $rights->getComboRights());
        $rights->setComboRights([$right])
            ->addComboRight($right);
        $this->assertSame([$right, $right], $rights->getComboRights());
        $rights->setComboRights([$right]);

        $type = RightType::PRESET()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<rights>
    <r n="$name" type="$type" targetType="$targetType" />
</rights>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, ComboRights::class, 'xml'));

        $json = json_encode([
            'r' => [
                [
                    'n' => $name,
                    'type' => $type,
                    'targetType' => $targetType,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rights, 'json'));
        $this->assertEquals($rights, $this->serializer->deserialize($json, ComboRights::class, 'json'));
    }
}
