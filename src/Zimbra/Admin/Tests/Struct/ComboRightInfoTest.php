<?php declare(strict_types=1);

namespace Zimbra\Admin\Tests\Struct;

use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Enum\RightType;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for ComboRightInfo.
 */
class ComboRightInfoTest extends ZimbraStructTestCase
{
    public function testComboRightInfo()
    {
        $name = $this->faker->word;
        $targetType = $this->faker->word;

        $right = new ComboRightInfo(
            $name, RightType::COMBO(), $targetType
        );
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::COMBO(), $right->getType());
        $this->assertSame($targetType, $right->getTargetType());

        $right = new ComboRightInfo('', RightType::COMBO());
        $right->setName($name)
            ->setType(RightType::PRESET())
            ->setTargetType($targetType);
        $this->assertSame($name, $right->getName());
        $this->assertEquals(RightType::PRESET(), $right->getType());
        $this->assertSame($targetType, $right->getTargetType());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<right n="' . $name . '" type="' . RightType::PRESET() . '" targetType="' . $targetType . '" />';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, ComboRightInfo::class, 'xml'));

        $json = json_encode([
            'n' => $name,
            'type' => (string) RightType::PRESET(),
            'targetType' => $targetType,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, ComboRightInfo::class, 'json'));
    }
}
