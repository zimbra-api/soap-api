<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\ComboRightInfo;
use Zimbra\Enum\RightType;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for ComboRightInfo.
 */
class ComboRightInfoTest extends ZimbraTestCase
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

        $type = RightType::PRESET()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<right n="$name" type="$type" targetType="$targetType" />
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($right, 'xml'));
        $this->assertEquals($right, $this->serializer->deserialize($xml, ComboRightInfo::class, 'xml'));

        $json = json_encode([
            'n' => $name,
            'type' => $type,
            'targetType' => $targetType,
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($right, 'json'));
        $this->assertEquals($right, $this->serializer->deserialize($json, ComboRightInfo::class, 'json'));
    }
}
