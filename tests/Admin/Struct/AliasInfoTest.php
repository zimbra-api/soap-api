<?php declare(strict_types=1);

namespace Zimbra\Tests\Admin\Struct;

use Zimbra\Admin\Struct\AliasInfo;
use Zimbra\Admin\Struct\Attr;
use Zimbra\Enum\TargetType;
use Zimbra\Tests\Struct\ZimbraStructTestCase;

/**
 * Testcase class for AliasInfo.
 */
class AliasInfoTest extends ZimbraStructTestCase
{
    public function testAliasInfo()
    {
        $name = $this->faker->word;
        $id = $this->faker->uuid;
        $key = $this->faker->word;
        $value = $this->faker->word;
        $targetName = $this->faker->word;
        $targetType = TargetType::ACCOUNT();

        $alias = new AliasInfo($name, $id, $targetName, $targetType);
        $this->assertSame($targetName, $alias->getTargetName());
        $this->assertSame($targetType, $alias->getTargetTyoe());

        $alias = new AliasInfo($name, $id, '', TargetType::ACCOUNT(), [new Attr($key, $value)]);
        $alias->setTargetName($targetName)
            ->setTargetTyoe($targetType);
        $this->assertSame($targetName, $alias->getTargetName());
        $this->assertSame($targetType, $alias->getTargetTyoe());

        $xml = <<<EOT
<?xml version="1.0"?>
<alias name="$name" id="$id" targetName="$targetName" type="$targetType">
    <a n="$key">$value</a>
</alias>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($alias, 'xml'));
        $this->assertEquals($alias, $this->serializer->deserialize($xml, AliasInfo::class, 'xml'));

        $json = json_encode([
            'name' => $name,
            'id' => $id,
            'targetName' => $targetName,
            'type' => $targetType->getValue(),
            'a' => [
                [
                    'n' => $key,
                    '_content' => $value,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($alias, 'json'));
        $this->assertEquals($alias, $this->serializer->deserialize($json, AliasInfo::class, 'json'));
    }
}
