<?php declare(strict_types=1);

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsTargetSpec;
use Zimbra\Struct\Tests\ZimbraStructTestCase;

/**
 * Testcase class for CheckRightsTargetSpec.
 */
class CheckRightsTargetSpecTest extends ZimbraStructTestCase
{
    public function testCheckRightsTargetSpec()
    {
        $key = $this->faker->word;
        $right1 = $this->faker->word;
        $right2 = $this->faker->word;
        $right3 = $this->faker->word;

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

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key . '">'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
                . '<right>' . $right3 . '</right>'
            . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, $this->serializer->serialize($target, 'xml'));
        $this->assertEquals($target, $this->serializer->deserialize($xml, CheckRightsTargetSpec::class, 'xml'));

        $json = json_encode([
            'type' => TargetType::ACCOUNT(),
            'by' => TargetBy::NAME(),
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
        $this->assertSame($json, $this->serializer->serialize($target, 'json'));
        $this->assertEquals($target, $this->serializer->deserialize($json, CheckRightsTargetSpec::class, 'json'));
    }
}
