<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Admin\Struct\ComboRights;
use Zimbra\Enum\RightType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<rights>'
                . '<r n="' . $name . '" type="' . RightType::PRESET() . '" targetType="' . $targetType . '" />'
            . '</rights>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($rights, 'xml'));
        $this->assertEquals($rights, $this->serializer->deserialize($xml, ComboRights::class, 'xml'));

        $json = json_encode([
            'r' => [
                [
                    'n' => $name,
                    'type' => (string) RightType::PRESET(),
                    'targetType' => $targetType,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($rights, 'json'));
        $this->assertEquals($rights, $this->serializer->deserialize($json, ComboRights::class, 'json'));
    }
}
