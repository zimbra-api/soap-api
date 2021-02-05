<?php declare(strict_types=1);

namespace Zimbra\Tests\Account\Struct;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Tests\ZimbraTestCase;

/**
 * Testcase class for CheckRightsTargetSpec.
 */
class CheckRightsTargetSpecTest extends ZimbraTestCase
{
    public function testCheckRightsTargetSpec()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->unique()->word;
        $right2 = $this->faker->unique()->word;
        $right3 = $this->faker->unique()->word;

        $target = new CheckRightsTargetSpec(
            TargetType::DOMAIN(), TargetBy::ID(), $key, [$right1, $right2]
        );
        $this->assertEquals(TargetType::DOMAIN(), $target->getTargetType());
        $this->assertEquals(TargetBy::ID(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2], $target->getRights());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->addRight($right3);

        $this->assertEquals(TargetType::ACCOUNT(), $target->getTargetType());
        $this->assertEquals(TargetBy::NAME(), $target->getTargetBy());
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights());

        $type = TargetType::ACCOUNT()->getValue();
        $by = TargetBy::NAME()->getValue();
        $xml = <<<EOT
<?xml version="1.0"?>
<target type="$type" by="$by" key="$key">
    <right>$right1</right>
    <right>$right2</right>
    <right>$right3</right>
</target>
EOT;
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, CheckRightsTargetSpec::class, 'xml'));

        $json = json_encode([
            'type' => $type,
            'by' => $by,
            'key' => $key,
            'right' => [
                [
                    '_content' => $right1,
                ],
                [
                    '_content' => $right2,
                ],
                [
                    '_content' => $right3,
                ],
            ],
        ]);
        $this->assertJsonStringEqualsJsonString($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, CheckRightsTargetSpec::class, 'json'));
    }
}