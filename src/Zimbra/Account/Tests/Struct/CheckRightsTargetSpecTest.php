<?php

namespace Zimbra\Account\Tests\Struct;

use Zimbra\Account\Tests\ZimbraAccountTestCase;
use Zimbra\Enum\TargetBy;
use Zimbra\Enum\TargetType;
use Zimbra\Account\Struct\CheckRightsTargetSpec;

/**
 * Testcase class for CheckRightsTargetSpec.
 */
class CheckRightsTargetSpecTest extends ZimbraAccountTestCase
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
        $this->assertTrue($target->getTargetType()->is('domain'));
        $this->assertTrue($target->getTargetBy()->is('id'));
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2], $target->getRights()->all());

        $target->setTargetType(TargetType::ACCOUNT())
               ->setTargetBy(TargetBy::NAME())
               ->setTargetKey($key)
               ->addRight($right3);

        $this->assertTrue($target->getTargetType()->is('account'));
        $this->assertTrue($target->getTargetBy()->is('name'));
        $this->assertSame($key, $target->getTargetKey());
        $this->assertSame([$right1, $right2, $right3], $target->getRights()->all());

        $xml = '<?xml version="1.0"?>' . "\n"
            . '<target type="' . TargetType::ACCOUNT() . '" by="' . TargetBy::NAME() . '" key="' . $key . '">'
                . '<right>' . $right1 . '</right>'
                . '<right>' . $right2 . '</right>'
                . '<right>' . $right3 . '</right>'
            . '</target>';
        $this->assertXmlStringEqualsXmlString($xml, (string) $target);

        $array = [
            'target' => [
                'type' => TargetType::ACCOUNT()->value(),
                'by' => TargetBy::NAME()->value(),
                'key' => $key,
                'right' => [
                    $right1,
                    $right2,
                    $right3,
                ],
            ],
        ];
        $this->assertEquals($array, $target->toArray());
    }
}
